<?php
/**
 * Inner of modal-prod
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$product_id = $args['id'];
$is_top     = get_field( 'is-top', $product_id );
$delivery   = get_field( 'delivery', $product_id );
$price      = get_field( 'price', $product_id );
$text       = get_field( 'text', $product_id );
?>

<div class="modal-prod__top">
	<?php if ( $is_top ) : ?>
		<div class="prod-marker modal-prod__marker">
			<svg width="16" height="16">
				<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-top' ); ?>"></use>
			</svg>
			Топ продаж
		</div>
	<?php endif; ?>
	<?php
	echo get_the_post_thumbnail(
		$product_id,
		'full',
		array( 'class' => 'modal-prod__img' )
	);
	?>
</div>
<div class="modal-prod__body">
	<div class="modal-prod__title"><?php echo esc_html( get_the_title( $product_id ) ); ?></div>
	<?php if ( $delivery ) : ?>
		<div class="modal-prod__delivery"><?php echo wp_kses_post( $delivery ); ?></div>
	<?php endif; ?>
	<div class="modal-prod__price">
		<div class="modal-prod__p-new"><?php echo esc_html( adem_number_format( $price['new'] ) ); ?></div>
		<?php if ( $price['old'] ) : ?>
			<div class="modal-prod__p-old"><?php echo esc_html( adem_number_format( $price['old'] ) ); ?></div>
		<?php endif; ?>
	</div>
	<?php if ( $text ) : ?>
		<div class="modal-prod__text">
			<div class="modal-prod__caption">Краткое описание:</div>
			<?php echo wp_kses_post( $text ); ?>
		</div>
	<?php endif; ?>
	<div class="modal-prod__footer">
		<div class="qty">
			<input type="number" class="input qty__input" value="1" min="1" max="99">
			<button class="qty__btn qty__btn--plus" type="button">
				<svg width="10" height="17">
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-arrow-left' ); ?>"></use>
				</svg>
			</button>
			<button class="qty__btn qty__btn--minus" type="button">
				<svg width="10" height="17">
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-arrow-right' ); ?>"></use>
				</svg>
			</button>
		</div>
		<button class="btn btn--main modal-prod__btn" type="button">В корзину</button>
	</div>
</div>
