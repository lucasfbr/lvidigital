<?php
function seoplan_display_breadcrumb()
{
    if ( is_front_page() )
    {
        return;
    }
    $show_breadcrumb = seoplan_get_option( 'enable_breadcrumb' );
    $show_on = seoplan_get_option( 'breadcrumb' );
    $current_post_type = get_post_type() == false ? 'page' : get_post_type() ;
    $hide_breadcrumb = seoplan_get_post_meta( 'seoplan_hide_breadcrumb' );
    if ( $show_breadcrumb && $show_on[$current_post_type] && ! $hide_breadcrumb )
    {
        $background_parallax = seoplan_get_option( 'breadcrumb_parallax_bg' );
        $parallax_style = '';
        if ( $background_parallax && ! empty( $background_parallax['url'] ) )
        {
            $parallax_style = sprintf( 'style="background-image: url(%s)"', esc_url( $background_parallax['url'] ) );
        }

        $background = seoplan_get_option( 'breadcrumb_bg' );
        $background_style = '';
        if ( $background && ! empty( $background['url'] ) )
        {
            $background_style = sprintf( 'style="background-image: url(%s)"', esc_url( $background['url'] ) );
        }
?>
    <section class="seoplan-breadcrumb parallax" <?php echo $parallax_style; ?>>
        <div class="pt-lv2">
            <div class="pt-lv1 animation-bg" <?php echo $background_style; ?>>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1>
                            <?php
                                if ( is_home() )
                                {
                                    $blog_page_title = seoplan_get_option( 'breadcrumd_blog_title' );
                                    if ( $blog_page_title )
                                    {
                                        echo esc_html( $blog_page_title );
                                    }
                                    else
                                    {
                                        esc_html_e( 'Blog', 'seoplan' );
                                    }
                                }
                                else {
                                    the_title();
                                }
                            ?>
                            </h1>
                            <ul class="breadcrumb">
                                <?php
                                seoplan_breadcrumbs( array(
                                    'separator'     => '<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>',
                                    'before_item'   =>  '<li>',
                                    'after_item'    =>  '</li>',
                                    'before'        => '',
                                ) );
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    }
}
add_action( 'seoplan_before_content', 'seoplan_display_breadcrumb' );