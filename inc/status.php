<?php
/**
 * Status settings
 *
 * @package Anna-vip
 * @since 1.0.0
 */

add_action( 'wp_ajax_status', 'status' );
add_action( 'wp_ajax_nopriv_status', 'status' );
function status() {
	if ( empty( $_POST['uid'] ) ||
		empty( $_POST['password'] ) ) {
		exit;
	}

	// define('RESTORE_CHARSET', 'cp1251');
	$host      = 'localhost';
	$user_name = 'u369911_user01';
	$password  = '0M3y1J6d';
	$dbname    = 'u369911_mambo1051377865';
	// TODO убрать тестовые данные
	// $host      = 'MariaDB-11.8';
	// $user_name = 'root';
	// $password  = '';
	// $dbname    = 'anna-vip-users';
	$db = mysqli_connect( $host, $user_name, $password, $dbname );
	mysqli_select_db( $db, $dbname );
	mysqli_query( $db, "set character_set_client='cp1251'" );
	mysqli_query( $db, "set character_set_results='cp1251'" );
	mysqli_query( $db, "set collation_connection='cp1251_general_ci'" );

	$uid      = iconv( 'utf-8//IGNORE', 'windows-1251//IGNORE', $_POST['uid'] );
	$password = iconv( 'utf-8//IGNORE', 'windows-1251//IGNORE', $_POST['password'] );

	$client = mysqli_query( $db, "SELECT * FROM `av_users` WHERE `uid`='$uid' AND `password`='$password' LIMIT 1" );

	if ( ! $client ) {
		echo '<p>Запрос на выборку данных из базы не прошел. <br> <strong>Код ошибки:</strong></p>';
		exit( mysqli_error() );
		wp_die();
	}

	$result = '';

	if ( mysqli_num_rows( $client ) > 0 ) {
		$orders = mysqli_query( $db, "SELECT * FROM `av_order` WHERE `user`='$uid'" );

		$row_client = mysqli_fetch_array( $client );

		$password = iconv( 'windows-1251//IGNORE', 'UTF-8//IGNORE', $row_client['password'] );
		$fio      = iconv( 'windows-1251//IGNORE', 'UTF-8//IGNORE', $row_client['fio'] );
		$shetEUR  = $row_client['shetEUR'];
		$of_pos   = $row_client['of_pos'];
		$of_dop   = $row_client['of_dop'];

		$table_head = '
			<table class="status__table">
				<tr class="status__row status__user">
					<td colspan="4" class="status__name">' . $password . ' ' . $fio . '</td>
					<td colspan="3" class="status__check">на счету: ' . $shetEUR . ' EUR</td>
				</tr>
				<tr class="status__row status__header">
					<td>Дата зак.</td>
					<td>№ заказа</td>
					<td>Наименование</td>
					<td>Статус</td>
					<td>Сумма</td>
					<td>Оплачено</td>
					<td>Доплатить</td>
				</tr>';

		$table_rows = '';
		if ( mysqli_num_rows( $orders ) > 0 ) {
			$row_order = mysqli_fetch_array( $orders );

			do {
				$id     = $row_order['id'];
				$data_z = $row_order['data_z'];
				$tovar  = iconv( 'windows-1251//IGNORE', 'UTF-8//IGNORE', $row_order['tovar'] );
				$status = iconv( 'windows-1251//IGNORE', 'UTF-8//IGNORE', $row_order['status'] );
				$sum    = $row_order['sum'];
				$opl    = $row_order['opl'] !== ' ' ? $row_order['opl'] : 'Нет';
				$dop    = $row_order['dop'];

				$table_rows .= '
					<tr class="status__row status__order">
						<td data-name="Дата зак.">' . $data_z . '</td>
						<td data-name="№ заказа">' . $id . '</td>
						<td data-name="Наименование">' . $tovar . '</td>
						<td data-name="Статус">' . $status . '</td>
						<td data-name="Сумма">' . $sum . '</td>
						<td data-name="Оплачено">' . $opl . '</td>
						<td data-name="Доплатить">' . $dop . '</td>
					</tr>';
			} while ( $row_order = mysqli_fetch_array( $orders ) );
		}

		$table_foot = '
			<tr class="status__row status__total">
				<td colspan="7">Количество посылок в офисе: ' . $of_pos . ' (' . $of_dop . ' EUR)</td>
			</tr>
		</table>';

		$result = $table_head . $table_rows . $table_foot;
	} else {
		$result = '<p>Нет результатов</p>';
	}

	echo $result;

	die();
}
