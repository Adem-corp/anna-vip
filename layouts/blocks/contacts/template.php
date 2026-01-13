<?php
/**
 * Contacts template.
 *
 * @package Anna-vip
 * @since 1.0.0
 */

$option_address   = get_field( 'address', 'option' );
$option_work_time = get_field( 'work-time', 'option' );
$option_tel       = get_field( 'tel', 'option' );
$option_email     = get_field( 'email', 'option' );
$option_map       = get_field( 'map', 'option' );
?>

<section class="contacts">
	<?php
	get_template_part(
		'/layouts/partials/title',
		null,
		array(
			'class' => 'contacts__title',
			'title' => get_sub_field( 'title' ),
		)
	);
	?>
	<div class="contacts__body">
		<div class="contacts-info contacts__info">
			<?php if ( $option_address ) : ?>
				<address class="contacts-info__address"><?php echo wp_kses_post( $option_address ); ?></address>
			<?php endif; ?>
			<?php if ( $option_work_time ) : ?>
				<div class="contacts-info__work-time">
					<div class="contacts-info__caption">График работы:</div>
					<?php echo wp_kses_post( $option_work_time ); ?>
				</div>
			<?php endif; ?>
			<div class="contacts-info__main-contacts">
				<div class="contacts-info__caption">Контакты:</div>
				<?php if ( $option_tel ) : ?>
					<a href="<?php echo esc_url( 'tel:' . adem_clear_tel( $option_tel ) ); ?>" class="contacts-info__link contacts-info__tel">
						<?php echo esc_html( $option_tel ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $option_email ) : ?>
					<a href="<?php echo esc_url( 'mailto:' . $option_email ); ?>" class="contacts-info__link contacts-info__email">
						<?php echo esc_html( $option_email ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $option_map ) : ?>
			<div class="contacts__map">
				<?php
				echo wp_kses(
					$option_map,
					array(
						'iframe' => array(
							'src'                   => true,
							'width'                 => true,
							'height'                => true,
							'webkitallowfullscreen' => true,
							'mozallowfullscreen'    => true,
							'allowfullscreen'       => true,
							'allowtransparency'     => true,
							'scrolling'             => true,
							'loading'               => true,
						),
					)
				);
				?>
			</div>
		<?php endif; ?>
	</div>
</section>
