<?php
/**
 * Fallback archive template.
 *
 * @package mrh
 */

get_header();
?>

<section class="page-body">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="entry">
					<h2 class="entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<h1 class="section-heading"><?php esc_html_e( 'Nothing here yet', 'mrh' ); ?></h1>
			<p><a class="btn btn--red" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the show', 'mrh' ); ?></a></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
