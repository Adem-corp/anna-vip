<?php
/**
 * Order template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_catalogs = get_field( 'catalogs', 'option' );
$text            = get_sub_field( 'text' );
?>

<section class="order">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'order__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<?php if ( $text ) : ?>
		<div class="order__text"><?php echo wp_kses_post( $text ); ?></div>
	<?php endif; ?>
	<form class="order__form" name="Заказ" id="order">
		<div class="order__form-title">Клиент офиса</div>
		<div class="order__main-info">
			<input class="input" type="text" name="client_name" placeholder="Фамилия Имя Отчество*" required>
			<input class="input" type="text" name="client_kod" placeholder="Код клиента*" required>
			<input class="input" type="email" name="client_email" placeholder="example@gmail.com*" required>
			<input class="input" type="tel" name="client_tel" placeholder="+7 (___) ___-__-__" pattern="[+]7 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}">
		</div>
		<div class="order__form-caption">* - поля, обязательные для заполнения</div>
		<div class="table order__table">
			<table>
				<tr class="order__header-row">
					<td>Название каталога</td>
					<td>Стр.</td>
					<td>Рис.</td>
					<td>Название на русском</td>
					<td>Кол-во</td>
					<td>Артикул</td>
					<td>Размер</td>
					<td>Цвет</td>
					<td>Цена (EURO)</td>
				</tr>
			</table>
		</div>
		<div class="order__delivery">
			<div class="order__delivery-block">Для расчета стоимости заказа введите вашу доставку в % <input class="input order__input" type="number" name="percent" maxlength="2" oninput="if(this.value.length>this.maxLength) this.value=this.value.slice(0,this.maxLength)"></div>
			<button title="Дообавить позицию" type="button" class="order__add-btn" id="add_pos">
				<svg width="18" height="18">
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-plus' ); ?>"></use>
				</svg>
			</button>
		</div>
		<div class="order__total">
			<div class="order__total-text"></div>
			<button type="button" class="btn btn--secondary" id="calc_order">Расчет заказа</button>
		</div>
		<label class="checkbox order__privacy">
			<input type="checkbox" name="policy" required>
			<span class="checkbox__text">Даю согласие на обработку моих персональных данных в соответствии с <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">Политикой конфиденциальности</a></span>
		</label>
		<button type="submit" class="btn btn--main order__btn">Отправить заказ</button>
		<input type="hidden" name="catalog_count">
		<?php wp_nonce_field( 'make_order', 'make_order_adem' ); ?>
	</form>
</section>
