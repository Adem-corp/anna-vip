<?php
/**
 * Template Name: Заказ
 * Template Post Type: page
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();

$option_contacts = get_field( 'contacts', 'option' );
$option_catalogs = get_field( 'catalogs', 'option' );
?>

<div class="container main__container">
	<?php get_template_part( 'layouts/partials/sidebar' ); ?>
	<section class="page">
		<h1 class="page__title"><?php the_title(); ?></h1>
		<div class="page__body">
			<section class="order">
				<?php the_content(); ?>
				<form class="form" name="order" method="post" data-name="Заказ" id="order">
					<div class="table">
						<table class="order__table order__table_client">
							<tr>
								<th colspan="2">Клиент офиса</th>
							</tr>
							<tr>
								<td>Ф.И.О. *</td>
								<td>
									<input class="input" type="text" name="client_name" placeholder="Фамилия Имя Отчество" required>
								</td>
							</tr>
							<tr>
								<td>Код клиента *</td>
								<td>
									<input class="input" type="text" name="client_kod" placeholder="Код клиента" required>
								</td>
							</tr>
							<tr>
								<td>E-mail *</td>
								<td>
									<input class="input" type="email" name="client_email" placeholder="example@gmail.com" required>
								</td>
							</tr>
							<tr>
								<td>Телефон</td>
								<td>
									<input class="input" type="tel" placeholder="+7(123)456-78-90" name="client_tel">
								</td>
							</tr>
							<tr>
								<td>Офис получения заказа</td>
								<td>
									<select name="office">
										<?php foreach ( $option_contacts['offices'] as $office ) : ?>
											<option value="<?php echo esc_attr( preg_match( '/(?<=["\'])[^"\']+/', $office['title'] ) ); ?>"><?php echo esc_html( $office['title'] ); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Сезон каталогов</td>
								<td>
									<select name="season">
										<option value="Весна-Лето">Весна-Лето</option>
										<option value="Осень-Зима">Осень-Зима</option>
									</select>
								</td>
							</tr>
						</table>
					</div>

					<p>* - поля, обязательные для заполнения</p>

					<div class="table">
						<table class="order__table order__table_catalog">
							<tr>
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
							<tr class="order__delivery">
								<td colspan="8">Для расчета стоимости заказа введите вашу доставку в % <input type="text" name="percent" maxlength="2" size="2">
								</td>
								<td>
									<button title="Дообавить позицию" type="button" class="btn btn_add" id="add_pos">+</button>
								</td>
							</tr>
							<tr>
								<td colspan="6" class="order__total"></td>
								<td colspan="3">
									<button type="button" class="btn btn_main" id="calc_order">Расчет заказа</button>
								</td>
							</tr>
							<tr>
								<td colspan="9" style="text-align: center;">
									<label class="checkbox" style="font-size: 14px;">
										<input type="checkbox" name="policy" required>
										<span class="checkbox__text">Даю согласие на обработку моих персональных данных в соответствии с <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">Политикой конфиденциальности</a></span>
									</label>
								</td>
							</tr>
							<tr>
								<td colspan="9">
									<button type="submit" class="btn btn_submit">Отправить заказ</button>
								</td>
							</tr>
						</table>
					</div>
					<input type="hidden" name="catalog_count">
					<?php wp_nonce_field( 'make_order', 'make_order_adem' ); ?>
				</form>
			</section>
		</div>
		<?php get_template_part( 'layouts/partials/contacts' ); ?>
	</section>
	<script>
		document.addEventListener("DOMContentLoaded", function(e) {
			let counter = 1;

			function addCatalogRow() {
				let row = $(`<tr class="order__catalog-row">
								<td>
									<select name='cat_${counter}'>
										<?php foreach ( $option_catalogs as $catalog ) : ?>
											<option value="<?php echo esc_attr( $catalog['name'] ); ?>"><?php echo esc_html( $catalog['name'] ); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<input class="input" type='text' name='page_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='img_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='name_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='count_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='art_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='size_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='color_${counter}'>
								</td>
								<td>
									<input class="input" type='text' name='price_${counter}'>
								</td>
							</tr>`).insertBefore($('.order__delivery'));
				$('input[name=catalog_count]').val(counter);
				counter++;
			}

			addCatalogRow();

			$('#add_pos').on('click', function () {
				addCatalogRow();
			});

			function calcOrder() {
				let rows = $('.order__catalog-row');
				let total = 0;
				let percent = $('input[name=percent]').val();
				let result = '';

				rows.each(function (i, elem) {
					let quantity = $(elem).find('input[name^=count_]').val();
					let price = $(elem).find('input[name^=price_]').val();

					total += quantity * price;
				});

				if (percent) {
					total += total*percent/100;
					result = 'Сумма заказа с учетом доставки ' + total + ' EUR';
				} else {
					result = 'Сумма заказа без учета доставки ' + total + ' EUR';
				}

				if (total > 0) {
					$('.order__total').html(`<strong>${result}</strong>`);
				}
			}

			$('#calc_order').on('click', function () {
				calcOrder();
			});

			$('form#order').on('submit', function (e) {
				e.preventDefault();
				const form = $(this);
				let formData = new FormData(form.get(0));

				if (form.data('name')) {
					formData.append('form_name', form.data('name'));
				} else {
					return;
				}

				$.ajax({
					type: 'POST',
					url: '/wp-admin/admin-ajax.php?action=make_order',
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function (data) {
						form.trigger("reset");
						$.fancybox.open({
							src: '<div class="success" id="order_success">' +
								'<svg class="success__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">' +
								'<circle class="success__icon-circle" cx="26" cy="26" r="25" fill="none" />' +
								'<path class="success__icon-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />' +
								'</svg>' +
								'<h3>Поздравляем!</h3>' +
								'<p>Ваш заказ № <strong>' + data + '</strong> отправлен.</p>' +
								'<button class="btn btn_success" type="button" data-fancybox-close>OK</button>' +
								'</div>',
							type: 'inline',
							modal: true
						});
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log(jqXHR, textStatus, errorThrown);
					}
				});
			});
		});
	</script>
</div>

<?php
get_template_part( 'layouts/partials/blocks' );

get_footer();
