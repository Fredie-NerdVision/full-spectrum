<?php
/**
 * Static page template.
 *
 * @package fse
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article class="page-section">
		<div class="wrap wrap--narrow">
			<h1 class="section-heading"><?php the_title(); ?></h1>
			<div class="prose"><?php the_content(); ?></div>
		</div>
	</article>
	<?php
endwhile;

get_footer();
