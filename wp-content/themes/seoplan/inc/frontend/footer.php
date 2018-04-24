<?php
/**
 * Hooks custom elements in footer
 */

/**
 * Function output a subscribe form in footer
 */
function seoplan_footer_subscribe_form()
{
    $section_subscribe = seoplan_get_option( 'footer_enable_subscribe' );
    if ( $section_subscribe )
    {
        $background_img = seoplan_get_option( 'footer_subscribe_background_image' );
        $background_color = seoplan_get_option( 'footer_subscribe_background_color' );
        $background_img_style = '';

        if ( $background_img )
        {
            $background_img_style = sprintf( 'style="background-image: url( %s )"', esc_url( $background_img['url'] ) );
        }
        $background_color_style = '';
        if ( $background_color )
        {
            $background_color_style = sprintf( 'style="background-color: %s"', esc_attr( $background_color ) );
        }
?>
    <section class="seoplan-newsletter" <?php echo $background_color_style; ?> >
        <div class="newsletter-bg animation-bg" <?php echo $background_img_style; ?> >
            <div class="container">
                <div class="form-newsletter col-xs-12">
                    <?php
                    if ( class_exists('NewsletterSubscription') )
                    {
                        ?>
                        <div class="newsletter">
                            <span><?php esc_html_e( 'Email Newsletter!', 'seoplan' ); ?></span>
                            <?php echo do_shortcode( '[newsletter_form type="minimal" placeholder="' . esc_html__( 'You Email', 'seoplan' ) . '"]' ); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php
    }
}
add_action( 'seoplan_before_footer', 'seoplan_footer_subscribe_form', 15 );

/**
 * Function displays widgets registered on footer
 */
function seoplan_footer_widget()
{
    $enable_footer_widget = seoplan_get_option( 'enable_footer_widget_columns' );

    if( $enable_footer_widget )
    {
        $number_column =  seoplan_get_option( 'footer_widget_columns' );
        $widget_active = false;
        for ( $i = 1; $i <= $number_column; $i++ )
        {
            if ( is_active_sidebar( "footer-sidebar-$i" ) )
            {
                $widget_active = true;
            }
        }
        if ( $widget_active )
        {
    ?>
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                <?php
                for ( $i = 1; $i <= $number_column; $i++ )
                {
                    $col_range = 12 / $number_column;
                    $col_sm = 6;
                    $col_offset = '';
                    if ( 3 == $number_column )
                    {
                        if ( 1 == $i )
                        {
                            $col_range = 5;
                            $col_sm = 12;
                        }
                        elseif ( 2 == $i )
                        {
                            $col_offset = 'col-md-offset-1';
                            $col_range = 3;
                        }
                        elseif ( 3 == $i )
                        {
                            $col_range = 3;
                        }
                    }
                ?>
                    <div class="footer-<?php echo esc_attr( $i ); ?> col-md-<?php echo esc_attr( $col_range ); ?> col-xs-12 col-sm-<?php echo esc_attr( $col_sm ); ?> <?php echo esc_attr( $col_offset )?>">
                    <?php
                        if ( is_active_sidebar( "footer-sidebar-$i" ) )
                        {
                            dynamic_sidebar( "footer-sidebar-$i" );
                        }
                    ?>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    <?php
        }
    }
}
add_action( 'seoplan_footer', 'seoplan_footer_widget', 5 );

/**
 * Function displays footer menu
 */
function seoplan_footer()
{
?>
    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="copyright col-md-5 cil-sm-12 col-xs-12">
                <?php
                $info = seoplan_get_option( 'footer_copyright' );
                if ( $info )
                {
                    echo do_shortcode( wp_kses( $info, wp_kses_allowed_html( 'post' ) ) );
                }
                ?>
                </div>
                <?php
                if ( has_nav_menu( 'footer' ) )
                {
                ?>
                    <div class="footer-menu col-md-7 hidden-sm hidden-xs">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'container'      => false,
                        ) );
                        ?>
                    </div><!-- end .footer-menu -->
                <?php
                }
                ?>
            </div>
        </div>
    </div><!-- .site-info -->
<?php
}
add_action( 'seoplan_footer', 'seoplan_footer', 10 );

/**
 *  Function display popup search form
 */
function seoplan_popup_search_form()
{
?>
    <div class="seoplan-popup-search">
        <div class="container">
            <div class="popup-content">
            <?php
            get_search_form();
            ?>
            </div>
        </div>
    </div>
<?php
}
add_action( 'wp_footer', 'seoplan_popup_search_form' );

/**
 * Function display mobile menu
 */
function seoplan_mobile_menu()
{
    $location = has_nav_menu( 'mobile' ) ? 'mobile' : 'primary';
    if ( has_nav_menu( $location ) )
    {
        ?>
        <div class="side-menu-background"></div>
        <nav id="mobile-menu-nav" class="mobile-nav mobile-menu-nav hidden-lg" role="navigation">
            <div id="close-menu"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></div>
            <?php
            wp_nav_menu( array(
                'theme_location' => $location,
                'container'      => false,
            ) );
            ?>
        </nav>
        <?php
    }
}
add_action( 'wp_footer', 'seoplan_mobile_menu' );

function seoplan_count_post_view()
{
    if ( is_singular( 'post' ) )
    {
        $post_id = get_the_ID();
        $post_view = get_post_meta( $post_id, '_seoplan_count_post_view', true ) ? get_post_meta( $post_id, '_seoplan_count_post_view', true ) : 0;
        // update post view
        $post_view++;
        update_post_meta( $post_id, '_seoplan_count_post_view', $post_view );
    }
}
add_action( 'wp_footer', 'seoplan_count_post_view' );