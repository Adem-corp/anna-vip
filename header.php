<?php
/**
 * The Header template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_tel    = get_field( 'tel', 'option' );
$option_email  = get_field( 'email', 'option' );
$option_social = get_field( 'social', 'option' );
$sidebar       = get_field( 'sidebar' );
$main_class    = 'main';

if ( $sidebar ) {
	$main_class .= ' main--w-sidebar';
}
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
	<div class="container header__container">
		<a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="header__logo">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="" width="170" height="105">
		</a>
		<div class="header__content">
			<div class="header__line header__top">
				<?php if ( $option_tel ) : ?>
					<a href="<?php echo esc_url( 'tel:' . adem_clear_tel( $option_tel ) ); ?>" class="header__contact">
						<svg width="17" height="17">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-tel' ); ?>"></use>
						</svg>
						<?php echo esc_html( $option_tel ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $option_email ) : ?>
					<a href="<?php echo esc_url( 'mailto:' . $option_email ); ?>" class="header__contact header__email">
						<svg width="20" height="16">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-email' ); ?>"></use>
						</svg>
						<?php echo esc_html( $option_email ); ?>
					</a>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu_top',
						'container'      => '',
						'menu_id'        => 'menu-top',
						'menu_class'     => 'reset-list menu-top header__menu-top',
						'depth'          => 1,
					)
				);
				?>
				<button class="header__link" type="button" data-src="#modal-call" data-fancybox>Заказать консультацию</button>
			</div>
			<div class="header__line header__bottom">
				<?php if ( $option_tel ) : ?>
					<a href="<?php echo esc_url( 'tel:' . adem_clear_tel( $option_tel ) ); ?>" class="header__contact">
						<svg width="17" height="17">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-tel' ); ?>"></use>
						</svg>
						<?php echo esc_html( $option_tel ); ?>
					</a>
				<?php endif; ?>
				<nav class="burger js-burger">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu_main',
							'container'      => '',
							'menu_id'        => 'menu-main',
							'menu_class'     => 'reset-list menu-main header__menu-main',
							'depth'          => 1,
						)
					);
					?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu_top',
							'container'      => '',
							'menu_id'        => 'menu-top',
							'menu_class'     => 'reset-list menu-top header__menu-top',
							'depth'          => 1,
						)
					);
					?>
				</nav>
				<?php if ( $option_social ) : ?>
					<ul class="reset-list social header__social">
						<li class="header__cart">
							<a href="#" class="social__link">
								<svg width="36" height="36">
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-cart' ); ?>"></use>
								</svg>
							</a>
						</li>
						<?php foreach ( $option_social as $item ) : ?>
							<li>
								<a href="<?php echo esc_url( $item['link'] ); ?>" class="social__link">
									<svg width="32" height="32">
										<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-' . $item['icon'] ); ?>"></use>
									</svg>
								</a>
							</li>
						<?php endforeach; ?>
						<li class="header__burger-btn">
							<button class="social__link burger-btn js-burger-btn" type="button">
								<svg width="24" height="24" class="burger-btn__main-icon">
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-burger' ); ?>"></use>
								</svg>
								<svg width="24" height="24" class="burger-btn__close-icon">
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-close' ); ?>"></use>
								</svg>
							</button>
						</li>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
<main class="<?php echo esc_attr( $main_class ); ?>">
	<div class="container main__container">
		<?php
		if ( $sidebar ) {
			get_template_part( 'layouts/partials/sidebar' );
		}
		?>
