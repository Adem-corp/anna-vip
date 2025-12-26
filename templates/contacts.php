<?php
/**
 * Template Name: Контакты
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
	<section class="page">
		<h1 class="page__title"><?php the_title(); ?></h1>
		<div class="page__body">
			<section class="contacts">
				<?php foreach ( $option_contacts['offices'] as $key => $office ) : ?>
					<div class="contacts__item">
						<div class="contacts__text">
							<div class="contacts__title"><?php echo esc_html( $office['title'] ); ?></div>
							<div class="contacts__body">
								<p><?php echo esc_html( $office['address'] ); ?></p>
								<p>
									<strong>График работы:</strong><br>
									<?php echo wp_kses_post( $office['schedule'] ); ?>
								</p>
								<p>
									<strong>Контакты:</strong><br>
									<?php foreach ( $office['tel'] as $tel ) : ?>
										<a href="<?php echo esc_url( 'tel:' . adem_clear_tel( $tel['number'] ) ); ?>"><?php echo esc_html( $tel['number'] ); ?></a><br>
									<?php endforeach; ?>
									<?php if ( $office['mail'] ) : ?>
										<a href="<?php echo esc_url( 'mailto:' . $office['mail'] ); ?>"><?php echo esc_html( $office['mail'] ); ?></a><br>
									<?php endif; ?>
								</p>
							</div>
						</div>
						<div class="contacts__map" id="<?php echo esc_js( 'map_' . $key ); ?>"></div>
						<?php $map = json_decode( $office['map'], true ); ?>
						<script type="text/javascript">
							document.addEventListener("DOMContentLoaded", function(e) {
								ymaps.ready(init);

								function init() {
									let maps = new ymaps.Map("<?php echo esc_js( 'map_' . $key ); ?>", {
										center: ['<?php echo esc_js( $map['center_lat'] ); ?>', '<?php echo esc_js( $map['center_lng'] ); ?>'],
										zoom: '<?php echo esc_js( $map['zoom'] ); ?>',
										controls: []
									});
									<?php foreach ( $map['marks'] as $mark ) : ?>
									maps.geoObjects.add(
										new ymaps.Placemark(
											[
												'<?php echo esc_js( $mark['coords'][0] ); ?>',
												'<?php echo esc_js( $mark['coords'][1] ); ?>'
											],
											{
												hintContent: '<?php echo esc_js( $mark['content'] ); ?>',
												balloonContent: '<?php echo esc_js( $mark['content'] ); ?>'
											}
										)
									);
									<?php endforeach; ?>
								}
							});
						</script>
					</div>
				<?php endforeach; ?>
			</section>
		</div>
	</section>
</div>

<?php
get_template_part( 'layouts/partials/blocks' );

get_footer();
