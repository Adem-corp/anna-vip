<?php
/**
 * Order settings
 *
 * @package Anna-vip
 * @since 1.0.0
 */

add_action( 'wp_ajax_make_order', 'make_order' );
add_action( 'wp_ajax_nopriv_make_order', 'make_order' );
function make_order() {
	if ( empty( $_POST['form_name'] ) ||
		empty( $_POST['client_name'] ) ||
		empty( $_POST['client_kod'] ) ||
		empty( $_POST['client_email'] ) ||
		! isset( $_POST['make_order_adem'] ) ||
		! wp_verify_nonce( $_POST['make_order_adem'], 'make_order' ) ) {
		die();
	}

	$form_name  = $_POST['form_name'];
	$client_tel = "<a href='tel:" . adem_clear_tel( $_POST['client_tel'] ) . "'>" . $_POST['client_tel'] . '</a>';

	$office_client = "
		<table style='max-width:100%;width:100%;margin:0;padding:0;' border='0' cellpadding='0' cellspacing='0' bgcolor='#e9fefa'>
			<tr>
				<th colspan='2' style='border:1px solid #dee2e6;padding:8px;'>Клиент офиса</th>
			</tr>
			<tr>
				<td style='width:215px;border:1px solid #dee2e6;padding:8px;'>Ф.И.О.</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST['client_name'] . "</td>
			</tr>
			<tr>
				<td style='width:215px;border:1px solid #dee2e6;padding:8px;'>Код клиента</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST['client_kod'] . "</td>
			</tr>
			<tr>
				<td style='width:215px;border:1px solid #dee2e6;padding:8px;'>Email</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST['client_email'] . "</td>
			</tr>
			<tr>
				<td style='width:215px;border:1px solid #dee2e6;padding:8px;'>Телефон</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>" . $client_tel . '</td>
			</tr>
		</table><br>';

	$order = "
		<table style='max-width:100%;width:100%;margin:0;padding:0;' border='0' cellpadding='0' cellspacing='0' bgcolor='#e9fefa'>
			<tr>
				<th colspan='9' style='border:1px solid #dee2e6;padding:8px;'>Заказ</th>
			</tr>
			<tr>
				<td style='border:1px solid #dee2e6;padding:8px;'>Название каталога</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Стр.</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Рис.</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Название на русском</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Кол-во</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Артикул</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Размер</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Цвет</td>
				<td style='border:1px solid #dee2e6;padding:8px;'>Цена (EURO)</td>
			</tr>";

	for ( $i = 1; $i <= $_POST['catalog_count']; $i++ ) {
		$order .= "
			<tr>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'cat_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'page_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'img_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'name_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'count_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'art_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'size_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'color_' . $i ] . "</td>
        <td style='border:1px solid #dee2e6;padding:8px;'>" . $_POST[ 'price_' . $i ] . '</td>
      </tr>';
	}

	$order .= '</table>';

	$post_data = array(
		'post_title'  => $form_name,
		'post_status' => 'pending',
		'post_author' => 1,
		'post_type'   => 'mail',
	);
	$post_ID   = wp_insert_post( $post_data );

	wp_insert_post(
		array(
			'ID'          => $post_ID,
			'post_title'  => $form_name . ' № ' . $post_ID,
			'post_status' => 'pending',
			'post_author' => 1,
			'post_type'   => 'mail',
		)
	);

	$mail_to = array(
		$_POST['client_email'],
		get_field( 'order-mail', 'forms' ),
	);
	$subject = get_bloginfo( 'name' ) . ' - ' . $form_name . ' № ' . $post_ID;
	$headers = 'Content-type: text/html; charset="utf-8"';

	if ( have_rows( 'emails', 'forms' ) ) {
		while ( have_rows( 'emails', 'forms' ) ) {
			the_row();

			$mail_to[] = get_sub_field( 'emails_item' );
		}
	}

	wp_mail( $mail_to, $subject, $office_client . $order, $headers );

	update_post_meta( $post_ID, 'office_client', $office_client );
	update_post_meta( $post_ID, 'order', $order );

	echo $post_ID;

	die();
}
