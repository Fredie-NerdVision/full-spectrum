<?php
/**
 * Static page template.
 *
 * @package mrh
 */

get_header();
?>

<section class="page-body">
	<div class="wrap">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="section-heading"><?php the_title(); ?></h1>
			<div class="entry__content"><?php the_content(); ?></div>
		<?php endwhile; ?>
	</div>
</section>

<?php
get_footer();
