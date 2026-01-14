<?php
/**
 * Title partial template.
 *
 * @package Oknaproekt
 * @since 1.0.0
 */

if ( ! empty( $args['title']['text'] ) ) {
	$h_class_array = array( 'title', 'title--' . $args['title']['position'], $args['class'] );
	$h_class       = implode( ' ', $h_class_array );

	echo wp_kses_post(
		sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			$args['title']['type'],
			$h_class,
			$args['title']['text']
		)
	);
}
