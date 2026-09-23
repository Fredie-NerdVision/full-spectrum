<?php
/**
 * Booking enquiry form: stores every submission before mailing it, so a mail
 * routing failure can never lose a lead during peak booking season.
 *
 * @package fse
 */

const FSE_ENQUIRY_POST_TYPE = 'fse_enquiry';

add_action(
	'init',
	function () {
		register_post_type(
			FSE_ENQUIRY_POST_TYPE,
			array(
				'labels'          => array(
					'name'          => __( 'Enquiries', 'fse' ),
					'singular_name' => __( 'Enquiry', 'fse' ),
					'menu_name'     => __( 'Enquiries', 'fse' ),
				),
				'public'          => false,
				'show_ui'         => true,
				'menu_icon'       => 'dashicons-email-alt',
				'menu_position'   => 5,
				'supports'        => array( 'title', 'editor' ),
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

/**
 * Form field definitions, shared by the renderer and the handler.
 *
 * @return array<string, array<string, mixed>>
 */
function fse_contact_fields() {
	return array(
		'first_name'   => array(
			'label'    => __( 'First name', 'fse' ),
			'type'     => 'text',
			'required' => true,
		),
		'last_name'    => array(
			'label'    => __( 'Last name', 'fse' ),
			'type'     => 'text',
			'required' => true,
		),
		'organization' => array(
			'label'    => __( 'School, library or organization', 'fse' ),
			'type'     => 'text',
			'required' => false,
		),
		'email'        => array(
			'label'    => __( 'Email', 'fse' ),
			'type'     => 'email',
			'required' => true,
		),
		'phone'        => array(
			'label'    => __( 'Phone', 'fse' ),
			'type'     => 'tel',
			'required' => false,
		),
		'event_date'   => array(
			'label'    => __( 'Date of event', 'fse' ),
			'type'     => 'date',
			'required' => false,
			'hint'     => __( 'Optional — an approximate date is fine.', 'fse' ),
		),
		'service'      => array(
			'label'    => __( 'What are you planning?', 'fse' ),
			'type'     => 'select',
			'required' => false,
		),
		'message'      => array(
			'label'    => __( 'Tell us about your event', 'fse' ),
			'type'     => 'textarea',
			'required' => false,
			'hint'     => __( 'Grade levels, number of students, indoor or outdoor, time of day.', 'fse' ),
		),
	);
}

/**
 * Recipients for enquiry notifications.
 *
 * @return string[]
 */
function fse_contact_recipients() {
	$raw = (string) fse_home_field( 'contact_recipients', get_option( 'admin_email' ) );

	$emails = array_filter( array_map( 'trim', explode( ',', $raw ) ), 'is_email' );

	return $emails ? array_values( $emails ) : array( get_option( 'admin_email' ) );
}

add_action(
	'init',
	function () {
		if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) || ! isset( $_POST['fse_contact'] ) ) {
			return;
		}

		$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );
		$redirect = remove_query_arg( array( 'fse_sent', 'fse_error' ), $redirect );

		if ( ! isset( $_POST['fse_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fse_contact_nonce'] ) ), 'fse_contact' ) ) {
			wp_safe_redirect( add_query_arg( 'fse_error', 'expired', $redirect ) . '#contact' );
			exit;
		}

		// Honeypot: bots fill hidden fields, humans do not.
		if ( ! empty( $_POST['fse_website'] ) ) {
			wp_safe_redirect( add_query_arg( 'fse_sent', '1', $redirect ) . '#contact' );
			exit;
		}

		$values = array();

		foreach ( fse_contact_fields() as $name => $field ) {
			$raw = isset( $_POST[ $name ] ) ? wp_unslash( $_POST[ $name ] ) : '';

			if ( 'email' === $field['type'] ) {
				$values[ $name ] = sanitize_email( $raw );
			} elseif ( 'textarea' === $field['type'] ) {
				$values[ $name ] = sanitize_textarea_field( $raw );
			} else {
				$values[ $name ] = sanitize_text_field( $raw );
			}

			if ( $field['required'] && '' === $values[ $name ] ) {
				wp_safe_redirect( add_query_arg( 'fse_error', 'required', $redirect ) . '#contact' );
				exit;
			}
		}

		if ( ! is_email( $values['email'] ) ) {
			wp_safe_redirect( add_query_arg( 'fse_error', 'email', $redirect ) . '#contact' );
			exit;
		}

		if ( ! fse_spam_turnstile_passes( isset( $_POST['cf-turnstile-response'] ) ? sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) ) : '' ) ) {
			wp_safe_redirect( add_query_arg( 'fse_error', 'challenge', $redirect ) . '#contact' );
			exit;
		}

		$spam = fse_spam_score(
			$values,
			fse_spam_token_age( isset( $_POST['fse_started'] ) ? sanitize_text_field( wp_unslash( $_POST['fse_started'] ) ) : '' )
		);

		$held = $spam['score'] >= FSE_SPAM_THRESHOLD;

		$name  = trim( $values['first_name'] . ' ' . $values['last_name'] );
		$lines = array();

		foreach ( fse_contact_fields() as $key => $field ) {
			if ( '' !== $values[ $key ] ) {
				$lines[] = $field['label'] . ': ' . $values[ $key ];
			}
		}

		$body = implode( "\n", $lines );

		wp_insert_post(
			array(
				'post_type'    => FSE_ENQUIRY_POST_TYPE,
				'post_status'  => $held ? 'draft' : 'publish',
				'post_title'   => sprintf(
					/* translators: 1: enquirer name, 2: organization or service. */
					__( '%1$s — %2$s', 'fse' ),
					$name,
					$values['organization'] ? $values['organization'] : $values['service']
				),
				'post_content' => $body,
				'meta_input'   => array(
					FSE_SPAM_SCORE_META  => $spam['score'],
					FSE_SPAM_REASON_META => implode( '; ', $spam['reasons'] ),
				),
			)
		);

		/*
		 * A held submission is kept and marked, never mailed and never bounced
		 * back at the sender: a bot learns nothing from the response, and a
		 * school that trips the filter still reaches the admin.
		 */
		if ( $held ) {
			wp_safe_redirect( add_query_arg( 'fse_sent', '1', $redirect ) . '#contact' );
			exit;
		}

		$headers = array(
			'Content-Type: text/plain; charset=UTF-8',
			sprintf( 'Reply-To: %s <%s>', $name, $values['email'] ),
		);

		wp_mail(
			fse_contact_recipients(),
			sprintf(
				/* translators: 1: enquirer name, 2: service requested. */
				__( 'Website enquiry: %1$s (%2$s)', 'fse' ),
				$name,
				$values['service'] ? $values['service'] : __( 'general', 'fse' )
			),
			$body,
			$headers
		);

		wp_safe_redirect( add_query_arg( 'fse_sent', '1', $redirect ) . '#contact' );
		exit;
	}
);

/**
 * Send notifications from an address on the site's own domain so SPF and DMARC
 * checks pass at Microsoft 365 and the mail is not silently dropped.
 */
add_filter(
	'wp_mail_from',
	function ( $from ) {
		$host = wp_parse_url( home_url(), PHP_URL_HOST );

		if ( ! $host ) {
			return $from;
		}

		return 'website@' . preg_replace( '/^www\./', '', $host );
	}
);

add_filter(
	'wp_mail_from_name',
	function () {
		return get_bloginfo( 'name' );
	}
);
