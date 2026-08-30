<?php
/**
 * A single program, for administrators who want the full detail and specs.
 *
 * @package fse
 */

get_header();

while ( have_posts() ) :
	the_post();

	$fse_highlights = fse_lines( fse_field( 'program_highlights' ) );
	?>
	<article class="program">
		<header class="program__header">
			<div class="wrap wrap--narrow">
				<?php
				$fse_discipline = fse_field( 'program_discipline' );

				if ( $fse_discipline ) :
					?>
					<p class="program__eyebrow"><?php echo esc_html( $fse_discipline ); ?></p>
				<?php endif; ?>

				<h1 class="program__title"><?php the_title(); ?></h1>

				<?php
				$fse_tagline = fse_field( 'program_tagline' );

				if ( $fse_tagline ) :
					?>
					<p class="program__tagline"><?php echo esc_html( $fse_tagline ); ?></p>
				<?php endif; ?>
			</div>
		</header>

		<div class="wrap wrap--narrow program__body">
			<?php fse_program_media( get_the_ID() ); ?>

			<div class="prose"><?php the_content(); ?></div>

			<?php if ( $fse_highlights ) : ?>
				<h2><?php esc_html_e( 'What students experience', 'fse' ); ?></h2>
				<ul class="program__highlights">
					<?php foreach ( $fse_highlights as $fse_highlight ) : ?>
						<li><?php echo esc_html( $fse_highlight ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<dl class="program__specs">
				<?php
				$fse_specs = array(
					__( 'Target audience', 'fse' ) => fse_field( 'program_audience' ),
					__( 'Format', 'fse' )          => fse_field( 'program_duration' ),
					__( 'Pricing', 'fse' )         => fse_field( 'program_price' ),
				);

				foreach ( $fse_specs as $fse_label => $fse_value ) :
					if ( ! $fse_value ) {
						continue;
					}
					?>
					<div class="program__spec">
						<dt><?php echo esc_html( $fse_label ); ?></dt>
						<dd><?php echo esc_html( $fse_value ); ?></dd>
					</div>
				<?php endforeach; ?>
			</dl>

			<p class="program__cta">
				<a class="btn btn--accent btn--lg" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Check availability for this program', 'fse' ); ?></a>
			</p>
		</div>
	</article>
	<?php
endwhile;

get_footer();
