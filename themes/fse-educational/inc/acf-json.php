<?php
/**
 * Keep any admin-side field group edits in version control.
 *
 * @package fse
 */

add_filter(
	'acf/settings/save_json',
	function () {
		return FSE_DIR . '/acf-json';
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = FSE_DIR . '/acf-json';

		return $paths;
	}
);
