<?php
/**
 * Single post template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();

?>

<?php if ( post_password_required() ) : ?>
	<?php
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
<?php else : ?>
	<article class="post">
		<h1 class="post__title"><?php the_title(); ?></h1>
		<div class="post__content"><?php the_content(); ?></div>
	</article>

	<?php get_template_part( 'layouts/partials/blocks' ); ?>
<?php endif; ?>

<?php
get_footer();
