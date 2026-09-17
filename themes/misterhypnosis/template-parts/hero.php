<?php
/**
 * Hero: stage photo under the red wash, headline stack left, sizzle reel right.
 *
 * @package mrh
 */

$mrh_kicker  = mrh_home_field( 'hero_kicker', __( 'Mister Hypnosis', 'mrh' ) );
$mrh_heading = mrh_home_field( 'hero_heading', __( 'Richard Rumble', 'mrh' ) );
$mrh_intro   = mrh_home_field(
	'hero_intro',
	__( 'The world’s most entertaining comedy hypnotist will have you laughing non-stop and craving for more.', 'mrh' )
);
$mrh_bg      = mrh_home_field( 'hero_background', 0 );
$mrh_video   = mrh_home_field( 'hero_video', '' );
?>

<section class="hero<?php echo $mrh_video ? ' hero--has-media' : ''; ?>" id="top">
	<?php if ( $mrh_bg ) : ?>
		<div class="hero__bg">
			<?php echo wp_get_attachment_image( $mrh_bg, 'full', false, array( 'class' => 'hero__bg-img', 'alt' => '' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="wrap hero__inner">
		<div class="hero__content">
			<p class="hero__kicker"><?php echo esc_html( $mrh_kicker ); ?></p>
			<h1 class="hero__heading"><?php echo esc_html( $mrh_heading ); ?></h1>
			<p class="hero__role"><?php esc_html_e( 'Comedy Hypnotist', 'mrh' ); ?></p>
			<div class="hero__intro"><?php echo wp_kses_post( wpautop( $mrh_intro ) ); ?></div>

			<p class="hero__actions">
				<a class="btn btn--red btn--lg" href="#booking"><?php esc_html_e( 'Book Mister Hypnosis', 'mrh' ); ?></a>
				<a class="btn btn--outline btn--lg" href="#shows"><?php esc_html_e( 'See The Shows', 'mrh' ); ?></a>
			</p>
		</div>

		<?php if ( $mrh_video ) : ?>
			<div class="hero__media">
				<?php echo mrh_vimeo_embed( $mrh_video, __( 'Mister Hypnosis performance reel', 'mrh' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- markup built in helper. ?>
			</div>
		<?php endif; ?>
	</div>
</section>
