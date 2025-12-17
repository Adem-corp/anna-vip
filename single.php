<?php
/**
 * Single post template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

get_header();

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
} else {
	get_template_part( 'layouts/partials/blocks' );
}

get_footer();
