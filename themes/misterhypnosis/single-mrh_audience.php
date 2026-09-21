<?php
/**
 * Audience detail page, for organisers who land on a service URL from search.
 *
 * @package mrh
 */

get_header();

while ( have_posts() ) :
	the_post();

	$mrh_id           = get_the_ID();
	$mrh_kicker       = mrh_field( 'audience_kicker', '', $mrh_id );
	$mrh_tagline      = mrh_field( 'audience_tagline', '', $mrh_id );
	$mrh_points       = mrh_lines( mrh_field( 'audience_points', '', $mrh_id ) );
	$mrh_video        = mrh_field( 'audience_video', '', $mrh_id );
	$mrh_testimonials = mrh_testimonials( $mrh_id );
	?>
	<article class="audience audience--single">
		<div class="wrap audience__inner">
			<div class="audience__body">
				<?php if ( $mrh_kicker ) : ?>
					<p class="kicker"><?php echo esc_html( $mrh_kicker ); ?></p>
				<?php endif; ?>

				<h1 class="audience__heading"><?php the_title(); ?></h1>

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
						<footer><strong><?php echo esc_html( $mrh_testimonial->post_title ); ?></strong></footer>
					</blockquote>
				<?php endforeach; ?>

				<p class="audience__actions">
					<a class="btn btn--red btn--lg" href="<?php echo esc_url( home_url( '/#booking' ) ); ?>"><?php esc_html_e( 'Check your date', 'mrh' ); ?></a>
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
	<?php
endwhile;

get_footer();
