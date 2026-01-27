<?php
/**
 * The Product-card template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$is_top = get_field( 'is-top' );
$params = get_field( 'params' );
$price  = get_field( 'price' );
?>

<article class="prod-card">
	<div class="prod-card__top">
		<?php if ( $is_top ) : ?>
			<div class="prod-marker prod-card__marker">
				<svg width="16" height="16">
					<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-top' ); ?>"></use>
				</svg>
				Топ продаж
			</div>
		<?php endif; ?>
		<?php
		the_post_thumbnail(
			'full',
			array( 'class' => 'prod-card__img' )
		);
		?>
		<button class="prod-card__show-btn js-show-product" type="button" data-id="<?php the_ID(); ?>">Подробнее</button>
	</div>
	<div class="prod-card__body">
		<div class="prod-card__name"><?php the_title(); ?></div>
		<?php if ( $params ) : ?>
			<ul class="reset-list prod-card__params">
				<?php foreach ( $params as $item ) : ?>
					<li class="prod-card__p-item">
						<div class="prod-card__p-name"><?php echo esc_html( $item['name'] ); ?></div>
						<div class="prod-card__p-value"><?php echo esc_html( $item['value'] ); ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="prod-card__footer">
		<div class="prod-card__price">
			<div class="prod-card__p-new"><?php echo esc_html( adem_number_format( $price['new'] ) ); ?></div>
			<?php if ( $price['old'] ) : ?>
				<sup class="prod-card__p-old"><?php echo esc_html( adem_number_format( $price['old'] ) ); ?></sup>
			<?php endif; ?>
		</div>
		<button class="prod-card__cart-btn" type="button">
			<svg width="20" height="20">
				<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-prod-cart' ); ?>"></use>
			</svg>
		</button>
	</div>
</article>
