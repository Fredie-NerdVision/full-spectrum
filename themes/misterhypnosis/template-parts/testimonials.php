<?php
/**
 * General testimonials — the ones not pinned to a single audience section.
 *
 * @package mrh
 */

$mrh_items = mrh_testimonials();

if ( ! $mrh_items ) {
	return;
}
?>

<section class="testimonials" id="testimonials">
	<div class="wrap">
		<h2 class="section-heading"><?php esc_html_e( 'What event organisers say', 'mrh' ); ?></h2>

		<div class="testimonials__grid">
			<?php
			foreach ( $mrh_items as $mrh_item ) :
				$mrh_role  = mrh_field( 'testimonial_role', '', $mrh_item->ID );
				$mrh_video = mrh_field( 'testimonial_video', '', $mrh_item->ID );
				?>
				<figure class="testimonial">
					<?php
					if ( $mrh_video ) {
						echo mrh_vimeo_embed( $mrh_video, $mrh_item->post_title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- markup built in helper.
					}
					?>
					<blockquote><?php echo wp_kses_post( wpautop( wp_strip_all_tags( $mrh_item->post_content ) ) ); ?></blockquote>
					<figcaption>
						<strong><?php echo esc_html( $mrh_item->post_title ); ?></strong>
						<?php if ( $mrh_role ) : ?>
							<span><?php echo esc_html( $mrh_role ); ?></span>
						<?php endif; ?>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
