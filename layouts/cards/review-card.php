<?php
/**
 * The Review-card template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$city = get_field( 'city' );
$text = get_field( 'text' );
?>

<article class="review-card" id="<?php echo esc_attr( get_the_ID() ); ?>">
	<div class="review-card__header">
		<?php
		echo wp_kses_post(
			adem_dynamic_thumbnail(
				get_field( 'avatar' ),
				60,
				60,
				true,
				array(
					'class' => 'review-card__img',
				)
			)
		);
		?>
		<div class="review-card__info">
			<div class="review-card__name"><?php echo esc_html( get_field( 'name' ) ); ?></div>
			<?php if ( $city ) : ?>
				<div class="review-card__city"><?php echo esc_html( $city ); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<div class="review-card__body"><?php echo wp_kses_post( $text ); ?></div>
</article>
