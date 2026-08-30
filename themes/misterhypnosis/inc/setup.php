<?php
/**
 * Theme supports and menus.
 *
 * @package mrh
 */

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'mrh', MRH_DIR . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'custom-logo', array(
			'height'      => 160,
			'width'       => 640,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'script', 'style' ) );

		register_nav_menus(
			array(
				'primary' => __( 'Primary (section jump links)', 'mrh' ),
			)
		);

		add_image_size( 'mrh-portrait', 900, 1200, true );
		add_image_size( 'mrh-card', 800, 600, true );
		add_image_size( 'mrh-logo', 320, 160, false );
	}
);
