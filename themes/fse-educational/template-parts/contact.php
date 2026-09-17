<?php
/**
 * Booking enquiry form.
 *
 * @package fse
 */

$fse_heading = fse_home_field( 'contact_heading', __( 'Check Your Date', 'fse' ) );
$fse_intro   = fse_home_field(
	'contact_intro',
	__( 'Tell us the date, the grade levels and roughly how many students, and we will confirm availability and pricing.', 'fse' )
);
$fse_phone   = fse_home_field( 'footer_phone', '(949) 496-6244' );
$fse_sent    = isset( $_GET['fse_sent'] );
$fse_error   = isset( $_GET['fse_error'] ) ? sanitize_key( wp_unslash( $_GET['fse_error'] ) ) : '';
?>

<section class="contact" id="contact">
	<div class="wrap contact__inner">
		<div class="contact__intro">
			<h2 class="section-heading"><?php echo esc_html( $fse_heading ); ?></h2>
			<div class="section-intro"><?php echo wp_kses_post( wpautop( $fse_intro ) ); ?></div>

			<?php if ( $fse_phone ) : ?>
				<p>
					<a class="contact__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $fse_phone ) ); ?>">
						<?php echo esc_html( $fse_phone ); ?>
					</a>
				</p>
			<?php endif; ?>

			<ul class="contact__facts">
				<li><?php esc_html_e( 'Serving preschools, public libraries and K–12 schools throughout California.', 'fse' ); ?></li>
				<li><?php esc_html_e( 'Peak seasons book early: August–October and January–April.', 'fse' ); ?></li>
				<li><?php esc_html_e( 'Purchase orders welcome — W-9 and certificate of insurance on request.', 'fse' ); ?></li>
			</ul>
		</div>

		<div class="contact__form-wrap">
			<?php if ( $fse_sent ) : ?>
				<p class="notice notice--success" role="status">
					<?php echo esc_html( fse_home_field( 'contact_success', __( 'Thank you — we have your request and will reply within one business day.', 'fse' ) ) ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $fse_error ) : ?>
				<p class="notice notice--error" role="alert">
					<?php
					if ( 'email' === $fse_error ) {
						esc_html_e( 'That email address does not look right — please check it and send again.', 'fse' );
					} elseif ( 'expired' === $fse_error ) {
						esc_html_e( 'The form timed out. Please send it once more.', 'fse' );
					} else {
						esc_html_e( 'Please complete the required fields.', 'fse' );
					}
					?>
				</p>
			<?php endif; ?>

			<form class="form" method="post" action="<?php echo esc_url( home_url( '/' ) ); ?>#contact" novalidate>
				<?php wp_nonce_field( 'fse_contact', 'fse_contact_nonce' ); ?>
				<input type="hidden" name="fse_contact" value="1">

				<p class="form__honeypot" aria-hidden="true">
					<label for="fse_website"><?php esc_html_e( 'Website', 'fse' ); ?></label>
					<input type="text" id="fse_website" name="fse_website" tabindex="-1" autocomplete="off">
				</p>

				<?php foreach ( fse_contact_fields() as $fse_name => $fse_field ) : ?>
					<?php
					$fse_id      = 'fse-' . str_replace( '_', '-', $fse_name );
					$fse_classes = 'form__row';

					if ( in_array( $fse_name, array( 'first_name', 'last_name', 'email', 'phone', 'event_date', 'service' ), true ) ) {
						$fse_classes .= ' form__row--half';
					}
					?>
					<div class="<?php echo esc_attr( $fse_classes ); ?>">
						<label class="form__label" for="<?php echo esc_attr( $fse_id ); ?>">
							<?php echo esc_html( $fse_field['label'] ); ?>
							<?php if ( $fse_field['required'] ) : ?>
								<span class="form__required" aria-hidden="true">*</span>
								<span class="screen-reader-text"><?php esc_html_e( '(required)', 'fse' ); ?></span>
							<?php endif; ?>
						</label>

						<?php if ( 'textarea' === $fse_field['type'] ) : ?>
							<textarea class="form__input" id="<?php echo esc_attr( $fse_id ); ?>" name="<?php echo esc_attr( $fse_name ); ?>" rows="5"<?php echo $fse_field['required'] ? ' required' : ''; ?>></textarea>
						<?php elseif ( 'select' === $fse_field['type'] ) : ?>
							<select class="form__input" id="<?php echo esc_attr( $fse_id ); ?>" name="<?php echo esc_attr( $fse_name ); ?>">
								<option value=""><?php esc_html_e( 'Select one', 'fse' ); ?></option>
								<?php foreach ( fse_service_groups() as $fse_label ) : ?>
									<option value="<?php echo esc_attr( $fse_label ); ?>"><?php echo esc_html( $fse_label ); ?></option>
								<?php endforeach; ?>
								<option value="<?php esc_attr_e( 'Something else', 'fse' ); ?>"><?php esc_html_e( 'Something else', 'fse' ); ?></option>
							</select>
						<?php else : ?>
							<input class="form__input" type="<?php echo esc_attr( $fse_field['type'] ); ?>" id="<?php echo esc_attr( $fse_id ); ?>" name="<?php echo esc_attr( $fse_name ); ?>"<?php echo $fse_field['required'] ? ' required' : ''; ?>>
						<?php endif; ?>

						<?php if ( ! empty( $fse_field['hint'] ) ) : ?>
							<span class="form__hint"><?php echo esc_html( $fse_field['hint'] ); ?></span>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>

				<div class="form__actions">
					<button class="btn btn--accent btn--lg" type="submit"><?php esc_html_e( 'Send Request', 'fse' ); ?></button>
					<span class="form__hint">
						<?php
						/* translators: %s: business phone number. */
						printf( esc_html__( 'Prefer the phone? Call %s.', 'fse' ), esc_html( $fse_phone ) );
						?>
					</span>
				</div>
			</form>
		</div>
	</div>
</section>
