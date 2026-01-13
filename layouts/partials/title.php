<?php
/**
 * Title partial template.
 *
 * @package Oknaproekt
 * @since 1.0.0
 */

if ( ! empty( $args['title']['text'] ) ) {
	$h_class  = 'title';
	$h_class .= $args['class'];

	echo wp_kses_post(
		sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			$args['title']['type'],
			'title ' . $args['class'],
			$args['title']['text']
		)
	);
}
