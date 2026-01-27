<?php
/**
 * Catalog settings
 *
 * @package Anna-vip
 * @since 1.0.0
 */

add_action( 'init', 'adem_register_product_post_type' );
/**
 * Register custom post type - product.
 */
function adem_register_product_post_type() {
	register_post_type(
		'product',
		array(
			'label'         => null,
			'labels'        => array(
				'name'               => 'Каталог',
				'singular_name'      => 'Товар',
				'add_new'            => 'Добавить товар',
				'add_new_item'       => 'Добавить новый товар',
				'edit_item'          => 'Редактировать товар',
				'new_item'           => 'Новый товар',
				'view_item'          => 'Просмотреть товар',
				'search_items'       => 'Искать товары',
				'not_found'          => 'Товары не найдены',
				'not_found_in_trash' => 'Товары в корзине не найдены',
				'menu_name'          => 'Каталог',
			),
			'public'        => true,
			'show_in_menu'  => true,
			'has_archive'   => true,
			'menu_position' => 24,
			'menu_icon'     => 'dashicons-admin-generic',
			'rewrite'       => true,
			'supports'      => array( 'title', 'thumbnail' ),
		)
	);
}
