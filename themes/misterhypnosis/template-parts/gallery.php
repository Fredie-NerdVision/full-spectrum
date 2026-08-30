<?php
/**
 * Photo gallery.
 *
 * @package mrh
 */

$mrh_items = get_posts(
	array(
		'post_type'      => MRH_MEDIA_POST_TYPE,
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( ! $mrh_items ) {
	return;
}
?>

<section class="gallery" id="gallery">
	<div class="wrap">
		<h2 class="section-heading"><?php esc_html_e( 'On stage', 'mrh' ); ?></h2>

		<ul class="gallery__grid">
			<?php
			foreach ( $mrh_items as $mrh_item ) :
				$mrh_image = mrh_field( 'gallery_image', 0, $mrh_item->ID );
				$mrh_image = $mrh_image ? $mrh_image : get_post_thumbnail_id( $mrh_item );

				if ( ! $mrh_image ) {
					continue;
				}

				$mrh_caption = mrh_field( 'gallery_caption', $mrh_item->post_title, $mrh_item->ID );
				?>
				<li class="gallery__item">
					<figure>
						<?php
						echo wp_get_attachment_image(
							$mrh_image,
							'mrh-card',
							false,
							array(
								'alt'     => esc_attr( $mrh_caption ),
								'loading' => 'lazy',
							)
						);
						?>
						<?php if ( $mrh_caption ) : ?>
							<figcaption><?php echo esc_html( $mrh_caption ); ?></figcaption>
						<?php endif; ?>
					</figure>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
