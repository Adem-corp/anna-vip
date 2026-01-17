<?php
/**
 * Ajax load more.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

add_action( 'wp_ajax_nopriv_load_more', 'load_more' );
add_action( 'wp_ajax_load_more', 'load_more' );

/**
 * Handler for ajax request.
 */
function load_more() {
	if ( ! isset( $_POST['nonce'] ) || ! isset( $_POST['query'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'load_more' ) ) {
		exit;
	}

	$args          = json_decode( sanitize_text_field( wp_unslash( $_POST['query'] ) ), true );
	$args['paged'] = isset( $_POST['page'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['page'] ) ) + 1 : 1;
	$query         = new WP_Query( $args );

	ob_start();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			get_template_part( 'layouts/cards/catalog-card' );
		}
		wp_reset_postdata();
	}

	$return_html = ob_get_clean();

	echo wp_kses_post( $return_html );
	wp_die();
}
