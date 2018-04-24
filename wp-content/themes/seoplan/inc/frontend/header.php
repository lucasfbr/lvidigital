<?php
if ( ! function_exists( '_wp_render_title_tag' ) )
{
    /**
     * Render title tag on old version of WordPress
     */
    function seoplan_render_title()
    {
        ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <?php
    }

    add_action( 'wp_head', 'seoplan_render_title' );
}

/**
 * Display header codes
 *
 * @return void
 * @since  1.0.1
 */
function seoplan_generate_header_scripts()
{
    $header_scripts = seoplan_get_option( 'custom_header_editor' );

    if ( ! empty( $header_scripts ) )
    {
        echo $header_scripts;
    }
}


add_action( 'wp_head', 'seoplan_generate_header_scripts' );

/**
 * Enqueue main scripts and styles
 *
 * @return void
 * @since  1.0
 */
function seoplan_enqueue_scripts()
{
    wp_enqueue_style( 'google-fonts', seoplan_fonts_url() );
    wp_enqueue_style( 'font-awesome', SEOPLAN_URL . '/css/font-awesome.min.css', array(), '4.6.3' );
    wp_enqueue_style( 'flaticons', SEOPLAN_URL . '/css/flaticon.css' );
    wp_enqueue_style( 'bootstrap', SEOPLAN_URL . '/css/bootstrap.min.css', array(), '3.3.6' );
    wp_enqueue_style( 'owl-carousel', SEOPLAN_URL . '/css/owl.carousel.min.css', array(), '3.3.6' );
    wp_enqueue_style( 'magnific-popup', SEOPLAN_URL . '/css/magnific-popup.min.css', array(), '1.1.0' );
    wp_enqueue_style( 'seoplan-style', get_template_directory_uri() . '/style.css', array(), SEOPLAN_VERSION );

    /** Register and enqueue scripts */
    $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    wp_register_script( 'seoplan-plugins-script', SEOPLAN_URL . "/js/plugins$min.js", array( 'jquery', 'jquery-migrate' ), SEOPLAN_VERSION, true );
    wp_enqueue_script( 'seoplan-scripts', SEOPLAN_URL . "/js/scripts$min.js", array( 'seoplan-plugins-script' ), SEOPLAN_VERSION, true );
    $seo_plan_data = array(
        'ajaxurl' =>  admin_url( 'admin-ajax.php' ),
    );
    wp_localize_script( 'seoplan-scripts', 'seoplanData', $seo_plan_data );
    if ( is_singular() && get_option( 'thread_comments' ) && comments_open() )
        wp_enqueue_script( 'comment-reply' );
}


add_action( 'wp_enqueue_scripts', 'seoplan_enqueue_scripts', 10 );

function seoplan_header_minimized()
{
    if ( ! seoplan_get_option( 'header_enable_sticky' ) )
    {
        return;
    }
    $css_class= '';
    printf( '<div id="seoplan-header-minimized" class="seoplan-header-minimized %s"></div>', esc_attr( $css_class ) );
}

add_action( 'seoplan_before_header', 'seoplan_header_minimized' );

function seoplan_show_topbar()
{
    $display_top_bar = seoplan_get_option( 'header_display_topbar' );
    if ( $display_top_bar )
    {
        $background_color = seoplan_get_option( 'header_topbar_background' );
        $topbar_style = '';
        if ( $background_color )
        {
            $topbar_style = sprintf( 'style="background-color: %s;"', esc_attr( $background_color ) );
        }
?>
    <div class="top-panel" <?php echo $topbar_style; ?>>
        <div class="container">
            <div class="row">
                <div class="col-xs-7 col-sm-11 col-md-9 header-contact">
                <?php
                dynamic_sidebar( "top-sidebar" );
                ?>
                </div>
                <div class="col-xs-5 col-sm-1 col-md-3 free-analytic">
                    <?php
                    $display_analytic_btn = seoplan_get_option( 'header_topbar_display_analytic_btn' );
                    if ( $display_analytic_btn )
                    {
                        $button_text = seoplan_get_option( 'header_topbar_analytic_text' );
                        $button_link = seoplan_get_option( 'header_topbar_analytic_action_link' );
                        $button_background = seoplan_get_option( 'header_topbar_analytic_background' );
                        $button_style = '';
                        if ( $button_background )
                        {
                            $button_style = sprintf( 'style="background-color: %s"', esc_attr( $button_background ) );
                        }
                    ?>
                    <div class="button-analytic" <?php echo $button_style?> >
                        <a href="<?php echo $button_link ? esc_url( $button_link ) : '#'; ?>" title="free analytic">
                        <?php
                        if ( $button_text )
                        {
                            echo wp_kses_post( $button_text );
                        }
                        ?>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}

add_action( 'seoplan_header', 'seoplan_show_topbar', 5 );

/**
 * Function show nav menu
 */
function seoplan_show_nav_menu()
{
?>
    <div class="header-main">
        <div class="container">
            <div class="row eq-height">
                <div class="site-logo col-xs-10 col-md-10 col-lg-3 col-sm-10">
                    <span class="toggle-nav hidden-lg" data-target="mobile-menu"><span class="icon-nav"></span></span>
                    <?php get_template_part( 'templates/logo' ) ?>
                </div>
                <div class="nav-container col-lg-8 hidden-xs hidden-md hidden-sm">
                    <nav id="primary-nav-menu" class="main-nav primary-nav nav">
                        <?php
                        if ( has_nav_menu( 'primary' ) )
                        {
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav-menu'
                            ) );
                        }
                        ?>
                    </nav>
                </div>

                <div class="col-xs-2 col-sm-2 col-lg-1 header-actions">
                    <?php
                    $more_settings_nav = seoplan_get_option( 'header_more_settings_items' );
                    if ( $more_settings_nav )
                    {
                        $items_enable = array();
                        foreach ( $more_settings_nav as $key => $value )
                        {
                            if ( $value )
                            {
                                switch ( $key )
                                {
                                    case 'search':
                                        ?>
                                        <div class="form-search">
                                            <span class="label-icon">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                        <?php
                                        break;
                                    case 'multi_lans':
                                        seoplan_language_switcher();
                                        break;
                                    case 'social':
                                        ?>
                                            <div class="social dropdown-wrap">
                                                <span class="label-icon">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </span>
                                                <?php
                                                $enable_socials = seoplan_get_option( 'enable_socials' );
                                                if ( $enable_socials )
                                                {
                                                    $socials = array();
                                                    $socials_selected = seoplan_get_socials();
                                                    foreach ( $socials_selected as $key => $item )
                                                    {
                                                        $socials_active = seoplan_get_option( 'socials-' . $key );
                                                        if( isset( $socials_active ) && ! empty( $socials_active ) )
                                                        {
                                                            $socials[$key] = $socials_active;
                                                        }
                                                    }
                                                    if ( ! empty( $socials ) )
                                                    {
                                                        $target = '_self';
                                                        if (seoplan_get_option('open-new-tab')) {
                                                            $target = '_blank';
                                                        }

                                                        ?>
                                                            <div class="dropdown">
                                                                <ul class="social-select dropdown-content">
                                                                    <?php
                                                                    foreach ( $socials as $key => $value )
                                                                    {
                                                                    ?>
                                                                        <li>
                                                                            <a target="<?php echo esc_attr( $target ); ?>" href="<?php echo esc_url( $value ); ?>">
                                                                                <i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i>
                                                                            </a>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                        </div>
                                        <?php
                                        break;
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}

add_action( 'seoplan_header', 'seoplan_show_nav_menu', 10 );


/**
 * Display site's favicon
 */

function seoplan_site_icons()
{
    $favicon = seoplan_get_option('opt_favicon');
    if ( isset( $favicon['url'] ) && ! empty( $favicon['url'] ) )
    {
        if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) )
        {
            echo '<link rel="icon" type="image/x-ico" href="' . esc_url( $favicon['url'] ) . '" />';
        }
    }
}
add_action( 'wp_head', 'seoplan_site_icons' );

/**
 * Function uses to custom CSS
 */
function seoplan_custom_css()
{
    $enable_custom_style = seoplan_get_post_meta( 'seoplan_custom_layout' );
    $single_custom_style = '';
    $custom_css = '';

    if ( $enable_custom_style )
    {
        $single_custom_style = seoplan_get_post_meta( 'seoplan_custom_css' );
    }
    $custom_css .= $single_custom_style;
    if ( seoplan_get_option( 'custom_css_editor' ) )
    {
        $custom_css_option = seoplan_get_option( 'custom_css_editor' );
        $custom_css .= $custom_css_option;
    }
    if ( seoplan_get_option( 'custom_color_scheme' ) )
    {
        $color_scheme = seoplan_get_option( 'custom_color_scheme' );
        $color_scheme_css = seoplan_get_color_scheme_css( $color_scheme );
        $custom_css .= $color_scheme_css;
    }
    if ( seoplan_get_option( 'typography_body' ) )
    {
        $body_type = seoplan_get_option( 'typography_body' );
        if ( isset( $body_type['font-family'] ) && ! empty( $body_type['font-family'] ) )
        {
            $body_typo_css = seoplan_get_typography_css( $body_type['font-family'] );
            $custom_css .= $body_typo_css;
        }
    }
    wp_add_inline_style( 'seoplan-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'seoplan_custom_css', 15 );


/**
 * Returns CSS for the color schemes.
 *
 *
 * @param array $colors Color scheme colors.
 *
 * @return string Color scheme CSS.
 */
function seoplan_get_color_scheme_css( $colors ) {
    return <<<CSS
	/* Color Scheme */

	/* Color */
	a:active, a:hover, a:focus,
    .primary-nav .nav-menu > li > a:hover, 
    .seplan-icon-box.type-flat-icons.layout_inline i,
     .seoplan-information .section-title,
     .seoplan-testimonial-carousel .testimonials .testimonial-item .content i,
     .seoplan-pricing-table.layout-basic .pricing-info li.disable,
     footer.type1 .footer-widgets .service li a:hover,
     footer.type1 .site-info .copyright i,
     footer.type1 .site-info .footer-menu li a:hover,
     .blog .blog-list .blog-item .entry-content .entry-title a:hover,
     .search .blog-list .blog-item .entry-content .entry-title a:hover,
     .archive .blog-list .blog-item .entry-content .entry-title a:hover,
     .related-post .blog-list .blog-item .entry-content .entry-title a:hover,
     .seoplan-posts-carousel .blog-list .blog-item .entry-content .entry-title a:hover,
     .seoplan-case-study-nav ul li.next a:hover,
     .seoplan-case-study-nav ul li.prev a:hover,
     footer.type1 .footer-widgets .service li .icon,
      footer.type1 .footer-widgets .contact-social li a:hover {
		color: {$colors};
	 }

	/* Background Color */
    .btn.focus, .btn:active, .btn:hover,
	header.type1 .top-panel .free-analytic .button-analytic,
	 .wpcf7-form .seo-score .submit-form:hover,
	 .blog .blog-list .blog-item .entry-header .view-more:hover,
	 .search .blog-list .blog-item .entry-header .view-more:hover,
	 .archive .blog-list .blog-item .entry-header .view-more:hover,
	 .related-post .blog-list .blog-item .entry-header .view-more:hover,
	 .seoplan-posts-carousel .blog-list .blog-item .entry-header .view-more:hover,
	 .seoplan-pricing-table.layout-basic .pricing-button .btn:hover,
	 .seoplan-case-study-nav ul li.back-to-list a:hover,
	  footer.type1 .footer-widgets .wpcf7-form .footer-contact input[type=submit]:hover,
	  footer.type1 .footer-widgets .contact-list .icon {
		background-color: {$colors};
	}

	/* Border Color */
	blockquote {
		border-left-color: {$colors};
	}
    
    footer.type1 .footer-widgets .wpcf7-form .footer-contact .form-row-wide input[type=text]:focus,
    footer.type1 .footer-widgets .wpcf7-form .footer-contact .form-row-wide input[type=email]:focus,
    footer.type1 .footer-widgets .wpcf7-form .footer-contact .form-row-wide textarea:focus {
        border-color: {$colors};
    }

CSS;
}

/**
 * Returns CSS for the typography.
 *
 *
 * @param array $body_typo Color scheme body typography.
 *
 * @return string typography CSS.
 */
function seoplan_get_typography_css( $body_typo ) {
    return <<<CSS
	.seoplan-information .section-title,
	form.wpcf7 input,
	.seoplan-video-banner.banner_information h3,
	.seoplan-video-banner.banner_information .btn,
	.seoplan-button-section  a,
	.pricing-info ul li,
	.seoplan-breadcrumb h1,
	.breadcrumb li a,
	.breadcrumb li span,
	.blog-item .entry-title,
	.single h1,
	.comments-area h3,
	form.comment-form .btn,
	.comments-area .head-title,
	.comment-list .user-time-post .user,
	.comment-list .user-time-post .time,
	.comment-list .user-time-post .user a {
		  font-family: {$body_typo}, Arial, sans-serif !important;
	}
CSS;
}

/**
 * Add icon list as svg at the footer
 * It is hidden
 */
function seoplan_include_shadow_icons() {
    echo '<div id="svg-defs" class="svg-defs hidden">';
    include get_template_directory() . '/img/svg/sprite.svg';
    echo '</div>';
}

add_action( 'seoplan_after_header', 'seoplan_include_shadow_icons' );