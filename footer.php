<?php
/**
 * The Footer template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_address   = get_field( 'address', 'option' );
$option_map       = get_field( 'map-link', 'option' );
$option_social    = get_field( 'social', 'option' );
$option_tel       = get_field( 'tel', 'option' );
$option_work_time = get_field( 'work-time', 'option' );
?>

</main>
<footer class="footer">
	<div class="container footer__container">
		<a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="footer__logo">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="" width="170" height="105">
		</a>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu_footer',
				'container'      => '',
				'menu_id'        => 'menu-footer',
				'menu_class'     => 'reset-list menu-footer footer__menu',
				'depth'          => 1,
			)
		);
		?>
		<div class="footer__col footer__col-address">
			<?php if ( $option_address ) : ?>
				<address class="footer__address"><?php echo wp_kses_post( $option_address ); ?></address>
			<?php endif; ?>
			<?php if ( $option_map ) : ?>
				<a href="<?php echo esc_url( $option_map['url'] ); ?>" class="footer__map-link" target="<?php echo $option_map['target'] ? esc_attr( $option_map['target'] ) : '_self'; ?>">
					<?php echo esc_html( $option_map['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="footer__col footer__col-contacts">
			<?php if ( $option_social ) : ?>
				<ul class="reset-list social footer__social">
					<?php foreach ( $option_social as $item ) : ?>
						<li>
							<a href="<?php echo esc_url( $item['link'] ); ?>" class="social__link">
								<svg width="36" height="36">
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sprite.svg#i-' . $item['icon'] ); ?>"></use>
								</svg>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( $option_tel ) : ?>
				<a href="<?php echo esc_url( 'tel:' . adem_clear_tel( $option_tel ) ); ?>" class="footer__tel">
					<?php echo esc_html( $option_tel ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $option_work_time ) : ?>
				<div class="footer__work-time"><?php echo wp_kses_post( $option_work_time ); ?></div>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php
get_template_part( 'layouts/partials/modals' );

wp_footer();
?>

</body>
</html>
