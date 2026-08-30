<?php
/**
 * Credibility section aimed at administrators and library coordinators.
 *
 * @package fse
 */

$fse_heading = fse_home_field( 'credentials_heading', __( 'Booked With Confidence By California Educators', 'fse' ) );
$fse_body    = fse_home_field(
	'credentials_body',
	'<p>' . esc_html__( 'Every program is presented by credentialed-educator-reviewed performers using NASA and JPL assets, safe demonstration equipment and setups certified by municipal Fire Marshals. Our portable planetarium has been showcased at the Anaheim PTA Convention and the Pasadena Civic Auditorium for the AIAA Foundation.', 'fse' ) . '</p>'
);
$fse_image   = fse_home_field( 'credentials_image', 0 );
?>

<section class="credentials" id="credentials">
	<div class="wrap credentials__inner">
		<div class="credentials__text">
			<h2 class="section-heading"><?php echo esc_html( $fse_heading ); ?></h2>
			<div class="prose"><?php echo wp_kses_post( $fse_body ); ?></div>
		</div>

		<?php if ( $fse_image ) : ?>
			<figure class="credentials__figure">
				<?php echo wp_get_attachment_image( $fse_image, 'large', false, array( 'loading' => 'lazy' ) ); ?>
			</figure>
		<?php endif; ?>
	</div>
</section>
