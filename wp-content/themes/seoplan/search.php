<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Seo Plan
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="clearfix">
				<h1 class="entry-header screen-reader-text col-xs-12"><?php printf( esc_html__( 'Search Results for: %s', 'seoplan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

		<?php
		if ( have_posts() ) : ?>

			<div class="blog-list clearfix">
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
				get_template_part( 'templates/content', 'search' );

			endwhile;

			?>
			</div><!-- end .blog-list -->

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
