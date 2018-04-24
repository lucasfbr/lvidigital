<?php
/**
 * Itto functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Seo Plan
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
{
	$content_width = 660;
}
/**
 * Define theme's constants
 */
define( 'SEOPLAN_VERSION', '1.2' );
define( 'SEOPLAN_PATH', get_template_directory() );
define( 'SEOPLAN_URL' , get_template_directory_uri() );

if ( ! function_exists( 'seoplan_setup' ) )
{
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function seoplan_setup()
    {
        /*
         * Make theme available for translation.
         */
        load_theme_textdomain( 'seoplan', get_template_directory() . '/languages' );

        // Add theme features
        add_theme_support( 'woocommerce' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats', array( 'image', 'gallery', 'video' ) );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'seoplan' ),
            'footer'  => esc_html__( 'Footer Menu', 'seoplan' ),
            'mobile'  => esc_html__( 'Mobile Menu', 'seoplan' ),
        ) );

        // Register new image sizes
        add_image_size( 'seoplan-blog-thumbnail', 370, 240, true );
        add_image_size( 'seoplan-blog-single-thumbnail-1', 1170, 620, true );
        add_image_size( 'seoplan-blog-single-thumbnail-2', 770, 520, true );
        add_image_size( 'seoplan-image-carousel-1', 570, 420, true );
        add_image_size( 'seoplan-image-gallery-1', 570, 360, true );
        add_image_size( 'seoplan-case-study-thumnbail-1', 370, 300, true );
        add_image_size( 'seoplan-case-study-thumnbail-2', 570, 300, true );
        add_image_size( 'seoplan-case-study-thumnbail-3', 270, 300, true );
        add_image_size( 'seoplan-testimonial-thumnbail', 80, 80, true );

        // Custom Menu Item Fields
        if ( is_admin() )
        {
            new SeoPlan_Mega_Menu_Edit();
        }
    }
}
add_action( 'after_setup_theme', 'seoplan_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function seoplan_content_width()
{
	$GLOBALS['content_width'] = apply_filters( 'seoplan_content_width', 640 );
}
add_action( 'after_setup_theme', 'seoplan_content_width', 0 );

/**
 * Register widget area.
 */
function seoplan_widgets_init()
{
    $sidebars = array(
        'post-sidebar' => esc_html__( 'Post Sidebar', 'seoplan' ),
        'page-sidebar' => esc_html__( 'Page Sidebar', 'seoplan' ),
    );

    // Register sidebars
    foreach( $sidebars as $id => $name )
    {
        register_sidebar( array(
            'name'          => $name,
            'id'            => $id,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }

    // Register top sidebars
    register_sidebar( array(
        'name'          => esc_html__( 'Top Sidebar', 'seoplan' ),
        'id'            => "top-sidebar",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    // Register footer sidebars
    for ( $i = 1; $i <= 3; $i++ )
    {
        register_sidebar( array(
            'name'          => esc_html__( 'Footer', 'seoplan' ) . " $i",
            'id'            => "footer-sidebar-$i",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'seoplan_widgets_init' );

require SEOPLAN_PATH . '/inc/template-tags.php';
require SEOPLAN_PATH . '/inc/functions/theme-options.php';
require SEOPLAN_PATH . '/inc/functions/breadcrumbs.php';
require SEOPLAN_PATH . '/inc/backend/theme-options.php';
require SEOPLAN_PATH . '/inc/backend/core/theme-options/framework.php';
require SEOPLAN_PATH . '/inc/backend/nav-menus.php';
require SEOPLAN_PATH . '/inc/backend/plugins-required.php';
require SEOPLAN_PATH . '/inc/functions/site-layout.php';

if( is_admin() )
{
    require SEOPLAN_PATH . '/inc/backend/meta-boxes.php';
}
else
{
    require SEOPLAN_PATH . '/inc/frontend/media.php';
    require SEOPLAN_PATH . '/inc/frontend/menus.php';
    require SEOPLAN_PATH . '/inc/frontend/header.php';
    require SEOPLAN_PATH . '/inc/frontend/content.php';
    require SEOPLAN_PATH . '/inc/frontend/footer.php';
    require SEOPLAN_PATH . '/inc/frontend/site-layout.php';
    require SEOPLAN_PATH . '/inc/frontend/nav-menu.php';
    require SEOPLAN_PATH . '/inc/frontend/entry.php';
}