<?php
/**
 * Class render mega menu
 *
 * @package Seo Plan
 */

if( ! class_exists( 'WPF_walker_Mega_Menu' ) )
{
    /**
     * Walker mega menu class
     *
     * @since 1.0.0
     */
    class SeoPlan_Walker_Mega_Menu extends Walker_Nav_Menu
    {
        /**
         * Check Top sub menu is marked is mega type
         *
         * @since 1.0.0
         * @var boolean
         */
        protected $is_mega_menu = false;

        /**
         * Starts the list before the elements are added.
         *
         * @see Walker::start_lvl()
         *
         * @since 1.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function start_lvl( &$output, $depth = 0, $args = array() )
        {
            $indent = str_repeat("\t", $depth);

            if( 0 == $depth && $this->is_mega_menu )
            {
                $output .= "\n$indent<div class='wpf-mega-menu container'><ul class=\"sub-menu\">\n";
            }
            else
            {
                $output .= "\n$indent<ul class=\"sub-menu\">\n";
            }

        }

        /**
         * Ends the list of after the elements are added.
         *
         * @see Walker::end_lvl()
         *
         * @since 1.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function end_lvl( &$output, $depth = 0, $args = array() )
        {
            $indent = str_repeat("\t", $depth);

            if( 0 == $depth && $this->is_mega_menu )
            {
                $output .= "$indent</ul></div>\n";
            }
            else
            {
                $output .= "$indent</ul>\n";
            }
        }

        /**
         * Start the element output.
         * Display item description text and classes
         *
         * @see   Walker::start_el()
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         * @param int    $id     Current item ID.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
        {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            $is_mega_menu    = get_post_meta( $item->ID, 'menu-item-enable-mega-menu', true );
            $custom_content  = get_post_meta( $item->ID, 'menu-item-custom-content', true );
            $item_column     = get_post_meta( $item->ID, 'menu-item-column', true );

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            /**
             * Check top sub menu is mega menu
             */
            if ( 0 == $depth )
            {
                $this->is_mega_menu = $is_mega_menu;
            }
            if ( $is_mega_menu && 0 == $depth )
            {
                $classes[] = 'mega-menu-item';
            }
            if ( $this->is_mega_menu && 1 == $depth )
            {
                $classes[] = 'mega-sub-menu col-md-' . $item_column;
            }

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
            $output .= $indent . '<li' . $id . $class_names .'>';

            $atts = array();
            $atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target ) ? $item->target : '';
            $atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
            $atts['href'] = ! empty( $item->url ) ? $item->url : '';

            $attributes = '';
            foreach ( $atts as $attr => $value )
            {
                if ( ! empty( $value ) )
                {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            /** This filter is documented in wp-includes/post-template.php */
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            if ( $this->is_mega_menu && in_array( 'hide-label', $classes ) )
            {
                $item_output = '';
            }

            if ( 1 <= $depth && ! empty( $custom_content ) )
            {
                $item_output .= '<div class="menu-item-custom-content">' . do_shortcode( $custom_content ) . '</div>';
            }

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        /**
         * Ends the element output, if needed.
         *
         * @see Walker::end_el()
         *
         * @since 1.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Page data object. Not used.
         * @param int    $depth  Depth of page. Not Used.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function end_el( &$output, $item, $depth = 0, $args = array() )
        {
            $output .= "</li>\n";
        }
    }
}