<?php
/**
 * Template Name: Корзина
 * Template Post Type: page
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();

$cart      = json_decode( wp_unslash( $_COOKIE['anna_cart'] ), true );
$all_count = 0;
$all_price = 0;
?>

<div class="main__content">
	<section class="cart">
		<h1 class="title cart__title"><?php the_title(); ?></h1>
		<?php if ( $cart ) : ?>
			<div class="cart__body">
				<div class="cart__content">
					<?php foreach ( $cart as $prod_id => $count ) : ?>
						<?php
						$price_field = get_field( 'price', $prod_id );
						$price       = $count * $price_field['new'];
						$all_count  += $count;
						$all_price  += $price;
						?>
						<div class="cart__item">
							<a href="<?php echo esc_url( get_the_permalink( $prod_id ) ); ?>" class="cart__name">
								<?php echo esc_html( get_the_title( $prod_id ) ); ?>
							</a>
							<div class="cart__count"><?php echo esc_html( $count . ' шт.' ); ?></div>
							<div class="cart__price"><?php echo esc_html( adem_number_format( $price ) ); ?></div>
							<button class="cart__del-btn js-del-from-cart" type="button" data-id="<?php echo esc_attr( $prod_id ); ?>">
								<svg width="24" height="24">
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-cross' ); ?>"></use>
								</svg>
							</button>
						</div>
					<?php endforeach; ?>
					<div class="cart__item cart__total">
						<div>Итого</div>
						<div class="cart__count"><?php echo esc_html( $all_count . ' шт.' ); ?></div>
						<div class="cart__price"><?php echo esc_html( adem_number_format( $all_price ) ); ?></div>
						<div></div>
					</div>
					<div class="cart__item cart__total">
						<div class="cart__alert">Итоговую стоимость уточните в офисе</div>
					</div>
				</div>
				<form class="cart__form js-form" name="Корзина">
					<input class="input" type="text" name="name" placeholder="Ваше имя*" required>
					<input class="input" type="tel" name="tel" placeholder="+7 (___) ___-__-__" pattern="[+]7 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}">
					<input class="input" type="email" name="email" placeholder="E-mail">
					<textarea name="message" rows="5" class="input" placeholder="Комментарий к заказу"></textarea>
					<button type="submit" class="btn btn--main cart__btn">Оформить заказ</button>
					<input type="hidden" name="products" value="<?php echo esc_attr( $_COOKIE['anna_cart'] ); ?>">
					<?php wp_nonce_field( 'Корзина', 'nonce' ); ?>
				</form>
			</div>
		<?php else : ?>
			В корзине пусто. Сначала добавьте товары в корзину.
		<?php endif; ?>
	</section>
	<?php
	get_template_part( 'layouts/partials/blocks' );

	the_content();
	?>
</div>

<?php get_footer(); ?>
