<?php
/**
 * The Sidebar template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_info = get_field( 'info_first', 'option' );
?>

<div class="sidebar">
	<nav class="nav" id="sales-nav">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu_sales',
				'container'      => '',
				'menu_id'        => 'menu-sales',
				'menu_class'     => 'reset-list nav__menu sidebar__menu menu-sales',
			)
		);
		?>
	</nav>
	<?php if ( $option_info ) : ?>
		<div class="sidebar__info-container">
			<?php foreach ( $option_info as $info ) : ?>
				<div class="sidebar__info"><?php echo wp_kses_post( $info['text'] ); ?></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<nav class="nav" id="catalog-nav">
		<div class="nav__title"><?php echo esc_html( wp_get_nav_menu_name( 'menu_catalog' ) ); ?></div>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu_catalog',
				'container'      => '',
				'menu_id'        => 'menu-catalog',
				'menu_class'     => 'reset-list nav__menu sidebar__menu menu-catalog',
			)
		);
		?>
	</nav>
	<div class="sidebar__subscribe">
		<p>Вы можете подписаться на наши новости</p>
		<button type="button" class="btn btn_main" data-src="#subscribe" data-fancybox>Подписаться</button>
	</div>
</div>
