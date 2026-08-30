<?php
/**
 * Site footer.
 *
 * @package fse
 */

$fse_phone   = fse_home_field( 'footer_phone', '(949) 496-6244' );
$fse_email   = fse_home_field( 'footer_email', 'programs@full-spectrum.org' );
$fse_address = fse_home_field( 'footer_address', 'P.O. Box 596, Dana Point, CA 92629' );
?>
</main>

<footer class="site-footer">
	<div class="wrap site-footer__inner">
		<div class="site-footer__brand">
			<span class="lockup lockup--footer">
				<span class="lockup__top"><?php esc_html_e( 'Full Spectrum', 'fse' ); ?></span>
				<strong class="lockup__emphasis"><?php esc_html_e( 'Educational', 'fse' ); ?></strong>
				<span class="lockup__bottom"><?php esc_html_e( 'Services', 'fse' ); ?></span>
			</span>
			<p class="site-footer__slogan"><?php echo esc_html( fse_home_field( 'footer_tagline', 'Creating Good Times And Great Memories Is What We Do Best' ) ); ?></p>
			<p class="site-footer__slogan site-footer__slogan--alt"><?php echo esc_html( fse_home_field( 'footer_secondary_tagline', 'Once A Customer, Always A Friend' ) ); ?></p>
		</div>

		<div class="site-footer__contact">
			<h2 class="site-footer__heading"><?php esc_html_e( 'Booking', 'fse' ); ?></h2>
			<p>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $fse_phone ) ); ?>"><?php echo esc_html( $fse_phone ); ?></a><br>
				<a href="mailto:<?php echo esc_attr( $fse_email ); ?>"><?php echo esc_html( $fse_email ); ?></a><br>
				<?php echo esc_html( $fse_address ); ?>
			</p>
		</div>

		<div class="site-footer__links">
			<h2 class="site-footer__heading"><?php esc_html_e( 'Our Other Services', 'fse' ); ?></h2>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'site-footer__menu',
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul class="site-footer__menu">
					<li><a href="https://www.fullspectrument.com"><?php esc_html_e( 'Corporate & Private Events', 'fse' ); ?></a></li>
					<li><a href="https://www.misterhypnosis.com"><?php esc_html_e( 'Mister Hypnosis — Grad Nights', 'fse' ); ?></a></li>
					<li><a href="https://dreamshapers.org"><?php esc_html_e( 'Dream Shapers Performing Arts', 'fse' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>
	</div>

	<div class="wrap site-footer__legal">
		<p>
			<?php
			printf(
				/* translators: %1$s: year, %2$s: site name. */
				esc_html__( '© %1$s %2$s. All rights reserved.', 'fse' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>
		<p><?php esc_html_e( 'Designed by NerdVision', 'fse' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
