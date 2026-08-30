<?php
/**
 * Template helpers.
 *
 * @package mrh
 */

/**
 * Read an ACF value with a fallback.
 *
 * @param string $name    Field name.
 * @param mixed  $default Fallback.
 * @param mixed  $post_id Optional post ID.
 * @return mixed
 */
function mrh_field( $name, $default = '', $post_id = null ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $name, $post_id );

	if ( null === $value || '' === $value || false === $value || array() === $value ) {
		return $default;
	}

	return $value;
}

/**
 * Read an ACF value from the front page.
 *
 * @param string $name    Field name.
 * @param mixed  $default Fallback.
 * @return mixed
 */
function mrh_home_field( $name, $default = '' ) {
	return mrh_field( $name, $default, get_option( 'page_on_front' ) );
}

/**
 * Split a textarea into trimmed lines.
 *
 * @param string $value Raw value.
 * @return string[]
 */
function mrh_lines( $value ) {
	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return array();
	}

	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $value ) ) ) );
}

/**
 * Responsive Vimeo embed. Replaces the legacy AudioAcrobat players, which broke
 * on mobile browsers.
 *
 * @param string $id    Vimeo video ID (digits only).
 * @param string $title Accessible title.
 * @return string
 */
function mrh_vimeo_embed( $id, $title = '' ) {
	$id = preg_replace( '/[^0-9]/', '', (string) $id );

	if ( ! $id ) {
		return '';
	}

	$src = add_query_arg(
		array(
			'title'    => 0,
			'byline'   => 0,
			'portrait' => 0,
			'dnt'      => 1,
		),
		'https://player.vimeo.com/video/' . $id
	);

	return sprintf(
		'<div class="video"><iframe src="%1$s" title="%2$s" loading="lazy" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>',
		esc_url( $src ),
		esc_attr( $title ? $title : __( 'Mister Hypnosis video', 'mrh' ) )
	);
}

/**
 * Query a support post type in menu order.
 *
 * @param string $post_type Post type.
 * @param int    $limit     Max posts.
 * @return WP_Query
 */
function mrh_query( $post_type, $limit = -1 ) {
	return new WP_Query(
		array(
			'post_type'      => $post_type,
			'posts_per_page' => $limit,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
		)
	);
}

/**
 * Testimonials, optionally scoped to one audience section.
 *
 * @param int|null $audience_id Audience post ID, or null for unscoped testimonials.
 * @return WP_Post[]
 */
function mrh_testimonials( $audience_id = null ) {
	$posts = get_posts(
		array(
			'post_type'      => MRH_TESTIMONIAL_POST_TYPE,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);

	return array_values(
		array_filter(
			$posts,
			function ( $post ) use ( $audience_id ) {
				$linked = (int) mrh_field( 'testimonial_audience', 0, $post->ID );

				return $audience_id ? $linked === (int) $audience_id : ! $linked;
			}
		)
	);
}

/**
 * Anchor id for an audience section.
 *
 * @param WP_Post|int $post Audience post.
 * @return string
 */
function mrh_audience_anchor( $post ) {
	$post = get_post( $post );

	return $post ? 'shows-' . $post->post_name : '';
}
