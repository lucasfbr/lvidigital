<?php
/**
 * Class contains shortcodes use in themes and vc
 *
 * @package seoplan
 */

if( ! class_exists( 'SeoPlan_Shortcodes' ) )
{
    class SeoPlan_Shortcodes
    {
        /**
         * Store variables for js
         *
         * @var array
         */
        public $l10n = array();

        /**
         * Check if WooCommerce plugin is actived or not
         *
         * @var bool
         */

        /**
         * SeoPlan_Shortcodes constructor.
         */
        function __construct()
        {

            $shortcodes = array(
                'section_information',
                'images_carousel',
                'section_button_action',
                'section_case_study_information',
                'chart_pie',
                'case_study_nav',
                'list_case_studies',
                'icon_box',
                'process_steps',
                'seoplan_button',
                'information_result',
                'gg_map',
                'video_banner',
                'case_studies_carousel',
                'testimonials_carousel',
                'posts_carousel',
                'pricing_table',
                'timeline_story',
                'team_member',
                'overview_information',
                'seoplan_faq'
            );

            // register shortcode
            foreach ($shortcodes as $shortcode) {
                add_shortcode($shortcode, array($this, $shortcode));
            }
            add_action('wp_footer', array($this, 'footer'));
        }

        /**
         * FAQ element
         * @param $atts
         * @param $content
         */
        function seoplan_faq( $atts, $content )
        {
            $atts = shortcode_atts( array(
                'title' =>  '',
                'title_color'   =>  '',
                'content_color' =>  '',
                'bg_color'      =>  '',
                'css_animation' =>  '',
                'class_name'    =>  '',
                'css'           =>  ''
            ), $atts );

            $css_classed = array(
                'seoplan-faq',
                self::get_css_animation( $atts['css_animation'] ),
                vc_shortcode_custom_css_class( $atts['css'], ' ' ),
                $atts['class_name']
            );

            ob_start();
            ?>
            <div class="<?php echo implode( ' ', $css_classed ); ?>">
                <h4>
                    <?php echo esc_html_e( $atts['title'] ); ?>
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>

                </h4>
                <div class="toogle-content">
                <?php
                echo wp_kses_post( $content );
                ?>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        function overview_information( $atts, $content )
        {
            $atts = shortcode_atts( array(
                'layout'    =>  'full_width',
                'image'     =>  '',
                'title'     =>  '',
                'button_text'   =>  '',
                'button_link'   =>  '',
                'css_animation' =>  '',
                'class_name'    =>  '',
            ), $atts );

            $css_classed = array(
                'seoplan-overview-information',
                self::get_css_animation( $atts['css_animation'] ),
                $atts['class_name']
            );

            ob_start();
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_classed ) ); ?>">
                <div class="overview-image">
                <?php
                if ( $atts['image'] )
                {
                       $img_src = wp_get_attachment_image_src( $atts['image'], 'full' );
                        if ( $img_src )
                        {
                        ?>
                        <img src="<?php echo esc_url( $img_src[0] ); ?>" alt="<?php echo esc_attr( $atts['image'] ); ?>">
                        <?php
                        }
                }
                ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-4 col-md-offset-7 col-lg-offset-8 overview-content col-xs-12">
                            <div class="title-wrap">
                                <h2><?php echo esc_html__( $atts['title'], 'seoplan' ); ?></h2>
                                <span class="line"></span>
                            </div>
                            <div class="overview-text">
                            <?php
                            $content_p = wpautop( $content );
                            echo wp_kses_post( $content_p );
                            ?>
                            </div>
                            <div class="button-wrap">
                                <a href="<?php echo $atts['button_link'] ? esc_url( $atts['button_link'] ) : '#' ?>" class="btn"><?php echo esc_html__( $atts['button_text'], 'seoplan' ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display member information
         * @param $atts array shortcode attribute
         * @param $content  string short description about memeber
         */
        function team_member( $atts, $content )
        {
            $atts = shortcode_atts( array(
                'layout'            =>  'layout_1',
                'image_thumbnail'   =>  '',
                'name'              =>  '',
                'position_icon'     =>  '',
                'position'          =>  '',
                'facebook'          =>  '',
                'twitter'           =>  '',
                'youtube'           =>  '',
                'css_animation' => '',
                'class_name'    =>  ''
            ), $atts );
            $css_classes = array(
                'seoplan-member',
                self::get_css_animation( $atts['css_animation'] ),
                $atts['class_name'],
                $atts['layout'],
            );
            ob_start();
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_classes ) )?>">
                <div class="image">
                <?php
                if ( $atts['image_thumbnail'] )
                {
                    $thumbnail = wp_get_attachment_image_src( $atts['image_thumbnail'], 'full' );
                    if ( $thumbnail )
                    {
                    ?>
                    <img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( $atts['image_thumbnail'] ); ?>">
                    <ul>
                    <?php
                    if ( $atts['facebook'] )
                    {
                    ?>
                        <li>
                            <a target="_blank" href="<?php echo esc_url( $atts['facebook'] ); ?>" class="member-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    }
                    if ( $atts['twitter'] )
                    {
                    ?>
                        <li>
                            <a target="_blank" href="<?php echo esc_url( $atts['twitter'] ); ?>" class="member-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                    <?php
                    }
                    if ( $atts['youtube'] )
                    {
                        ?>
                        <li>
                            <a target="_blank" href="<?php echo esc_url( $atts['youtube'] ); ?>" class="member-twitter"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                    <?php
                    }
                }
                ?>
                </div><!-- end .image -->
                <div class="content">
                <?php
                if ( $atts['name'] )
                {
                ?>
                    <h3 class="name"><?php echo esc_html( $atts['name'] ); ?></h3>
                <?php
                }
                if ( $content )
                {
                echo wpautop( $content );
                }
                ?>
                    <span class="job">
                    <?php
                    if ( $atts['position_icon'] )
                    {
                    ?>
                        <i class="<?php echo esc_attr( $atts['position_icon'] ); ?>" aria-hidden="true"></i>
                    <?php
                    }
                    if ( $atts['position'] )
                    {
                        echo esc_html( $atts['position'] );
                    }
                    ?>
                    </span>
                </div><!-- end .content -->
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
        /**
         * Function display timeline stories
         * @param $atts array shortcode attributes
         */
        function timeline_story( $atts )
        {
            $atts = shortcode_atts( array(
                'timeline'  =>  '',
                'stories'   =>  '',
                'css_animation' => '',
                'class_name'    =>  ''
            ), $atts );

            $css_class = array(
                'seoplan-timeline-stories',
                self::get_css_animation( $atts['css_animation'] ),
                $atts['class_name']
            );

            ob_start();
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <div class="timeline">
                    <div class="events-wrapper">
                        <div class="events">
                            <ol>
                                <?php
                                if ( isset( $atts['timeline'] ) )
                                {
                                    $years = vc_param_group_parse_atts( $atts['timeline'] );
                                    $events = array();
                                    $count = 0;
                                    foreach ( $years as $year )
                                    {
                                        $year_class = '';
                                        if ( 0 === $count )
                                        {
                                            $year_class = 'selected';
                                        }
                                        $date_event = sprintf( '01/01/%s', $year['year'] )
                                        ?>
                                        <li>
                                            <a href="#" class="<?php echo esc_attr( $year_class ); ?>" data-date="<?php echo esc_attr( $date_event ); ?>"><?php echo esc_attr( $year['year'] ); ?></a>
                                        </li>
                                        <?php
                                        $events[] = $date_event;
                                        $count++;
                                    }
                                }
                                ?>
                            </ol>
                            <span class="filling-line" aria-hidden="true"></span>
                        </div>
                    </div>
                    <ul class="cd-timeline-navigation">
                        <li>
                            <a href="#" class="prev inactive seoicon-play"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="next seoicon-play"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="events-content">
                    <ol>
                    <?php
                    $stories = vc_param_group_parse_atts( $atts['stories'] );
                    for ( $i = 0; $i < count( $events ); $i++ )
                    {
                        $story_class = '';
                        if ( 0 === $i )
                        {
                            $story_class = 'selected';
                        }
                     ?>
                        <li class="<?php echo esc_attr( $story_class ); ?> <?php echo esc_attr( $stories[$i]['layout'] ); ?>" data-layout="<?php echo esc_attr( $stories[$i]['layout'] ); ?>" data-date="<?php echo $events[$i]; ?>">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-lg-5 story-text">
                                    <div class="time-line-content">
                                        <div class="time-line-text">
                                            <?php
                                            if ( isset( $stories[$i]['story_content'] ) )
                                            {
                                                echo wpautop( $stories[$i]['story_content'] );
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if ( isset( $stories[$i]['line_info'] ) )
                                        {
                                            $line_infos = vc_param_group_parse_atts( $stories[$i]['line_info'] );
                                            ?>
                                            <ul>
                                                <?php
                                                foreach ( $line_infos as $line_info )
                                                {
                                                    $flat_icon = isset( $line_info['flat_icon'] ) ? $line_info['flat_icon'] : '';
                                                    $information = isset( $line_info['information'] ) ? $line_info['information'] : '';
                                                    ?>
                                                    <li>
                                                        <i class="<?php echo esc_attr( $flat_icon ); ?>"></i> <span><?php echo esc_attr( $information ); ?></span>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }


                                        if ( ! isset( $stories[$i]['hide_button_action'] ) )
                                        {
                                            $button_link = isset( $stories[$i]['button_link'] ) ? $stories[$i]['button_link'] : '#';
                                            $button_text = isset( $stories[$i]['button_text'] ) ? $stories[$i]['button_text'] : '';
                                            ?>
                                            <a href="<?php echo esc_url( $button_link ); ?>" class="btn"><?php echo esc_html( $button_text ); ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-lg-6 col-lg-offset-1 story-image">
                                <?php
                                if ( isset( $stories[$i]['image_upload'] ) )
                                {
                                    $image = wp_get_attachment_image_src( $stories[$i]['image_upload'], 'full' );
                                ?>
                                    <div class="time-line-thumb">
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr( $stories[$i]['image_upload'] ); ?>">
                                    </div> <!-- end .time-line-thumb -->
                                <?php
                                }
                                ?>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                    </ol>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display pricing table
         * @param $atts     array shortcode attributes
         */
        function pricing_table( $atts )
        {
            $atts = shortcode_atts( array(
                'layout'        =>  'basic',
                'icon'          =>  '',
                'bg_icon_color' =>  '',
                'currency'      =>  '',
                'price'         =>  '',
                'recurrence'    =>  '',
                'plan_name'     =>  '',
                'table_header_color'    =>  '',
                'rows'          =>  '',
                'button_text'   =>  '',
                'button_link'   =>  '',
                'css_animation' => '',
                'class_name'    =>  ''
            ), $atts );

            $css_class = array(
                'seoplan-pricing-table',
                self::get_css_animation( $atts['css_animation'] ),
                $atts['class_name'],
                'layout-' . $atts['layout'],
            );

            ob_start();
            ?>
            <div class=" <?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <?php
                $pricing_top_style = '';
                if ( $atts['table_header_color'] )
                {
                    $pricing_top_style = sprintf( 'style="background-color: %s"', esc_attr( $atts['table_header_color'] ) );
                }
                ?>
                <div class="pricing-top" <?php echo $pricing_top_style; ?>>
                <?php
                if ( $atts['icon'] )
                {
                    $icon = wp_get_attachment_image_src( $atts['icon'], 'full' );
                    if ( $icon )
                    {
                        $pricing_icon_style = '';
                        if ( $atts['bg_icon_color'] )
                        {
                            $pricing_icon_style = sprintf( 'style="background-color: %s"', esc_attr( $atts['bg_icon_color'] ) );
                        }
                    ?>
                    <div class="pricing-icon" <?php echo $pricing_icon_style; ?> >
                        <img src="<?php echo esc_url( $icon[0] ); ?>" alt="<?php echo esc_attr( $atts['icon'] ); ?>">
                    </div>
                    <?php
                    }
                }
                ?>
                    <div class="pricing-price">
                        <span class="currency"><?php echo esc_html__( $atts['currency'], 'seoplan' ); ?></span>
                        <?php esc_html_e( $atts['price'], 'seoplan' ); ?>
                    </div>
                    <div class="recurrence">
                        <?php esc_html_e( $atts['recurrence'], 'seoplan' ); ?>
                    </div>
                    <div class="plan-name">
                        <?php esc_html_e( $atts['plan_name'], 'seoplan' ); ?>
                    </div>
                </div> <!-- end .pricing-top -->
                <div class="pricing-info">
                    <ul>
                    <?php
                    if ( $atts['rows'] && isset( $atts['rows'] ) && ! empty( $atts['rows'] ) )
                    {
                        $rows = vc_param_group_parse_atts( $atts['rows'] );
                        foreach ( $rows as $row )
                        {
                            $disable = '';
                            if (  isset( $row['line_through'] ) && $row['line_through'] )
                            {
                                $disable = 'disable';
                            }
                        ?>
                        <li class="<?php echo esc_attr( $disable ); ?>" ><?php echo esc_html_e( $row['information'], 'seoplan' ); ?></li>
                        <?php
                        }
                    }
                    ?>
                    </ul>
                </div><!-- end .pricing-info -->
                <div class="pricing-button">
                    <a href="<?php echo esc_url( $atts['button_link'] ); ?>" class="btn"><?php echo esc_html__( $atts['button_text'], 'seoplan' ); ?></a>
                </div><!-- end .pricing-button -->
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * @param $atts  array shortcode attribute
         */
        function posts_carousel( $atts )
        {
            $atts = shortcode_atts( array(
                'layout'    =>  'creative',
                'category'  =>  '',
                'order_by'  =>  'date',
                'order'     =>  'desc',
                'per_page'  =>  '',
                'columns'   =>  '3',
                'auto_play' =>  '',
                'hide_navigation'   =>  '',
                'class_name'    =>  '',
            ), $atts );

            $posts = seoplan_get_posts( $atts );

            $id = uniqid('posts-carousel-');
            $this->l10n['postsCarousel'][$id] = array(
                'number' => $atts['columns'],
                'autoplay' => $atts['auto_play'],
                'navigation' => !$atts['hide_navigation'],
            );

            $output = sprintf('<div id="%s" class="seoplan-posts-carousel pagination-dotted %s %s"><div class="blog-list">%s</div></div>',
                esc_attr($id),
                esc_attr($atts['class_name']),
                esc_attr($atts['layout']),
                $posts
            );

            return $output;

        }

        /**
         * Function display testimonial carousel
         * @param $atts     array  shortcode attribute
         */
        function testimonials_carousel( $atts )
        {
            $atts = shortcode_atts( array(
                'layout'    =>  'two_cols',
                'category'  =>  '',
                'per_page'  =>  '',
                'orderby'   =>  'date',
                'order'     =>  'desc',
                'auto_play' =>  '',
                'hide_pagigation'   =>  '',
                'class_name'    =>  ''
            ), $atts );

            $testimonials = seoplan_get_testimonials( $atts );

            $id = uniqid( 'seoplan-testimonial-carousel-' );

            $this->l10n['TCourousel'][$id] = array(
                'autoplay'   => $atts['auto_play'],
                'navigation' => ! $atts['hide_pagigation'],
                'layout'    =>  $atts['layout'],
            );

            return sprintf( '<div id="%s" class="seoplan-testimonial-carousel pagination-dotted %s %s"><div class="testimonials">%s</div></div>', esc_attr( $id ), esc_attr( $atts['layout'] ), esc_attr( $atts['class_name'] ), $testimonials );
        }
        /**
         * Function displays case studies
         * @param $atts    array shortcode attributes
         * @return string
         */
        function case_studies_carousel( $atts )
        {
            $atts = shortcode_atts( array(
                'layout'    =>  'creative',
                'category'  =>  '',
                'per_page'  =>  '',
                'columns'   =>  '3',
                'orderby'   =>  'date',
                'order'     =>  'desc',
                'auto_play' =>  '',
                'hide_navigation'   =>  '',
                'class_name'    =>  '',
            ), $atts );
            $case_studies = seoplan_get_list_case_studies( $atts );
            $atts['class_name'] .= ' ' . $atts['layout'];
            $id = uniqid( 'seoplan-case-study-carousel-' );

            $this->l10n['CSCourousel'][$id] = array(
                'number'     => $atts['columns'],
                'autoplay'   => $atts['auto_play'],
                'navigation' => ! $atts['hide_navigation'],
            );
            return sprintf( '<div id="%s" class="seoplan-case-studies-carousel seoplan-list-case-studies %s coloumns_%s"><div class="case-study-items pagination-dotted">%s</div></div>', $id, esc_attr( $atts['class_name'] ), esc_attr( $atts['columns'] ), $case_studies );
        }

        /**
         * Function display video banner element
         * @param $atts
         */
        function video_banner( $atts, $content )
        {
            $atts = shortcode_atts( array(
                'layout'    =>  'banner_information',
                'video_url' =>  '',
                'bg_image'    =>  '',
                'bg_color'    =>  '',
                'title'     =>  '',
                'button_text'   =>  '',
                'button_link'   =>  '',
                'text_align'    =>  'align-left',
                'css_animation' =>  '',
                'class_name'    =>  '',
            ), $atts );
            ob_start();
            $css_animation = self::get_css_animation( $atts['css_animation'] );
            $id = uniqid( 'seoplan-video-' );

            $this->l10n['VideoBanner'] = $id;

            if ( 'banner_information' == $atts['layout'] )
            {
            ?>
                <div class="seoplan-video-banner <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['layout'] ); ?> <?php echo esc_attr( $css_animation ); ?>">
                    <?php
                    $video_container_atts = array();
                    $video_container_style = '';
                    if ( $atts['bg_image'] )
                    {
                        $image = wp_get_attachment_image_src( intval( $atts['bg_image'] ), 'full' );
                        $video_container_atts[] = sprintf( 'background-image: url( %s )', esc_url( $image[0] ) );
                    }
                    if ( $atts['bg_color'] )
                    {
                        $video_container_atts[] = sprintf( 'background-color: %s', esc_attr( $atts['bg_color'] ) );
                    }
                    if ( count( $video_container_atts ) > 0 )
                    {
                        $video_container_style = sprintf( 'style="%s"', implode( '; ', $video_container_atts ) );
                    }
                    ?>
                    <div class="video-container col-xs-12 col-md-6 outer-fix" <?php echo $video_container_style; ?>>
                        <div class="play-icon">
                            <a id="<?php echo esc_attr( $id ); ?>" href="<?php echo esc_url( $atts['video_url'] ); ?>"><i class="flaticon-interface"></i></a>
                        </div>
                    </div>
                    <div class="video-info col-xs-12 col-md-6 <?php echo esc_attr( $atts['text_align'] ); ?>">
                        <div class="info-inner">
                            <div class="title-wrap no-des <?php echo esc_attr( $atts['text_align'] ); ?>">
                                <h3 class="head-title size-36"><?php echo esc_html__( $atts['title'], 'seoplan' ); ?></h3>
                                <span class="line"></span>
                            </div>
                            <div class="video-banner-description">
                                <?php
                                $content_p = wpautop( $content );
                                echo wp_kses_post( $content_p );
                                ?>
                            </div>
                            <a class="btn" href="<?php echo esc_url( $atts['button_link'] ); ?>" title="view more"><?php echo esc_html__( $atts['button_text'], 'seoplan' ); ?></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            elseif ( 'banner_only' == $atts['layout'] )
            {
                if ( $atts['bg_image'] )
                {
                    $image = wp_get_attachment_image_src( intval( $atts['bg_image'] ), 'seoplan-image-gallery-1' );
                }
            ?>
                <div class="seoplan-video-banner <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['layout'] ); ?> <?php echo esc_attr( $css_animation ); ?>">
                    <div class="video-container outer-fix">
                        <?php
                        if ( isset( $image ) )
                        {
                        ?>
                            <img src="<?php echo esc_url( $image[0] )?>" alt="<?php echo esc_attr( $atts['bg_image'] ); ?>">
                        <?php
                        }
                        ?>
                        <div id="play-intro">
                            <a id="<?php echo esc_attr( $id ); ?>" href="<?php echo esc_url( $atts['video_url'] ); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display google map
         * @param $atts
         * @return string
         */
        function gg_map( $atts )
        {
            $atts = shortcode_atts( array(
                'addrs' =>  '',
                'zoom'  =>  '12',
                'class_name'    =>  '',
            ), $atts );

            $id = uniqid( 'seoplan-map-' );
            $key = seoplan_get_option( 'genaral_map_api_key' );
            $marker = SEOPLAN_URL . '/img/contact1-icon.png';

            $addrs = vc_param_group_parse_atts( $atts['addrs'] );
            $locations = array();
            foreach ( $addrs as $addr )
            {
                if ( ! isset( $addr ) || empty( $addr ) )
                {
                    continue;
                }
                $addr_tmp = str_replace(" ", "+", $addr['addr']);

                $json = wp_remote_get("https://maps.google.com/maps/api/geocode/json?address=$addr_tmp&key=$key&sensor=false");

                $body = wp_remote_retrieve_body( $json );
                $json = json_decode($body);

                $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                $locations[] = array(
                    'lat'   =>  $lat,
                    'long'   =>  $long
                );
            }
            if ( empty( $locations ) )
            {
                return '';
            }

            ob_start();
            ?>
            <div class="seoplan-map-container">
                <div id="<?php echo esc_attr( $id ); ?>" class="seoplan-map <?php echo esc_attr( $atts['class_name'] ); ?>"></div>
            </div>
            <script>
                function initMap()
                {
                    var mapDiv = document.getElementById('<?php echo esc_attr( $id ); ?>');
                    var firstLocationLat = <?php echo esc_attr( $locations[0]['lat'] ); ?>;
                    var firstLocationLong = <?php echo esc_attr( $locations[0]['long'] ); ?>;

                    window.map = new google.maps.Map(mapDiv, {
                        center: {lat: firstLocationLat, lng:  firstLocationLong},
                        zoom: <?php echo esc_attr( $atts['zoom'] ); ?>,
                        scrollwheel: false,
                    });

                    var iconUrl = '<?php echo esc_url( $marker ); ?>';
                    var locations = <?php echo json_encode( $locations ); ?>;
                    for ( var i = 0; i < locations.length; i++ )
                    {
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng( locations[i]['lat'], locations[i]['long'] ),
                            icon: iconUrl,
                            map: window.map
                        });
                    }
                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $key ); ?>&callback=initMap">
            </script>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display information result block
         * @param $atts   array shortcode attributes
         */
        function information_result( $atts )
        {
            $atts = shortcode_atts( array(
                'steps' => '',
                'class_name'    =>  '',
            ), $atts );

            ob_start();
            ?>
            <div class="seoplan-information-results <?php echo esc_attr( $atts['class_name'] ); ?>">
            <?php
            if ( $atts['steps'] && isset( $atts['steps'] ) && ! empty( $atts['steps'] ) )
            {
                $steps = vc_param_group_parse_atts( $atts['steps'] );
                $total_steps = count( $steps ) == 0 ? 1 : count( $steps );
                $col = '';
                if ( $total_steps < 5 )
                {
                    $col = 'col-xs-' . 12 / $total_steps;
                }
                else {
                    $col = 'custom-col-5';
                }
                $current_step = 0;
                ?>
                <div class="row">
                <?php
                foreach ( $steps as $step )
                {
                    if ( $current_step > 4 )
                    {
                        break;
                    }
                ?>
                    <div class="result-item <?php echo esc_attr( $col ); ?>">
                        <?php
                        if ( isset( $step['flat_icon'] ) )
                        {
                            $icon_color = '';
                            if ( isset( $step['icon_color'] ) )
                            {
                                $icon_color = sprintf( 'style="color: %s"', esc_attr( $step['icon_color'] ) );;
                            }
                        ?>
                            <div class="icon">
                                <i <?php echo $icon_color; ?> class="<?php echo esc_attr( $step['flat_icon'] ); ?>"></i>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if ( isset( $step['result'] ) )
                        {
                            $result_color = '';
                            if ( isset( $step['result_color'] ) )
                            {
                                $result_color = sprintf( 'style="color: %s"', esc_attr( $step['result_color'] ) );;
                            }
                            $id = uniqid( 'seoplan-count-result-' );
                            $this->l10n['countResult'][$id] = array(
                                'value' =>  $step['result']
                            );
                        ?>
                            <h4 id="<?php echo esc_attr( $id ); ?>" <?php echo $result_color; ?> class="result"><?php echo esc_html( $step['result'] ); ?></h4>
                        <?php
                        }
                        ?>

                        <?php
                        if ( isset( $step['result_information'] ) )
                        {
                            $infor_color = '';
                            if ( isset( $step['result_information_color'] ) )
                            {
                                $infor_color = sprintf( 'style="color: %s"', esc_attr( $step['result_information_color'] ) );;
                            }
                        }
                        ?>
                        <div <?php echo $infor_color; ?> class="content">
                            <?php
                            echo esc_html( $step['result_information'] );
                            ?>
                        </div>
                    </div>
                <?php
                    $current_step++;
                }

                ?>
                </div>
                <?php
            }
            ?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function displays a button
         * @param $atts array attributes
         */
        function seoplan_button( $atts )
        {
            $atts = shortcode_atts( array(
                'button_text'   =>  '',
                'button_url'    =>  '',
                'background'    =>  '#fb8c00',
                'text_color'    =>  '#ffffff',
                'background_hover'  =>  '#4155c5',
                'text_color_hover'  =>  '#ffffff',
                'align'         =>  'align-center',
                'full_width'    =>  '',
                'class_name'    =>  '',
                'css_animation' =>  '',
                'css'           =>  '',
            ), $atts );

            $css_class = vc_shortcode_custom_css_class( $atts['css'], ' ' );
            $css_animation = self::get_css_animation( $atts['css_animation'] );
            ob_start();
            ?>
            <div class="seoplan-button-section <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['align'] ); ?> <?php echo esc_attr( $css_animation ); ?>">
                <?php
                $styles[] = sprintf( 'background-color: %s;', esc_attr( $atts['background'] ) );
                $styles[] = sprintf( 'color: %s;', esc_attr( $atts['text_color'] ) );
                if ( $atts['full_width'] )
                {
                    $styles[] = 'width: 100%;';
                }
                $custom_style = sprintf( 'style="%s"', implode( '', $styles ) );
                ?>
                <a onMouseOver="this.style.backgroundColor='<?php echo esc_attr( $atts['background_hover'] ); ?>'; this.style.color='<?php echo esc_attr( $atts['text_color_hover'] ); ?>'" onMouseOut="this.style.backgroundColor='<?php echo esc_attr( $atts['background'] ); ?>'; this.style.color='<?php echo esc_attr( $atts['text_color'] ); ?>'" class="seoplan-button <?php echo esc_attr( $css_class ); ?>" href="<?php echo esc_url( $atts['button_url'] ); ?>" <?php echo $custom_style; ?>><?php echo esc_html( $atts['button_text'] ); ?></a>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function displays process step
         * @param $atts    array attributes
         * @return string
         */
        function process_steps( $atts )
        {
            $atts = shortcode_atts( array(
                'steps' =>  '',
                'bg_image'  =>  '',
                'class_name'    =>  ''
            ), $atts );
            ob_start();
            ?>
            <div class="seoplan-process-steps <?php echo esc_attr( $atts['class_name'] ); ?>">
            <?php
            if ( $atts['bg_image'] )
            {
                $bg_img = wp_get_attachment_image_src( $atts['bg_image'], 'full' );
            ?>
                <div class="process-background-layer animation-bottom">
                    <img src="<?php echo esc_url( $bg_img[0] ); ?>" alt="<?php echo esc_attr( $atts['bg_image'] ); ?>">
                </div>
            <?php
            }
            ?>

            <?php
            if ( $atts['steps'] && isset( $atts['steps'] ) && ! empty( $atts['steps'] ) )
            {
                $steps = vc_param_group_parse_atts( $atts['steps'] );
                $total_steps = count( $steps ) == 0 ? 1 : count( $steps );
                if ( 4 < $total_steps )
                {
                    $total_steps = 4;
                }
                $col = 'col-xs-' . 12 / $total_steps;
                $current_step = 0;
                ?>
                <div class="container">
                    <div class="row">
                        <?php
                        foreach ( $steps as $step )
                        {
                            if ( $current_step >= 4 )
                            {
                                break;
                            }
                            ?>
                            <div class="<?php echo esc_attr( $col ); ?> process-item">
                                <?php
                                if ( isset( $step['icon'] ) )
                                {
                                    $icon_img = wp_get_attachment_image_src( $step['icon'], 'full' );

                                    $icon_style = '';
                                    if ( isset( $step['icon_placeholder_color'] ) )
                                    {
                                        $icon_style = sprintf( 'style="background-color: %s"', esc_attr( $step['icon_placeholder_color'] ) );
                                    }
                                    ?>
                                    <div class="icon" <?php echo $icon_style; ?>>
                                        <img src="<?php echo esc_url( $icon_img[0] ); ?>" alt="<?php echo esc_attr( $step['icon'] ); ?>">
                                    </div>
                                    <?php
                                }
                                if ( isset( $step['process_title'] ) )
                                {
                                    $title_style = '';
                                    if ( isset( $step['heading_color'] ) )
                                    {
                                        $title_style = sprintf( 'style="color: %s"', esc_attr( $step['heading_color'] ) );
                                    }
                                    ?>
                                    <h4 class="process-title" <?php echo $title_style; ?>> <?php echo esc_html( $step['process_title'] ); ?></h4>
                                    <?php
                                }
                                if ( isset( $step['process_description'] ) )
                                {
                                    $description_style = '';
                                    if ( isset( $step['description_color'] ) )
                                    {
                                        $description_style = sprintf( 'style="color: %s"', esc_attr( $step['description_color'] ) );
                                    }
                                    ?>
                                    <div class="content" <?php echo $description_style; ?>>
                                        <?php
                                        echo esc_html( $step['process_description'] );
                                        ?>
                                    </div>
                                    <?php
                                }
                                $current_step++;
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * @param $atts    array shortcode attributes
         * @param $content string box content
         */
        function icon_box( $atts, $content )
        {
            $atts = shortcode_atts( array(
                'icon_type'     =>  'image',
                'image_icon'    =>  '',
                'layout'        =>  'layout_1',
                'box_title'     =>  '',
                'add_animation' =>  '',
                'animation_type'    =>  'animation-bottom',
                'flat_icon'     =>  '',
                'font_awesome'  =>  '',
                'icon_awesome_color'    =>  '',
                'background_color'  =>  '',
                'img_bg_color'      =>  '',
                'img_title_color'   =>  '',
                'img_description_color' =>  '',
                'icon_color'    =>  '',
                'icon_layout'   =>  'layout_1',
                'icon_awesome_layout'   =>  'layout_inline',
                'icon_flat_layout3_color'   =>  '',
                'icon_flat_layout3_image_line'  =>  '',
                'container_icon_color'  =>  '',
                'class_name'    =>  ''
            ), $atts );
            ob_start();
            $add_animation = '';
            if ( $atts['add_animation'] )
            {
                $add_animation = $atts['animation_type'];
            }
            if ( 'image' == $atts['icon_type'] )
            {
                if ( 'layout_1' == $atts['layout'] || 'layout_2' == $atts['layout'] )
                {
                ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['layout'] ); ?>">
                        <div class="icon <?php echo esc_attr( $add_animation ); ?>">
                            <?php
                            if ( $atts['image_icon'] )
                            {
                                $icon = wp_get_attachment_image_src( $atts['image_icon'], 'full' );
                                ?>
                                <img src="<?php echo esc_url( $icon[0] ); ?>" alt="<?php echo esc_attr( $atts['image_icon'] ); ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <h3 class="post-title"><?php echo esc_html( $atts['box_title'] ); ?></h3>
                        <div class="content">
                            <?php echo wp_kses_post( $content ); ?>
                        </div>
                    </div>
                <?php
                }
                elseif ( 'layout_3' == $atts['layout'] )
                {
                ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['layout'] ); ?>">
                        <div class="icon <?php echo esc_attr( $add_animation ); ?>">
                            <?php
                            if ( $atts['image_icon'] )
                            {
                                $icon = wp_get_attachment_image_src( $atts['image_icon'], 'full' );
                                ?>
                                <img src="<?php echo esc_url( $icon[0] ); ?>" alt="<?php echo esc_attr( $atts['image_icon'] ); ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="content">
                            <h3 class="post-title"><?php echo esc_html( $atts['box_title'] ); ?></h3>
                            <?php
                            $content = wp_kses_post( $content );
                            echo wpautop( $content );
                            ?>
                        </div>
                    </div>
                <?php
                }
                elseif ( 'img_layout_4' == $atts['layout'] )
                {
                    $id = uniqid( 'seoplan-count-result-' );
                    $this->l10n['countResult'][$id] = array(
                        'value' =>  $atts['box_title']
                    );
                    ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['layout'] ); ?>">
                        <?php
                        $icon_bg_style = '';
                        if ( $atts['img_bg_color'] )
                        {
                            $icon_bg_style = sprintf( 'style="background-color: %s"', esc_attr( $atts['img_bg_color'] ) );
                        }
                        ?>
                        <div <?php echo $icon_bg_style; ?> class="icon <?php echo esc_attr( $add_animation ); ?>">
                            <?php
                            if ( $atts['image_icon'] )
                            {
                                $icon = wp_get_attachment_image_src( $atts['image_icon'], 'full' );
                                ?>
                                <img src="<?php echo esc_url( $icon[0] ); ?>" alt="<?php echo esc_attr( $atts['image_icon'] ); ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        $title_style = '';
                        if ( $atts['img_title_color'] )
                        {
                            $title_style = sprintf( 'style="color: %s"', esc_attr( $atts['img_title_color'] ) );
                        }
                        ?>

                        <h3 id="<?php echo esc_attr( $id ); ?>" <?php echo $title_style; ?> class="post-title"><?php echo esc_html( $atts['box_title'] ); ?></h3>
                        <?php
                        $content_style = '';
                        if ( $atts['img_description_color'] )
                        {
                            $content_style = sprintf( 'style="color: %s"', esc_attr( $atts['img_description_color'] ) );
                        }
                        ?>
                        <div <?php echo $content_style; ?> class="content">
                            <?php
                            $content_p = wpautop( $content );
                            echo wp_kses_post( $content_p );
                            ?>
                        </div>
                    </div>
                    <?php
                }
            ?>

            <?php
            }
            elseif ( 'flat-icons' == $atts['icon_type'] )
            {
                if ( 'layout_inline' == $atts['icon_layout'] )
                {
                    ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['icon_layout'] ); ?>">
                        <?php
                        if ( $atts['flat_icon'] )
                        {
                        ?>
                            <?php
                            $icon_color = '';
                            if ( $atts['icon_color'] )
                            {
                                $icon_color = sprintf('style="color:%s ;"', esc_attr( $atts['icon_color'] ) );
                            }
                            ?>
                            <i class="<?php echo esc_attr( $atts['flat_icon'] ); ?>" <?php echo $icon_color; ?>></i>
                            <?php
                        }
                        ?>
                        <span><?php echo esc_html__( $atts['box_title'] ,'seoplan' ); ?></span>
                    </div>
                    <?php
                    $output = ob_get_clean();
                    return $output;
                }
                elseif( 'layout_3' == $atts['icon_layout'] )
                {
                    $icon_bg_color = '';
                    if ( $atts['background_color'] )
                    {
                        $icon_bg_color = sprintf('style="background-color:%s ;"', esc_attr( $atts['background_color'] ) );
                    }
                    ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['icon_layout'] ); ?>" <?php echo $icon_bg_color;?> >
                        <?php
                        if ( $atts['flat_icon'] )
                        {
                            ?>
                            <div class="icon <?php echo esc_attr( $add_animation ); ?>">
                                <?php
                                $icon_color = '';
                                if ( $atts['icon_color'] )
                                {
                                    $icon_color = sprintf('style="color:%s ;"', esc_attr( $atts['icon_color'] ) );
                                }
                                ?>
                                <i class="<?php echo esc_attr( $atts['flat_icon'] ); ?>" <?php echo $icon_color; ?>></i>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="title">
                            <h3><?php echo esc_html( $atts['box_title'] ); ?></h3>
                        </div>
                        <div class="image-line">
                        <?php
                        if ( $atts['icon_flat_layout3_image_line'] )
                        {
                            $image_line = wp_get_attachment_image_src( $atts['icon_flat_layout3_image_line'], 'full' );
                            ?>
                            <img src="<?php echo esc_url( $image_line[0] ); ?>" alt="<?php echo esc_attr( $atts['icon_flat_layout3_image_line'] ); ?>">
                            <?php
                        }
                        ?>
                        </div>
                        <div class="content">
                            <?php echo wp_kses_post( $content ); ?>
                        </div>
                    </div>
                    <?php
                    $output = ob_get_clean();
                    return $output;
                }
                elseif( 'layout_4' == $atts['icon_layout'] )
                {
                    $bg_color = '';
                    if ( $atts['background_color'] )
                    {
                        $bg_color = sprintf('style="background-color:%s ;"', esc_attr( $atts['background_color'] ) );
                    }
                    $container_icon_color = '';
                    if ( $atts['container_icon_color'] )
                    {
                        $container_icon_color = sprintf('style="background-color:%s ;"', esc_attr( $atts['container_icon_color'] ) );
                    }
                    ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['icon_layout'] ); ?>" <?php echo $bg_color; ?>>
                        <?php
                        $icon_bg_color = '';
                        if ( $atts['background_color'] )
                        {
                            $icon_bg_color = sprintf('style="background-color:%s ;"', esc_attr( $atts['background_color'] ) );
                        }
                        ?>
                        <div class="icon <?php echo esc_attr( $add_animation ); ?>" <?php echo $icon_bg_color;?> >
                            <?php
                            $icon_color = '';
                            if ( $atts['icon_color'] )
                            {
                                $icon_color = sprintf('style="color:%s ;"', esc_attr( $atts['icon_color'] ) );
                            }
                            ?>
                            <span <?php echo $container_icon_color; ?>><i class="<?php echo esc_attr( $atts['flat_icon'] ); ?>" <?php echo $icon_color; ?>></i></span>
                        </div>
                        <?php
                        ?>
                        <div class="information">
                            <div class="title">
                                <?php echo esc_html( $atts['box_title'] ); ?>
                            </div>
                            <div class="content">
                                <?php echo wp_kses_post( $content ); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $output = ob_get_clean();
                    return $output;
                }
            ?>
                <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['icon_layout'] ); ?>">
                <?php
                if ( $atts['flat_icon'] )
                {
                    $icon_bg_color = '';
                    if ( $atts['background_color'] )
                    {
                        $icon_bg_color = sprintf('style="background-color:%s ;"', esc_attr( $atts['background_color'] ) );
                    }
                ?>
                    <div class="icon <?php echo esc_attr( $add_animation ); ?>" <?php echo $icon_bg_color;?> >
                        <?php
                        $icon_color = '';
                        if ( $atts['icon_color'] )
                        {
                            $icon_color = sprintf('style="color:%s ;"', esc_attr( $atts['icon_color'] ) );
                        }
                        ?>
                        <i class="<?php echo esc_attr( $atts['flat_icon'] ); ?>" <?php echo $icon_color; ?>></i>
                    </div>
                <?php
                }
                ?>
                    <div class="number">
                        <?php echo esc_html( $atts['box_title'] ); ?>
                    </div>
                    <div class="title">
                        <?php echo wp_kses_post( $content ); ?>
                    </div>
                </div>
            <?php
            }
            elseif ( 'font-awesome' == $atts['icon_type'] )
            {
                if ( 'layout_inline' == $atts['icon_awesome_layout'] )
                {
                    ?>
                    <div class="seplan-icon-box type-<?php echo esc_attr( $atts['icon_type'] ); ?> <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['icon_awesome_layout'] ); ?>">
                        <?php
                        if ( $atts['font_awesome'] )
                        {
                            ?>
                            <?php
                            $icon_color = '';
                            if ( $atts['icon_awesome_color'] )
                            {
                                $icon_color = sprintf('style="color:%s ;"', esc_attr( $atts['icon_awesome_color'] ) );
                            }
                            ?>
                            <i class="<?php echo esc_attr( $atts['font_awesome'] ); ?>" <?php echo $icon_color; ?>></i>
                            <?php
                        }
                        ?>
                        <span><?php echo esc_html__( $atts['box_title'] ,'seoplan' ); ?></span>
                    </div>
                    <?php
                    $output = ob_get_clean();
                    return $output;
                }
            }
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Functions displays list case study
         * @param $atts array shortcode attributes
         */
        function list_case_studies( $atts )
        {
            $atts = shortcode_atts( array(
                'per_page'  =>  9,
                'columns'   =>  3,
                'orderby'   =>  'date',
                'order'     =>  'desc',
                'class_name'    =>  ''
            ), $atts );

            $terms = seoplan_get_case_study_categories();
            $list_terms = array( sprintf( '<li><a class="active case-study-filter" href="%s" data-filter="*" >%s</a></li>', esc_url( '#' ), __( 'All', 'seoplan' ) ) );
            foreach ( $terms as $term )
            {
                $list_terms[] = sprintf( '<li><a href="%s" class="case-study-filter" data-filter=".filter-%s">%s</a></li>', esc_url( '#' ), isset( $term->slug ) ? $term->slug : '', $term->name );
            }
            $categories_filter = sprintf( '<ul class="case-studies-filter">%s</ul>', implode( '', $list_terms ) );

            $case_studies = seoplan_get_case_studies( $atts );

            ob_start();
            ?>
            <div class="seoplan-list-case-studies <?php echo esc_attr( $atts['class_name'] ); ?>">
                <?php
                echo $categories_filter;
                ?>
                <div class="row case-studies-list">
                <?php
                echo $case_studies;
                ?>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Functions display Next/Prev Case study button
         * @param $atts array shortcode attributes
         */
        function case_study_nav( $atts )
        {
            $atts = shortcode_atts( array(
                'pre_btn_text'  =>  __( 'Previous Project', 'seoplan' ),
                'next_btn_text' =>  __( 'Next Project', 'seoplan' ),
                'class_name'    =>  '',
            ), $atts );

            if ( ! is_singular( 'case_study' ) )
            {
                return '';
            }

            ob_start();
            ?>
            <div class="seoplan-case-study-nav <?php echo esc_attr( $atts['class_name'] ); ?>">
                <ul class="row">
                    <li class="prev col-xs-4">
                        <?php
                        previous_post_link( '%link', sprintf( '<i class="fa fa-caret-left" aria-hidden="true"></i><span>%s</span>', esc_html( $atts['pre_btn_text'] ) ) );
                        ?>
                    </li>
                    <li class="back-to-list col-xs-4">
                        <?php
                        if ( seoplan_get_option( 'case_studies_page_list' ) )
                        {
                            $page_id = seoplan_get_option( 'case_studies_page_list' );
                        ?>
                            <a href="<?php echo get_the_permalink( $page_id ); ?>" title="prev"><i class="fa fa-th" aria-hidden="true"></i></a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="next col-xs-4">
                        <?php
                        next_post_link( '%link', sprintf( '<span>%s</span><i class="fa fa-caret-right" aria-hidden="true"></i>', esc_html( $atts['next_btn_text'] ) ) );
                        ?>
                    </li>
                </ul>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function displays chart element
         * @param $atts array shortcode attributes
         */
        function chart_pie( $atts )
        {
            $atts = shortcode_atts( array(
                'pie_datas' =>  '',
                'chart_width' =>  '',
                'chart_height' =>  '',
                'class_name'    =>  '',
            ), $atts );
            ob_start();
            ?>
            <div class="seoplan-charts row <?php echo esc_attr( $atts['class_name'] ); ?>">
            <?php
            if ( isset( $atts['pie_datas'] ) && ! empty( $atts['pie_datas'] ) )
            {
                $width = 270;
                $height = 270;
                if ( isset( $atts['chart_width'] ) )
                {
                    $width = $atts['chart_width'];
                }
                if ( isset( $atts['chart_height'] ) )
                {
                    $height = $atts['chart_height'];
                }
                $id = uniqid( 'chart-' );
                $items = vc_param_group_parse_atts( $atts['pie_datas'] );
                ?>
                <div class="col-xs-12 col-md-6 chart-result">
                    <canvas id="<?php echo esc_attr( $id ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>"></canvas>
                </div>
                <div class="col-xs-12 col-md-6 chart-list">
                    <ul>
                    <?php
                    $label = array();
                    $data = array();
                    $background_color = array();
                    $background_color_hover = array();
                    foreach ( $items as $item )
                    {
                        $bg_color = '';
                        $percent = 0;
                        $label = '';
                        if ( isset( $item['pie_label'] ) )
                        {
                            $label[] = $item['pie_label'];
                            $label = $item['pie_label'];
                        }
                        if ( isset( $item['pie_percent'] ) )
                        {
                            $data[] = $item['pie_percent'];
                            $percent = $item['pie_percent'];
                        }
                        if ( isset( $item['bg_color'] ) )
                        {
                            $background_color[] = $item['bg_color'];
                            $bg_color = $item['bg_color'];
                        }
                        if ( isset( $item['bg_color_hover'] ) )
                        {
                            $background_color_hover[] = $item['bg_color_hover'];
                        }
                    ?>
                        <li>
                            <span class="point" style="background-color: <?php echo esc_attr( $bg_color ); ?>"></span>
                            <span class="percent"><?php echo sprintf( '%s', esc_html( $percent ) ); ?></span>
                            <span class="text"><?php echo sprintf( '%s', esc_html( $label ) ); ?></span>
                        </li>
                    <?php
                    }
                    ?>
                    </ul>
                </div>
                <?php
                $this->l10n['Charts'][$id] = array(
                    'labels'     => $label,
                    'data'     => $data,
                    'backgroundColor'   => $background_color,
                    'hoverBackgroundColor' => $background_color_hover,
                );
            }
            ?>
            </div><!-- end .seoplan-charts -->
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display section information
         * @param $atts array section attribute
         */
        function section_case_study_information( $atts )
        {
            $atts = shortcode_atts( array(
                'bg_color'  =>  '',
                'display_publish_date'  =>  true,
                'display_category'  =>  true,
                'display_client_information'    =>  true,
                'share_facebook'    =>  true,
                'share_twitter'    =>  true,
                'share_pinterest'    =>  true,
                'share_google'    =>  true,
                'class_name'    =>  '',
            ) , $atts);

            if ( ! is_singular( 'case_study' ) )
            {
                return '';
            }

            ob_start();
            $background_color = '';
            if ( isset( $atts['bg_color'] ) )
            {
                $background_color = sprintf( 'style="background-color: %s"', esc_attr( $atts['bg_color'] ) );
            }
            ?>
            <div class="seoplan-case-study-information <?php echo esc_attr( $atts['class_name'] ); ?>" <?php echo $background_color; ?> >
                <div class="row">
                    <div class="infos">
                        <div class="col-xs-3 date">
                            <h4><?php _e( 'Date', 'seoplan' ); ?></h4>
                            <?php
                            if ( $atts['display_publish_date'] ) :
                            ?>
                            <p><?php echo get_the_date( 'F , d Y' ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-3 project-type">
                            <h4><?php _e( 'Project Type', 'seoplan' ); ?></h4>
                            <?php
                            $display_terms = $atts['display_category'];
                            $current_ID = get_the_ID();
                            if ( $display_terms )
                            {
                                $terms = get_the_terms( $current_ID, 'case_study_category' );
                            ?>
                            <p>
                                <?php
                                if ( $terms )
                                {
                                    $count = 1;
                                    foreach ( $terms as $term )
                                    {
                                        $separator = ',';
                                        if ( $count == count( $terms ) )
                                        {
                                            $separator = '';
                                        }
                                    ?>
                                        <a href="<?php echo get_term_link( $term->term_id ); ?>" title="<?php echo esc_html( $term->name ); ?>"><?php echo esc_html( $term->name ); echo $separator; ?></a>
                                    <?php
                                        $count++;
                                    }
                                }
                                ?>
                            </p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-3 clients">
                            <h4><?php _e( 'Clients', 'seoplan' ); ?></h4>
                            <?php
                            $client = seoplan_get_post_meta( 'client_information' );
                            if ( $atts['display_client_information'] ) :
                            ?>
                            <p><?php echo esc_html( $client ); ?></p>
                            <?php
                            endif;
                            ?>
                        </div>
                        <div class="col-xs-3 share">
                            <h4><?php _e( 'Share', 'seoplan' ); ?></h4>
                            <?php
                            ?>
                            <ul>
                                <?php
                                if ( $atts['share_facebook'] )
                                {
                                ?>
                                    <li>
                                        <a class="facebook" href="<?php echo esc_url( sprintf( 'http://www.facebook.com/sharer.php?u=%s', get_the_permalink() ) ); ?>" title="<?php echo esc_attr( 'Facebook', 'seoplan' ); ?>" target="_blank">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                if ( $atts['share_twitter'] )
                                {
                                ?>
                                    <li>
                                        <a class="twitter" href="<?php echo esc_url( sprintf( 'http://twitter.com/home/?status=%s - %s', get_the_title(), get_the_permalink() ) ); ?>" title="<?php echo esc_attr( 'Twitter', 'seoplan' ); ?>">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                if ( $atts['share_google'] )
                                {
                                ?>
                                    <li>
                                        <a class="google-plus" href="<?php echo esc_url( sprintf( 'https://plus.google.com/share?url=%s', get_the_permalink() ) ); ?>" title="<?php echo esc_attr( 'Google Plus', 'seoplan' ); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                if ( $atts['share_pinterest'] )
                                {
                                ?>
                                    <li>
                                        <a class="pinterest" href="<?php echo esc_url( sprintf( 'http://pinterest.com/pin/create/button/?url=%s', get_the_permalink() ) ); ?>" target="_blank">
                                            <i class="fa fa-pinterest" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function displays section button attributes
         * @param $atts button action attributes
         */
        function section_button_action( $atts )
        {
            $atts = shortcode_atts( array(
                'button_text'   =>  '',
                'button_url'    =>  '',
                'display_wishlist_button'   =>  'true',
                'class_name'    =>  ''
            ), $atts );
            ob_start();
            ?>
            <div class="seoplan-button-action <?php echo esc_attr( $atts['class_name'] ); ?>">
                <a class="btn" href="<?php echo esc_url( $atts['button_url'] ); ?>"><?php echo esc_html($atts['button_text'] ); ?></a>
                <?php
                if ( $atts['display_wishlist_button'] )
                {
                ?>
                    <a href="#" class="heart course-add-to-wishlist" data-cid="<?php echo get_the_ID(); ?>">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </a>
                <?php
                }
                ?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display section title
         *
         * @param array $atts
         * @param string $content
         *
         * @return string
         */
        function section_information( $atts, $content )
        {
            $atts = shortcode_atts( array(
                'heading'    =>  '',
                'align'   =>  'align-left',
                'heading_color' =>  '',
                'description_color' =>  '',
                'line_color'    =>  '',
                'hide_bottom_line'  =>  '',
                'css_animation' =>  '',
                'class_name' => '',
                'css'       =>  '',
            ), $atts );
            $css_class = vc_shortcode_custom_css_class( $atts['css'], ' ' );

            $css_animation = self::get_css_animation( $atts['css_animation'] );
            ob_start();
            ?>
            <div class="seoplan-information <?php echo esc_attr( $atts['class_name'] ); ?> <?php echo esc_attr( $atts['align'] ); ?> <?php echo esc_attr( $css_animation ); ?> <?php echo esc_attr( $css_class ); ?>">
                <div class="title">
                    <?php
                    $heading_style = '';
                    if ( $atts['heading_color'] )
                    {
                        $heading_style = sprintf( 'style="color: %s"', esc_attr( $atts['heading_color'] ) );
                    }
                    $description_style = '';
                    if ( $atts['description_color'] )
                    {
                        $description_style = sprintf( 'style="color: %s"', esc_attr( $atts['description_color'] ) );
                    }
                    $line_style = '';
                    if ( $atts['line_color'] )
                    {
                        $line_style = sprintf( 'style="background-color: %s"', esc_attr( $atts['line_color'] ) );
                    }
                    ?>
                    <h2 class="section-title" <?php echo $heading_style; ?>><?php echo esc_html( $atts['heading'] ); ?></h2>
                    <?php
                    if ( ! $atts['hide_bottom_line'] )
                    {
                    ?>
                        <span class="line" <?php echo $line_style; ?>></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="content" <?php echo $description_style; ?>>
                    <?php
                    $content_p = wpautop( $content );
                    echo wp_kses_post( $content_p ); ?>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function displays image carousel
         * @param $atts button action attributes
         */
        function images_carousel( $atts )
        {
            /**
             * Function display imagess carousel
             *
             * @param array $atts
             *
             * @return string
             */

            $atts = shortcode_atts( array(
                'images'    =>  '',
                'image_size'    =>  'full',
                'layout'    =>  'single',
                'auto_play' =>  '',
                'hide_pagination'    =>  '',
                'hide_navigation'   =>  '',
                'custom_links'  =>  '',
                'css_animation' =>  '',
                'class_name'    =>  '',
            ), $atts );

            $output = '';
            $images = $atts['images'] ? explode( ',', $atts['images'] ) : '';
            $css_animation = self::get_css_animation( $atts['css_animation'] );
            $id = uniqid( 'images-carousel-' );

            if ( 'single' == $atts['layout'] )
            {
                if ( $images )
                {
                    foreach ( $images as $attachment_id )
                    {
                        $image = wp_get_attachment_image_src( $attachment_id, $atts['image_size'] );
                        if( $image )
                        {

                            $result[] =	sprintf( '<div class="item"><img alt="%s" src="%s"></div>',
                                esc_attr( $attachment_id ),
                                esc_url( $image[0] )
                            );
                        }
                    }
                }

                if ( isset( $result ) )
                {
                    $this->l10n['imagesCarousel'][$id] = array(
                        'number'     => 1,
                        'layout'     => $atts['layout'],
                        'autoplay'   => $atts['auto_play'],
                        'pagination' => ! $atts['hide_pagination'],
                    );

                }
            }
            elseif ( 'list' == $atts['layout'] )
            {
                $custom_links = $atts['custom_links'] ? explode("\n", $atts['custom_links']) : '';

                if ( $images )
                {
                    $i = 0;
                    foreach ( $images as $attachment_id )
                    {
                        $first_item = '';
                        if ( 0 == $i )
                        {
                            $first_item = 'first-item';
                        }
                        $image = wp_get_attachment_image_src( $attachment_id, $atts['image_size'] );
                        if ( $custom_links && isset( $custom_links[$i] ) )
                        {
                            $link = str_replace('<br />', '', $custom_links[$i]);
                        }
                        else
                        {
                            $link = '#';
                        }
                        if( $image )
                        {

                            $result[] =	sprintf( '<div class="item %s"><a target="_blank" href="%s"><img alt="%s" src="%s"></a></div>',
                                esc_attr( $first_item ),
                                esc_url( $link ),
                                esc_attr( $attachment_id ),
                                esc_url( $image[0] )
                            );
                        }
                        $i++;
                    }
                }

                if ( isset( $result ) )
                {
                    $this->l10n['imagesCarousel'][$id] = array(
                        'number'     => 6,
                        'layout'     => $atts['layout'],
                        'autoplay'   => $atts['auto_play'],
                        'pagination' => ! $atts['hide_pagination'],
                    );

                }
            }
            elseif ( 'gallery' == $atts['layout'] )
            {
                if ( $images )
                {
                    foreach ( $images as $attachment_id )
                    {
                        $image = wp_get_attachment_image_src( $attachment_id, $atts['image_size'] );
                        if( $image )
                        {

                            $result[] =	sprintf( '<div class="item"><img alt="%s" src="%s"></div>',
                                esc_attr( $attachment_id ),
                                esc_url( $image[0] )
                            );
                        }
                    }
                }

                if ( isset( $result ) )
                {
                    $this->l10n['imagesGallery'][$id] = array(
                        'number'     => 1,
                        'layout'     => $atts['layout'],
                        'autoplay'   => $atts['auto_play'],
                        'hideNavigation' => ! $atts['hide_navigation'],
                    );

                }
            }
            $output .= sprintf( '<div id="%s" class="seoplan-images-carousel %s %s layout-%s"><div class="carousel-wrapper">%s</div></div>', esc_attr( $id ), esc_attr( $css_animation ), esc_attr( $atts['class_name'] ), esc_attr( $atts['layout'] ), implode( ' ', $result ));

            return $output;
        }

        /**
         * Function enqueues script
         */
        function footer()
        {
            wp_localize_script('seoplan-scripts', 'seoPlanShortCode', $this->l10n);
        }

        /**
         * Get CSS classes for animation
         *
         * @param string $css_animation
         *
         * @return string
         */
        public static function get_css_animation( $css_animation ) {
            $output = '';

            if ( '' !== $css_animation ) {
                wp_enqueue_script( 'waypoints' );
                wp_enqueue_style( 'animate-css' );
                $output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
            }

            return $output;
        }
    }
}
