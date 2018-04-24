<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once SEOPLAN_PATH . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'seoplan_register_required_plugins' );

/**
 * Register required plugins use in theme
 *
 * @since  1.0
 */
function seoplan_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => 'SeoPlan Theme Funtionality',
            'slug'               => 'seo-plan-theme-functionality',
            'source'             => esc_url( 'http://plugins.themecitizen.com/seoplan/seo-plan-theme-functionality.zip' ),
            'required'           => true,
        ),
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'required'           => true,
        ),
        array(
            'name'               => 'WPBakery Visual Composer',
            'slug'               => 'js_composer',
            'source'             => esc_url( 'http://plugins.themecitizen.com/seoplan/js_composer.zip' ),
            'required'           => true,
        ),
        array(
            'name'               => 'Revolution Slider',
            'slug'               => 'revslider',
            'source'             => esc_url( 'http://plugins.themecitizen.com/seoplan/revslider.zip' ),
            'required'           => true,
        ),
        array(
            'name'      => esc_html__( 'Newsletter','seoplan' ),
            'slug'      => 'newsletter',
            'required'  => true,
        ),
        array(
            'name'               => esc_html__( 'Contact Form 7', 'seoplan' ),
            'slug'               => 'contact-form-7',
            'required'           => false
        ),
    );

    $config = array(
        'id'           => 'seoplan',
        'default_path' => '',
        'menu'         => 'install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );

}
