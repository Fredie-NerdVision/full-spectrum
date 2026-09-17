<?php
/**
 * Template helpers. Every one degrades gracefully when ACF is inactive so the
 * layout never collapses on a fresh install.
 *
 * @package fse
 */

/**
 * Read an ACF value with a fallback.
 *
 * @param string $name    Field name.
 * @param string $default Fallback copy.
 * @param mixed  $post_id Optional post ID.
 * @return mixed
 */
function fse_field( $name, $default = '', $post_id = null ) {
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
 * Read an ACF value from the front page regardless of which page is rendering.
 *
 * @param string $name    Field name.
 * @param string $default Fallback copy.
 * @return mixed
 */
function fse_home_field( $name, $default = '' ) {
	return fse_field( $name, $default, get_option( 'page_on_front' ) );
}

/**
 * Split a textarea into trimmed lines.
 *
 * @param string $value Raw textarea value.
 * @return string[]
 */
function fse_lines( $value ) {
	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return array();
	}

	$lines = preg_split( '/\r\n|\r|\n/', $value );

	return array_values( array_filter( array_map( 'trim', $lines ) ) );
}

/**
 * Query the published program cards, optionally limited to one service group.
 *
 * @param string $group Service group slug.
 * @return WP_Query
 */
function fse_programs_query( $group = '' ) {
	$args = array(
		'post_type'      => FSE_PROGRAM_POST_TYPE,
		'posts_per_page' => -1,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'title'      => 'ASC',
		),
	);

	if ( $group ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => FSE_PROGRAM_TAXONOMY,
				'field'    => 'slug',
				'terms'    => $group,
			),
		);
	}

	return new WP_Query( $args );
}

/**
 * Service groups that actually have programs attached, in quick-nav order.
 *
 * @return WP_Term[]
 */
function fse_active_service_groups() {
	$ordered = array();

	foreach ( array_keys( fse_service_groups() ) as $slug ) {
		$term = get_term_by( 'slug', $slug, FSE_PROGRAM_TAXONOMY );

		if ( $term instanceof WP_Term ) {
			$ordered[] = $term;
		}
	}

	return $ordered;
}

/**
 * Program card artwork, or a branded placeholder when photography is pending.
 *
 * @param int $post_id Program ID.
 */
function fse_program_media( $post_id ) {
	$awaiting = fse_field( 'program_awaiting_photo', false, $post_id );

	if ( ! $awaiting && has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail(
			$post_id,
			'fse-program-card',
			array(
				'class'   => 'card__image',
				'loading' => 'lazy',
			)
		);

		return;
	}

	$terms = get_the_terms( $post_id, FSE_PROGRAM_TAXONOMY );
	$glyph = '★';

	if ( is_array( $terms ) && $terms ) {
		$icon = get_term_meta( $terms[0]->term_id, 'group_icon', true );

		if ( $icon ) {
			$glyph = $icon;
		}
	}

	printf(
		'<div class="card__image card__image--placeholder" role="img" aria-label="%s"><span aria-hidden="true">%s</span><em>%s</em></div>',
		esc_attr__( 'Program photography coming soon', 'fse' ),
		esc_html( $glyph ),
		esc_html__( 'Photos coming soon', 'fse' )
	);
}

/**
 * Anchor id for a service group section.
 *
 * @param WP_Term $term Term.
 * @return string
 */
function fse_group_anchor( $term ) {
	return 'services-' . $term->slug;
}

/**
 * Accent colour for a service group, so the quick-nav tile, section heading
 * rule and card bars of one group always agree. Assigned by the group's
 * position so adding a group never leaves it colourless.
 *
 * @param WP_Term $term Term.
 * @return string CSS custom-property value.
 */
function fse_group_accent( $term ) {
	$palette = array( 'var(--violet)', 'var(--blue)', 'var(--coral)', 'var(--sky)', 'var(--amber)' );
	$slugs   = wp_list_pluck( fse_active_service_groups(), 'slug' );
	$index   = array_search( $term->slug, $slugs, true );

	if ( false === $index ) {
		$index = 0;
	}

	return $palette[ $index % count( $palette ) ];
}

/**
 * Header menu wording for a service group. Full names such as "School
 * Carnivals & Festivals" are too long for a single-line menu, so editors can
 * supply a shorter label per group.
 *
 * @param WP_Term $term Term.
 * @return string
 */
function fse_group_nav_label( $term ) {
	$label = get_term_meta( $term->term_id, 'group_nav_label', true );

	return $label ? $label : $term->name;
}
