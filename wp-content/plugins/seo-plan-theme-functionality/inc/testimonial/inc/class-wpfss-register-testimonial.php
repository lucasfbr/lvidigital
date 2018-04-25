<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Class register taxonomies and metaboxes
 */

if ( ! class_exists( 'SeoPlan_Register_Testimonial' ) )
{
    class SeoPlan_Register_Testimonial
    {

        /**
         * WPFSS_Register_Case_Study constructor
         */
        function __construct()
        {
            add_action( 'init', array( $this, 'register' ), 5 );
            add_action( 'init', array( $this, 'register_taxonomy_category' ), 5 );
        }

        /**
         * Register Testimonial post type
         */
        function register()
        {
            $labels = array(
                'name'               => _x( 'Testimonials', 'post type general name', 'seoplan' ),
                'singular_name'      => _x( 'Testimonial', 'post type singular name', 'seoplan' ),
                'menu_name'          => _x( 'Testimonials', 'admin menu', 'seoplan' ),
                'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'seoplan' ),
                'add_new'            => _x( 'Add New', 'case_study', 'seoplan' ),
                'add_new_item'       => __( 'Add New Testimonial', 'seoplan' ),
                'new_item'           => __( 'New Testimonial', 'seoplan' ),
                'edit_item'          => __( 'Edit Testimonial', 'seoplan' ),
                'view_item'          => __( 'View Testimonial', 'seoplan' ),
                'all_items'          => __( 'All Testimonials', 'seoplan' ),
                'search_items'       => __( 'Search Testimonials', 'seoplan' ),
                'parent_item_colon'  => __( 'Parent Testimonials:', 'seoplan' ),
                'not_found'          => __( 'No Testimonials found.', 'seoplan' ),
                'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'seoplan' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', 'seoplan' ),
                'public'             => true,
                'publicly_queryable' => true,
                'menu_icon'          => 'dashicons-testimonial',
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'seoplan_testimonial' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title', 'editor' )
            );

            register_post_type( 'seoplan_testimonial', $args );
        }

        /**
         * Function register collection taxonomy
         */
        function register_taxonomy_category()
        {
            register_taxonomy( 'seoplan_testimonial_category',
               'seoplan_testimonial',
                apply_filters( 'wpfss_taxonomy_args_seoplan_testimonial_category', array(
                    'hierarchical'          => true,
                    'label'                 => __( 'Categories', 'seoplan' ),
                    'labels' => array(
                        'name'              => __( 'Testimonial Categories', 'seoplan' ),
                        'singular_name'     => __( 'Testimonial Category', 'seoplan' ),
                        'menu_name'         => _x( 'Categories', 'Admin menu name', 'seoplan' ),
                        'search_items'      => __( 'Search Testimonial Categories', 'seoplan' ),
                        'all_items'         => __( 'All Testimonial Categories', 'seoplan' ),
                        'parent_item'       => __( 'Parent Testimonial Category', 'seoplan' ),
                        'parent_item_colon' => __( 'Parent Testimonial Category:', 'seoplan' ),
                        'edit_item'         => __( 'Edit Testimonial Category', 'seoplan' ),
                        'update_item'       => __( 'Update Testimonial Category', 'seoplan' ),
                        'add_new_item'      => __( 'Add New Testimonial Category', 'seoplan' ),
                        'new_item_name'     => __( 'New Case Testimonial Name', 'seoplan' ),
                        'not_found'         => __( 'No Case Testimonial found', 'seoplan' ),
                    ),
                    'show_ui'               => true,
                    'query_var'             => true,
                    'rewrite'               => array(
                        'slug'         => 'seoplan-testimonial-category',
                    ),
                ) )
            );
        }
    }
}