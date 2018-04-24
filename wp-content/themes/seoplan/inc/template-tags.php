<?php
if ( ! function_exists( 'seoplan_get_mega_menu_setting_default' ) ) :
    /**
     * Get the default mega menu settings of a menu item
     *
     * @return array
     */
    function seoplan_get_mega_menu_setting_default() {
        return apply_filters(
            'seoplan_mega_menu_setting_default',
            array(
                'mega'         => false,
                'icon'         => '',
                'hide_text'    => false,
                'disable_link' => false,
                'content'      => '',
                'width'        => '',
                'border'       => array(
                    'left' => 0,
                ),
                'background'   => array(
                    'image'      => '',
                    'color'      => '',
                    'attachment' => 'scroll',
                    'size'       => '',
                    'repeat'     => 'no-repeat',
                    'position'   => array(
                        'x'      => 'left',
                        'y'      => 'top',
                        'custom' => array(
                            'x' => '',
                            'y' => '',
                        ),
                    ),
                ),
            )
        );
    }
endif;

if ( ! function_exists( 'seoplan_parse_args' ) ) :
    /**
     * Recursive merge user defined arguments into defaults array.
     *
     * @param array $args
     * @param array $default
     *
     * @return array
     */
    function seoplan_parse_args( $args, $default = array() )
    {
        $args   = (array) $args;
        $result = $default;

        foreach ( $args as $key => $value )
        {
            if ( is_array( $value ) && isset( $result[ $key ] ) ) {
                $result[ $key ] = seoplan_parse_args( $value, $result[ $key ] );
            } else {
                $result[ $key ] = $value;
            }
        }

        return $result;
    }

endif;

if ( ! function_exists( 'get_theme_file_path' ) ) :
    /**
     * Retrieves the path of a file in the theme.
     *
     * Searches in the stylesheet directory before the template directory so themes
     * which inherit from a parent theme can just override one file.
     *
     * @param string $file Optional. File to search for in the stylesheet directory.
     *
     * @return string The path of the file.
     */
    function get_theme_file_path( $file = '' ) {
        $file = ltrim( $file, '/' );

        if ( empty( $file ) ) {
            $path = get_stylesheet_directory();
        } elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
            $path = get_stylesheet_directory() . '/' . $file;
        } else {
            $path = get_template_directory() . '/' . $file;
        }

        /**
         * Filters the path to a file in the theme.
         *
         * @param string $path The file path.
         * @param string $file The requested file to search for.
         */
        return apply_filters( 'theme_file_path', $path, $file );
    }
endif;

if ( ! function_exists( 'get_theme_file_uri' ) ) :
    /**
     * Retrieves the URL of a file in the theme.
     *
     * Searches in the stylesheet directory before the template directory so themes
     * which inherit from a parent theme can just override one file.
     *
     * @param string $file Optional. File to search for in the stylesheet directory.
     *
     * @return string The URL of the file.
     */
    function get_theme_file_uri( $file = '' ) {
        $file = ltrim( $file, '/' );

        if ( empty( $file ) ) {
            $url = get_stylesheet_directory_uri();
        } elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
            $url = get_stylesheet_directory_uri() . '/' . $file;
        } else {
            $url = get_template_directory_uri() . '/' . $file;
        }

        /**
         * Filters the URL to a file in the theme.
         *
         * @param string $url  The file URL.
         * @param string $file The requested file to search for.
         */
        return apply_filters( 'theme_file_uri', $url, $file );
    }
endif;