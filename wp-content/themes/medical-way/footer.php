<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medical_Way
 */

	/**
	 * Hook - medical_way_after_content.
	 *
	 * @hooked medical_way_after_content_action - 10
	 */
	do_action( 'medical_way_after_content' );

?>

	<?php get_template_part( 'template-parts/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php $copyright_text = medical_way_get_option( 'copyright_text' ); ?>
			<?php if ( ! empty( $copyright_text ) ) : ?>
				<div class="copyright">
					<?php echo wp_kses_data( $copyright_text ); ?>
				</div><!-- .copyright -->
			<?php endif; ?>

			<?php do_action( 'medical_way_credit' ); ?>
			
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
