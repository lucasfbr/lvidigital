<?php
/**
 * Register page option, sections and field options
 */


/**
 * Register argument
 */
function seoplan_register_option_page( $theme_option_name, $theme )
{
    $args = array(
        'opt_name'      =>  $theme_option_name,
        'menu_title'    =>  esc_html__( 'Theme Options', 'seoplan' ),
        'page_title'    =>  esc_html__( 'Theme Options', 'seoplan' ),
        'menu_type'     =>  'submenu',
        'dev_mode'      => false,
        'display_name' => esc_html__( 'Theme Options', 'seoplan' ),
        'display_version' => SEOPLAN_VERSION,
        'class'         => 'wpfriend-options',
        'system_info'   => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        'customizer'           => true,
        'forced_dev_mode_off'  => false,
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
    Redux::setArgs( $theme_option_name, $args );
}

add_action( 'seoplan_register_option_page', 'seoplan_register_option_page', 10 , 2 );
/**
 * Register help tabs
 */

function seoplan_register_help_tab( $theme_option_name )
{
    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => 'Theme Information 1',
            'content' => '<br />This is the tab content, HTML is allowed.<br />',
        ),
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => 'Theme Information 1',
            'content' => '<br />This is the tab content, HTML is allowed.<br />'
        )
    );
    //Redux::setHelpTab( $theme_option_name, $tabs );
}
//add_action( 'seoplan_register_help_tab', 'seoplan_register_help_tab', 10, 1 );

/**
 * Register tabs Section and section's fields
 */
add_action( 'seoplan_register_setting_setions', 'seoplan_section_general', 10, 1 );
add_action( 'seoplan_register_setting_setions', 'seoplan_section_header', 10, 1 );
add_action( 'seoplan_register_setting_setions', 'seoplan_section_layout', 10, 1 );
add_action( 'seoplan_register_setting_setions', 'seoplan_section_typos', 10, 1 );
add_action( 'seoplan_register_setting_setions', 'seoplan_section_breadcrumb', 10, 1 );
add_action( 'seoplan_register_setting_setions', 'seoplan_section_social', 10, 1 );
add_action( 'seoplan_register_setting_setions', 'seoplan_section_footer', 10, 1 );

/**
 * Function add layout section option tab on theme options page
 */
function seoplan_section_typos( $theme_option_name )
{
    $section = array(
        'title'  => esc_html__( 'Typography', 'seoplan' ),
        'id'     => 'options-typography',
        'desc'   => '',
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'typography_body',
                'type'     => 'typography',
                'title'    => __( 'Body Font', 'seoplan' ),
                'subtitle' => __( 'Specify the body font properties.', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
            ),
            array(
                'id'       => 'typography_heading_begin_section',
                'type'     => 'section',
                'indent'   =>  true,
                'title'    => esc_html__( 'Heading', 'seoplan' ),
            ),
            array(
                'id'       => 'typography_h1',
                'type'     => 'typography',
                'title'    => __( 'Heading 1', 'seoplan' ),
                'subtitle' => __( 'Customize the H1 font', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.single .entry-content h1', '.h1', 'h1')
            ),
            array(
                'id'       => 'typography_h2',
                'type'     => 'typography',
                'title'    => __( 'Heading 2', 'seoplan' ),
                'subtitle' => __( 'Customize the H2 font', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.single .entry-content h2', '.h2', 'h2')
            ),
            array(
                'id'       => 'typography_h3',
                'type'     => 'typography',
                'title'    => __( 'Heading 3', 'seoplan' ),
                'subtitle' => __( 'Customize the H3 font', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.single .entry-content h3', '.h3', 'h3')
            ),
            array(
                'id'       => 'typography_h4',
                'type'     => 'typography',
                'title'    => __( 'Heading 4', 'seoplan' ),
                'subtitle' => __( 'Customize the H3 font', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.single .entry-content h4', '.h4', 'h4')
            ),
            array(
                'id'       => 'typography_h5',
                'type'     => 'typography',
                'title'    => __( 'Heading 5', 'seoplan' ),
                'subtitle' => __( 'Customize the H5 font', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.single .entry-content h5', '.h5', 'h5')
            ),
            array(
                'id'       => 'typography_h6',
                'type'     => 'typography',
                'title'    => __( 'Heading 6', 'seoplan' ),
                'subtitle' => __( 'Customize the H6 font', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.single .entry-content h6', '.h6', 'h6')
            ),
            array(
                'id'       => 'typography_heading_end_section',
                'type'     => 'section',
                'indent'   =>  false,
            ),
            array(
                'id'       => 'typography_page_header',
                'type'     => 'typography',
                'title'    => __( 'Page Header', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.page-header h1', '.button-analytic a', '.primary-nav ul li'),
            ),
            array(
                'id'       => 'typography_widget',
                'type'     => 'typography',
                'title'    => __( 'Widget', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.widget .widget-title'),
            ),
            array(
                'id'       => 'typography_footer',
                'type'     => 'typography',
                'title'    => __( 'Footer', 'seoplan' ),
                'google'   => true,
                'text-align' => false,
                'subsets' => false,
                'output'    => array('.site-footer'),
            ),
        )
    );

    Redux::setSection( $theme_option_name, $section );
}

/**
 * Function add layout section option tab on theme options page
 */
function seoplan_section_layout( $theme_option_name )
{
    $section = array(
        'title'  => esc_html__( 'Layout', 'seoplan' ),
        'id'     => 'options-layout',
        'desc'   => '',
        'icon'   => 'el el-screen',
        'fields' => array(
            array(
                'id'       => 'layout_page',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Layout', 'seoplan' ),
                'subtitle' => esc_html__( 'Select layout for page', 'seoplan' ),
                'options'  => array(
                    'full-content' => array(
                        'alt' => esc_attr__( 'Full Page', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/full-side.png'
                    ),
                    'left-sidebar' => array(
                        'alt' =>  esc_attr__( 'Left Sidebar', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/left-sidebar.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => esc_attr__( 'Right Sidebar', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/right-sidebar.png'
                    ),
                ),
                'default'  => 'full-content'
            ),
            array(
                'id'       => 'layout_post',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Post Layout', 'seoplan' ),
                'subtitle' => esc_html__( 'Select layout for post', 'seoplan' ),
                'options'  => array(
                    'full-content' => array(
                        'alt' => esc_attr__( 'Full Page', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/full-side.png'
                    ),
                    'left-sidebar' => array(
                        'alt' =>  esc_attr__( 'Left Sidebar', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/left-sidebar.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => esc_attr__( 'Right Sidebar', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/right-sidebar.png'
                    ),
                ),
                'default'  => 'full-content'
            ),
        )
    );

    Redux::setSection( $theme_option_name, $section );
}

/**
 * Function add General section option tab on theme options page
 */

function seoplan_section_general( $theme_option_name )
{
    $list_pages = seoplan_get_pages();

    $section = array(
        'title'  => 'General',
        'id'     => 'options-general',
        'desc'   => '',
        'icon'   => 'el el-cog',
        'fields' => array(
            array(
                'id'       => 'general_custom_permalink',
                'type'     => 'text',
                'title'    => esc_html__( 'Permalink Length', 'seoplan' ),
                'subtitle' => esc_html__( 'Input here your custom permalink length', 'seoplan' ),
                'default'  => '14'
            ),
            array(
                'id'        => 'general_display_count_post_view',
                'type'      => 'switch',
                'title'     => esc_html__( 'Show Count Post View', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'seoplan' ),
                'off'      => esc_html__( 'Hide', 'seoplan' ),
            ),
            array(
                'id'       => 'general_404_begin_section',
                'type'     => 'section',
                'indent'   =>  true,
                'title'    => esc_html__( '404 Page Settings', 'seoplan' ),
            ),
            array(
                'id'       => 'general_404_page_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Title', 'seoplan' ),
                'default'  => "404"
            ),
            array(
                'id'       => 'general_404_page_sub_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Page sub description', 'seoplan' ),
                'default'  => "Page not found!"
            ),
            array(
                'id'       => 'general_404_page_description',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Page description', 'seoplan' ),
                'default'  => ""
            ),
            array(
                'id'       => 'general_404_end_section',
                'type'     => 'section',
                'indent'   =>  false,
            ),
            array(
                'id'       => 'genaral_map_api_key',
                'type'     => 'text',
                'title'    => esc_html__( 'Google map API key', 'seoplan' ),
                'subtitle' => esc_html__( 'Input here the API key to display google map, you can register it at: ', 'seoplan' ) . '<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Here</a>',
            ),
            array(
                'id'       => 'case_studies_page_list',
                'type'     => 'select',
                'title'    => esc_html__( 'Case Studies Page List', 'seoplan' ),
                'subtitle' => esc_html__( 'Select page displays list case studies' , 'seoplan' ),
                'options'  => $list_pages,
                'default'  => '-9999'
            ),
            array(
                'id'        => 'custom_color_scheme',
                'type'      => 'color',
                'title'     => esc_html__( 'Custom Color Scheme', 'seoplan' ),
            ),
            array(
                'id'       => 'custom_css_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom CSS', 'seoplan' ),
                'subtitle' => esc_html__( 'Input here your custom CSS codes', 'seoplan' ),
                'mode'     => 'css',
                'theme'    => 'dreamweaver',
                'default'  => ""
            )
        )
    );

    Redux::setSection( $theme_option_name, $section );
}

/**
 * Function add Header section option tab on theme options page
 */

function seoplan_section_header( $theme_option_name )
{
     $section = array(
        'title'  => 'Header',
        'id'     => 'options-header',
        'desc'   => '',
        'icon'   => 'el el-flag',
        'fields' => array(
            array(
                'id'        => 'header_enable_sticky',
                'type'      => 'switch',
                'title'     => esc_html__( 'Sticky Header', 'seoplan' ),
                'default'  => 0,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'       => 'header-topbar-section-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Topbar', 'seoplan' ),
                'subtitle' => esc_html__( 'The options apply for topbar element', 'seoplan' ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'        => 'header_display_topbar',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display Topbar', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'        => 'header_topbar_background',
                'type'      => 'color',
                'title'     => esc_html__( 'Topbar background color', 'seoplan' ),
                'default'  => '#120c2e',
                'required'      => array( 'header_display_topbar', '=', '1' ),
            ),
            array(
                'id'        => 'header_topbar_display_analytic_btn',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display Button Analytic', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
                'required'      => array( 'header_display_topbar', '=', '1' ),
            ),
            array(
                'id'        => 'header_topbar_analytic_background',
                'type'      => 'color',
                'title'     => esc_html__( 'Button background color', 'seoplan' ),
                'default'  => '#4155c5',
                'required'      => array( 'header_topbar_display_analytic_btn', '=', '1' ),
            ),
            array(
                'id'        => 'header_topbar_analytic_text',
                'type'      => 'text',
                'title'     => esc_html__( 'Button Text', 'seoplan' ),
                'default'  => esc_html__( 'Free analytics', 'seoplan' ),
                'required'      => array( 'header_topbar_display_analytic_btn', '=', '1' ),
            ),
            array(
                'id'        => 'header_topbar_analytic_action_link',
                'type'      => 'text',
                'title'     => esc_html__( 'Button Link Action', 'seoplan' ),
                'required'      => array( 'header_topbar_display_analytic_btn', '=', '1' ),
            ),
            array(
                'id'       => 'header-topbar-section-end',
                'type'     => 'section',
                'indent'   => false, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'opt_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo' , 'seoplan'),
                'subtitle' => esc_html__( 'Upload new logo or select one in media library', 'seoplan' ),
                'compiler' => 'true',
                'default'  => array( 'url' => SEOPLAN_URL . '/img/logo.png' ),
            ),
            array(
                'id'       => 'opt_favicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Favicon' , 'seoplan'),
                'subtitle' => esc_html__( 'Upload new logo or select one in media library', 'seoplan' ),
                'compiler' => 'true',
                'default'  => array( 'url' => SEOPLAN_URL . '/img/favicon.ico' ),
            ),
            array(
                'id'       => 'header_more_settings_items',
                'type'     => 'sortable',
                'mode'     => 'checkbox', // checkbox or text
                'title'    => esc_html__( 'Menu extra item', 'seoplan' ),
                'subtitle' => esc_html__( 'Display and sortable menu extra items', 'seoplan' ),
                'desc'     => esc_html__( 'There are items display at the end of navigation bar', 'seoplan' ),
                'options'  => array(
                    'search' => esc_html__( 'Search', 'seoplan' ),
                    'multi_lans' => esc_html__( 'Multi Languages', 'seoplan' ),
                    'social' => esc_html__( 'Socials', 'seoplan' ),
                ),
                'default'  => array(
                    'search' => true,
                    'multi_lans' => true,
                    'social' => true,
                )
            ),
            array(
                'id'       => 'custom_header_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Header Scripts', 'seoplan' ),
                'subtitle' => esc_html__( 'Input here your custom scripts', 'seoplan' ),
                'mode'     => 'javascript',
                'theme'    => 'dreamweaver',
                'default'  => ""
            )
        )
    );

    Redux::setSection( $theme_option_name, $section );
}

/**
 * Function add Footer section option tab on theme options page
 */
function seoplan_section_footer( $theme_option_name )
{
    $section = array(
        'title'  => 'Footer',
        'id'     => 'options_footer',
        'desc'   => '',
        'icon'   => 'el el-leaf',
        'fields' => array(
            array(
                'id'        => 'footer_enable_subscribe',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display Subscribe Section', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'        => 'footer_subscribe_background_color',
                'type'      => 'color',
                'title'     => esc_html__( 'Section Background Color', 'seoplan' ),
                'default'  => '#43a047',
                'required'      => array( 'footer_enable_subscribe', '=', '1' ),
            ),
            array(
                'id'       => 'footer_subscribe_background_image',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Subscribe Background Image' , 'seoplan'),
                'subtitle' => esc_html__( 'Upload new logo or select one in media library', 'seoplan' ),
                'compiler' => 'true',
                'default'  => array( 'url' => SEOPLAN_URL . '/img/newsletter-bg.png' ),
                'required'      => array( 'footer_enable_subscribe', '=', '1' ),
            ),
            array(
                'id'        => 'enable_footer_widget_columns',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display Footer Widgets', 'seoplan' ),
                'subtitle'  => esc_html__( 'Look, it\'s on!', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'       => 'footer_widget_columns',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Footer Widget Columns', 'seoplan' ),
                'subtitle' => esc_html__( 'Select the number of columns are displayed', 'seoplan' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_html__( '1 Column', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/1col.png'
                    ),
                    '2' => array(
                        'alt' =>  esc_html__( '2 Columns', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/2col.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__( '3 Columns', 'seoplan' ),
                        'img' => SEOPLAN_URL . '/img/theme-options/3col.png'
                    ),
                ),
                'default'  => '3',
                'required'      => array( 'enable_footer_widget_columns', '=', '1' ),
            ),
            array(
                'id'       => 'footer_copyright',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Footer Copy Right', 'seoplan' ),
                'validate' => 'html',
                'default'  => esc_html__( '©All Rights Reserved 2017 SeoPlan', 'seoplan' ),
            ),
            array(
                'id'       => 'custom_footer_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Footer Scripts', 'seoplan' ),
                'subtitle' => esc_html__( 'Input here your custom scripts', 'seoplan' ),
                'mode'     => 'javascript',
                'theme'    => 'dreamweaver',
                'default'  => ""
            )
        )
    );

    Redux::setSection( $theme_option_name, $section );
}


/**
 * Function add social section option tab on theme options page
 */
function seoplan_section_social( $theme_option_name )
{
    $socials = seoplan_get_socials();

    $section = array(
        'title'  => 'Social',
        'id'     => 'options_social',
        'desc'   => '',
        'icon'   => 'el el-adult',
        'fields' => array(
            array(
                'id'        => 'enable_socials',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display social buttons', 'seoplan' ),
                'default'  => 0,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'       => 'open-new-tab',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Open link on new tab', 'seoplan' ),
                'default'  => '1'// 1 = on | 0 = off
            )
        )
    );

    foreach ( $socials as $key => $item )
    {
        $section['fields'][] = array(
            'id'            => 'socials-' . $key,
            'required'      => array( 'enable_socials', '=', '1' ),
            'type'          => 'text',
            'title'         => $item['label'],
            'default'       =>  $item['default'],
        );
    }


    Redux::setSection( $theme_option_name, $section );
}

/**
 * Function add breadcrumb section option tab on theme options page
 */
function seoplan_section_breadcrumb( $theme_option_name )
{
    $section = array(
        'title'  => esc_html__( 'Breadcrumb', 'seoplan' ),
        'id'     => 'options-breadcrumb',
        'desc'   => '',
        'icon'   => 'el el-fork',
        'fields' => array(
            array(
                'id'            =>  'breadcrumd_blog_title',
                'type'          => 'text',
                'title'         => esc_html__( 'Blog Page Title', 'seoplan' ),
                'default'       =>  esc_html__( 'Blog', 'seoplan' ),
            ),
            array(
                'id'        => 'enable_breadcrumb',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display Breadcrumb', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'       => 'breadcrumb',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Display breadcrumb on', 'seoplan' ),
                'subtitle' => esc_html__( 'Select page displays breadcrumb', 'seoplan' ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'blog'          => esc_html__( 'Blog', 'seoplan' ),
                    'post'          => esc_html__( 'Blog Detail', 'seoplan' ),
                    'page'          => esc_html__( 'Page', 'seoplan' ),
                    'case_study'          => esc_html__( 'Case Study', 'seoplan' ),
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    'blog'          =>  '1',
                    'post'          =>  '1',
                    'page'          =>  '1',
                    'case_study'    =>  '1',
                )
            ),
            array(
                'id'        => 'breadcrumb_bg',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Background Image' , 'seoplan'),
                'subtitle'  => esc_html__( 'Upload new logo or select one in media library', 'seoplan' ),
                'compiler'  => 'true',
                'default'   => array( 'url' => SEOPLAN_URL . '/img/breadcrumb.png' ),
            ),
            array(
                'id'        => 'enable_parallax',
                'type'      => 'switch',
                'title'     => esc_html__( 'Display Parallax Background Image', 'seoplan' ),
                'default'  => 1,
                'on'       => esc_html__( 'On', 'seoplan' ),
                'off'      => esc_html__( 'Off', 'seoplan' ),
            ),
            array(
                'id'        => 'breadcrumb_parallax_bg',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__( 'Background Parallax Image' , 'seoplan'),
                'subtitle'  => esc_html__( 'Upload new image or select one in media library', 'seoplan' ),
                'compiler'  => 'true',
                'default'   => array( 'url' => SEOPLAN_URL . '/img/breadcrumb_parallax.png' ),
            ),
        )
    );

    Redux::setSection( $theme_option_name, $section );
}
