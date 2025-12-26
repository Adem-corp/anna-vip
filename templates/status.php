<?php
/**
 * Template Name: Статус
 * Template Post Type: page
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();

$option_contacts = get_field( 'contacts', 'option' );
?>

<div class="container main__container">
	<?php get_template_part( 'layouts/partials/sidebar' ); ?>
	<section class="page"">
		<h1 class="page__title"><?php the_title(); ?></h1>
		<div class="page__body">
			<section class="status">
				<form class="status__form" id="status">
					<label>
						<span>Код:</span>
						<input class="input" type="number" name="uid" min="0" step="1" required>
					</label>
					<label>
						<span>Фамилия:</span>
						<input class="input" type="text" name="password" required>
					</label>
					<button type="submit" class="btn btn_submit">Войти</button>
				</form>
			</section>
		</div>
		<?php get_template_part( 'layouts/partials/contacts' ); ?>
	</section>
</div>

<?php
get_template_part( 'layouts/partials/blocks' );

get_footer();
