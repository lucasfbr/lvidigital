<?php
/**
 * Plugin Name: Seo Plan Theme Funtionality
 * Plugin URI: http://themecitizen.com/
 * Description: Seo Plan Theme Funtionality includes important functions use for theme
 * Version: 1.2
 * Author: WP Friends
 * Author URI: http://themecitizen.com/
 */

define( 'SEO_PLAN_TF_PATH', plugin_dir_path( __FILE__ ) );
define( 'SEO_PLAN_TF_URL', plugin_dir_url( __FILE__ ) );

define( 'SEO_PLAN_TF_INC_PATH', trailingslashit( SEO_PLAN_TF_PATH . 'inc' ) );

define( 'SEO_PLAN_TF_CSS_URL', trailingslashit( SEO_PLAN_TF_URL . 'css' ) );
define( 'SEO_PLAN_TF_JS_URL', trailingslashit( SEO_PLAN_TF_URL . 'js' ) );

define( 'SEO_PLAN_TF_VERSION', '1.0.0' );

// require redux framework
require SEO_PLAN_TF_INC_PATH . 'core/redux/redux-framework.php';

// include case studies
require SEO_PLAN_TF_INC_PATH . 'case-study/case-study.php';
new SeoPlan_Register_Case_Study();

// include testimonial
require SEO_PLAN_TF_INC_PATH . 'testimonial/testimonial.php';
new SeoPlan_Register_Testimonial();

// registration custom vc elements
require SEO_PLAN_TF_INC_PATH . 'visual-composer/functions.php';
require SEO_PLAN_TF_INC_PATH . 'visual-composer/shortcodes.php';
require  SEO_PLAN_TF_INC_PATH . 'visual-composer/backend/class-vc-elements.php';
require SEO_PLAN_TF_INC_PATH . 'visual-composer/ajax.php';

function seoplan_register_extend_elements()
{
    new SeoPlan_VC_Elements();
    if ( ! is_admin() )
    {
        new SeoPlan_VC_Elements();
    }
}
add_action( 'after_setup_theme', 'seoplan_register_extend_elements' );

if ( is_admin() )
{

}
else
{
    new SeoPlan_Shortcodes();
}