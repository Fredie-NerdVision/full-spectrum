<?php
/**
 * Audience sections: Grad Nights & proms, corporate, college.
 *
 * @package mrh
 */

$mrh_heading = mrh_home_field( 'audiences_heading', __( 'A different show for every room', 'mrh' ) );
$mrh_intro   = mrh_home_field( 'audiences_intro', '' );
$mrh_query   = mrh_query( MRH_AUDIENCE_POST_TYPE );

if ( ! $mrh_query->have_posts() ) {
	return;
}
?>

<section class="audiences" id="shows">
	<div class="wrap">
		<h2 class="section-heading"><?php echo esc_html( $mrh_heading ); ?></h2>
		<?php if ( $mrh_intro ) : ?>
			<div class="section-intro"><?php echo wp_kses_post( wpautop( $mrh_intro ) ); ?></div>
		<?php endif; ?>
	</div>

	<?php
	$mrh_index = 0;

	while ( $mrh_query->have_posts() ) :
		$mrh_query->the_post();

		$mrh_id           = get_the_ID();
		$mrh_kicker       = mrh_field( 'audience_kicker', '', $mrh_id );
		$mrh_tagline      = mrh_field( 'audience_tagline', '', $mrh_id );
		$mrh_points       = mrh_lines( mrh_field( 'audience_points', '', $mrh_id ) );
		$mrh_video        = mrh_field( 'audience_video', '', $mrh_id );
		$mrh_cta          = mrh_field( 'audience_cta', __( 'Check your date', 'mrh' ), $mrh_id );
		$mrh_testimonials = mrh_testimonials( $mrh_id );
		$mrh_index++;
		?>
		<article class="audience <?php echo 0 === $mrh_index % 2 ? 'audience--alt' : ''; ?>" id="<?php echo esc_attr( mrh_audience_anchor( get_post() ) ); ?>">
			<div class="wrap audience__inner">
				<div class="audience__body">
					<?php if ( $mrh_kicker ) : ?>
						<p class="kicker"><?php echo esc_html( $mrh_kicker ); ?></p>
					<?php endif; ?>

					<h3 class="audience__heading"><?php the_title(); ?></h3>

					<?php if ( $mrh_tagline ) : ?>
						<p class="audience__tagline"><?php echo esc_html( $mrh_tagline ); ?></p>
					<?php endif; ?>

					<div class="audience__content"><?php the_content(); ?></div>

					<?php if ( $mrh_points ) : ?>
						<ul class="ticks">
							<?php foreach ( $mrh_points as $mrh_point ) : ?>
								<li><?php echo esc_html( $mrh_point ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php foreach ( $mrh_testimonials as $mrh_testimonial ) : ?>
						<blockquote class="quote">
							<p><?php echo wp_kses_post( wp_strip_all_tags( $mrh_testimonial->post_content ) ); ?></p>
							<footer>
								<strong><?php echo esc_html( $mrh_testimonial->post_title ); ?></strong>
								<?php $mrh_role = mrh_field( 'testimonial_role', '', $mrh_testimonial->ID ); ?>
								<?php if ( $mrh_role ) : ?>
									<span><?php echo esc_html( $mrh_role ); ?></span>
								<?php endif; ?>
							</footer>
						</blockquote>
					<?php endforeach; ?>

					<p class="audience__actions">
						<a class="btn btn--red" href="#booking"><?php echo esc_html( $mrh_cta ); ?></a>
					</p>
				</div>

				<div class="audience__media">
					<?php
					if ( $mrh_video ) {
						echo mrh_vimeo_embed( $mrh_video, get_the_title() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- markup built in helper.
					} elseif ( has_post_thumbnail() ) {
						the_post_thumbnail( 'mrh-card', array( 'class' => 'audience__image' ) );
					}
					?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
</section>
