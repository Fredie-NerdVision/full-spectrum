<?php
/**
 * Mister Hypnosis theme bootstrap.
 *
 * @package mrh
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MRH_VERSION', '1.1.0' );
define( 'MRH_DIR', get_template_directory() );
define( 'MRH_URI', get_template_directory_uri() );

require_once MRH_DIR . '/inc/setup.php';
require_once MRH_DIR . '/inc/enqueue.php';
require_once MRH_DIR . '/inc/post-types.php';
require_once MRH_DIR . '/inc/acf-fields.php';
require_once MRH_DIR . '/inc/acf-json.php';
require_once MRH_DIR . '/inc/helpers.php';
require_once MRH_DIR . '/inc/booking-form.php';
require_once MRH_DIR . '/inc/spam-guard.php';
