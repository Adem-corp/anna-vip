<?php
/**
 * Products template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$products = get_sub_field( 'products' );
?>

<section class="products">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'products__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<?php if ( $products ) : ?>
		<div class="products__body">
			<?php
			foreach ( $products as $post ) {
				setup_postdata( $post );

				get_template_part( 'layouts/cards/prod-card', );
			}

			wp_reset_postdata();
			?>
		</div>
	<?php endif; ?>
</section>
