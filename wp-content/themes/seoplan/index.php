<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seo Plan
 */

get_header(); ?>
<?php
$content_class = array();
$content_class = apply_filters( 'seoplan_main_content_class', $content_class );
$all_class = implode( ' ', $content_class );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main <?php echo esc_attr( $all_class ); ?>" role="main">

		<?php
		if ( have_posts() ) :

			if ( ! is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="entry-header screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;
			?>

			<?php
			/* Start the Loop */

			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

				$post_title = get_the_title();
                if ( empty( $post_title ) )
                {
                    continue;
                }
				get_template_part( 'templates/content', get_post_format() );
            endwhile;
			?>
			<div class="bottom-toolbar col-xs-12">
				<div class="pager">
					<?php seoplan_numeric_pagination(); ?>
				</div>
			</div>
			<?php

		else :

			get_template_part( 'templates/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
