<?php
/**
 * Register Case Study custom post type and taxonomy
 */

define( 'SEO_PLAN_CASESTUDY_DIR', trailingslashit( SEO_PLAN_TF_INC_PATH . 'case-study' ) );

require SEO_PLAN_CASESTUDY_DIR . 'inc/class-wpfss-register-case-study.php';
