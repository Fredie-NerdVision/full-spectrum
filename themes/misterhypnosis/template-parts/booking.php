<?php
/**
 * Booking form section.
 *
 * @package mrh
 */

$mrh_heading = mrh_home_field( 'contact_heading', __( 'Check your date', 'mrh' ) );
$mrh_intro   = mrh_home_field( 'contact_intro', '' );
$mrh_success = mrh_home_field( 'contact_success', __( 'Thank you — your enquiry is in. Sandee or Richard will reply within one business day.', 'mrh' ) );
$mrh_phone   = mrh_home_field( 'footer_phone', '(949) 496-6244' );
$mrh_sent    = isset( $_GET['mrh_sent'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.
$mrh_error   = isset( $_GET['mrh_error'] ) ? sanitize_key( wp_unslash( $_GET['mrh_error'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display only.

$mrh_errors = array(
	'required' => __( 'Please fill in your name, email and event type.', 'mrh' ),
	'email'    => __( 'That email address does not look right — please check it.', 'mrh' ),
	'expired'  => __( 'The form timed out. Please send it once more.', 'mrh' ),
);
?>

<section class="booking" id="booking">
	<div class="wrap booking__inner">
		<div class="booking__intro">
			<h2 class="section-heading"><?php echo esc_html( $mrh_heading ); ?></h2>
			<?php echo wp_kses_post( wpautop( $mrh_intro ) ); ?>

			<p class="booking__phone">
				<?php esc_html_e( 'Prefer to talk it through?', 'mrh' ); ?>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $mrh_phone ) ); ?>"><?php echo esc_html( $mrh_phone ); ?></a>
			</p>
		</div>

		<div class="booking__form-wrap">
			<?php if ( $mrh_sent ) : ?>
				<p class="notice notice--ok" role="status"><?php echo esc_html( $mrh_success ); ?></p>
			<?php endif; ?>

			<?php if ( $mrh_error ) : ?>
				<p class="notice notice--error" role="alert">
					<?php echo esc_html( $mrh_errors[ $mrh_error ] ?? __( 'Something went wrong — please try again.', 'mrh' ) ); ?>
				</p>
			<?php endif; ?>

			<form class="form" method="post" action="<?php echo esc_url( home_url( '/' ) ); ?>#booking">
				<?php wp_nonce_field( 'mrh_booking', 'mrh_booking_nonce' ); ?>
				<input type="hidden" name="mrh_booking" value="1">

				<p class="form__honeypot" aria-hidden="true">
					<label for="mrh-website"><?php esc_html_e( 'Leave this field empty', 'mrh' ); ?></label>
					<input type="text" id="mrh-website" name="mrh_website" tabindex="-1" autocomplete="off">
				</p>

				<?php foreach ( mrh_form_fields() as $mrh_name => $mrh_field ) : ?>
					<?php $mrh_id = 'mrh-' . str_replace( '_', '-', $mrh_name ); ?>
					<p class="form__row form__row--<?php echo esc_attr( $mrh_field['type'] ); ?>">
						<label for="<?php echo esc_attr( $mrh_id ); ?>">
							<?php echo esc_html( $mrh_field['label'] ); ?>
							<?php if ( $mrh_field['required'] ) : ?>
								<span class="form__required" aria-hidden="true">*</span>
							<?php else : ?>
								<span class="form__optional"><?php esc_html_e( '(optional)', 'mrh' ); ?></span>
							<?php endif; ?>
						</label>

						<?php if ( ! empty( $mrh_field['hint'] ) ) : ?>
							<span class="form__hint" id="<?php echo esc_attr( $mrh_id ); ?>-hint"><?php echo esc_html( $mrh_field['hint'] ); ?></span>
						<?php endif; ?>

						<?php if ( 'textarea' === $mrh_field['type'] ) : ?>
							<textarea
								id="<?php echo esc_attr( $mrh_id ); ?>"
								name="<?php echo esc_attr( $mrh_name ); ?>"
								rows="5"
								<?php echo empty( $mrh_field['hint'] ) ? '' : 'aria-describedby="' . esc_attr( $mrh_id ) . '-hint"'; ?>
								<?php echo $mrh_field['required'] ? 'required' : ''; ?>
							></textarea>
						<?php elseif ( 'select' === $mrh_field['type'] ) : ?>
							<select id="<?php echo esc_attr( $mrh_id ); ?>" name="<?php echo esc_attr( $mrh_name ); ?>" <?php echo $mrh_field['required'] ? 'required' : ''; ?>>
								<option value=""><?php esc_html_e( 'Please choose…', 'mrh' ); ?></option>
								<?php foreach ( mrh_event_types() as $mrh_type ) : ?>
									<option value="<?php echo esc_attr( $mrh_type ); ?>"><?php echo esc_html( $mrh_type ); ?></option>
								<?php endforeach; ?>
							</select>
						<?php else : ?>
							<input
								type="<?php echo esc_attr( $mrh_field['type'] ); ?>"
								id="<?php echo esc_attr( $mrh_id ); ?>"
								name="<?php echo esc_attr( $mrh_name ); ?>"
								<?php echo empty( $mrh_field['hint'] ) ? '' : 'aria-describedby="' . esc_attr( $mrh_id ) . '-hint"'; ?>
								<?php echo $mrh_field['required'] ? 'required' : ''; ?>
							>
						<?php endif; ?>
					</p>
				<?php endforeach; ?>

				<p class="form__actions">
					<button class="btn btn--gold btn--lg" type="submit"><?php esc_html_e( 'Send booking enquiry', 'mrh' ); ?></button>
				</p>
			</form>
		</div>
	</div>
</section>
