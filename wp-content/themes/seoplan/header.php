<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seo Plan
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<?php do_action( 'seoplan_before_header' ) ?>

	<?php
	$header_type[] = 'type1';
	$header_type = apply_filters( 'seo_plan_header_type', $header_type );
	?>
	<header id="masthead" class="site-header <?php echo esc_attr( implode( ' ', $header_type ) ); ?>" role="banner">
		<?php do_action( 'seoplan_header' ); ?>
	</header><!-- #masthead -->

	<?php do_action( 'seoplan_after_header' ) ?>

	<div id="content" class="site-content">

		<?php do_action( 'seoplan_before_content' ); ?>

		<div class="container">
			<div class="row">
