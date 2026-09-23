<?php
/**
 * Booking form. Submissions are stored as Enquiries before the notification is
 * mailed, so a mail routing problem can never lose a booking lead.
 *
 * @package mrh
 */

const MRH_ENQUIRY_POST_TYPE = 'mrh_enquiry';

add_action(
	'init',
	function () {
		register_post_type(
			MRH_ENQUIRY_POST_TYPE,
			array(
				'labels'       => array(
					'name'          => __( 'Enquiries', 'mrh' ),
					'singular_name' => __( 'Enquiry', 'mrh' ),
					'menu_name'     => __( 'Enquiries', 'mrh' ),
				),
				'public'       => false,
				'show_ui'      => true,
				'menu_icon'    => 'dashicons-email-alt',
				'menu_position'=> 3,
				'supports'     => array( 'title', 'editor' ),
				'capabilities' => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap' => true,
			)
		);
	}
);

/**
 * Event types offered in the booking form.
 *
 * @return string[]
 */
function mrh_event_types() {
	return array(
		__( 'Grad Night', 'mrh' ),
		__( 'Prom or school dance', 'mrh' ),
		__( 'High school assembly', 'mrh' ),
		__( 'College event', 'mrh' ),
		__( 'Corporate event', 'mrh' ),
		__( 'Fair or festival', 'mrh' ),
		__( 'Private party', 'mrh' ),
		__( 'Magic / strolling magic', 'mrh' ),
		__( 'Something else', 'mrh' ),
	);
}

/**
 * Booking form fields.
 *
 * @return array<string, array<string, mixed>>
 */
function mrh_form_fields() {
	return array(
		'name'         => array(
			'label'    => __( 'Name', 'mrh' ),
			'type'     => 'text',
			'required' => true,
		),
		'organization' => array(
			'label'    => __( 'School or company', 'mrh' ),
			'type'     => 'text',
			'required' => false,
		),
		'email'        => array(
			'label'    => __( 'Email', 'mrh' ),
			'type'     => 'email',
			'required' => true,
		),
		'phone'        => array(
			'label'    => __( 'Phone', 'mrh' ),
			'type'     => 'tel',
			'required' => false,
		),
		'event_type'   => array(
			'label'    => __( 'Event type', 'mrh' ),
			'type'     => 'select',
			'required' => true,
		),
		'event_date'   => array(
			'label'    => __( 'Date of event', 'mrh' ),
			'type'     => 'date',
			'required' => false,
			'hint'     => __( 'Optional — an approximate date is fine.', 'mrh' ),
		),
		'venue'        => array(
			'label'    => __( 'Venue or city', 'mrh' ),
			'type'     => 'text',
			'required' => false,
		),
		'message'      => array(
			'label'    => __( 'Tell us about your event', 'mrh' ),
			'type'     => 'textarea',
			'required' => false,
			'hint'     => __( 'Audience size, age group, indoor or outdoor, start time.', 'mrh' ),
		),
	);
}

/**
 * Notification recipients.
 *
 * @return string[]
 */
function mrh_form_recipients() {
	$raw    = (string) mrh_home_field( 'contact_recipients', get_option( 'admin_email' ) );
	$emails = array_filter( array_map( 'trim', explode( ',', $raw ) ), 'is_email' );

	return $emails ? array_values( $emails ) : array( get_option( 'admin_email' ) );
}

add_action(
	'init',
	function () {
		if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) || ! isset( $_POST['mrh_booking'] ) ) {
			return;
		}

		$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );
		$redirect = remove_query_arg( array( 'mrh_sent', 'mrh_error' ), $redirect );

		if ( ! isset( $_POST['mrh_booking_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mrh_booking_nonce'] ) ), 'mrh_booking' ) ) {
			wp_safe_redirect( add_query_arg( 'mrh_error', 'expired', $redirect ) . '#booking' );
			exit;
		}

		if ( ! empty( $_POST['mrh_website'] ) ) {
			wp_safe_redirect( add_query_arg( 'mrh_sent', '1', $redirect ) . '#booking' );
			exit;
		}

		$values = array();

		foreach ( mrh_form_fields() as $name => $field ) {
			$raw = isset( $_POST[ $name ] ) ? wp_unslash( $_POST[ $name ] ) : '';

			if ( 'email' === $field['type'] ) {
				$values[ $name ] = sanitize_email( $raw );
			} elseif ( 'textarea' === $field['type'] ) {
				$values[ $name ] = sanitize_textarea_field( $raw );
			} else {
				$values[ $name ] = sanitize_text_field( $raw );
			}

			if ( $field['required'] && '' === $values[ $name ] ) {
				wp_safe_redirect( add_query_arg( 'mrh_error', 'required', $redirect ) . '#booking' );
				exit;
			}
		}

		if ( ! is_email( $values['email'] ) ) {
			wp_safe_redirect( add_query_arg( 'mrh_error', 'email', $redirect ) . '#booking' );
			exit;
		}

		if ( ! mrh_spam_turnstile_passes( isset( $_POST['cf-turnstile-response'] ) ? sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) ) : '' ) ) {
			wp_safe_redirect( add_query_arg( 'mrh_error', 'challenge', $redirect ) . '#booking' );
			exit;
		}

		$spam = mrh_spam_score(
			$values,
			mrh_spam_token_age( isset( $_POST['mrh_started'] ) ? sanitize_text_field( wp_unslash( $_POST['mrh_started'] ) ) : '' )
		);

		$held = $spam['score'] >= MRH_SPAM_THRESHOLD;

		$lines = array();

		foreach ( mrh_form_fields() as $key => $field ) {
			if ( '' !== $values[ $key ] ) {
				$lines[] = $field['label'] . ': ' . $values[ $key ];
			}
		}

		$body = implode( "\n", $lines );

		wp_insert_post(
			array(
				'post_type'    => MRH_ENQUIRY_POST_TYPE,
				'post_status'  => $held ? 'draft' : 'publish',
				'post_title'   => sprintf( '%s — %s', $values['name'], $values['event_type'] ),
				'post_content' => $body,
				'meta_input'   => array(
					MRH_SPAM_SCORE_META  => $spam['score'],
					MRH_SPAM_REASON_META => implode( '; ', $spam['reasons'] ),
				),
			)
		);

		/*
		 * A held submission is kept and marked, never mailed and never bounced
		 * back at the sender: a bot learns nothing from the response, and a real
		 * enquiry that trips the filter still reaches the admin.
		 */
		if ( $held ) {
			wp_safe_redirect( add_query_arg( 'mrh_sent', '1', $redirect ) . '#booking' );
			exit;
		}

		wp_mail(
			mrh_form_recipients(),
			sprintf(
				/* translators: 1: enquirer name, 2: event type. */
				__( 'Booking enquiry: %1$s (%2$s)', 'mrh' ),
				$values['name'],
				$values['event_type']
			),
			$body,
			array(
				'Content-Type: text/plain; charset=UTF-8',
				sprintf( 'Reply-To: %s <%s>', $values['name'], $values['email'] ),
			)
		);

		wp_safe_redirect( add_query_arg( 'mrh_sent', '1', $redirect ) . '#booking' );
		exit;
	}
);

/**
 * Send from the site's own domain so Microsoft 365 and Proofpoint do not reject
 * the notification on SPF or DMARC alignment.
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
