<?php
/**
 * Full Spectrum Educational Services theme bootstrap.
 *
 * @package fse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FSE_VERSION', '1.1.0' );
define( 'FSE_DIR', get_template_directory() );
define( 'FSE_URI', get_template_directory_uri() );

require_once FSE_DIR . '/inc/setup.php';
require_once FSE_DIR . '/inc/enqueue.php';
require_once FSE_DIR . '/inc/post-types.php';
require_once FSE_DIR . '/inc/acf-fields.php';
require_once FSE_DIR . '/inc/acf-json.php';
require_once FSE_DIR . '/inc/helpers.php';
require_once FSE_DIR . '/inc/contact-form.php';
require_once FSE_DIR . '/inc/spam-guard.php';
