<?php
/**
 * Register metabox on for posts, pages and custom post-type
 *
 * @package Seo Plan
 */

/**
 * Register meta boxes
 *
 * @since 1.0
 *
 * @param array $meta_boxes
 *
 * @return array
 */
function seoplan_register_meta_boxes( $meta_boxes )
{
	// Post format
	$meta_boxes[] = array(
		'id'       => 'post-format-settings',
		'title'    => esc_html__( 'MetaBox Settings', 'seoplan' ),
		'pages'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields'   => array(
			array(
				'name'             => esc_html__( 'Image', 'seoplan' ),
				'id'               => 'seoplan_image',
				'type'             => 'image_advanced',
				'class'            => 'image',
				'max_file_uploads' => 1,
			),
			array(
				'name'  => esc_html__( 'Gallery', 'seoplan' ),
				'id'    => 'seoplan_images',
				'type'  => 'image_advanced',
				'class' => 'gallery',
			),
			array(
				'name'  => esc_html__( 'Audio', 'seoplan' ),
				'id'    => 'seoplan_audio',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'audio',
			),
			array(
				'name'  => esc_html__( 'Video', 'seoplan' ),
				'id'    => 'seoplan_video',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'video',
			),
			array(
				'name'  => esc_html__( 'Link', 'seoplan' ),
				'id'    => 'seoplan_url',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 1,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Text', 'seoplan' ),
				'id'    => 'seoplan_url_text',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 1,
				'class' => 'link',
			),
			array(
				'name'  => esc_html__( 'Quote', 'seoplan' ),
				'id'    => 'seoplan_quote',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 2,
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Author', 'seoplan' ),
				'id'    => 'seoplan_quote_author',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 1,
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'URL', 'seoplan' ),
				'id'    => 'seoplan_author_url',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 1,
				'class' => 'quote',
			),
			array(
				'name'  => esc_html__( 'Status', 'seoplan' ),
				'id'    => 'seoplan_status',
				'type'  => 'textarea',
				'cols'  => 20,
				'rows'  => 1,
				'class' => 'status',
			),
		),
	);

	// Page format
	$meta_boxes[] = array(
		'id'       => 'display-settings',
		'title'    => esc_html__( 'Display Settings', 'seoplan' ),
		'pages'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Title', 'seoplan' ),
				'id'   => 'seoplan_heading_title',
				'type' => 'heading',
			),
			array(
				'name'  => esc_html__( 'Hide The Title', 'seoplan' ),
				'id'    => 'seoplan_hide_title',
				'type'  => 'checkbox',
				'std'   => false,
			),
			array(
				'name' => esc_html__( 'Breadcrumb', 'seoplan' ),
				'id'   => 'seoplan_heading_breadcrumb',
				'type' => 'heading',
			),
			array(
				'name'  => esc_html__( 'Hide Breadcrumb', 'seoplan' ),
				'id'    => 'seoplan_hide_breadcrumb',
				'type'  => 'checkbox',
				'std'   => false,
			),
			array(
				'name' => esc_html__( 'Layout & Styles', 'seoplan' ),
				'id'   => 'seoplan_heading_layout',
				'type' => 'heading',
			),
			array(
				'name'  => esc_html__( 'Custom Layout', 'seoplan' ),
				'id'    => 'seoplan_custom_layout',
				'type'  => 'checkbox',
				'std'   => false,
			),
			array(
				'name'  => esc_html__( 'Custom CSS', 'seoplan' ),
				'id'    => 'seoplan_custom_css',
				'type'  => 'textarea',
				'std'   => false,
			),
			array(
				'name'  => esc_html__( 'Custom JavaScript', 'seoplan' ),
				'id'    => 'seoplan_custom_js',
				'type'  => 'textarea',
				'std'   => false,
			),
		),
	);

    // Case study
    $meta_boxes[] = array(
        'id'       => 'display-settings',
        'title'    => esc_html__( 'Information', 'seoplan' ),
        'pages'    => array( 'case_study' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name' => esc_html__( 'Clients', 'seoplan' ),
                'id'   => 'client_information',
                'type' => 'textarea',
                'rows'  => '1'
            ),
            array(
                'name' => esc_html__( 'Short Description', 'seoplan' ),
                'id'   => 'short_description',
                'type' => 'textarea',
                'rows'  => '10'
            ),
        ),
    );

    // Testimonial

    $meta_boxes[] = array(
        'id'       => 'testimonial-customer-information',
        'title'    => esc_html__( 'Client Information', 'seoplan' ),
        'pages'    => array( 'seoplan_testimonial' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => array(
            array(
                'name'             => esc_html__( 'Thumbnail', 'seoplan' ),
                'id'               => 'client_thumbnail_image',
                'type'             => 'image_advanced',
                'class'            => 'image',
                'max_file_uploads' => 1,
            ),
            array(
                'name'  => esc_html__( 'Information', 'seoplan' ),
                'id'    => 'client_information',
                'type'  => 'textarea',
                'cols'  => 20,
                'rows'  => 1,
            ),
        ),
    );

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'seoplan_register_meta_boxes' );

/**
 * Enqueue scripts for admin
 *
 * @since  1.0
 */
function seoplan_meta_boxes_scripts( $hook )
{
	// Detect to load un-minify scripts when WP_DEBUG is enable
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) )
	{
		wp_enqueue_script( 'wpf-meta-boxes', SEOPLAN_URL . "/js/admin/scripts.js", array( 'jquery' ), SEOPLAN_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'seoplan_meta_boxes_scripts' );
