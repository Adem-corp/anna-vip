<?php
/**
 * The Post template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$site_link = get_field( 'site_link' );
?>

<article class="tease tease-post">
	<div class="tease-post__info">
		<?php if ( $site_link ) : ?>
			<a href="<?php echo esc_url( $site_link['url'] ); ?>" class="tease-post__link" target="<?php echo esc_attr( $site_link['target'] ); ?>"><?php echo esc_html( $site_link['title'] ); ?></a>
		<?php endif; ?>
		<?php if ( get_the_content() ) : ?>
			<a class="tease-post__link" href="<?php the_permalink(); ?>">Листать каталог</a>
		<?php endif; ?>
		<div class="tease-post__title"><?php the_title(); ?></div>
	</div>
	<?php the_post_thumbnail( 'full' ); ?>
</article>
