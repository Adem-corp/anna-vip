<?php
/**
 * Text template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$text = get_sub_field( 'text' );
?>

<section class="text">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'text__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<?php if ( $text ) : ?>
		<div class="text__body"><?php echo wp_kses_post( $text ); ?></div>
	<?php endif; ?>
</section>
