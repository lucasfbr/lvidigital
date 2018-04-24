<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seo Plan
 */

?>
			</div><!-- end .row -->
		</div><!-- end .container -->
		<?php do_action( 'seoplan_after_content' ); ?>
	</div><!-- #content -->
	<div class="before-footer-section">
		<?php do_action( 'seoplan_before_footer' ); ?>
	</div>
	<footer id="colophon" class="site-footer type1">
		<?php do_action( 'seoplan_footer' ) ?>
	</footer><!-- #colophon -->
	<div class="after-footer-section">
		<?php do_action( 'seoplan_after_footer' ); ?>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
