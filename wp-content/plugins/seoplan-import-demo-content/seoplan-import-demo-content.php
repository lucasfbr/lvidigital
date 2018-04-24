<?php
/**
 * Plugin Name: SeoPlan Import Demo Content
 * Plugin URI: http://themecitizen.com/
 * Description: The plugin contain feature import demo content that will setting your site same as the theme demo
 * Version: 1.0.0
 * Author: WP Friends
 * Author URI: http://themecitizen.com/
 */

define( 'SP_TD_PATH', plugin_dir_path( __FILE__ ) );
define( 'SP_TD_URL', plugin_dir_url( __FILE__ ) );

// import folder path

define( 'SP_TD_IMPORT_PATH', trailingslashit( SP_TD_PATH . 'import-demo-content' ) );
define( 'SP_TD_IMPORT_URL', trailingslashit( SP_TD_URL . 'import-demo-content' ) );

require SP_TD_IMPORT_PATH . 'import-demo-content.php';
new WPF_Import_Demo_Content();