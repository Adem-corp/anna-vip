<?php
/**
 * Hero template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$hero = array(
	'title'    => get_field( 'title' ),
	'subtitle' => get_field( 'subtitle' ),
	'text'     => get_field( 'text' ),
	'btn'      => get_field( 'btn' ),
	'img'      => get_field( 'img' ),
	'banner'   => get_field( 'banner' ),
	'gallery'  => get_field( 'gallery' ),
);
?>

<section class="hero">
	<div class="container hero__container">
		<div class="hero__top">
			<h1 class="title hero__title"><?php echo wp_kses_post( $hero['title'] ); ?></h1>
			<?php if ( $hero['subtitle'] ) : ?>
				<div class="hero__subtitle"><?php echo wp_kses_post( $hero['subtitle'] ); ?></div>
			<?php endif; ?>
			<?php if ( $hero['text'] ) : ?>
				<div class="hero__text"><?php echo wp_kses_post( $hero['text'] ); ?></div>
			<?php endif; ?>
			<?php if ( $hero['btn']['url'] ) : ?>
				<a href="<?php echo esc_url( $hero['btn']['url'] ); ?>" class="hero__btn">
					<?php echo wp_kses_post( $hero['btn']['title'] ); ?>
					<span class="hero__b-icon">
						<svg width="21" height="33" class="burger-btn__main-icon">
							<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-hero-btn-arrow' ); ?>"></use>
						</svg>
					</span>
				</a>
			<?php endif; ?>
			<?php
			echo wp_get_attachment_image(
				$hero['img'],
				'full',
				false,
				array(
					'class' => 'hero__img',
				)
			);
			?>
		</div>
		<div class="hero__bottom">
			<?php
			echo wp_kses_post(
				adem_dynamic_thumbnail(
					$hero['banner'],
					995,
					442,
					true,
					array(
						'class' => 'hero__banner',
					)
				)
			);
			?>
			<?php if ( $hero['gallery'] ) : ?>
				<div class="hero__gallery">
					<?php
					foreach ( $hero['gallery'] as $img_id ) {
						echo wp_kses_post(
							adem_dynamic_thumbnail(
								$img_id,
								315,
								420,
								true,
								array(
									'class' => 'hero__g-img',
								)
							)
						);
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
