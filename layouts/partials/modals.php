<?php
/**
 * Template for all modals
 *
 * @package Anna-vip
 * @since 1.0.0
 */

?>

<form class="subscribe" data-name="Подписка на рассылку" id="subscribe">
	<h3>Подписаться на рассылку</h3>
	<input class="subscribe__input" type="text" name="client_name" placeholder="Ваше имя *" required>
	<input class="subscribe__input" type="email" name="client_email" placeholder="Ваш email *" required>
	<label class="checkbox" style="display: block; margin-bottom: 20px; font-size: 14px;">
		<input type="checkbox" name="policy" required>
		<span class="checkbox__text">Даю согласие на обработку моих персональных данных в соответствии с <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">Политикой конфиденциальности</a></span>
	</label>
	<button type="submit" class="btn btn_main subscribe__btn">Отправить</button>
	<?php adem_wp_nonce_field( 'Подписка на рассылку' ); ?>
</form>
