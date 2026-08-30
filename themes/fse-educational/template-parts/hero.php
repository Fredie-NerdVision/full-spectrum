<?php
/**
 * Hero. The former "spectacle" tagline is deliberately gone: the headline now
 * speaks to school administrators, and "Educational" carries the branding.
 *
 * @package fse
 */

$fse_banner  = fse_home_field( 'hero_banner', 0 );
$fse_heading = fse_home_field( 'hero_heading', __( 'Curriculum-Aligned Assemblies That Students Remember', 'fse' ) );
$fse_intro   = fse_home_field(
	'hero_intro',
	__( 'Full Spectrum Educational Services brings NGSS-aligned STEM, literacy, character-building and conservation programs to California preschools, libraries and schools — presented by performers who have been doing this for three decades.', 'fse' )
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
			<li><strong><?php esc_html_e( 'NGSS-aligned', 'fse' ); ?></strong><?php esc_html_e( 'Science & STEM assemblies', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'Fire Marshal certified', 'fse' ); ?></strong><?php esc_html_e( 'Portable planetarium domes', 'fse' ); ?></li>
			<li><strong><?php esc_html_e( 'Preschool to high school', 'fse' ); ?></strong><?php esc_html_e( 'Libraries, districts & PTAs statewide', 'fse' ); ?></li>
		</ul>
	</div>
</section>
