<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Seo Plan
 */

get_header(); ?>

    <div id="primary" class="content-area col-xs-12">
        <main id="main" class="site-main" role="main">

            <section class="error-404 not-found text-center">
                <header class="page-header">
                    <?php
                    $page_title = seoplan_get_option( 'general_404_page_title' );
                    if ( ! $page_title )
                    {
                        $page_title = '404';
                    }
                    $page_sub_description = seoplan_get_option( 'general_404_page_sub_description' );
                    if ( ! $page_sub_description )
                    {
                        $page_sub_description = esc_html__( 'Page not found!', 'seoplan' );
                    }
                    $page_description = seoplan_get_option( 'general_404_page_description' );
                    if ( ! $page_description )
                    {
                        $page_description = esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'seoplan' );
                    }
                    $home_url = get_home_url();
                    ?>
                    <h1 class="title"><?php echo esc_html( $page_title ); ?></h1>
                    <h3 class="page-sub-title"><?php echo esc_html( $page_sub_description ); ?></h3>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php echo esc_html( $page_description ); ?></p>
                </div><!-- .page-content -->
                <a class="back-homepage" href="<?php echo esc_url( $home_url ); ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> <?php esc_html_e( 'Back To HomePage', 'seoplan' ); ?></a>
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
