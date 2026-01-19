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
	<nav class="sidebar__menu">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu_sales',
				'container'      => '',
				'menu_id'        => 'menu-sales',
				'menu_class'     => 'reset-list menu-sidebar menu-sales',
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
	<nav class="sidebar__menu">
		<div class="sidebar__caption">
			<span><?php echo esc_html( wp_get_nav_menu_name( 'menu_catalog' ) ); ?></span>
		</div>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu_catalog',
				'container'      => '',
				'menu_id'        => 'menu-catalog',
				'menu_class'     => 'reset-list menu-sidebar menu-catalog',
			)
		);
		?>
	</nav>
</div>
