<?php
/**
 * Front-end assets.
 *
 * @package fse
 */

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'fse-fonts',
			'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,900&family=Inter:wght@400;500;700&display=swap',
			array(),
			null
		);

		wp_enqueue_style( 'fse-theme', FSE_URI . '/assets/css/theme.css', array( 'fse-fonts' ), FSE_VERSION );

		wp_enqueue_script( 'fse-theme', FSE_URI . '/assets/js/theme.js', array(), FSE_VERSION, true );
	}
);

add_action(
	'wp_head',
	function () {
		printf(
			'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>%s',
			"\n"
		);
	},
	1
);
