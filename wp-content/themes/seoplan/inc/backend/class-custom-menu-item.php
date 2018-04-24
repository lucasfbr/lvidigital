<?php
/**
 * Class add some meta to menu items
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Walker_Nav_Menu_Edit' ) ) {
    require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
}

/**
 * Class to add new custom fields to menu item
 *
 * @link https://github.com/kucrut/wp-menu-item-custom-fields
 *
 * @since 1.0
 */
class SeoPlan_Custom_Menu_Item_Fields
{
    /**
     * Holds our custom fields
     *
     * @var    array
     * @access protected
     * @since  1.0.0
     */
    protected $fields = array();

    /**
     * Initialize
     *
     * @since 1.0.0
     */

    function __construct()
    {
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'menu_walker' ) );

        add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'fields' ), 10, 4 );
        add_action( 'wp_update_nav_menu_item', array( $this, 'save' ), 10, 3 );
        add_filter( 'manage_nav-menus_columns', array( $this, 'columns' ), 99 );

        $this->fields = array(
            'enable-mega-menu'  => esc_html__( 'Enable Mega Menu', 'seoplan' ),
            'custom-content'    => esc_html__( 'Custom content', 'seoplan' ),
            'column'          => esc_html__( 'Column Width', 'seoplan' ),
        );
    }

    /**
     * Replace default menu editor walker with theme's
     *
     * We don't actually replace the default walker. We're still using it and
     * only injecting some HTMLs.
     *
     * @since   1.0.0
     *
     * @param   string $walker Walker class name
     *
     * @return  string Walker class name
     */
    public function menu_walker( $walker ) {
        $walker = 'WPF_Walker_Nav_Menu_Edit';

        return $walker;
    }

    /**
     * Print fields
     *
     * @param object $item  Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args  Menu item args.
     * @param int    $id    Nav menu ID.
     *
     * @return string Form fields
     */
    public function fields( $id, $item, $depth, $args )
    {
        $mega = get_post_meta( $item->ID, 'menu-item-enable-mega-menu', true );
        $custom_content = get_post_meta( $item->ID, 'menu-item-custom-content', true );
        $column  = get_post_meta( $item->ID, 'menu-item-column', true );
        if ( ! isset( $column ) || empty( $column ) )
        {
            $column = 3;
        }
    ?>
        <p class="description description-wide field-mega-menu">
            <label for="<?php echo esc_attr( $this->get_field_id( 'enable-mega-menu', $item->ID ) ) ?>">
                <input
                    type="checkbox"
                    id="<?php echo esc_attr( $this->get_field_id( 'enable-mega-menu', $item->ID ) ) ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'enable-mega-menu', $item->ID ) ) ?>"
                    value="1"
                    <?php checked( 1, $mega ) ?>
                />
                <?php echo $this->fields['enable-mega-menu'] ?>
            </label>
        </p>
        <p class="description description-thin field-column">
            <label for="<?php echo esc_attr( $this->get_field_id( 'column', $item->ID ) ) ?>">
                <?php echo $this->fields['column'] ?><br />
                <select
                    id="<?php echo esc_attr( $this->get_field_id( 'column', $item->ID ) ) ?>"
                    class="widefat edit-menu-item-column"
                    name="<?php echo esc_attr( $this->get_field_name( 'column', $item->ID ) ) ?>"
                >
                    <option value="12" <?php selected( 12, $column ); ?>>1/1</option>
                    <option value="6" <?php selected( 6, $column ); ?>>1/2</option>
                    <option value="4" <?php selected( 4, $column ); ?>>1/3</option>
                    <option value="3" <?php selected( 3, $column ); ?>>1/4</option>
                    <option value="8" <?php selected( 8, $column ); ?>>2/3</option>
                    <option value="9" <?php selected( 9, $column ); ?>>3/4</option>
                </select>
            </label>
        </p>
        <p class="description description-wide field-mega-menu">
            <label for="<?php echo esc_attr( $this->get_field_id( 'custom-content', $item->ID ) ) ?>">
                <?php echo $this->fields['custom-content'] ?>
                <textarea
                    id="<?php echo esc_attr( $this->get_field_id( 'custom-content', $item->ID ) ) ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'custom-content', $item->ID ) ) ?>"
                    class="widefat edit-menu-item-content"
                    rows="5"
                ><?php echo esc_html( $custom_content ); ?></textarea>
            </label>
        </p>
    <?php
    }

    /**
     * Save custom field value
     *
     * @wp_hook action wp_update_nav_menu_item
     *
     * @param int   $menu_id         Nav menu ID
     * @param int   $menu_item_db_id Menu item ID
     * @param array $menu_item_args  Menu item data
     */
    public function save( $menu_id, $menu_item_db_id, $menu_item_args )
    {
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
        {
            return;
        }

        foreach ( $this->fields as $name => $label )
        {
            $key = sprintf( 'menu-item-%s', $name );
            // Sanitize
            if ( ! empty( $_REQUEST[$key][$menu_item_db_id] ) )
            {
                $value = $_REQUEST[$key][$menu_item_db_id];
            }
            else
            {
                $value = null;
            }
            // Update
            if ( ! is_null( $value ) )
            {
                update_post_meta( $menu_item_db_id, $key, $value );
            }
            else
            {
                delete_post_meta( $menu_item_db_id, $key );
            }
        }
    }

    /**
     * Add our fields to the screen options toggle
     *
     * @since 1.0.0
     *
     * @param array $columns Menu item columns
     *
     * @return array
     */
    public function columns( $columns )
    {
        $columns = array_merge( $columns, $this->fields );
        return $columns;
    }

    /**
     * Get field name
     *
     * @since  1.0.0
     *
     * @param  string  $name The field name
     * @param  integer $id   The ID of menu item
     *
     * @return string        The name attribute
     */
    protected function get_field_name( $name, $id = 0 )
    {
        return sprintf( 'menu-item-%s[%s]', $name, $id );
    }

    /**
     * Get field id
     *
     * @since  1.0.0
     *
     * @param  string  $name The field name
     * @param  integer $id   The ID of menu item
     *
     * @return string        The name attribute
     */
    protected function get_field_id( $name, $id = 0 )
    {
        return "edit-menu-item-$name-$id";
    }

    /**
     * Display field type icon
     *
     * @since  1.0.0
     *
     * @param  string $selected The selected icon
     *
     * @return array
     */
}

/**
 * Menu item custom fields walker
 *
 * @link https://github.com/kucrut/wp-menu-item-custom-fields
 *
 * @since 1.0
 */
class WPF_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit
{
    /**
     * Start the element output.
     *
     * @see Walker_Nav_Menu::start_el()
     * @since 1.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     * @param int    $id     Not used.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        global $wp_version;

        $item_output = '';
        parent::start_el( $item_output, $item, $depth, $args );

        if ( -1 == version_compare( $wp_version , '4.7' ) )
        {
            $output .= preg_replace(
            // NOTE: Check this regex from time to time!
                '/(?=<p[^>]+class="[^"]*field-move)/',
                $this->get_fields( $item, $depth, $args ),
                $item_output
            );
        }
        else
        {
            $output .= preg_replace(
            // NOTE: Check this regex from time to time!
                '/(?=<fieldset[^>]+class="[^"]*field-move)/',
                $this->get_fields( $item, $depth, $args ),
                $item_output
            );
        }
    }

    /**
     * Get custom fields
     *
     * @since 1.0.0
     * @uses add_action() Calls 'menu_item_custom_fields' hook
     *
     * @param object $item  Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args  Menu item args.
     * @param int    $id    Nav menu ID.
     *
     * @return string Form fields
     */
    protected function get_fields( $item, $depth, $args = array(), $id = 0 )
    {
        ob_start();

        /**
         * Get menu item custom fields from plugins/themes
         *
         * @since 1.0.0
         *
         * @param object $item  Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args  Menu item args.
         * @param int    $id    Nav menu ID.
         *
         * @return string Custom fields
         */
        do_action( 'wp_nav_menu_item_custom_fields', $id, $item, $depth, $args );

        return ob_get_clean();
    }
}