<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Class register taxonomies and metaboxes
 */

if ( ! class_exists( 'SeoPlan_Register_Case_Study' ) )
{
    class SeoPlan_Register_Case_Study
    {

        /**
         * WPFSS_Register_Case_Study constructor
         */
        function __construct()
        {
            add_action( 'init', array( $this, 'case_study' ), 5 );
            add_action( 'init', array( $this, 'register_taxonomy_category' ), 5 );
        }

        /**
         * Register case study post type
         */
        function case_study()
        {
            $labels = array(
                'name'               => _x( 'Case Studies', 'post type general name', 'seoplan' ),
                'singular_name'      => _x( 'Case Study', 'post type singular name', 'seoplan' ),
                'menu_name'          => _x( 'Case Studies', 'admin menu', 'seoplan' ),
                'name_admin_bar'     => _x( 'Case Study', 'add new on admin bar', 'seoplan' ),
                'add_new'            => _x( 'Add New', 'case_study', 'seoplan' ),
                'add_new_item'       => __( 'Add New Case Study', 'seoplan' ),
                'new_item'           => __( 'New Case Study', 'seoplan' ),
                'edit_item'          => __( 'Edit Case Study', 'seoplan' ),
                'view_item'          => __( 'View Case Study', 'seoplan' ),
                'all_items'          => __( 'All Case Studies', 'seoplan' ),
                'search_items'       => __( 'Search Case Studies', 'seoplan' ),
                'parent_item_colon'  => __( 'Parent Case Studies:', 'seoplan' ),
                'not_found'          => __( 'No Case Studies found.', 'seoplan' ),
                'not_found_in_trash' => __( 'No Case Studies found in Trash.', 'seoplan' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', 'seoplan' ),
                'public'             => true,
                'publicly_queryable' => true,
                'menu_icon'          => 'dashicons-media-document',
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'case_study' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title', 'editor', 'thumbnail' )
            );

            register_post_type( 'case_study', $args );
        }

        /**
         * Function register collection taxonomy
         */
        function register_taxonomy_category()
        {
            register_taxonomy( 'case_study_category',
               'case_study',
                apply_filters( 'wpfss_taxonomy_args_case_study_category', array(
                    'hierarchical'          => true,
                    'label'                 => __( 'Categories', 'seoplan' ),
                    'labels' => array(
                        'name'              => __( 'Case Study Categories', 'seoplan' ),
                        'singular_name'     => __( 'Case Study Category', 'seoplan' ),
                        'menu_name'         => _x( 'Categories', 'Admin menu name', 'seoplan' ),
                        'search_items'      => __( 'Search Case Study Categories', 'seoplan' ),
                        'all_items'         => __( 'All Case Study Categories', 'seoplan' ),
                        'parent_item'       => __( 'Parent Case Study Category', 'seoplan' ),
                        'parent_item_colon' => __( 'Parent Case Study Category:', 'seoplan' ),
                        'edit_item'         => __( 'Edit Case Study Category', 'seoplan' ),
                        'update_item'       => __( 'Update Case Study Category', 'seoplan' ),
                        'add_new_item'      => __( 'Add New Case Study Category', 'seoplan' ),
                        'new_item_name'     => __( 'New Case Study Category Name', 'seoplan' ),
                        'not_found'         => __( 'No Case Study Category found', 'seoplan' ),
                    ),
                    'show_ui'               => true,
                    'query_var'             => true,
                    'rewrite'               => array(
                        'slug'         => 'case-study-category',
                    ),
                ) )
            );
        }
    }
}