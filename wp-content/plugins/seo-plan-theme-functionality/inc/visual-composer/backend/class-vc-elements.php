<?php

if ( ! function_exists( 'is_plugin_active' ) )
{
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( ! class_exists( 'SeoPlan_VC_Elements' ) )
{
    /**
     * Class SeoPlan_VC_Elements register new elements for vc
     */
    class SeoPlan_VC_Elements
    {
        public $icons;
        public $flat_icons;
        /**
         * SeoPlan_VC_Elements constructor.
         */
        function __construct()
        {
            // Stop if VC is not installed
            if ( ! is_plugin_active( 'js_composer/js_composer.php' ) )
            {
                return false;
            }
            $this->icons = self::icons();
            $this->flat_icons = self::flat_icons();
            if ( function_exists( 'vc_add_shortcode_param' ) )
            {
                vc_add_shortcode_param( 'font-icons', array( $this, 'register_param_icon' ), SEO_PLAN_TF_JS_URL . 'visual-composer/seo-plan-font-icons.js' );
                vc_add_shortcode_param( 'flat-icons', array( $this, 'register_param_flat_icon' ), SEO_PLAN_TF_JS_URL . 'visual-composer/seo-plan-font-icons.js' );
            }
            else
            {
                return false;
            }
            add_action( 'vc_before_init', array( $this, 'maps' ) );
        }

        /**
         * Define fontawesome icon classes
         *
         * @since  1.0.0
         *
         * @return array
         */
        public static function icons() {
            $icons = array( 'fa fa-adjust', 'fa fa-adn', 'fa fa-align-center', 'fa fa-align-justify', 'fa fa-align-left',
                'fa fa-align-right', 'fa fa-ambulance', 'fa fa-anchor', 'fa fa-android', 'fa fa-angellist',
                'fa fa-angle-double-down', 'fa fa-angle-double-left', 'fa fa-angle-double-right', 'fa fa-angle-double-up',
                'fa fa-angle-down', 'fa fa-angle-left', 'fa fa-angle-right', 'fa fa-angle-up', 'fa fa-apple', 'fa fa-archive',
                'fa fa-area-chart', 'fa fa-arrow-circle-down', 'fa fa-arrow-circle-left', 'fa fa-arrow-circle-o-down',
                'fa fa-arrow-circle-o-left', 'fa fa-arrow-circle-o-right', 'fa fa-arrow-circle-o-up', 'fa fa-arrow-circle-right',
                'fa fa-arrow-circle-up', 'fa fa-arrow-down', 'fa fa-arrow-left', 'fa fa-arrow-right', 'fa fa-arrow-up',
                'fa fa-arrows', 'fa fa-arrows-alt', 'fa fa-arrows-h', 'fa fa-arrows-v', 'fa fa-asterisk', 'fa fa-at',
                'fa fa-automobile', 'fa fa-backward', 'fa fa-ban', 'fa fa-bank', 'fa fa-bar-chart', 'fa fa-bar-chart-o',
                'fa fa-barcode', 'fa fa-bars', 'fa fa-beer', 'fa fa-behance', 'fa fa-behance-square', 'fa fa-bell',
                'fa fa-bell-o', 'fa fa-bell-slash', 'fa fa-bell-slash-o', 'fa fa-bicycle', 'fa fa-binoculars',
                'fa fa-birthday-cake', 'fa fa-bitbucket', 'fa fa-bitbucket-square', 'fa fa-bitcoin', 'fa fa-bold',
                'fa fa-bolt', 'fa fa-bomb', 'fa fa-book', 'fa fa-bookmark', 'fa fa-bookmark-o', 'fa fa-briefcase',
                'fa fa-btc', 'fa fa-bug', 'fa fa-building', 'fa fa-building-o', 'fa fa-bullhorn', 'fa fa-bullseye',
                'fa fa-bus', 'fa fa-cab', 'fa fa-calculator', 'fa fa-calendar', 'fa fa-calendar-o', 'fa fa-camera',
                'fa fa-camera-retro', 'fa fa-car', 'fa fa-caret-down', 'fa fa-caret-left', 'fa fa-caret-right',
                'fa fa-caret-square-o-down', 'fa fa-caret-square-o-left', 'fa fa-caret-square-o-right',
                'fa fa-caret-square-o-up', 'fa fa-caret-up', 'fa fa-cc', 'fa fa-cc-amex', 'fa fa-cc-discover',
                'fa fa-cc-mastercard', 'fa fa-cc-paypal', 'fa fa-cc-stripe', 'fa fa-cc-visa', 'fa fa-certificate',
                'fa fa-chain', 'fa fa-chain-broken', 'fa fa-check', 'fa fa-check-circle', 'fa fa-check-circle-o',
                'fa fa-check-square', 'fa fa-check-square-o', 'fa fa-chevron-circle-down', 'fa fa-chevron-circle-left',
                'fa fa-chevron-circle-right', 'fa fa-chevron-circle-up', 'fa fa-chevron-down', 'fa fa-chevron-left',
                'fa fa-chevron-right', 'fa fa-chevron-up', 'fa fa-child', 'fa fa-circle', 'fa fa-circle-o',
                'fa fa-circle-o-notch', 'fa fa-circle-thin', 'fa fa-clipboard', 'fa fa-clock-o', 'fa fa-close',
                'fa fa-cloud', 'fa fa-cloud-download', 'fa fa-cloud-upload', 'fa fa-cny', 'fa fa-code', 'fa fa-code-fork',
                'fa fa-codepen', 'fa fa-coffee', 'fa fa-cog', 'fa fa-cogs', 'fa fa-columns', 'fa fa-comment', 'fa fa-comment-o',
                'fa fa-comments', 'fa fa-comments-o', 'fa fa-compass', 'fa fa-compress', 'fa fa-copy', 'fa fa-copyright',
                'fa fa-credit-card', 'fa fa-crop', 'fa fa-crosshairs', 'fa fa-css3', 'fa fa-cube', 'fa fa-cubes', 'fa fa-cut',
                'fa fa-cutlery', 'fa fa-dashboard', 'fa fa-database', 'fa fa-dedent', 'fa fa-delicious', 'fa fa-desktop',
                'fa fa-deviantart', 'fa fa-digg', 'fa fa-dollar', 'fa fa-dot-circle-o', 'fa fa-download', 'fa fa-dribbble',
                'fa fa-dropbox', 'fa fa-drupal', 'fa fa-edit', 'fa fa-eject', 'fa fa-ellipsis-h', 'fa fa-ellipsis-v',
                'fa fa-empire', 'fa fa-envelope', 'fa fa-envelope-o', 'fa fa-envelope-square', 'fa fa-eraser', 'fa fa-eur',
                'fa fa-euro', 'fa fa-exchange', 'fa fa-exclamation', 'fa fa-exclamation-circle', 'fa fa-exclamation-triangle',
                'fa fa-expand', 'fa fa-external-link', 'fa fa-external-link-square', 'fa fa-eye', 'fa fa-eye-slash',
                'fa fa-eyedropper', 'fa fa-facebook', 'fa fa-facebook-square', 'fa fa-fast-backward', 'fa fa-fast-forward',
                'fa fa-fax', 'fa fa-female', 'fa fa-fighter-jet', 'fa fa-file', 'fa fa-file-archive-o', 'fa fa-file-audio-o',
                'fa fa-file-code-o', 'fa fa-file-excel-o', 'fa fa-file-image-o', 'fa fa-file-movie-o', 'fa fa-file-o',
                'fa fa-file-pdf-o', 'fa fa-file-photo-o', 'fa fa-file-picture-o', 'fa fa-file-powerpoint-o',
                'fa fa-file-sound-o', 'fa fa-file-text', 'fa fa-file-text-o', 'fa fa-file-video-o', 'fa fa-file-word-o',
                'fa fa-file-zip-o', 'fa fa-files-o', 'fa fa-film', 'fa fa-filter', 'fa fa-fire', 'fa fa-fire-extinguisher',
                'fa fa-flag', 'fa fa-flag-checkered', 'fa fa-flag-o', 'fa fa-flash', 'fa fa-flask', 'fa fa-flickr',
                'fa fa-floppy-o', 'fa fa-folder', 'fa fa-folder-o', 'fa fa-folder-open', 'fa fa-folder-open-o', 'fa fa-font',
                'fa fa-forward', 'fa fa-foursquare', 'fa fa-frown-o', 'fa fa-futbol-o', 'fa fa-gamepad', 'fa fa-gavel',
                'fa fa-gbp', 'fa fa-ge', 'fa fa-gear', 'fa fa-gears', 'fa fa-gift', 'fa fa-git', 'fa fa-git-square',
                'fa fa-github', 'fa fa-github-alt', 'fa fa-github-square', 'fa fa-gittip', 'fa fa-glass', 'fa fa-globe',
                'fa fa-google', 'fa fa-google-plus', 'fa fa-google-plus-square', 'fa fa-google-wallet', 'fa fa-graduation-cap',
                'fa fa-group', 'fa fa-h-square', 'fa fa-hacker-news', 'fa fa-hand-o-down', 'fa fa-hand-o-left',
                'fa fa-hand-o-right', 'fa fa-hand-o-up', 'fa fa-hdd-o', 'fa fa-header', 'fa fa-headphones', 'fa fa-heart',
                'fa fa-heart-o', 'fa fa-history', 'fa fa-home', 'fa fa-hospital-o', 'fa fa-html5', 'fa fa-ils', 'fa fa-image',
                'fa fa-inbox', 'fa fa-indent', 'fa fa-info', 'fa fa-info-circle', 'fa fa-inr', 'fa fa-instagram',
                'fa fa-institution', 'fa fa-ioxhost', 'fa fa-italic', 'fa fa-joomla', 'fa fa-jpy', 'fa fa-jsfiddle',
                'fa fa-key', 'fa fa-keyboard-o', 'fa fa-krw', 'fa fa-language', 'fa fa-laptop', 'fa fa-lastfm',
                'fa fa-lastfm-square', 'fa fa-leaf', 'fa fa-legal', 'fa fa-lemon-o', 'fa fa-level-down', 'fa fa-level-up',
                'fa fa-life-bouy', 'fa fa-life-buoy', 'fa fa-life-ring', 'fa fa-life-saver', 'fa fa-lightbulb-o',
                'fa fa-line-chart', 'fa fa-link', 'fa fa-linkedin', 'fa fa-linkedin-square', 'fa fa-linux', 'fa fa-list',
                'fa fa-list-alt', 'fa fa-list-ol', 'fa fa-list-ul', 'fa fa-location-arrow', 'fa fa-lock',
                'fa fa-long-arrow-down', 'fa fa-long-arrow-left', 'fa fa-long-arrow-right', 'fa fa-long-arrow-up',
                'fa fa-magic', 'fa fa-magnet', 'fa fa-mail-forward', 'fa fa-mail-reply', 'fa fa-mail-reply-all',
                'fa fa-male', 'fa fa-map-marker', 'fa fa-maxcdn', 'fa fa-meanpath', 'fa fa-medkit', 'fa fa-meh-o',
                'fa fa-microphone', 'fa fa-microphone-slash', 'fa fa-minus', 'fa fa-minus-circle', 'fa fa-minus-square',
                'fa fa-minus-square-o', 'fa fa-mobile', 'fa fa-mobile-phone', 'fa fa-money', 'fa fa-moon-o',
                'fa fa-mortar-board', 'fa fa-music', 'fa fa-navicon', 'fa fa-newspaper-o', 'fa fa-openid',
                'fa fa-outdent', 'fa fa-pagelines', 'fa fa-paint-brush', 'fa fa-paper-plane', 'fa fa-paper-plane-o',
                'fa fa-paperclip', 'fa fa-paragraph', 'fa fa-paste', 'fa fa-pause', 'fa fa-paw', 'fa fa-paypal',
                'fa fa-pencil', 'fa fa-pencil-square', 'fa fa-pencil-square-o', 'fa fa-phone', 'fa fa-phone-square',
                'fa fa-photo', 'fa fa-picture-o', 'fa fa-pie-chart', 'fa fa-pied-piper', 'fa fa-pied-piper-alt',
                'fa fa-pinterest', 'fa fa-pinterest-square', 'fa fa-plane', 'fa fa-play', 'fa fa-play-circle',
                'fa fa-play-circle-o', 'fa fa-plug', 'fa fa-plus', 'fa fa-plus-circle', 'fa fa-plus-square',
                'fa fa-plus-square-o', 'fa fa-power-off', 'fa fa-print', 'fa fa-puzzle-piece', 'fa fa-qq', 'fa fa-qrcode',
                'fa fa-question', 'fa fa-question-circle', 'fa fa-quote-left', 'fa fa-quote-right', 'fa fa-ra',
                'fa fa-random', 'fa fa-rebel', 'fa fa-recycle', 'fa fa-reddit', 'fa fa-reddit-square', 'fa fa-refresh',
                'fa fa-remove', 'fa fa-renren', 'fa fa-reorder', 'fa fa-repeat', 'fa fa-reply', 'fa fa-reply-all',
                'fa fa-retweet', 'fa fa-rmb', 'fa fa-road', 'fa fa-rocket', 'fa fa-rotate-left', 'fa fa-rotate-right',
                'fa fa-rouble', 'fa fa-rss', 'fa fa-rss-square', 'fa fa-rub', 'fa fa-ruble', 'fa fa-rupee', 'fa fa-save',
                'fa fa-scissors', 'fa fa-search', 'fa fa-search-minus', 'fa fa-search-plus', 'fa fa-send', 'fa fa-send-o',
                'fa fa-share', 'fa fa-share-alt', 'fa fa-share-alt-square', 'fa fa-share-square', 'fa fa-share-square-o',
                'fa fa-shekel', 'fa fa-sheqel', 'fa fa-shield', 'fa fa-shopping-cart', 'fa fa-sign-in', 'fa fa-sign-out',
                'fa fa-signal', 'fa fa-sitemap', 'fa fa-skype', 'fa fa-slack', 'fa fa-sliders', 'fa fa-slideshare',
                'fa fa-smile-o', 'fa fa-soccer-ball-o', 'fa fa-sort', 'fa fa-sort-alpha-asc', 'fa fa-sort-alpha-desc',
                'fa fa-sort-amount-asc', 'fa fa-sort-amount-desc', 'fa fa-sort-asc', 'fa fa-sort-desc', 'fa fa-sort-down',
                'fa fa-sort-numeric-asc', 'fa fa-sort-numeric-desc', 'fa fa-sort-up', 'fa fa-soundcloud',
                'fa fa-space-shuttle', 'fa fa-spinner', 'fa fa-spoon', 'fa fa-spotify', 'fa fa-square', 'fa fa-square-o',
                'fa fa-stack-exchange', 'fa fa-stack-overflow', 'fa fa-star', 'fa fa-star-half', 'fa fa-star-half-empty',
                'fa fa-star-half-full', 'fa fa-star-half-o', 'fa fa-star-o', 'fa fa-steam', 'fa fa-steam-square',
                'fa fa-step-backward', 'fa fa-step-forward', 'fa fa-stethoscope', 'fa fa-stop', 'fa fa-strikethrough',
                'fa fa-stumbleupon', 'fa fa-stumbleupon-circle', 'fa fa-subscript', 'fa fa-suitcase', 'fa fa-sun-o',
                'fa fa-superscript', 'fa fa-support', 'fa fa-table', 'fa fa-tablet', 'fa fa-tachometer', 'fa fa-tag',
                'fa fa-tags', 'fa fa-tasks', 'fa fa-taxi', 'fa fa-tencent-weibo', 'fa fa-terminal', 'fa fa-text-height',
                'fa fa-text-width', 'fa fa-th', 'fa fa-th-large', 'fa fa-th-list', 'fa fa-thumb-tack', 'fa fa-thumbs-down',
                'fa fa-thumbs-o-down', 'fa fa-thumbs-o-up', 'fa fa-thumbs-up', 'fa fa-ticket', 'fa fa-times',
                'fa fa-times-circle', 'fa fa-times-circle-o', 'fa fa-tint', 'fa fa-toggle-down', 'fa fa-toggle-left',
                'fa fa-toggle-off', 'fa fa-toggle-on', 'fa fa-toggle-right', 'fa fa-toggle-up', 'fa fa-trash', 'fa fa-trash-o',
                'fa fa-tree', 'fa fa-trello', 'fa fa-trophy', 'fa fa-truck', 'fa fa-try', 'fa fa-tty', 'fa fa-tumblr',
                'fa fa-tumblr-square', 'fa fa-turkish-lira', 'fa fa-twitch', 'fa fa-twitter', 'fa fa-twitter-square',
                'fa fa-umbrella', 'fa fa-underline', 'fa fa-undo', 'fa fa-university', 'fa fa-unlink', 'fa fa-unlock',
                'fa fa-unlock-alt', 'fa fa-unsorted', 'fa fa-upload', 'fa fa-usd', 'fa fa-user', 'fa fa-user-md',
                'fa fa-users', 'fa fa-video-camera', 'fa fa-vimeo-square', 'fa fa-vine', 'fa fa-vk', 'fa fa-volume-down',
                'fa fa-volume-off', 'fa fa-volume-up', 'fa fa-warning', 'fa fa-wechat', 'fa fa-weibo', 'fa fa-weixin',
                'fa fa-wheelchair', 'fa fa-wifi', 'fa fa-windows', 'fa fa-won', 'fa fa-wordpress', 'fa fa-wrench',
                'fa fa-xing', 'fa fa-xing-square', 'fa fa-yahoo', 'fa fa-yelp', 'fa fa-yen', 'fa fa-youtube',
                'fa fa-youtube-play', 'fa fa-youtube-square', );

            return apply_filters( 'seoplan_theme_icons', $icons );
        }

        public static function flat_icons()
        {
            $icons = array(
                'flaticon-link', 'flaticon-arrows-2', 'flaticon-interface', 'flaticon-prev-page1', 'flaticon-newspaper', 'flaticon-design', 'flaticon-viral-marketing', 'flaticon-sharing-archives',
                'flaticon-online-shop', 'flaticon-domain-registration', 'flaticon-browser-2', 'flaticon-backup', 'flaticon-funnel', 'flaticon-flag', 'flaticon-video', 'flaticon-tags', 'flaticon-creativity',
                'flaticon-handshake', 'flaticon-building', 'flaticon-search-engine-1', 'flaticon-music', 'flaticon-typewriter', 'flaticon-ranking', 'flaticon-folder', 'flaticon-keywords', 'flaticon-earth',
                'flaticon-search-3', 'flaticon-coding', 'flaticon-search-2', 'flaticon-target-2', 'flaticon-browser-1', 'flaticon-browser', 'flaticon-shield', 'flaticon-link-1', 'flaticon-devices',
                'flaticon-speedometer-1', 'flaticon-analytics', 'flaticon-stats', 'flaticon-arrows-1', 'flaticon-map', 'flaticon-baggage', 'flaticon-two-money-cards', 'flaticon-quality-badge', 'flaticon-two-contacts', 'flaticon-computer-mouse-with-long-cable',
                'flaticon-networking-group', 'flaticon-truck-facing-right', 'flaticon-pc-tower-and-monitor', 'flaticon-phone-on-circle', 'flaticon-big-envelope', 'flaticon-inclined-paper-plane', 'flaticon-big-telephone',
                'flaticon-translation', 'flaticon-envelope', 'flaticon-technology-1', 'flaticon-inclined-rocket', 'flaticon-rocket', 'flaticon-search-1', 'flaticon-business-1', 'flaticon-technology',
                'flaticon-laptop', 'flaticon-global-network', 'flaticon-screen', 'flaticon-smartphone', 'flaticon-right-quote', 'flaticon-social', 'flaticon-business', 'flaticon-geolocalization', 'flaticon-search',
                'flaticon-location', 'flaticon-arrows', 'flaticon-pen', 'flaticon-speedometer', 'flaticon-target-1', 'flaticon-commerce', 'flaticon-people', 'flaticon-light-bulb', 'flaticon-connection',
                'flaticon-mountain', 'flaticon-target', 'flaticon-marketing', 'flaticon-profile', 'flaticon-magnifying-glass', 'flaticon-quality', 'flaticon-speech-bubbles', 'flaticon-social-media',
                'flaticon-server', 'flaticon-sitemap', 'flaticon-targeting', 'flaticon-email', 'flaticon-blogging', 'flaticon-shared-folder', 'flaticon-computer', 'flaticon-image', 'flaticon-customer',
                'flaticon-tool', 'flaticon-monitoring', 'flaticon-cloud-computing', 'flaticon-idea', 'flaticon-trophy', 'flaticon-search-engine',
            );
            return $icons;
        }
        /**
         * Function registers new vc elements and map them with theme's shortcodes
         *
         * @since 1.0
         *
         * @return void
         */
        function maps()
        {

            // Add section title shortcode
            vc_map( array(
                'name'     => __( 'Section Information', 'seoplan' ),
                'base'     => 'section_information',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Heading', 'seoplan' ),
                        'param_name'  => 'heading',
                        'value'       => '',
                        'description' => __( 'Enter the title content', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'heading'     => __( 'Description', 'seoplan' ),
                        'param_name'  => 'content',
                        'value'       => '',
                        'description' => __( 'Enter a short description for section', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Text alignment', 'seoplan' ),
                        'param_name'  => 'align',
                        'value'       => array(
                            __( 'Left', 'seoplan' )    =>  'align-left',
                            __( 'Center', 'seoplan' )  =>  'align-center',
                            __( 'Right', 'seoplan' )   =>  'align-right',
                        ),
                        'description' => __( 'Align Text', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Hide bottom line', 'seoplan' ),
                        'param_name'  => 'hide_bottom_line',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Heading Color', 'seoplan' ),
                        'param_name'  => 'heading_color',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Description Color', 'seoplan' ),
                        'param_name'  => 'description_color',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Line Color', 'seoplan' ),
                        'param_name'  => 'line_color',
                        'value'       => '',
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                    array(
                        'heading'    => esc_html__( 'CSS box', 'seoplan' ),
                        'type'       => 'css_editor',
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design Options', 'seoplan' ),
                    ),
                ),
            ) );

            // Add section title shortcode
            vc_map( array(
                'name'     => __( 'FAQ', 'seoplan' ),
                'base'     => 'seoplan_faq',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Title', 'seoplan' ),
                        'param_name'  => 'title',
                        'value'       => '',
                        'description' => __( 'Enter the title', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'heading'     => __( 'Content', 'seoplan' ),
                        'param_name'  => 'content',
                        'value'       => '',
                        'description' => __( 'Enter the content', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Title Color', 'seoplan' ),
                        'param_name'  => 'title_color',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Content Color', 'seoplan' ),
                        'param_name'  => 'content_color',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'BackGround Color', 'seoplan' ),
                        'param_name'  => 'bg_color',
                        'value'       => '',
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                    array(
                        'heading'    => esc_html__( 'CSS box', 'seoplan' ),
                        'type'       => 'css_editor',
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design Options', 'seoplan' ),
                    ),
                ),
            ) );

            // Add images carousel
            vc_map( array(
                'name'     => __( 'Images Carousel', 'seoplan' ),
                'base'     => 'images_carousel',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'attach_images',
                        'holder'      => 'div',
                        'heading'     => __( 'Images', 'seoplan' ),
                        'param_name'  => 'images',
                        'value'       => '',
                        'description' => __( 'Select images from media library', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Image size', 'seoplan' ),
                        'param_name'  => 'image_size',
                        'value'       => array(
                            'Full Size'             =>  'full',
                            'Thumbnail (150x150)'   =>  'thumbnail',
                            'Medium (300x300)'      =>  'medium',
                            'Large (1024x1024)'     =>  'large',
                            'Single Image (570x420)'     =>  'seoplan-image-carousel-1',
                            'Gallery Image (570x360)'     =>  'seoplan-image-gallery-1',
                        ),
                        'description' => __( 'Select image size. Leave empty to use "thumbnail" size.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'layout',
                        'value'       => array(
                            __( 'Single Image', 'seoplan' )  =>  'single',
                            __( 'List Image', 'seoplan' )  =>  'list',
                            __( 'Gallery Images', 'seoplan' )  =>  'gallery',
                        ),
                        'description' => __( 'Select Layout for latest posts', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textarea',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Custom links', 'seoplan' ),
                        'param_name'  => 'custom_links',
                        'description' => esc_html__( 'Enter links for each slide here. Divide links with linebreaks (Enter).', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'list' ) ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Slider autoplay', 'seoplan' ),
                        'param_name'  => 'auto_play',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'description' => __( 'Enables autoplay mode.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Hide Pagination section', 'seoplan' ),
                        'param_name'  => 'hide_pagination',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'description' => __( 'If "YES" pagination control will be removed.', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'single', 'list' ) ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Hide prev/next buttons', 'seoplan' ),
                        'param_name'  => 'hide_navigation',
                        'value'       => array( esc_html__( 'Yes', 'seoplan' ) => 'false' ),
                        'description' => esc_html__( 'If "YES" prev/next control will be removed.', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'gallery' ) ),
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Button Action
            vc_map( array(
                'name'     => __( 'Button Action', 'seoplan' ),
                'base'     => 'section_button_action',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Text', 'seoplan' ),
                        'param_name'  => 'button_text',
                        'value'       => '',
                        'description' => __( 'Enter the button text', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'URL (Link)', 'seoplan' ),
                        'param_name'  => 'button_url',
                        'value'       => '',
                        'description' => __( 'Enter the destination URL', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Display wishlist button', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'display_wishlist_button',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Button
            vc_map( array(
                'name'     => __( 'Button', 'seoplan' ),
                'base'     => 'seoplan_button',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Text', 'seoplan' ),
                        'param_name'  => 'button_text',
                        'value'       => '',
                        'description' => __( 'Enter the button text', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'URL (Link)', 'seoplan' ),
                        'param_name'  => 'button_url',
                        'value'       => '',
                        'description' => __( 'Enter the destination URL', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Color', 'seoplan' ),
                        'param_name'  => 'background',
                        'value'       => '',
                        'std'         => '#fb8c00'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Text Color', 'seoplan' ),
                        'param_name'  => 'text_color',
                        'value'       => '',
                        'std'         => '#ffffff'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Color Hover', 'seoplan' ),
                        'param_name'  => 'background_hover',
                        'value'       => '',
                        'std'         => '#4155c5'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Text Color Hover', 'seoplan' ),
                        'param_name'  => 'text_color_hover',
                        'value'       => '',
                        'std'         => '#ffffff'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Align', 'seoplan' ),
                        'param_name'  => 'align',
                        'value'       => array(
                            __( 'Center', 'seoplan' )   => 'align-center',
                            __( 'Left', 'seoplan' )     => 'align-left',
                            __( 'Right', 'seoplan' )    => 'align-right',
                        ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Set Full Width Button?', 'seoplan' ),
                        'param_name'  => 'full_width',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'heading'    => esc_html__( 'CSS box', 'seoplan' ),
                        'type'       => 'css_editor',
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design Options', 'seoplan' ),
                    ),
                ),
            ) );

            // Add section case study shortcode
            vc_map( array(
                'name'     => __( 'Case Study Information', 'seoplan' ),
                'base'     => 'section_case_study_information',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Background color', 'seoplan' ),
                        'param_name'  => 'bg_color',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Display publish date', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'display_publish_date',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Display Category', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'display_category',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Display Client Information', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'display_client_information',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Share on Facebook', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'share_facebook',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Share on Twitter', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'share_twitter',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Share on Pinterest', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'share_pinterest',
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Share on Google +', 'seoplan' ),
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'std'         => 'true',
                        'param_name'  => 'share_google',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Add case studies carousel slider
            vc_map( array(
                'name'     => __( 'Case Studies Carousel', 'seoplan' ),
                'base'     => 'case_studies_carousel',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Case study category', 'seoplan' ),
                        'param_name'  => 'category',
                        'description' => __( 'Select a category or select All to get case studies from all categories.', 'seoplan' ),
                        'value'       => seoplan_get_list_case_study_categories(),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Total Case studies', 'seoplan' ),
                        'param_name'  => 'per_page',
                        'value'       => '12',
                        'description' => __( 'Set numbers of studies to show.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Columns', 'seoplan' ),
                        'param_name'  => 'columns',
                        'value'       => array(
                            __( '3 columns', 'seoplan' ) => '3',
                            __( '2 columns', 'seoplan' ) => '2',
                            __( '4 columns', 'seoplan' ) => '4',
                        ),
                        'description' => __( 'Select number of column layout', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Order By', 'seoplan' ),
                        'param_name'  => 'orderby',
                        'value'       => array(
                            __( 'Date', 'seoplan' )       => 'date',
                            __( 'Title', 'seoplan' )      => 'title',
                            __( 'Menu Order', 'seoplan' ) => 'menu_order',
                            __( 'Random', 'seoplan' )     => 'rand',
                        ),
                        'description' => __( 'Select to order case studies. Leave empty to use the default order by of theme.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Order', 'seoplan' ),
                        'param_name'  => 'order',
                        'value'       => array(
                            __( 'Descending ', 'seoplan' ) => 'desc',
                            __( 'Ascending ', 'seoplan' )  => 'asc',
                        ),
                        'description' => __( 'Select to sort case studies. Leave empty to use the default sort of theme', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Slider autoplay', 'seoplan' ),
                        'param_name'  => 'auto_play',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'description' => __( 'Enables autoplay mode.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Hide pagination', 'seoplan' ),
                        'param_name'  => 'hide_navigation',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'false' ),
                        'description' => __( 'If "YES" pagination control will be removed.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Add testimonial carousel slider
            vc_map( array(
                'name'     => __( 'Testimonials', 'seoplan' ),
                'base'     => 'testimonials_carousel',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'layout',
                        'value'       => array(
                            __( 'Two Columns', 'seoplan' ) => 'two_cols',
                            __( 'One Column', 'seoplan' )  => 'one_col',
                            __( 'One Column Transparent', 'seoplan' )  => 'one_col_trans',
                        ),
                        'description' => __( 'Select to sort testimonials. Leave empty to use the default sort of theme', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Testimonial category', 'seoplan' ),
                        'param_name'  => 'category',
                        'description' => __( 'Select a category or select All to get testimonials from all categories.', 'seoplan' ),
                        'value'       => seoplan_get_list_testimonial_categories(),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Total Testimonials', 'seoplan' ),
                        'param_name'  => 'per_page',
                        'value'       => '12',
                        'description' => __( 'Set number of testimonials to show.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Order By', 'seoplan' ),
                        'param_name'  => 'orderby',
                        'value'       => array(
                            __( 'Date', 'seoplan' )       => 'date',
                            __( 'Title', 'seoplan' )      => 'title',
                            __( 'Menu Order', 'seoplan' ) => 'menu_order',
                            __( 'Random', 'seoplan' )     => 'rand',
                        ),
                        'description' => __( 'Select to order testimonials. Leave empty to use the default order by of theme.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Order', 'seoplan' ),
                        'param_name'  => 'order',
                        'value'       => array(
                            __( 'Descending', 'seoplan' ) => 'desc',
                            __( 'Ascending', 'seoplan' )  => 'asc',
                        ),
                        'description' => __( 'Select to sort testimonials. Leave empty to use the default sort of theme', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Slider autoplay', 'seoplan' ),
                        'param_name'  => 'auto_play',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'description' => __( 'Enables autoplay mode.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Hide pagination', 'seoplan' ),
                        'param_name'  => 'hide_pagigation',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'false' ),
                        'description' => __( 'If "YES" pagination control will be removed.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Add posts carousel slider
            vc_map( array(
                'name'     => esc_html__( 'Posts Carousel', 'seoplan' ),
                'base'     => 'posts_carousel',
                'class'    => '',
                'category' => esc_html__( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'param_name'  => 'layout',
                        'heading'     => esc_html__( 'Layout', 'seoplan' ),
                        'value'       => array(
                            esc_html__( 'Creative', 'seoplan' )     => 'creative',
                        )
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Post categories', 'seoplan' ),
                        'param_name'  => 'category',
                        'description' => esc_html__( 'Select a category or select All to get products from all categories.', 'seoplan' ),
                        'value'       => seoplan_get_post_categories(),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Order By', 'seoplan' ),
                        'param_name'  => 'order_by',
                        'value'       => array(
                            esc_html__( 'Date', 'seoplan' )       => 'date',
                            esc_html__( 'Title', 'seoplan' )      => 'title',
                            esc_html__( 'Modified', 'seoplan' )   => 'modified',
                            esc_html__( 'Menu Order', 'seoplan' ) => 'menu_order',
                            esc_html__( 'Random', 'seoplan' )     => 'rand',
                        ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Order', 'seoplan' ),
                        'param_name'  => 'order',
                        'value'       => array(
                            esc_html__( 'Descending ', 'seoplan' ) => 'desc',
                            esc_html__( 'Ascending ', 'seoplan' )  => 'asc',
                        ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Total Posts', 'seoplan' ),
                        'param_name'  => 'per_page',
                        'value'       => '12',
                        'description' => esc_html__( 'Set numbers of products to show.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Columns', 'seoplan' ),
                        'param_name'  => 'columns',
                        'value'       => array(
                            esc_html__( '3 columns', 'seoplan' ) => '3',
                            esc_html__( '4 columns', 'seoplan' ) => '4',
                            esc_html__( '2 columns', 'seoplan' ) => '2',
                        ),
                        'description' => esc_html__( 'Select number of column layout', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Slider autoplay', 'seoplan' ),
                        'param_name'  => 'auto_play',
                        'value'       => array( esc_html__( 'Yes', 'seoplan' ) => 'true' ),
                        'description' => esc_html__( 'Enables autoplay mode.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Hide prev/next buttons', 'seoplan' ),
                        'param_name'  => 'hide_navigation',
                        'value'       => array( esc_html__( 'Yes', 'seoplan' ) => 'false' ),
                        'description' => esc_html__( 'If "YES" prev/next control will be removed.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Add section chart shortcode
            vc_map( array(
                'name'     => __( 'Chart', 'seoplan' ),
                'base'     => 'chart_pie',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'pie_datas',
                        'heading'     => esc_html__( 'Menu item', 'seoplan' ),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type'        => 'textfield',
                                'holder'      => 'div',
                                'heading'     => __( 'Label', 'seoplan' ),
                                'param_name'  => 'pie_label',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'textfield',
                                'holder'      => 'div',
                                'heading'     => __( 'Percent share', 'seoplan' ),
                                'param_name'  => 'pie_percent',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Background color', 'seoplan' ),
                                'param_name'  => 'bg_color',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Background color hover', 'seoplan' ),
                                'param_name'  => 'bg_color_hover',
                                'value'       => '',
                            ),
                        ),
                        'description' => __( 'Pie data settings', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Width', 'seoplan' ),
                        'param_name'  => 'chart_width',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Height', 'seoplan' ),
                        'param_name'  => 'chart_height',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Add section title shortcode
            vc_map( array(
                'name'     => __( 'Case Study Navigation', 'seoplan' ),
                'base'     => 'case_study_nav',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Previous Button Text', 'seoplan' ),
                        'param_name'  => 'pre_btn_text',
                        'value'       => __( 'Previous Project', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Nesxt Button Text', 'seoplan' ),
                        'param_name'  => 'next_btn_text',
                        'value'       => __( 'Next Project', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Add list case studies
            vc_map( array(
                'name'     => __( 'List Case Studies', 'seoplan' ),
                'base'     => 'list_case_studies',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Total case studies will display', 'seoplan' ),
                        'param_name'  => 'per_page',
                        'value'       => '9',
                        'description' => __( 'Set numbers of studies will show and are loaded when click on load button.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Columns', 'seoplan' ),
                        'param_name'  => 'columns',
                        'value'       => array(
                            __( '3 columns', 'seoplan' ) => '3',
                            __( '4 columns', 'seoplan' ) => '4',
                            __( '2 columns', 'seoplan' ) => '2',
                        ),
                        'description' => __( 'Select number of column layout', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Order By', 'seoplan' ),
                        'param_name'  => 'orderby',
                        'value'       => array(
                            __( 'Date', 'seoplan' )       => 'date',
                            __( 'Title', 'seoplan' )      => 'title',
                            __( 'Menu Order', 'seoplan' ) => 'menu_order',
                            __( 'Random', 'seoplan' )     => 'rand',
                        ),
                        'description' => __( 'Select to order case studies. Leave empty to use the default order by of theme.', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Order', 'seoplan' ),
                        'param_name'  => 'order',
                        'value'       => array(
                            __( 'Descending ', 'seoplan' ) => 'desc',
                            __( 'Ascending ', 'seoplan' )  => 'asc',
                        ),
                        'description' => __( 'Select to sort case studies. Leave empty to use the default sort of theme', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );
            // Icon Box
            vc_map( array(
                'name'     => __( 'Icon box', 'seoplan' ),
                'base'     => 'icon_box',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Type', 'seoplan' ),
                        'param_name'  => 'icon_type',
                        'value'       => array(
                            __( 'Image', 'seoplan' ) => 'image',
                            __( 'Flaticons', 'seoplan' ) => 'flat-icons',
                            __( 'Fontawesome', 'seoplan' ) => 'font-awesome',
                        ),
                        'description' => __( 'Select icon type', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'flat-icons',
                        'holder'      => 'div',
                        'heading'     => __( 'Flat Icons', 'seoplan' ),
                        'param_name'  => 'flat_icon',
                        'value'       => '',
                        'description' => __( 'Select an icon', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'flat-icons' ) ),
                    ),
                    array(
                        'type'        => 'font-icons',
                        'holder'      => 'div',
                        'heading'     => __( 'Fontawesome', 'seoplan' ),
                        'param_name'  => 'font_awesome',
                        'value'       => '',
                        'description' => __( 'Select an icon', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'font-awesome' ) ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Color', 'seoplan' ),
                        'param_name'  => 'background_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'icon_layout', 'value' => array( 'layout_1', 'layout_2', 'layout_4' ) ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Container Icon Color', 'seoplan' ),
                        'param_name'  => 'container_icon_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'icon_layout', 'value' => array( 'layout_4' ) ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Icon Color', 'seoplan' ),
                        'param_name'  => 'icon_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'flat-icons' ) ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Icon Color', 'seoplan' ),
                        'param_name'  => 'icon_awesome_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'font-awesome' ) ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Text Color', 'seoplan' ),
                        'param_name'  => 'icon_flat_layout3_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'icon_layout', 'value' => array( 'layout_3' ) ),
                    ),
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => __( 'Image Line', 'seoplan' ),
                        'param_name'  => 'icon_flat_layout3_image_line',
                        'value'       => '',
                        'description' => __( 'Select image from media library', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_layout', 'value' => array( 'layout_3' ) ),
                    ),
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => __( 'Image Icon', 'seoplan' ),
                        'param_name'  => 'image_icon',
                        'value'       => '',
                        'description' => __( 'Select image from media library', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'image' ) ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'layout',
                        'value'       => array(
                            __( 'Image Top Layout 1', 'seoplan' )       => 'layout_1',
                            __( 'Image Top Layout 2', 'seoplan' )       => 'layout_2',
                            __( 'Image Top Layout 3', 'seoplan' )       => 'img_layout_4',
                            __( 'Image Left Layout 1', 'seoplan' )       => 'layout_3',
                        ),
                        'description' => __( 'Select to the different layouts for box', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'image' ) ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Color', 'seoplan' ),
                        'param_name'  => 'img_bg_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'img_layout_4' ) ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'icon_layout',
                        'value'       => array(
                            __( 'Layout 1', 'seoplan' )       => 'layout_1',
                            __( 'Layout 2', 'seoplan' )       => 'layout_2',
                            __( 'Layout 3', 'seoplan' )       => 'layout_3',
                            __( 'Layout 4', 'seoplan' )       => 'layout_4',
                            __( 'Layout Inline', 'seoplan' )       => 'layout_inline',
                        ),
                        'description' => __( 'Select to the different layouts for box', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'flat-icons' ) ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'icon_awesome_layout',
                        'value'       => array(
                            __( 'Layout Inline', 'seoplan' )       => 'layout_inline',
                        ),
                        'description' => __( 'Select to the different layouts for box', 'seoplan' ),
                        'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'font-awesome' ) ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Box title', 'seoplan' ),
                        'param_name'  => 'box_title',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Title Color', 'seoplan' ),
                        'param_name'  => 'img_title_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'img_layout_4' ) ),
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'heading'     => __( 'Box Description', 'seoplan' ),
                        'param_name'  => 'content',
                        'value'       => '',
                        'description' => __( 'Enter a short description for section', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Description Color', 'seoplan' ),
                        'param_name'  => 'img_description_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'img_layout_4' ) ),
                    ),
                    array(
                        'type'        => 'checkbox',
                        'holder'      => 'div',
                        'heading'     => __( 'Add Animation', 'seoplan' ),
                        'param_name'  => 'add_animation',
                        'value'       => array( __( 'Yes', 'seoplan' ) => 'true' ),
                        'description' => __( 'Add an animation when icon displayed', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Animation Type', 'seoplan' ),
                        'param_name'  => 'animation_type',
                        'value'       => array(
                            __( 'From Bottom', 'seoplan' )       => 'animation-bottom',
                            __( 'From Top', 'seoplan' )       => 'animation-top',
                            __( 'From Left', 'seoplan' )       => 'animation-left',
                            __( 'From Right', 'seoplan' )       => 'animation-right',
                        ),
                        'description' => __( 'Select to the different layouts for box', 'seoplan' ),
                        'dependency'  => array( 'element' => 'add_animation', 'value' => array( 'true' ) ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );
            // Process Steps
            vc_map( array(
                'name'     => __( 'Process Steps', 'seoplan' ),
                'base'     => 'process_steps',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'steps',
                        'heading'     => esc_html__( 'Process steps', 'seoplan' ),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type'        => 'attach_image',
                                'holder'      => 'div',
                                'heading'     => __( 'Icon', 'seoplan' ),
                                'param_name'  => 'icon',
                                'value'       => '',
                                'description' => __( 'Process icon', 'seoplan' ),
                            ),
                            array(
                                'type'        => 'textfield',
                                'holder'      => 'div',
                                'heading'     => __( 'Title', 'seoplan' ),
                                'param_name'  => 'process_title',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'textarea',
                                'holder'      => 'div',
                                'heading'     => __( 'Description', 'seoplan' ),
                                'param_name'  => 'process_description',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Background Icon Placeholder Color', 'seoplan' ),
                                'param_name'  => 'icon_placeholder_color',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Heading Color', 'seoplan' ),
                                'param_name'  => 'heading_color',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Description Color', 'seoplan' ),
                                'param_name'  => 'description_color',
                                'value'       => '',
                            ),
                        ),
                        'description' => __( 'The Process, <strong>the element just can displays 4 steps</strong>', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Element Image', 'seoplan' ),
                        'param_name'  => 'bg_image',
                        'value'       => '',
                        'description' => __( 'Process icon', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Information Result
            vc_map( array(
                'name'     => __( 'Information Result', 'seoplan' ),
                'base'     => 'information_result',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'admin_enqueue_css' => SEO_PLAN_TF_CSS_URL . 'vc/param-icons.css',
                'params'   => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'steps',
                        'heading'     => esc_html__( 'Process steps', 'seoplan' ),
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type'        => 'flat-icons',
                                'holder'      => 'div',
                                'heading'     => __( 'Flaticons', 'seoplan' ),
                                'param_name'  => 'flat_icon',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'textfield',
                                'holder'      => 'div',
                                'heading'     => __( 'Result', 'seoplan' ),
                                'param_name'  => 'result',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'textfield',
                                'holder'      => 'div',
                                'heading'     => __( 'Result Information', 'seoplan' ),
                                'param_name'  => 'result_information',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Icon Color', 'seoplan' ),
                                'param_name'  => 'icon_color',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Result Color', 'seoplan' ),
                                'param_name'  => 'result_color',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'colorpicker',
                                'holder'      => 'div',
                                'heading'     => __( 'Result Information Color', 'seoplan' ),
                                'param_name'  => 'result_information_color',
                                'value'       => '',
                            ),
                        ),
                        'description' => __( 'The Result Information, <strong>the element just can displays 5 block elemnt</strong>', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Google map
            vc_map( array(
                'name'     => __( 'Google Map', 'seoplan' ),
                'base'     => 'gg_map',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'addrs',
                        // Note params is mapped inside param-group:
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Enter your address',
                                'param_name' => 'addr',
                                'description' => __( 'Address information should get from google map. Ex: Storey Avenue, San Francisco, CA', 'seoplan' ),
                            )
                        ),
                        'description' => __( 'Your Address', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Zoom', 'seoplan' ),
                        'param_name'  => 'zoom',
                        'value'       => array(
                            __( '12', 'seoplan' ) =>  '12',
                            __( '11', 'seoplan' ) =>  '11',
                            __( '10', 'seoplan' ) =>  '10',
                            __( '9', 'seoplan' ) =>  '9',
                        ),
                        'description' => __( 'Select google map style', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish have own style particular, Enter here class name and then apply your style with it', 'seoplan' ),
                    )
                ),
            ) );

            // Video Banner
            vc_map( array(
                'name'              => __( 'Video Banner', 'seoplan' ),
                'base'              => 'video_banner',
                'category'          => __( 'SeoPlan', 'seoplan' ),
                'params'            => array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'layout',
                        'value'       => array(
                            __( 'Video Banner Information', 'seoplan' )       => 'banner_information',
                            __( 'Video Banner Only', 'seoplan' )       => 'banner_only',
                        ),
                        'description' => __( 'Select to the different layouts for video banner', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Video link','seoplan' ),
                        'param_name'  => 'video_url',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Image', 'seoplan' ),
                        'param_name'  => 'bg_image',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => __( 'Background Color', 'seoplan' ),
                        'param_name'  => 'bg_color',
                        'value'       => '',
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'banner-information' ) ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Title', 'seoplan' ),
                        'param_name'  => 'title',
                        'value'       => '',
                        'description' => __( 'Input the title for section', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'banner_information' ) ),
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'heading'     => __( 'Description', 'seoplan' ),
                        'param_name'  => 'content',
                        'value'       => '',
                        'description' => __( 'Input the description for section', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'banner_information' ) ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Text', 'seoplan' ),
                        'param_name'  => 'button_text',
                        'value'       => '',
                        'description' => __( 'The button text', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'banner_information' ) ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Link', 'seoplan' ),
                        'param_name'  => 'button_link',
                        'value'       => '',
                        'description' => __( 'The button link action url', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'banner_information' ) ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Text alignment', 'seoplan' ),
                        'param_name'  => 'text_align',
                        'value'       => array(
                            __( 'Left', 'seoplan' )    =>  'align-left',
                            __( 'Center', 'seoplan' )  =>  'align-center',
                            __( 'Right', 'seoplan' )   =>  'align-right',
                        ),
                        'description' => __( 'Align Text for information section', 'seoplan' ),
                        'dependency'  => array( 'element' => 'layout', 'value' => array( 'banner_information' ) ),
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Pricing Table
            vc_map( array(
                'name'     => __( 'Pricing Table', 'seoplan' ),
                'base'     => 'pricing_table',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   => array(
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Icon', 'seoplan' ),
                        'param_name'  => 'icon',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Background Icon Color', 'seoplan' ),
                        'param_name'  => 'bg_icon_color',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Currency', 'seoplan' ),
                        'param_name'  => 'currency',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Price', 'seoplan' ),
                        'param_name'  => 'price',
                        'value'       => '',
                    ),
                    array(
                        'heading'     => esc_html__( 'Recurrence', 'seoplan' ),
                        'description' => esc_html__( 'Recurring payment unit', 'seoplan' ),
                        'param_name'  => 'recurrence',
                        'type'        => 'textfield',
                        'value'       => '',
                    ),
                    array(
                        'heading'     => esc_html__( 'Plan Name', 'seoplan' ),
                        'param_name'  => 'plan_name',
                        'type'        => 'textfield',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'holder'      => 'div',
                        'heading'     => esc_html__( 'Table header Color', 'seoplan' ),
                        'param_name'  => 'table_header_color',
                        'value'       => '',
                    ),
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'rows',
                        'heading'     => esc_html__( 'Table Row', 'seoplan' ),
                        // Note params is mapped inside param-group:
                        'params' => array(
                             array(
                                'type'        => 'textfield',
                                'holder'      => 'div',
                                'heading'     => __( 'Information', 'seoplan' ),
                                'param_name'  => 'information',
                                'value'       => '',
                            ),
                            array(
                                'type'        => 'checkbox',
                                'holder'      => 'div',
                                'heading'     => esc_html__( 'Mark Line Through', 'seoplan' ),
                                'param_name'  => 'line_through',
                                'value'       => array( esc_html__( 'Yes', 'seoplan' ) => 'true' ),
                            ),
                        ),
                        'description' => __( 'Table row content', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Text', 'seoplan' ),
                        'param_name'  => 'button_text',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Link', 'seoplan' ),
                        'param_name'  => 'button_link',
                        'value'       => '',
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                ),
            ) );

            // Timeline
            vc_map( array(
                    'name'     => __( 'Timeline Story', 'seoplan' ),
                    'base'     => 'timeline_story',
                    'class'    => '',
                    'category' => __( 'SeoPlan', 'seoplan' ),
                    'params'   =>   array(
                        array(
                            'type' => 'param_group',
                            'value' => '',
                            'param_name' => 'timeline',
                            'heading'     => esc_html__( 'Timeline', 'seoplan' ),
                            // Note params is mapped inside param-group:
                            'params' => array(
                                array(
                                    'type'        => 'textfield',
                                    'holder'      => 'div',
                                    'heading'     => __( 'Year', 'seoplan' ),
                                    'param_name'  => 'year',
                                    'value'       => '',
                                    'description' => __( 'Table row content', 'seoplan' ),
                                ),
                            ),
                            'description' => __( 'Special years on your timeline', 'seoplan' ),
                        ),
                        array(
                            'type' => 'param_group',
                            'value' => '',
                            'param_name' => 'stories',
                            'heading'     => esc_html__( 'Your Stories', 'seoplan' ),
                            // Note params is mapped inside param-group:
                            'params' => array(
                                array(
                                    'type'        => 'dropdown',
                                    'holder'      => 'div',
                                    'heading'     => __( 'Layout', 'seoplan' ),
                                    'param_name'  => 'layout',
                                    'value'       => array(
                                        __( 'Layout 1', 'seoplan' ) =>  'layout_1',
                                    ),
                                    'description' => __( 'Select Layout for content', 'seoplan' ),
                                ),
                                array(
                                    'type'        => 'attach_image',
                                    'holder'      => 'div',
                                    'heading'     => __( 'Image Upload', 'seoplan' ),
                                    'param_name'  => 'image_upload',
                                    'value'       => '',
                                    'description' => __( 'Select image from media library', 'seoplan' ),
                                ),
                                array(
                                    'type'        => 'textarea',
                                    'holder'      => 'div',
                                    'heading'     => __( 'Content', 'seoplan' ),
                                    'param_name'  => 'story_content',
                                    'value'       => '',
                                    'description' => __( 'Story content', 'seoplan' ),
                                    'rows'        => 10,
                                ),
                                array(
                                    'type' => 'param_group',
                                    'value' => '',
                                    'param_name' => 'line_info',
                                    'heading'     => esc_html__( 'Line information', 'seoplan' ),
                                    'params'    =>  array(
                                        array(
                                            'type'        => 'flat-icons',
                                            'holder'      => 'div',
                                            'heading'     => __( 'Flat Icons', 'seoplan' ),
                                            'param_name'  => 'flat_icon',
                                            'value'       => '',
                                            'description' => __( 'Select an icon', 'seoplan' ),
                                        ),
                                        array(
                                            'type'        => 'textfield',
                                            'holder'      => 'div',
                                            'heading'     => __( 'Information', 'seoplan' ),
                                            'param_name'  => 'information',
                                            'value'       => '',
                                            'description' => __( 'Line information', 'seoplan' ),
                                        ),
                                    ),
                                ),
                                array(
                                    'type'        => 'checkbox',
                                    'holder'      => 'div',
                                    'heading'     => esc_html__( 'Hide Button Action', 'seoplan' ),
                                    'param_name'  => 'hide_button_action',
                                    'value'       => array( esc_html__( 'Yes', 'seoplan' ) => 'true' ),
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'holder'      => 'div',
                                    'heading'     => __( 'Button Text', 'seoplan' ),
                                    'param_name'  => 'button_text',
                                    'value'       => '',
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'holder'      => 'div',
                                    'heading'     => __( 'Button Link', 'seoplan' ),
                                    'param_name'  => 'button_link',
                                    'value'       => '',
                                ),
                            ),
                            'description' => __( 'Group Timeline Stories', 'seoplan' ),
                        ),
                        vc_map_add_css_animation(),
                        array(
                            'type'        => 'textfield',
                            'holder'      => 'div',
                            'heading'     => __( 'Extra class name', 'seoplan' ),
                            'param_name'  => 'class_name',
                            'value'       => '',
                            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                        ),
                    )
                )  );

            // Team member
            vc_map( array(
                'name'     => __( 'Team Member', 'seoplan' ),
                'base'     => 'team_member',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   =>   array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'layout',
                        'value'       => array(
                            __( 'Layout 1', 'seoplan' )       => 'layout_1',
                        ),
                        'description' => __( 'Select to the different layouts for member box', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => __( 'Thumbnail', 'seoplan' ),
                        'param_name'  => 'image_thumbnail',
                        'value'       => '',
                        'description' => __( 'Select image from media library', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Name', 'seoplan' ),
                        'param_name'  => 'name',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'heading'     => __( 'Description', 'seoplan' ),
                        'param_name'  => 'content',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'font-icons',
                        'holder'      => 'div',
                        'heading'     => __( 'Icon For Position', 'seoplan' ),
                        'param_name'  => 'position_icon',
                        'value'       => '',
                        'description' => __( 'Select an icon for position', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Position', 'seoplan' ),
                        'param_name'  => 'position',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Facebook', 'seoplan' ),
                        'param_name'  => 'facebook',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Twitter', 'seoplan' ),
                        'param_name'  => 'twitter',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Youtube', 'seoplan' ),
                        'param_name'  => 'youtube',
                        'value'       => '',
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                )
            )  );

            // section overview
            vc_map( array(
                'name'     => __( 'Overview Information', 'seoplan' ),
                'base'     => 'overview_information',
                'class'    => '',
                'category' => __( 'SeoPlan', 'seoplan' ),
                'params'   =>   array(
                    array(
                        'type'        => 'dropdown',
                        'holder'      => 'div',
                        'heading'     => __( 'Layout', 'seoplan' ),
                        'param_name'  => 'layout',
                        'value'       => array(
                            __( 'Full width section', 'seoplan' )       => 'full_width',
                        ),
                        'description' => __( 'Select to the different layouts for member box', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'heading'     => __( 'Image', 'seoplan' ),
                        'param_name'  => 'image',
                        'value'       => '',
                        'description' => __( 'Select image from media library', 'seoplan' ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Title', 'seoplan' ),
                        'param_name'  => 'title',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'heading'     => __( 'Description', 'seoplan' ),
                        'param_name'  => 'content',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Text', 'seoplan' ),
                        'param_name'  => 'button_text',
                        'value'       => '',
                    ),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Button Link', 'seoplan' ),
                        'param_name'  => 'button_link',
                        'value'       => '',
                    ),
                    vc_map_add_css_animation(),
                    array(
                        'type'        => 'textfield',
                        'holder'      => 'div',
                        'heading'     => __( 'Extra class name', 'seoplan' ),
                        'param_name'  => 'class_name',
                        'value'       => '',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'seoplan' ),
                    ),
                )
            )  );
        }

        /**
         * Return setting UI for icon param type
         *
         * @param  array $settings
         * @param  string $value
         *
         * @return string
         */
        function register_param_icon( $settings, $value )
        {
            // Generate dependencies if there are any
            $icons = array();
            foreach( $this->icons as $icon )
            {
                $icons[] = sprintf(
                    '<i data-icon="%1$s" class="%1$s %2$s"></i>',
                    $icon,
                    $icon == $value ? 'selected' : ''
                );
            }

            return sprintf(
                '<div class="icon_block">
				<input type="text" class="icon-search" placeholder="%s">
				<span class="icon-preview"><i class="%s"></i><a href="#" title="%s" class="clear-icon-selected"><i class="fa fa-times"></i></a></span>
				<input type="hidden" name="%s" value="%s" class="wpb_vc_param_value wpb-textinput icon-data %s %s_field">
				<div class="icon-selector">%s</div>
			</div>',
                esc_attr__( 'Quick Search', 'seoplan' ),
                esc_attr( $value ),
                __( 'Clear Icon Selected', 'seoplan' ),
                esc_attr( $settings['param_name'] ),
                esc_attr( $value ),
                esc_attr( $settings['param_name'] ),
                esc_attr( $settings['type'] ),
                implode( '', $icons )
            );
        }

        /**
         * Return setting UI for icon param type
         *
         * @param  array $settings
         * @param  string $value
         *
         * @return string
         */
        function register_param_flat_icon( $settings, $value )
        {
            // Generate dependencies if there are any
            $icons = array();
            foreach( $this->flat_icons as $icon )
            {
                $icons[] = sprintf(
                    '<i data-icon="%1$s" class="%1$s %2$s"></i>',
                    $icon,
                    $icon == $value ? 'selected' : ''
                );
            }

            return sprintf(
                '<div class="icon_block">
				<input type="text" class="icon-search" placeholder="%s">
				<span class="icon-preview"><i class="%s"></i><a href="#" title="%s" class="clear-icon-selected"><i class="fa fa-times"></i></a></span>
				<input type="hidden" name="%s" value="%s" class="wpb_vc_param_value wpb-textinput icon-data %s %s_field">
				<div class="icon-selector">%s</div>
			</div>',
                esc_attr__( 'Quick Search', 'seoplan' ),
                esc_attr( $value ),
                __( 'Clear Icon Selected', 'seoplan' ),
                esc_attr( $settings['param_name'] ),
                esc_attr( $value ),
                esc_attr( $settings['param_name'] ),
                esc_attr( $settings['type'] ),
                implode( '', $icons )
            );
        }
    }

}