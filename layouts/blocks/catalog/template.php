<?php
/**
 * Catalog template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$query = new WP_Query(
	array(
		'post_type'   => 'post',
		'post_status' => 'publish',
	)
);
?>

<section class="catalog">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'catalog__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<div class="catalog__grid">
		<?php
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				get_template_part( 'layouts/cards/catalog-card' );
			}

			wp_reset_postdata();
		}
		?>
	</div>
	<?php if ( $query->max_num_pages > 1 ) : ?>
		<script>
			let catalog_query = <?php echo wp_json_encode( $query->query_vars ); ?>;
			let catalog_current_page = <?php echo get_query_var( 'paged' ) ? esc_js( get_query_var( 'paged' ) ) : 1; ?>;
			let catalog_nonce = '<?php echo esc_js( wp_create_nonce( 'load_more' ) ); ?>';
		</script>
		<div id="ajax_loader">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/loading.svg' ); ?>" alt="ajax_loader">
		</div>
	<?php endif; ?>
</section>
