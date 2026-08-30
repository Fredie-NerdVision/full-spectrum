<?php
/**
 * Hero. The former "spectacle" tagline is deliberately gone: the headline now
 * speaks to K-6 teachers and PTAs, and "Educational" carries the branding.
 *
 * @package fse
 */

$fse_banner  = fse_home_field( 'hero_banner', 0 );
$fse_heading = fse_home_field( 'hero_heading', __( 'Bubbles, Lightning And Magic — The Assembly Your Students Talk About All Week', 'fse' ) );
$fse_intro   = fse_home_field(
	'hero_intro',
	__( 'Full Spectrum brings hands-on science, character-building and magic assemblies to K-6 schools and libraries across Southern California. Loud, funny, a little messy — and quietly full of standards-aligned learning.', 'fse' )
);
$fse_cta     = fse_home_field( 'hero_cta_label', __( 'Check Your Date', 'fse' ) );
?>

<section class="hero" id="top">
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
			<h1 class="hero__heading"><?php echo esc_html( $fse_heading ); ?></h1>
			<div class="hero__intro"><?php echo wp_kses_post( wpautop( $fse_intro ) ); ?></div>

			<p class="hero__actions">
				<a class="btn btn--accent btn--lg" href="#contact"><?php echo esc_html( $fse_cta ); ?></a>
				<a class="btn btn--ghost btn--lg" href="#quick-nav"><?php esc_html_e( 'Browse Programs', 'fse' ); ?></a>
			</p>
		</div>

		<ul class="hero__trust">
			<li><strong><?php esc_html_e( '45 minutes of wow', 'fse' ); ?></strong><?php esc_html_e( 'Sized for K-6 attention spans', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'Standards-aligned', 'fse' ); ?></strong><?php esc_html_e( 'Real science behind every laugh', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'We bring everything', 'fse' ); ?></strong><?php esc_html_e( 'Sound, props and clean-up included', 'fse' ); ?></li>
		</ul>
	</div>
</section>
