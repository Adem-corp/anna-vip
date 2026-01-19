<?php
/**
 * Reviews settings
 *
 * @package Anna-vip
 * @since 1.0.0
 */

add_action( 'init', 'adem_register_review_post_type' );
/**
 * Register custom post type - review.
 */
function adem_register_review_post_type() {
	register_post_type(
		'review',
		array(
			'label'              => null,
			'labels'             => array(
				'name'               => 'Отзывы',
				'singular_name'      => 'Отзыв',
				'add_new'            => 'Добавить отзыв',
				'add_new_item'       => 'Добавить отзыв',
				'edit_item'          => 'Редактировать отзыв',
				'new_item'           => 'Новый отзыв',
				'view_item'          => 'Смотреть отзыв',
				'search_items'       => 'Найти отзыв',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => 'Отзывы',
			),
			'public'             => true,
			'show_in_menu'       => true,
			'menu_position'      => 22,
			'menu_icon'          => 'dashicons-format-chat',
			'supports'           => array( 'title' ),
			'has_archive'        => false,
			'rewrite'            => true,
			'query_var'          => true,
			'publicly_queryable' => false,
		)
	);
}
