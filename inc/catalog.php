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

add_action( 'wp_ajax_show_product', 'show_product' );
add_action( 'wp_ajax_nopriv_show_product', 'show_product' );
/**
 * Handler for ajax request.
 */
function show_product() {
	if ( ! isset( $_POST['nonce'] ) || ! isset( $_POST['id'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'show_product' ) ) {
		exit;
	}

	ob_start();

	get_template_part(
		'layouts/partials/modal-prod-inner',
		null,
		array(
			'id' => sanitize_text_field( wp_unslash( $_POST['id'] ) ),
		)
	);

	$return_html = ob_get_clean();

	adem_wp_kses_post_more( $return_html, array( 'svg', 'input' ) );
	wp_die();
}

/**
 * Checks if a product is in the cart.
 *
 * This function looks at the `anna_cart` cookie, which stores a JSON array in the format:
 * [
 *     "123" => 2, // key = product ID, value = quantity
 *     "456" => 1
 * ]
 *
 * If the given $product_id exists in the cookie, the function returns true; otherwise, false.
 *
 * @param int|string $product_id The ID of the product to check.
 *
 * @return bool Returns true if the product exists in the cart, false otherwise.
 */
function adem_check_prod_in_cart( $product_id ) {
	if ( ! empty( $_COOKIE['anna_cart'] ) ) {

		$cart = json_decode( wp_unslash( $_COOKIE['anna_cart'] ), true );

		if ( is_array( $cart ) && isset( $cart[ $product_id ] ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Returns the total quantity of all products in the cart.
 *
 * Looks at the `anna_cart` cookie, which stores a JSON array like:
 * [
 *     "123" => 2, // key = product ID, value = quantity
 *     "456" => 1
 * ]
 *
 * @return int|null Total quantity of all products in the cart, or null if cart is empty.
 */
function adem_get_count_in_cart() {
	$count = 0;

	if ( ! empty( $_COOKIE['anna_cart'] ) ) {

		$cart = json_decode( wp_unslash( $_COOKIE['anna_cart'] ), true );

		if ( is_array( $cart ) ) {
			foreach ( $cart as $prod ) {
				$count += (int) $prod;
			}
		}
	}

	return $count;
}
