<?php
/**
 * Not found.
 *
 * @package fse
 */

get_header();
?>

<section class="page-section">
	<div class="wrap wrap--narrow">
		<h1 class="section-heading"><?php esc_html_e( 'That page has moved', 'fse' ); ?></h1>
		<p><?php esc_html_e( 'Our programs now live on one page — start there, or call (714) 322-0207 and we will point you to the right show.', 'fse' ); ?></p>
		<p><a class="btn btn--accent" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to the programs', 'fse' ); ?></a></p>
	</div>
</section>

<?php
get_footer();
