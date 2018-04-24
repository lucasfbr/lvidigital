<?php
/**
 * Created by PhpStorm.
 * User: BABYMASTER
 * Date: 16/03/2017
 * Time: 4:06 PM
 */

/**
 * Add Bootstrap's column classes
 *
 * @since 1.0
 *
 * @param array  $classes
 * @param string $class
 * @param string $post_id
 *
 * @return array
 */
function seoplan_blog_classes( $classes, $class = '', $post_id = '' )
{
    if ( is_home() || is_archive() || is_search() )
    {
        $classes[] = 'col-sm-4 col-xs-6 blog-item';
    }

    return $classes;
}
// Add Bootstrap classes
add_filter( 'post_class', 'seoplan_blog_classes', 10, 3 );

function seoplan_custom_body_classes( $classes )
{
    $classes[] = seoplan_get_layout();
    // add sticky
    if ( seoplan_get_option( 'header_enable_sticky' ) )
    {
        $classes[] = 'sticky-header';
    }
    return $classes;
}
add_filter( 'body_class', 'seoplan_custom_body_classes' );