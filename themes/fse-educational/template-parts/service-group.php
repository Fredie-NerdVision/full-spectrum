<?php
/**
 * One service group section with its program cards.
 *
 * @package fse
 *
 * @var array $args Passed from front-page.php with a `term` key.
 */

$fse_term = $args['term'] ?? null;

if ( ! $fse_term instanceof WP_Term ) {
	return;
}

$fse_query = fse_programs_query( $fse_term->slug );

if ( ! $fse_query->have_posts() ) {
	return;
}

$fse_blurb  = fse_field( 'group_blurb', '', $fse_term );
$fse_desc   = $fse_blurb ? $fse_blurb : term_description( $fse_term );
$fse_accent = fse_group_accent( $fse_term );
$fse_slugs  = wp_list_pluck( fse_active_service_groups(), 'slug' );
$fse_tint   = 1 === ( (int) array_search( $fse_term->slug, $fse_slugs, true ) % 2 );
?>

<section class="services<?php echo $fse_tint ? ' services--tint' : ''; ?>" id="<?php echo esc_attr( fse_group_anchor( $fse_term ) ); ?>" data-group="<?php echo esc_attr( $fse_term->slug ); ?>" style="--g: <?php echo esc_attr( $fse_accent ); ?>">
	<div class="wrap">
		<header class="services__header">
			<?php
			$fse_eyebrow = fse_field( 'group_eyebrow', '', $fse_term );

			if ( $fse_eyebrow ) :
				?>
				<p class="services__eyebrow">
					<span aria-hidden="true"><?php echo esc_html( fse_field( 'group_icon', '★', $fse_term ) ); ?></span>
					<?php echo esc_html( $fse_eyebrow ); ?>
				</p>
			<?php endif; ?>

			<h2 class="section-heading"><?php echo esc_html( $fse_term->name ); ?></h2>
			<?php if ( $fse_desc ) : ?>
				<div class="section-intro"><?php echo wp_kses_post( wpautop( $fse_desc ) ); ?></div>
			<?php endif; ?>
		</header>

		<ul class="card-grid">
			<?php
			$fse_index = 0;

			while ( $fse_query->have_posts() ) :
				$fse_query->the_post();

				/* The first program in each group leads the section as a wide
				   editorial card; the rest are compact so the flagship reads first. */
				$fse_is_feature = ( 0 === $fse_index );
				++$fse_index;
				?>
				<li class="card<?php echo $fse_is_feature ? ' card--feature' : ''; ?>">
					<?php
					if ( $fse_is_feature ) {
						fse_program_media( get_the_ID() );
					}
					?>

					<div class="card__body">
						<?php
						$fse_discipline = fse_field( 'program_discipline' );

						if ( $fse_discipline ) :
							?>
							<p class="card__eyebrow"><?php echo esc_html( $fse_discipline ); ?></p>
						<?php endif; ?>

						<h3 class="card__title"><?php the_title(); ?></h3>

						<?php
						$fse_tagline = fse_field( 'program_tagline' );

						if ( $fse_tagline ) :
							?>
							<p class="card__tagline"><?php echo esc_html( $fse_tagline ); ?></p>
						<?php endif; ?>

						<div class="card__excerpt"><?php the_excerpt(); ?></div>

						<dl class="card__meta">
							<?php
							$fse_meta = array(
								__( 'Ages', 'fse' )   => fse_field( 'program_audience' ),
								__( 'Format', 'fse' ) => fse_field( 'program_duration' ),
								__( 'From', 'fse' )   => fse_field( 'program_price' ),
							);

							foreach ( $fse_meta as $fse_label => $fse_value ) :
								if ( ! $fse_value ) {
									continue;
								}
								?>
								<div class="card__meta-row">
									<dt><?php echo esc_html( $fse_label ); ?></dt>
									<dd><?php echo esc_html( $fse_value ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>

						<a class="card__link" href="<?php the_permalink(); ?>">
							<?php esc_html_e( 'Program details', 'fse' ); ?>
							<span class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></span>
						</a>
					</div>
				</li>
				<?php
			endwhile;

			wp_reset_postdata();
			?>
		</ul>
	</div>
</section>
