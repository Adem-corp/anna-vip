<?php
/**
 * The Contacts template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_contacts = get_field( 'contacts', 'option' );
?>

<section class="contacts">
	<div class="contacts__container">
		<?php foreach ( $option_contacts['offices'] as $office ) : ?>
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
			</div>
		<?php endforeach; ?>
	</div>
</section>
