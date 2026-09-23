<?php
/**
 * Spam defences for the booking enquiry form.
 *
 * Nothing is ever dropped: a submission that fails these checks is still stored
 * as an Enquiry, marked and left unpublished instead of being mailed out, so a
 * misjudged school inquiry can be recovered from the admin rather than lost.
 *
 * @package fse
 */

const FSE_SPAM_MIN_SECONDS = 4;
const FSE_SPAM_MAX_SECONDS = 6 * HOUR_IN_SECONDS;
const FSE_SPAM_THRESHOLD   = 4;
const FSE_SPAM_SCORE_META  = '_fse_spam_score';
const FSE_SPAM_REASON_META = '_fse_spam_reasons';

/**
 * Sales pitches that arrive through a school booking form. Each costs half the
 * quarantine threshold on its own, so one phrase plus a link is enough and a
 * phrase in an otherwise ordinary enquiry is not.
 *
 * @return string[]
 */
function fse_spam_phrases() {
	return array(
		'web visitors into leads',
		'visitors into leads',
		'lead generation',
		'leadgeneration',
		'boost your traffic',
		'increase your sales',
		'increase your revenue',
		'first page of google',
		'rank higher',
		'search engine optimization',
		'seo services',
		'seo audit',
		'digital marketing agency',
		'social media marketing package',
		'backlink',
		'guest post',
		'link building',
		'web design services',
		'mobile app development',
		'offshore team',
		'dedicated developers',
		'bitcoin',
		'crypto',
		'forex',
		'casino',
		'viagra',
		'payday loan',
		'business loan',
		'work from home',
		'unsubscribe from future',
		'no obligation quote',
		'free trial of our',
		'i came across your website',
		'i was browsing your website',
		'noticed your website',
		'reaching out to see if',
	);
}

/**
 * Signed timestamp proving how long the form was actually open. Signed so a bot
 * cannot post an older time to look human, and so the value survives page
 * caching no worse than the nonce beside it.
 */
function fse_spam_timestamp_field() {
	$now = time();

	printf(
		'<input type="hidden" name="fse_started" value="%s">',
		esc_attr( $now . '|' . wp_hash( $now . '|fse_contact' ) )
	);
}

/**
 * Seconds the form was open, or false when the token is missing or forged.
 *
 * @param string $token Posted token.
 * @return int|false
 */
function fse_spam_token_age( $token ) {
	$parts = explode( '|', (string) $token, 2 );

	if ( 2 !== count( $parts ) || ! ctype_digit( $parts[0] ) ) {
		return false;
	}

	if ( ! hash_equals( wp_hash( $parts[0] . '|fse_contact' ), $parts[1] ) ) {
		return false;
	}

	return time() - (int) $parts[0];
}

/**
 * Counts links of every shape bots use, including the bare-domain and BBCode
 * forms that skip the scheme.
 *
 * @param string $text Text to inspect.
 * @return int
 */
function fse_spam_link_count( $text ) {
	preg_match_all(
		'#(?:https?://|www\.)?\b[a-z0-9-]+\.(?:com|net|org|io|co|uk|ru|cn|xyz|top|biz|info|shop|online|site)\b#i',
		$text,
		$matches
	);

	/* One domain written twice — bare and linked — is still one link. */
	$domains = array_unique(
		array_map(
			function ( $match ) {
				return strtolower( preg_replace( '#^(?:https?://)?(?:www\.)?#i', '', $match ) );
			},
			$matches[0]
		)
	);

	return count( $domains ) + preg_match_all( '#\[url[=\]]|<a\s#i', $text );
}

/**
 * Scores a submission. Higher is more likely to be a bot; anything at or above
 * FSE_SPAM_THRESHOLD is quarantined rather than mailed.
 *
 * @param array<string, string> $values Sanitized field values.
 * @param int|false             $age    Seconds the form was open.
 * @return array{score:int, reasons:string[]}
 */
function fse_spam_score( $values, $age ) {
	$score   = 0;
	$reasons = array();

	if ( false === $age ) {
		$score    += 4;
		$reasons[] = 'no valid timing token';
	} elseif ( $age < FSE_SPAM_MIN_SECONDS ) {
		$score    += 4;
		$reasons[] = sprintf( 'submitted in %ds', $age );
	} elseif ( $age > FSE_SPAM_MAX_SECONDS ) {
		$score    += 2;
		$reasons[] = 'form open for hours';
	}

	$message = isset( $values['message'] ) ? $values['message'] : '';
	$links   = fse_spam_link_count( $message );

	if ( $links > 0 ) {
		$score    += 3 + min( $links - 1, 2 );
		$reasons[] = sprintf( '%d link(s) in the message', $links );
	}

	/* A school name or a person's name never contains a link. */
	foreach ( array( 'first_name', 'last_name', 'organization' ) as $field ) {
		$value = isset( $values[ $field ] ) ? $values[ $field ] : '';

		if ( '' !== $value && ( fse_spam_link_count( $value ) > 0 || str_contains( $value, '@' ) ) ) {
			$score    += 4;
			$reasons[] = sprintf( 'link or address in %s', $field );
			break;
		}
	}

	$haystack = strtolower( implode( ' ', $values ) );

	foreach ( fse_spam_phrases() as $phrase ) {
		if ( str_contains( $haystack, $phrase ) ) {
			$score    += 2;
			$reasons[] = sprintf( 'pitch phrase "%s"', $phrase );
		}
	}

	if ( preg_match( '#<[a-z/][^>]*>#i', $message ) ) {
		$score    += 3;
		$reasons[] = 'HTML in the message';
	}

	return array(
		'score'   => $score,
		'reasons' => $reasons,
	);
}

/**
 * Turnstile stays dormant until both keys are defined in wp-config, so the form
 * keeps working on any install that has not been given a Cloudflare account.
 */
function fse_spam_turnstile_enabled() {
	return defined( 'FSE_TURNSTILE_SITE_KEY' ) && FSE_TURNSTILE_SITE_KEY
		&& defined( 'FSE_TURNSTILE_SECRET_KEY' ) && FSE_TURNSTILE_SECRET_KEY;
}

function fse_spam_turnstile_field() {
	if ( ! fse_spam_turnstile_enabled() ) {
		return;
	}

	wp_enqueue_script(
		'cloudflare-turnstile',
		'https://challenges.cloudflare.com/turnstile/v0/api.js',
		array(),
		null,
		true
	);

	printf(
		'<div class="form__turnstile cf-turnstile" data-sitekey="%s" data-theme="light"></div>',
		esc_attr( FSE_TURNSTILE_SITE_KEY )
	);
}

/**
 * Verifies the Turnstile response. A network failure returns true: an outage at
 * Cloudflare must not stop a school from booking an assembly.
 *
 * @param string $token Posted Turnstile response token.
 */
function fse_spam_turnstile_passes( $token ) {
	if ( ! fse_spam_turnstile_enabled() ) {
		return true;
	}

	if ( '' === $token ) {
		return false;
	}

	$response = wp_remote_post(
		'https://challenges.cloudflare.com/turnstile/v0/siteverify',
		array(
			'timeout' => 10,
			'body'    => array(
				'secret'   => FSE_TURNSTILE_SECRET_KEY,
				'response' => $token,
				'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return true;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	return ! empty( $body['success'] );
}

/**
 * Flags quarantined enquiries in the admin list so nothing sits unnoticed in
 * draft, and a false positive is one click from being answered.
 */
add_filter(
	'manage_' . FSE_ENQUIRY_POST_TYPE . '_posts_columns',
	function ( $columns ) {
		$columns['fse_spam'] = __( 'Spam check', 'fse' );

		return $columns;
	}
);

add_action(
	'manage_' . FSE_ENQUIRY_POST_TYPE . '_posts_custom_column',
	function ( $column, $post_id ) {
		if ( 'fse_spam' !== $column ) {
			return;
		}

		$score = get_post_meta( $post_id, FSE_SPAM_SCORE_META, true );

		if ( '' === $score || (int) $score < FSE_SPAM_THRESHOLD ) {
			esc_html_e( 'Clean', 'fse' );

			return;
		}

		printf(
			'<strong>%s</strong><br><span class="description">%s</span>',
			esc_html__( 'Held as spam', 'fse' ),
			esc_html( (string) get_post_meta( $post_id, FSE_SPAM_REASON_META, true ) )
		);
	},
	10,
	2
);
