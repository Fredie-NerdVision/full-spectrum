<?php
/**
 * Content model: audience landing sections, testimonials, client logos and gallery.
 *
 * @package mrh
 */

const MRH_AUDIENCE_POST_TYPE    = 'mrh_audience';
const MRH_TESTIMONIAL_POST_TYPE = 'mrh_testimonial';
const MRH_CLIENT_POST_TYPE      = 'mrh_client';
const MRH_MEDIA_POST_TYPE       = 'mrh_gallery';

add_action(
	'init',
	function () {
		register_post_type(
			MRH_AUDIENCE_POST_TYPE,
			array(
				'labels'        => array(
					'name'          => __( 'Audiences', 'mrh' ),
					'singular_name' => __( 'Audience', 'mrh' ),
					'menu_name'     => __( 'Audiences', 'mrh' ),
					'add_new_item'  => __( 'Add Audience', 'mrh' ),
				),
				'public'        => true,
				'has_archive'   => false,
				'menu_icon'     => 'dashicons-groups',
				'menu_position' => 4,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
				'rewrite'       => array( 'slug' => 'shows' ),
				'show_in_rest'  => true,
			)
		);

		register_post_type(
			MRH_TESTIMONIAL_POST_TYPE,
			array(
				'labels'        => array(
					'name'          => __( 'Testimonials', 'mrh' ),
					'singular_name' => __( 'Testimonial', 'mrh' ),
					'menu_name'     => __( 'Testimonials', 'mrh' ),
					'add_new_item'  => __( 'Add Testimonial', 'mrh' ),
				),
				'public'        => false,
				'show_ui'       => true,
				'menu_icon'     => 'dashicons-format-quote',
				'menu_position' => 5,
				'supports'      => array( 'title', 'editor', 'page-attributes' ),
			)
		);

		register_post_type(
			MRH_CLIENT_POST_TYPE,
			array(
				'labels'        => array(
					'name'          => __( 'Client Logos', 'mrh' ),
					'singular_name' => __( 'Client Logo', 'mrh' ),
					'menu_name'     => __( 'Client Logos', 'mrh' ),
					'add_new_item'  => __( 'Add Client Logo', 'mrh' ),
				),
				'public'        => false,
				'show_ui'       => true,
				'menu_icon'     => 'dashicons-awards',
				'menu_position' => 6,
				'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			)
		);

		register_post_type(
			MRH_MEDIA_POST_TYPE,
			array(
				'labels'        => array(
					'name'          => __( 'Gallery', 'mrh' ),
					'singular_name' => __( 'Gallery Image', 'mrh' ),
					'menu_name'     => __( 'Gallery', 'mrh' ),
					'add_new_item'  => __( 'Add Gallery Image', 'mrh' ),
				),
				'public'        => false,
				'show_ui'       => true,
				'menu_icon'     => 'dashicons-format-gallery',
				'menu_position' => 7,
				'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
			)
		);
	}
);
