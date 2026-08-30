<?php
/**
 * Site header.
 *
 * @package mrh
 */

$mrh_phone = mrh_home_field( 'footer_phone', '(949) 496-6244' );
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

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'mrh' ); ?></a>

<header class="site-header" id="site-header">
	<div class="wrap site-header__inner">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-header__logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="lockup" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<span class="lockup__mister"><?php esc_html_e( 'Mister', 'mrh' ); ?></span>
				<strong class="lockup__hypnosis"><?php esc_html_e( 'Hypnosis', 'mrh' ); ?></strong>
			</a>
		<?php endif; ?>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<span class="nav-toggle__bars" aria-hidden="true"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'mrh' ); ?></span>
		</button>

		<nav class="site-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'mrh' ); ?>">
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

				$mrh_audiences = mrh_query( MRH_AUDIENCE_POST_TYPE );

				while ( $mrh_audiences->have_posts() ) {
					$mrh_audiences->the_post();

					printf(
						'<li><a href="%1$s">%2$s</a></li>',
						esc_url( home_url( '/#' . mrh_audience_anchor( get_post() ) ) ),
						esc_html( get_the_title() )
					);
				}

				wp_reset_postdata();

				printf(
					'<li><a href="%1$s">%2$s</a></li><li><a href="%3$s">%4$s</a></li>',
					esc_url( home_url( '/#about' ) ),
					esc_html__( 'About Richard', 'mrh' ),
					esc_url( home_url( '/#gallery' ) ),
					esc_html__( 'Gallery', 'mrh' )
				);

				echo '</ul>';
			}
			?>

			<div class="site-nav__actions">
				<a class="site-nav__phone" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $mrh_phone ) ); ?>"><?php echo esc_html( $mrh_phone ); ?></a>
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/#booking' ) ); ?>"><?php esc_html_e( 'Check Your Date', 'mrh' ); ?></a>
			</div>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
