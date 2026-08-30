<?php
/**
 * Fallback archive template.
 *
 * @package fse
 */

get_header();
?>

<section class="page-section">
	<div class="wrap">
		<h1 class="section-heading"><?php echo esc_html( wp_get_document_title() ); ?></h1>

		<?php if ( have_posts() ) : ?>
			<ul class="card-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<li class="card">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'fse-program-card', array( 'class' => 'card__image' ) ); ?>
						<?php endif; ?>
						<div class="card__body">
							<h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="card__excerpt"><?php the_excerpt(); ?></div>
						</div>
					</li>
					<?php
				endwhile;
				?>
			</ul>

			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing here yet.', 'fse' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
