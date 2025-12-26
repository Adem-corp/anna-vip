<?php
/**
 * The Header template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_header   = get_field( 'header', 'option' );
$option_contacts = get_field( 'contacts', 'option' );
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#ff5555">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
	<nav id="top-nav" class="nav nav_top">
		<button class="nav__toggle js-burger">Меню</button>
		<div class="menu-container">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu_main',
					'container'      => '',
					'menu_id'        => 'menu-mobile',
					'menu_class'     => 'reset-list container nav__menu menu-main',
				)
			);

			wp_nav_menu(
				array(
					'theme_location' => 'menu_top',
					'container'      => '',
					'menu_id'        => 'menu-top',
					'menu_class'     => 'reset-list container nav__menu menu-top',
				)
			);
			?>
		</div>
	</nav>
	<div class="container header__container">
		<a href="<?php echo site_url( '/' ); ?>" class="header__logo">
			<picture>
				<source srcset="<?php echo esc_url( $option_header['logo_mob']['url'] ); ?>" media="(max-width: 768px)">
				<img src="<?php echo esc_url( $option_header['logo']['url'] ); ?>" alt="<?php echo esc_attr( $option_header['logo']['alt'] ); ?>" width="<?php echo esc_attr( $option_header['logo']['width'] ); ?>" height="<?php echo esc_attr( $option_header['logo']['width'] ); ?>">
			</picture>
		</a>
		<div class="header__contacts">
			<div class="header__offices">
				<div class="header__offices-caption">Наши офисы:</div>
				<?php foreach ( $option_contacts['offices'] as $office ) : ?>
					<div class="header__office-title" style="color: <?php echo esc_attr( $office['color'] ); ?>">
						<span><?php echo esc_html( $office['title'] ); ?></span>
					</div>
					<?php foreach ( $office['tel'] as $tel ) : ?>
							<a href="<?php echo esc_url( 'tel:' . adem_clear_tel( $tel['number'] ) ); ?>" class="header__office-tel" style="color: <?php echo esc_attr( $office['color'] ); ?>"><?php echo esc_html( $tel['number'] ); ?></a>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>
			<?php if ( $option_header['insta'] ) : ?>
				<div class="header__insta">
					<a href="<?php echo esc_url( $option_header['insta'] ); ?>" title="Наш Instagram" target="_blank">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/instagram.svg' ); ?>" alt="Наш Instagram">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<nav id="main-nav" class="nav nav_main">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu_main',
				'container'      => '',
				'menu_id'        => 'menu-main',
				'menu_class'     => 'reset-list container nav__menu menu-main',
			)
		);
		?>
	</nav>
</header>
<main class="main">
