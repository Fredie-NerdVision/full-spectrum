<?php
/**
 * Program cards content model.
 *
 * @package fse
 */

const FSE_PROGRAM_POST_TYPE = 'fse_program';
const FSE_PROGRAM_TAXONOMY  = 'fse_service_group';

/**
 * The five service groups used by the quick-navigation buttons.
 *
 * @return array<string, string> Slug => label.
 */
function fse_service_groups() {
	return array(
		'assembly-programs'  => __( 'Assembly Programs', 'fse' ),
		'science-nights'     => __( 'Science Nights & Workshops', 'fse' ),
		'carnivals'          => __( 'School Carnivals & Festivals', 'fse' ),
		'dances-proms'       => __( 'School Dances & Proms', 'fse' ),
		'grad-nights'        => __( 'Grad Nights', 'fse' ),
	);
}

add_action(
	'init',
	function () {
		register_post_type(
			FSE_PROGRAM_POST_TYPE,
			array(
				'labels'       => array(
					'name'               => __( 'Programs', 'fse' ),
					'singular_name'      => __( 'Program', 'fse' ),
					'add_new_item'       => __( 'Add Program', 'fse' ),
					'edit_item'          => __( 'Edit Program', 'fse' ),
					'menu_name'          => __( 'Programs', 'fse' ),
					'not_found'          => __( 'No programs yet.', 'fse' ),
				),
				'public'       => true,
				'has_archive'  => false,
				'menu_icon'    => 'dashicons-star-filled',
				'menu_position'=> 4,
				'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions' ),
				'rewrite'      => array( 'slug' => 'programs' ),
				'show_in_rest' => true,
			)
		);

		register_taxonomy(
			FSE_PROGRAM_TAXONOMY,
			FSE_PROGRAM_POST_TYPE,
			array(
				'labels'            => array(
					'name'          => __( 'Service Groups', 'fse' ),
					'singular_name' => __( 'Service Group', 'fse' ),
					'menu_name'     => __( 'Service Groups', 'fse' ),
				),
				'public'            => true,
				'hierarchical'      => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'rewrite'           => array( 'slug' => 'services' ),
			)
		);
	}
);

/**
 * Seed the five service groups so the quick-navigation buttons always resolve.
 */
add_action(
	'admin_init',
	function () {
		if ( get_option( 'fse_service_groups_seeded' ) ) {
			return;
		}

		foreach ( fse_service_groups() as $slug => $label ) {
			if ( ! term_exists( $slug, FSE_PROGRAM_TAXONOMY ) ) {
				wp_insert_term( $label, FSE_PROGRAM_TAXONOMY, array( 'slug' => $slug ) );
			}
		}

		update_option( 'fse_service_groups_seeded', 1 );
	}
);
