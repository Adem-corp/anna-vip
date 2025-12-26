<?php
/**
 * The Footer template
 *
 * @package Anna-vip
 * @since 1.0.0
 */

?>

</main>
<footer class="footer">
	<div class="container">
		<div class="footer__info"><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>" target="_blank">Политика конфиденциальности</a></div>
		<div class="footer__info">anna-vip.ru © <?php echo esc_html( gmdate( 'Y' ) ); ?></div>
	</div>
</footer>

<?php
get_template_part( 'layouts/partials/modals' );

wp_footer();
?>

</body>
</html>
