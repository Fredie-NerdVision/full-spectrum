<?php
/**
 * Single-page home layout.
 *
 * @package mrh
 */

get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/clients' );
get_template_part( 'template-parts/audiences' );
get_template_part( 'template-parts/about' );
get_template_part( 'template-parts/testimonials' );
get_template_part( 'template-parts/gallery' );
get_template_part( 'template-parts/booking' );

get_footer();
