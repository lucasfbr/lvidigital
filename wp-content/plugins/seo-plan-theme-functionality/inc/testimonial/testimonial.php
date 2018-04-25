<?php
/**
 * Register Case Study custom post type and taxonomy
 */

define( 'SEOPLAN_TESTIMONIAL_DIR', trailingslashit( SEO_PLAN_TF_INC_PATH . 'testimonial' ) );

require SEOPLAN_TESTIMONIAL_DIR . 'inc/class-wpfss-register-testimonial.php';
