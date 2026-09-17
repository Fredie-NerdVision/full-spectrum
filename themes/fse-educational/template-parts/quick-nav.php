<?php
/**
 * Service quick-navigation buttons.
 *
 * @package fse
 */

$fse_groups = fse_active_service_groups();

if ( ! $fse_groups ) {
	return;
}

$fse_heading = fse_home_field( 'quicknav_heading', __( 'What are you planning?', 'fse' ) );
$fse_intro   = fse_home_field( 'quicknav_intro', __( 'Jump straight to the programs that fit your event.', 'fse' ) );
?>

<section class="quick-nav" id="quick-nav">
	<div class="wrap">
		<h2 class="section-heading"><?php echo esc_html( $fse_heading ); ?></h2>
		<div class="section-intro"><?php echo wp_kses_post( wpautop( $fse_intro ) ); ?></div>

		<ul class="quick-nav__grid">
			<?php foreach ( $fse_groups as $fse_term ) : ?>
				<li style="--g: <?php echo esc_attr( fse_group_accent( $fse_term ) ); ?>">
					<a class="quick-nav__btn" href="#<?php echo esc_attr( fse_group_anchor( $fse_term ) ); ?>">
						<span class="quick-nav__icon" aria-hidden="true"><?php echo esc_html( fse_field( 'group_icon', '★', $fse_term ) ); ?></span>
						<span class="quick-nav__label"><?php echo esc_html( $fse_term->name ); ?></span>
						<?php
						$fse_blurb = fse_field( 'group_blurb', '', $fse_term );

						if ( $fse_blurb ) :
							?>
							<span class="quick-nav__blurb"><?php echo esc_html( $fse_blurb ); ?></span>
						<?php endif; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
