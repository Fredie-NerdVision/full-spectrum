<?php
/**
 * Single-page scrolling home page.
 *
 * @package fse
 */

get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/quick-nav' );

foreach ( fse_active_service_groups() as $fse_term ) {
	get_template_part( 'template-parts/service-group', null, array( 'term' => $fse_term ) );
}

get_template_part( 'template-parts/credentials' );
get_template_part( 'template-parts/contact' );

get_footer();
