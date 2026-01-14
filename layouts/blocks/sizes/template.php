<?php
/**
 * Status template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$sizes = get_sub_field( 'sizes' );
?>

<section class="sizes">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'sizes__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<ul class="sizes__tabs sizes__tabs_gender js-tabs">
		<?php foreach ( $sizes as $gender_key => $size ) : ?>
			<li class="sizes__tab sizes__tab_gender<?php echo 0 === $gender_key ? ' active' : ''; ?>" data-tab="<?php echo esc_attr( 'gender_' . $gender_key ); ?>"><?php echo esc_html( $size['gender'] ); ?></li>
		<?php endforeach; ?>
	</ul>
	<div class="sizes__body">
		<?php foreach ( $sizes as $gender_key => $size ) : ?>
			<div class="sizes__gender<?php echo 0 === $gender_key ? ' active' : ''; ?>" id="<?php echo esc_attr( 'gender_' . $gender_key ); ?>">
				<ul class="sizes__tabs sizes__tabs_cloth js-tabs">
					<?php foreach ( $size['clothes'] as $cloth_key => $cloth ) : ?>
						<li class="sizes__tab sizes__tab_cloth<?php echo 0 === $cloth_key ? ' active' : ''; ?>" data-tab="<?php echo esc_attr( 'cloth_' . $gender_key . '_' . $cloth_key ); ?>">
							<?php echo wp_get_attachment_image( $cloth['image']['id'], 'full' ); ?>
							<div class="sizes__cat"><?php echo wp_kses_post( $cloth['name'] ); ?></div>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="sizes__tables">
					<?php foreach ( $size['clothes'] as $cloth_key => $cloth ) : ?>
						<div class="sizes__table<?php echo 0 === $cloth_key ? ' active' : ''; ?>" id="<?php echo esc_attr( 'cloth_' . $gender_key . '_' . $cloth_key ); ?>">
							<?php echo wp_kses_post( $cloth['content'] ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
