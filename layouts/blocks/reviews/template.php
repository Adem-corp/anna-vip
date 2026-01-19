<?php
/**
 * Reviews template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$reviews = get_sub_field( 'reviews' );
?>

<section class="reviews">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'reviews__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<?php if ( $reviews ) : ?>
		<div class="reviews__body">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $reviews as $post ) : ?>
						<?php setup_postdata( $post ); ?>
						<div class="swiper-slide">
							<?php
							get_template_part( 'layouts/cards/review-card' );
							?>
						</div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	<?php endif; ?>
</section>
