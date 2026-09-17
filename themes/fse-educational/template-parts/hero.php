<?php
/**
 * Hero. The former "spectacle" tagline is deliberately gone: the headline now
 * speaks to K-6 teachers and PTAs, and "Educational" carries the branding.
 *
 * @package fse
 */

$fse_banner  = fse_home_field( 'hero_banner', 0 );
$fse_photo   = fse_home_field( 'hero_photo', 0 );
$fse_kicker  = fse_home_field( 'hero_kicker', __( '★ Serving California schools & libraries since 1994', 'fse' ) );
$fse_heading = fse_home_field( 'hero_heading', 'Assemblies Your Students Love. <em>Paperwork You Can Trust.</em>' );
$fse_intro   = fse_home_field(
	'hero_intro',
	__( 'Hands-on science, character education and magic assemblies for preschools, K–6 schools and public libraries — standards-aligned, Fire Marshal certified, fully insured, and on site with everything we need.', 'fse' )
);
$fse_cta     = fse_home_field( 'hero_cta_label', __( 'Check Your Date', 'fse' ) );
$fse_badge   = fse_home_field( 'hero_badge', __( '1,200+ assemblies booked', 'fse' ) );
?>

<section class="hero<?php echo $fse_photo ? ' hero--has-photo' : ''; ?>" id="top">
	<?php if ( $fse_banner ) : ?>
		<div class="hero__banner">
			<?php
			echo wp_get_attachment_image(
				$fse_banner,
				'fse-banner',
				false,
				array(
					'class'    => 'hero__banner-img',
					'fetchpriority' => 'high',
					'alt'      => esc_attr( get_bloginfo( 'name' ) ),
				)
			);
			?>
		</div>
	<?php endif; ?>

	<div class="wrap hero__inner">
		<div class="hero__content">
			<?php if ( $fse_kicker ) : ?>
				<p class="hero__kicker"><?php echo esc_html( $fse_kicker ); ?></p>
			<?php endif; ?>

			<h1 class="hero__heading"><?php echo wp_kses( $fse_heading, array( 'em' => array() ) ); ?></h1>
			<div class="hero__intro"><?php echo wp_kses_post( wpautop( $fse_intro ) ); ?></div>

			<p class="hero__actions">
				<a class="btn btn--accent btn--lg" href="#contact"><?php echo esc_html( $fse_cta ); ?></a>
				<a class="btn btn--ghost btn--lg" href="#quick-nav"><?php esc_html_e( 'Browse Programs', 'fse' ); ?></a>
			</p>
		</div>

		<?php if ( $fse_photo ) : ?>
			<figure class="hero__figure">
				<?php
				echo wp_get_attachment_image(
					$fse_photo,
					'large',
					false,
					array(
						'fetchpriority' => 'high',
						'alt'           => esc_attr__( 'A Full Spectrum assembly in a school gym', 'fse' ),
					)
				);
				?>

				<?php if ( $fse_badge ) : ?>
					<figcaption class="hero__badge"><?php echo esc_html( $fse_badge ); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endif; ?>

		<ul class="hero__trust">
			<li><strong><?php esc_html_e( '45 minutes of wow', 'fse' ); ?></strong><?php esc_html_e( 'Sized for K-6 attention spans', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'Standards-aligned', 'fse' ); ?></strong><?php esc_html_e( 'Real science behind every laugh', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'We bring everything', 'fse' ); ?></strong><?php esc_html_e( 'Sound, props and clean-up included', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'One invoice, one contact', 'fse' ); ?></strong><?php esc_html_e( 'PO-friendly, W-9 and COI on file', 'fse' ); ?></li>
		</ul>
	</div>
</section>
