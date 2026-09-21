<?php
/**
 * Site header.
 *
 * @package fse
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'fse' ); ?></a>

<header class="site-header" id="site-header">
	<div class="wrap site-header__inner">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-header__logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="lockup" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<span class="lockup__top"><?php esc_html_e( 'Full Spectrum', 'fse' ); ?></span>
				<strong class="lockup__emphasis"><?php esc_html_e( 'Educational', 'fse' ); ?></strong>
				<span class="lockup__bottom"><?php esc_html_e( 'Services', 'fse' ); ?></span>
			</a>
		<?php endif; ?>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<span class="nav-toggle__bars" aria-hidden="true"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'fse' ); ?></span>
		</button>

		<nav class="site-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'fse' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'site-nav__list',
						'depth'          => 1,
					)
				);
			} else {
				echo '<ul class="site-nav__list">';

				foreach ( fse_active_service_groups() as $term ) {
					printf(
						'<li><a href="%1$s">%2$s</a></li>',
						esc_url( home_url( '/#' . fse_group_anchor( $term ) ) ),
						esc_html( fse_group_nav_label( $term ) )
					);
				}

				printf(
					'<li><a href="%1$s">%2$s</a></li>',
					esc_url( home_url( '/#credentials' ) ),
					esc_html__( 'About Us', 'fse' )
				);

				echo '</ul>';
			}

			$phone = fse_home_field( 'footer_phone', '(714) 322-0207' );
			?>

			<div class="site-nav__actions">
				<a class="site-nav__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
				<a class="btn btn--accent" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Check Your Date', 'fse' ); ?></a>
			</div>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
