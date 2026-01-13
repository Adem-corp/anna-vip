<?php
/**
 * The Page template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();

// $query = new WP_Query(
// array(
// 'post_type'   => 'post',
// 'post_status' => 'publish',
// )
// );
?>

<div class="main__content">
	<?php
	get_template_part( 'layouts/partials/blocks' );

	the_content();
	?>
</div>
<!--
	<section class="page">
		<h1 class="page__title"><?php the_title(); ?></h1>
		<div class="page__body"><?php the_content(); ?></div>
		<?php if ( is_front_page() ) : ?>
			<section class="page__grid">
				<?php
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();

						get_template_part( 'layouts/cards/tease-post' );
					}
					wp_reset_postdata();
				}
				?>
			</section>
			<?php if ( $query->max_num_pages > 1 ) : ?>
				<script>
					let query = <?php echo wp_json_encode( $query->query_vars ); ?>;
					let current_page = <?php echo ( get_query_var( 'paged' ) ) ? esc_js( get_query_var( 'paged' ) ) : 1; ?>;
					const max_pages = <?php echo esc_js( $query->max_num_pages ); ?>;
				</script>
				<div id="ajax_loader">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tail-spin.svg' ); ?>" alt="ajax_loader">
				</div>
			<?php endif; ?>
		<?php else : ?>
			<?php get_template_part( 'layouts/partials/contacts' ); ?>
		<?php endif; ?>
	</section>
	-->

<?php get_footer(); ?>
