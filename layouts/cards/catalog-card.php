<?php
/**
 * The Post template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$site_link = get_field( 'site_link' );
$blocks    = get_field( 'blocks' );
?>

<article class="catalog-card">
	<div class="catalog-card__info">
		<?php if ( $site_link ) : ?>
			<a href="<?php echo esc_url( $site_link['url'] ); ?>" class="catalog-card__link" target="<?php echo $site_link['target'] ? esc_attr( $site_link['target'] ) : '_self'; ?>"><?php echo esc_html( $site_link['title'] ); ?></a>
		<?php endif; ?>
		<?php if ( $blocks ) : ?>
			<a class="catalog-card__link" href="<?php the_permalink(); ?>">Листать каталог</a>
		<?php endif; ?>
		<div class="catalog-card__title"><?php the_title(); ?></div>
	</div>
	<?php
	the_post_thumbnail(
		'full',
		array( 'class' => 'catalog-card__img' )
	);
	?>
</article>
