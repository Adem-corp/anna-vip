<?php
/**
 * The Page template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();
?>

<div class="main__content">
	<?php
	get_template_part( 'layouts/partials/blocks' );

	the_content();
	?>
</div>

<?php get_footer(); ?>
