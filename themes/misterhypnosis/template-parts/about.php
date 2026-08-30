<?php
/**
 * About Richard Rumble plus the credential list (Magic Castle, guild
 * memberships) the client wants front and centre.
 *
 * @package mrh
 */

$mrh_heading     = mrh_home_field( 'about_heading', __( 'About Richard Rumble', 'mrh' ) );
$mrh_body        = mrh_home_field( 'about_body', '' );
$mrh_image       = mrh_home_field( 'about_image', 0 );
$mrh_credentials = mrh_lines( mrh_home_field( 'credentials_list', '' ) );
?>

<section class="about" id="about">
	<div class="wrap about__inner">
		<div class="about__media">
			<?php
			if ( $mrh_image ) {
				echo wp_get_attachment_image(
					$mrh_image,
					'mrh-portrait',
					false,
					array(
						'class' => 'about__image',
						'alt'   => esc_attr__( 'Richard Rumble in the red suit with pocket watch', 'mrh' ),
					)
				);
			}
			?>
		</div>

		<div class="about__body">
			<h2 class="section-heading"><?php echo esc_html( $mrh_heading ); ?></h2>
			<?php echo wp_kses_post( wpautop( $mrh_body ) ); ?>

			<?php if ( $mrh_credentials ) : ?>
				<h3 class="about__credentials-heading"><?php esc_html_e( 'Credentials & memberships', 'mrh' ); ?></h3>
				<ul class="credentials">
					<?php foreach ( $mrh_credentials as $mrh_credential ) : ?>
						<li><?php echo esc_html( $mrh_credential ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>
