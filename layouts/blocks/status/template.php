<?php
/**
 * Status template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

?>

<section class="status">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'status__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<div class="status__container">
		<form class="status__form" id="status">
			<input class="input status__input" type="number" name="uid" min="0" step="1" placeholder="Ваш код" required>
			<input class="input status__input" type="text" name="password" placeholder="Ваша фамилия" required>
			<button type="submit" class="btn btn--main status__btn">Показать</button>
		</form>
	</div>
</section>
