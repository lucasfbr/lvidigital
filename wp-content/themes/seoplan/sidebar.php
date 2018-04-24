<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seo Plan
 */

$sidebar = '';
if ( is_page() )
{
	$sidebar = 'page-sidebar';
}
else if ( is_singular( 'post' ) )
{
	$sidebar = 'post-sidebar';
}

if ( ! is_active_sidebar( $sidebar ) )
{
	return;
}

if ( 'full-content' == seoplan_get_layout() )
{
	return;
}

?>

<aside id="secondary" class="widget-area primary-sidebar <?php echo esc_attr( $sidebar ); ?> col-sm-3 col-xs-12" role="complementary">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
