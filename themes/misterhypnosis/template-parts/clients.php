<?php
/**
 * Scrolling client-logo marquee, replacing the old static logo cluster.
 *
 * @package mrh
 */

$mrh_clients = get_posts(
	array(
		'post_type'      => MRH_CLIENT_POST_TYPE,
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

if ( ! $mrh_clients ) {
	return;
}
?>

<section class="clients" id="clients" aria-label="<?php esc_attr_e( 'Clients', 'mrh' ); ?>">
	<div class="wrap">
		<h2 class="clients__heading"><?php esc_html_e( 'Trusted by schools, colleges and companies', 'mrh' ); ?></h2>
	</div>

	<div class="marquee" data-marquee>
		<?php // The list is duplicated so the CSS translation loops without a visible seam. ?>
		<?php for ( $mrh_pass = 0; $mrh_pass < 2; $mrh_pass++ ) : ?>
			<ul class="marquee__track" <?php echo 0 === $mrh_pass ? '' : 'aria-hidden="true"'; ?>>
				<?php
				foreach ( $mrh_clients as $mrh_client ) :
					$mrh_logo = mrh_field( 'client_logo', 0, $mrh_client->ID );
					$mrh_logo = $mrh_logo ? $mrh_logo : get_post_thumbnail_id( $mrh_client );
					$mrh_url  = mrh_field( 'client_url', '', $mrh_client->ID );

					if ( ! $mrh_logo ) {
						continue;
					}

					$mrh_image = wp_get_attachment_image(
						$mrh_logo,
						'mrh-logo',
						false,
						array(
							'class'   => 'marquee__logo',
							'alt'     => esc_attr( $mrh_client->post_title ),
							'loading' => 'lazy',
						)
					);
					?>
					<li class="marquee__item">
						<?php
						if ( $mrh_url && 0 === $mrh_pass ) {
							printf( '<a href="%1$s" rel="noopener">%2$s</a>', esc_url( $mrh_url ), $mrh_image ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- image markup from core.
						} else {
							echo $mrh_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- image markup from core.
						}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endfor; ?>
	</div>
</section>
