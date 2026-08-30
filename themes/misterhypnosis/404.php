<?php
/**
 * 404. The old site had deep per-service pages, so arrivals from stale links
 * are pointed at the matching section of the single-page layout.
 *
 * @package mrh
 */

get_header();
?>

<section class="page-body">
	<div class="wrap">
		<h1 class="section-heading"><?php esc_html_e( 'That page has moved', 'mrh' ); ?></h1>
		<p><?php esc_html_e( 'The site is now one page. Jump straight to what you were looking for:', 'mrh' ); ?></p>

		<ul class="ticks">
			<li><a href="<?php echo esc_url( home_url( '/#shows' ) ); ?>"><?php esc_html_e( 'Shows by audience', 'mrh' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php esc_html_e( 'About Richard Rumble', 'mrh' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>"><?php esc_html_e( 'Gallery', 'mrh' ); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/#booking' ) ); ?>"><?php esc_html_e( 'Check your date', 'mrh' ); ?></a></li>
		</ul>
	</div>
</section>

<?php
get_footer();
