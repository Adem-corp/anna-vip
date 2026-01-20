<?php
/**
 * Info template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$cards = get_sub_field( 'cards' );
?>

<section class="info">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'info__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<?php if ( $cards ) : ?>
		<div class="info__body">
			<div class="swiper info__slider">
				<div class="swiper-wrapper">
					<?php foreach ( $cards as $card ) : ?>
						<div class="swiper-slide info-card">
							<?php if ( $card['name'] ) : ?>
								<div class="info-card__name"><?php echo wp_kses_post( $card['name'] ); ?></div>
							<?php endif; ?>
							<?php if ( $card['text'] ) : ?>
								<div class="info-card__text"><?php echo wp_kses_post( $card['text'] ); ?></div>
							<?php endif; ?>
							<?php if ( $card['accent'] ) : ?>
								<div class="info-card__accent"><?php echo wp_kses_post( $card['accent'] ); ?></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="arrows info__arrows">
					<button class="arrow arrow--prev">
						<svg width="10" height="17" class="arrow__icon">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-arrow-left' ); ?>"></use>
						</svg>
					</button>
					<button class="arrow arrow--next">
						<svg width="10" height="17" class="arrow__icon">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-arrow-right' ); ?>"></use>
						</svg>
					</button>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
