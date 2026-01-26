<?php
/**
 * Cert template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$block_title = get_sub_field( 'title' );
$text        = get_sub_field( 'text' );
?>

<section class="cert">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cert-img.png' ); ?>" alt="" class="cert__img" width="630" height="451">
	<div class="cert__body">
		<?php if ( $block_title ) : ?>
			<div class="cert__title"><?php echo wp_kses_post( $block_title ); ?></div>
		<?php endif; ?>
		<?php if ( $text ) : ?>
			<div class="cert__text"><?php echo wp_kses_post( $text ); ?></div>
		<?php endif; ?>
	</div>
</section>
