<?php
/**
 * Site footer.
 *
 * @package mrh
 */

$mrh_phone     = mrh_home_field( 'footer_phone', '(714) 322-0207' );
$mrh_email     = mrh_home_field( 'footer_email', 'richard@misterhypnosis.com' );
$mrh_address   = mrh_home_field( 'footer_address', 'P.O. Box 596, Dana Point, CA 92629' );
$mrh_facebook  = mrh_home_field( 'footer_facebook', '' );
$mrh_instagram = mrh_home_field( 'footer_instagram', '' );
?>
</main>

<footer class="site-footer">
	<div class="wrap site-footer__inner">
		<div>
			<span class="lockup lockup--footer">
				<span class="lockup__mister"><?php esc_html_e( 'Mister', 'mrh' ); ?></span>
				<strong class="lockup__hypnosis"><?php esc_html_e( 'Hypnosis', 'mrh' ); ?></strong>
			</span>
			<p class="site-footer__tagline"><?php esc_html_e( 'Richard Rumble — clean-comedy stage hypnosis and magic.', 'mrh' ); ?></p>
		</div>

		<div>
			<h2 class="site-footer__heading"><?php esc_html_e( 'Booking', 'mrh' ); ?></h2>
			<p>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $mrh_phone ) ); ?>"><?php echo esc_html( $mrh_phone ); ?></a><br>
				<a href="mailto:<?php echo esc_attr( $mrh_email ); ?>"><?php echo esc_html( $mrh_email ); ?></a><br>
				<?php echo esc_html( $mrh_address ); ?>
			</p>

			<?php if ( $mrh_facebook || $mrh_instagram ) : ?>
				<ul class="site-footer__social">
					<?php if ( $mrh_facebook ) : ?>
						<li><a href="<?php echo esc_url( $mrh_facebook ); ?>"><?php esc_html_e( 'Facebook', 'mrh' ); ?></a></li>
					<?php endif; ?>
					<?php if ( $mrh_instagram ) : ?>
						<li><a href="<?php echo esc_url( $mrh_instagram ); ?>"><?php esc_html_e( 'Instagram', 'mrh' ); ?></a></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div>
			<h2 class="site-footer__heading"><?php esc_html_e( 'Also From Full Spectrum', 'mrh' ); ?></h2>
			<ul class="site-footer__menu">
				<li><a href="https://www.fullspectrument.com"><?php esc_html_e( 'Corporate & private entertainment', 'mrh' ); ?></a></li>
				<li><a href="https://full-spectrum.org"><?php esc_html_e( 'School & library assemblies', 'mrh' ); ?></a></li>
				<li><a href="https://dreamshapers.org"><?php esc_html_e( 'Dream Shapers performing arts', 'mrh' ); ?></a></li>
			</ul>
		</div>
	</div>

	<div class="wrap site-footer__legal">
		<p>
			<?php
			printf(
				/* translators: 1: year, 2: site name. */
				esc_html__( '© %1$s %2$s. All rights reserved.', 'mrh' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>
		<p>
			<?php
			printf(
				/* translators: 1: NerdVision site URL, 2: NerdVision name. */
				esc_html__( 'Designed by %1$s', 'mrh' ),
				'<a class="footer__brand-link" href="https://nerdvision.tech">' . esc_html__( 'NerdVision', 'mrh' ) . '</a>'
			);
			?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
