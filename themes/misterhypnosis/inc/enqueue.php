<?php
/**
 * Front-end assets.
 *
 * @package mrh
 */

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'mrh-fonts',
			'https://fonts.googleapis.com/css2?family=Fjalla+One&family=Inter:wght@400;500;600;700&display=swap',
			array(),
			null
		);

		wp_enqueue_style( 'mrh-theme', MRH_URI . '/assets/css/theme.css', array( 'mrh-fonts' ), MRH_VERSION );

		wp_enqueue_script( 'mrh-theme', MRH_URI . '/assets/js/theme.js', array(), MRH_VERSION, true );
	}
);
