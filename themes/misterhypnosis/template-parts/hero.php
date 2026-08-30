<?php
/**
 * Hero: the trademark purple jacket portrait plus a short sizzle reel.
 *
 * @package mrh
 */

$mrh_kicker   = mrh_home_field( 'hero_kicker', __( 'Clean-comedy stage hypnosis', 'mrh' ) );
$mrh_heading  = mrh_home_field( 'hero_heading', __( 'Richard Rumble', 'mrh' ) );
$mrh_intro    = mrh_home_field(
	'hero_intro',
	__( 'The whole room participates, nobody is embarrassed, and the show is clean enough for a school-sanctioned Grad Night. Magic Castle member, National Guild of Hypnotists, 30 years on stage.', 'mrh' )
);
$mrh_portrait = mrh_home_field( 'hero_portrait', 0 );
$mrh_bg       = mrh_home_field( 'hero_background', 0 );
$mrh_video    = mrh_home_field( 'hero_video', '' );
?>

<section class="hero" id="top">
	<?php if ( $mrh_bg ) : ?>
		<div class="hero__bg">
			<?php echo wp_get_attachment_image( $mrh_bg, 'full', false, array( 'class' => 'hero__bg-img', 'alt' => '' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="wrap hero__inner">
		<div class="hero__content">
			<p class="kicker"><?php echo esc_html( $mrh_kicker ); ?></p>
			<h1 class="hero__heading"><?php echo esc_html( $mrh_heading ); ?></h1>
			<p class="hero__role"><?php esc_html_e( 'Comedy Hypnotist & Magician', 'mrh' ); ?></p>
			<div class="hero__intro"><?php echo wp_kses_post( wpautop( $mrh_intro ) ); ?></div>

			<p class="hero__actions">
				<a class="btn btn--gold btn--lg" href="#booking"><?php esc_html_e( 'Book Mister Hypnosis', 'mrh' ); ?></a>
				<a class="btn btn--outline btn--lg" href="#shows"><?php esc_html_e( 'See The Shows', 'mrh' ); ?></a>
			</p>
		</div>

		<div class="hero__media">
			<?php
			if ( $mrh_video ) {
				echo mrh_vimeo_embed( $mrh_video, __( 'Mister Hypnosis performance reel', 'mrh' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- markup built in helper.
			} elseif ( $mrh_portrait ) {
				echo wp_get_attachment_image(
					$mrh_portrait,
					'mrh-portrait',
					false,
					array(
						'class' => 'hero__portrait',
						'alt'   => esc_attr__( 'Richard Rumble in his trademark purple jacket', 'mrh' ),
					)
				);
			}
			?>
		</div>
	</div>
</section>
