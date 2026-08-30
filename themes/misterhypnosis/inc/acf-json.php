<?php
/**
 * Keep any admin-side field group edits in version control.
 *
 * @package mrh
 */

add_filter(
	'acf/settings/save_json',
	function () {
		return MRH_DIR . '/acf-json';
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = MRH_DIR . '/acf-json';

		return $paths;
	}
);
