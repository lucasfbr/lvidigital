<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Importer classes
if( ! defined( 'WP_LOAD_IMPORTERS' ) )
{
    define( 'WP_LOAD_IMPORTERS', true );
}

if( ! class_exists( 'WPF_Content_Importer' ) )
{
    require_once SP_TD_IMPORT_PATH . 'importer/wordpress-importer.php';
}

if( ! class_exists( 'WPF_Widgets_Importer' ) )
{
    require_once SP_TD_IMPORT_PATH . 'importer/widgets-importer.php';
}
/**
 * Class uses for import demo data
 */
if( ! class_exists( 'WPF_Import_Demo_Content' ) )
{
    class WPF_Import_Demo_Content
    {
        public $demo_data_path;
        public $demo_data_url;
        public $assets_path;
        public $assets_url;
        private $option_name;
        /**
         * WPF_Import_Demo_Content constructor.
         */
        function __construct()
        {
            add_action( 'admin_menu', array( $this, 'menu' ) );
            add_action( 'admin_notices', array( $this, 'notice' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            $this->demo_data_path = SP_TD_IMPORT_PATH . 'demo-data';
            $this->demo_data_url = SP_TD_IMPORT_URL . 'demo-data';
            $this->assets_path = SP_TD_IMPORT_PATH . 'assets';
            $this->assets_url = SP_TD_IMPORT_URL . 'assets';
            $this->option_name = 'seoplan_theme_options';
        }

        /**
         * Function enqueue main scripts and styles use for theme
         */
        public function enqueue_scripts()
        {
            wp_enqueue_style( 'wpf-import-data-style', $this->assets_url . '/css/import-data-style.css' );
        }

        /**
         * Function add new menu under Appearance menu
         */
        public function menu() {
            add_theme_page(
                __( 'Import Theme Demo Data', 'smartseo' ),
                __( 'Theme Demo Data', 'smartseo' ),
                'edit_theme_options',
                'import-demo-content',
                array( $this, 'import_page' )
            );

        }

        /**
         * Display notice
         */
        public function notice() {
            global $pagenow;

            // Only display on themes page
            if ( 'themes.php' != $pagenow ) {
                return;
            }

            // Only display on import demo page
            if ( ! isset( $_GET['page'] ) || 'import-demo-content' != $_GET['page'] ) {
                return;
            }

            if ( isset( $_GET['import'] ) && 'success' == $_GET['import'] ) {
                return;
            }
            ?>

            <div class="updated notice is-dismissible">
                <p><?php _e( 'Before starting the import, you have to install all required plugins and other plugins that you want to use.', 'smartseo' ) ?></p>
                <p><h3><?php _e( 'What if the Import fails?', 'smartseo' ) ?></h3></p>
                <p><?php _e( 'If the import not response in a long time and fails after a few minutes You are suffering from PHP configuration limits that are set too low to complete the process. You should contact your hosting provider and ask them to increase those limits to a minimum as follows:', 'smartseo' ) ?></p>
                <ul style="list-style-type: disc; margin-left: 50px">
                    <li><?php _e( 'max_execution_time 600', 'smartseo' ); ?></li>
                    <li><?php _e( 'memory_limit 128M', 'smartseo' ); ?></li>
                    <li><?php _e( 'post_max_size 32M', 'smartseo' ); ?></li>
                    <li><?php _e( 'upload_max_filesize 32M', 'smartseo' ); ?></li>
                </ul>
                <p>You can verify your PHP configuration limits by installing a simple plugin found here: <a href="http://wordpress.org/extend/plugins/wordpress-php-info" target="_blank">http://wordpress.org/extend/plugins/wordpress-php-info</a>. And you can also check your PHP error logs to see the exact error being returned.</p>
                <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'smartseo' ) ?></span></button>
            </div>

            <?php
        }

        /**
         * Display import page
         */
        public function import_page()
        {
            $result = $this->import_data();
        ?>
            <div class="wrap">
                <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

                <?php if ( $result ) : ?>
                    <p>
                        <?php _e( 'All Done!', 'smartseo' ) ?>
                    </p>
                <?php else : ?>

                    <p class="description"><?php _e( 'It usally take some minutes to finish. Please be patient.', 'smartseo' ) ?></p>

                    <form id="smartseo-form-import-form" action="" method="post">
                        <?php wp_nonce_field( 'smartseo-import-demo-data', '_smartseo_import_nonce' ); ?>
                        <div class="data-box">
                            <div class="data-img"><img width="320" height="240" src="<?php echo $this->demo_data_url . '/home/screenshot.png'; ?>"></div>
                            <input type="submit" class="button button-primary" value="<?php _e( 'Import', 'smartseo' ) ?>">
                        </div>

                    </form>

                <?php endif; ?>
            </div>
        <?php
        }

        /**
         * Import Data
         */

        public function import_data()
        {
            if ( ! isset( $_POST['_smartseo_import_nonce'] ) || ! wp_verify_nonce( $_POST['_smartseo_import_nonce'], 'smartseo-import-demo-data' ) )
            {
                return;
            }

            // Import content
            $this->import_content();
            // Import content
            $this->import_widgets();
            // Import Revo Slider
            $this->import_slider();
            // Setup Page
            $this->setup_page();
            // Setup Menu
            $this->set_menu_locations();
            // Import theme options data
            $this->import_theme_options();

            return true;
        }

        /**
         * Function imports demo content exported from WP
         * @param string $file
         */
        private function import_content( $file = 'content.xml' )
        {
            // Import theme contents data
            require_once SP_TD_IMPORT_PATH . 'import-image-content.php';
            $content_file_path = $this->demo_data_path . '/home/' . $file;
            if ( ! file_exists( $content_file_path ) )
            {
                return;
            }

            $import = new WPF_Extend_Content_Importer();
            $xml    = $content_file_path;

            $import->fetch_attachments = true;

            ob_start();
            $import->import( $xml );
            ob_end_clean();
        }

        /**
         * Function imports theme options data exported from Redux
         */
        private function import_theme_options()
        {
            if( class_exists( 'ReduxFrameworkInstances' ) )
            {
                $theme_options_file = $this->demo_data_url . '/home/theme-options.txt';
                $file_contents = file_get_contents( $theme_options_file );
                $options = json_decode( preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $file_contents ), true );
                $redux = ReduxFrameworkInstances::get_instance( $this->option_name );
                $redux->set_options($options);
            }
        }

        /**
         * Function setup homepage, blog page, woocommerce page
         */
        private function setup_page( $active_demo = 'home' )
        {
            $wp_pages = array(
              'home'    =>  array(
                  'homepage'    => 'HomePage',
                  'blog'        =>  'Blog',
              )
            );
            apply_filters( 'wpf_args_import_content_wp_pages', $wp_pages );

            // set WP pages
            $homepage = get_page_by_title( $wp_pages[$active_demo]['homepage'] );
            $blogpage = get_page_by_title( $wp_pages[$active_demo]['blog'] );
            if ( isset( $homepage->ID ) )
            {
                update_option('page_on_front', $homepage->ID);
                update_option('show_on_front', 'page');
            }
            if ( isset( $blogpage->ID ) )
            {
                update_option('page_for_posts', $blogpage->ID);
            }

        }

        /**
         * Import widgets
         *
         * @param  string $file The exported file's name
         */
        private function import_widgets( $file = 'widgets.json' )
        {
            $widget_file_path = $this->demo_data_path . '/home/' . $file;
            if ( ! file_exists( $widget_file_path ) )
            {
                return;
            }

            $file_data 	= file_get_contents( $widget_file_path );
            $data 		= json_decode( preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $file_data ) );
            $importer   = new WPF_Widgets_Importer();
            $importer->import( $data );
        }

        /**
         * Set menu locations
         */
        private function set_menu_locations()
        {
            $top_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
            $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
            $mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
            if ( isset( $top_menu->term_id ) )
            {
                set_theme_mod( 'nav_menu_locations', array(
                        'primary' => $top_menu->term_id,
                        'footer'  => $footer_menu->term_id,
                        'mobile'  => $mobile_menu->term_id,
                    )
                );
            }
        }

        /**
         * Import Revo Slider
         */
        private function import_slider( $active_demo = 'home' )
        {
            if ( ! class_exists( 'RevSlider' ) ) {
                return;
            }

            $sliders = array(
              'home'    =>  array( 'home.zip' ),
            );


            $slider = new RevSlider();

            foreach( $sliders[$active_demo] as $file_name )
            {
                if ( $file_name == '.' || $file_name == '..' )
                {
                    continue;
                }
                $file_path = $this->demo_data_path . '/' . $active_demo . '/' . $file_name;
                if ( file_exists( $file_path ) )
                {
                    $slider->importSliderFromPost( true, true, $file_path );
                }

            }
        }
    }
}