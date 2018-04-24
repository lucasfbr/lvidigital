<?php
/**
 * Function get saved option's value
 *
 * @param $field_id string id registered when generate theme options
 * @return $result string option's value
 */
function seoplan_get_option( $field_id )
{
    global $seoplan_theme_options;
    if ( isset( $seoplan_theme_options[$field_id] ) )
    {
        $result = $seoplan_theme_options[$field_id];
    }
    else
    {
        $result = '';
    }
    return $result;
}

/**
 * Function return list socials available in theme
 *
 * @return array $socials socials name and link
 */

function seoplan_get_socials()
{
    $socials = array(
        'facebook'  =>  array(
            'label'     =>  esc_html__( 'Facebook', 'seoplan' ),
            'default'   =>  esc_url( 'http://facebook.com/' ),
        ),
        'twitter'   =>  array(
            'label'     =>  esc_html__( 'Twitter', 'seoplan' ),
            'default'   =>  esc_url( 'http://twitter.com/' ),
        ),
        'linkedin'  =>  array(
            'label'     =>  esc_html__( 'LinkedIn', 'seoplan' ),
            'default'   =>  '',
        ),
        'google-plus'    =>  array(
            'label'     =>  esc_html__( 'Google+', 'seoplan' ),
            'default'   =>  esc_url( 'http://google.com/' ),
        ),
        'tumblr'    =>  array(
            'label'     =>  esc_html__( 'Tumblr', 'seoplan' ),
            'default'   =>  '',
        ),
        'youtube'   =>  array(
            'label'     =>  esc_html__( 'YouTube', 'seoplan' ),
            'default'   =>  '',
        ),
        'instagram' =>  array(
            'label'     =>  esc_html__( 'Instagram', 'seoplan' ),
            'default'   =>  '',
        ),
        'wordpress' =>  array(
            'label'     =>  esc_html__( 'WordPress', 'seoplan' ),
            'default'   =>  '',
        ),
        'dribbble'   =>  array(
            'label'     =>  esc_html__( 'Dribble', 'seoplan' ),
            'default'   =>  esc_url( 'http://dribble.com/' ),
        ),
        'behance'   =>  array(
            'label'     =>  esc_html__( 'Behance', 'seoplan' ),
            'default'   =>  esc_url( 'http://behance.com/' ),
        ),
        'pinterest-p' =>  array(
            'label'     =>  esc_html__( 'Pinterest', 'seoplan' ),
            'default'   =>  esc_url( 'http://pinterest.com/' ),
        )
    );

    return apply_filters( 'seoplan_social_links', $socials );
}

/**
 * Function return pages in theme
 * @return $pages array pages
 */
function seoplan_get_pages()
{
    $results = array(
        -9999 => esc_html__( 'Select a page', 'seoplan' ),
    );
    $pages = get_pages();
    foreach ( $pages as $page )
    {
        $results[$page->ID] = $page->post_title;
    }
    return $results;
}