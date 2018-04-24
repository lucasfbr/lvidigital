<?php
/**
 * Customize and add more fields for mega menu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Walker_Nav_Menu_Edit' ) ) {
	require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
}

/**
 * Class SeoPlan_Mega_Menu_Walker_Edit
 *
 * Class for adding more controllers into a menu item
 */
class SeoPlan_Mega_Menu_Walker_Edit extends Walker_Nav_Menu_Edit {
	/**
	 * Start the element output.
	 *
	 * @see   Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @global int   $_wp_nav_menu_max_depth
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$mega = get_post_meta( $item->ID, '_menu_item_mega', true );
		$mega = seoplan_parse_args( $mega, seoplan_get_mega_menu_setting_default() );

		$item_output = '';
		parent::start_el( $item_output, $item, $depth, $args );

		$dom = new DOMDocument();

		$dom->validateOnParse = true;
		$dom->loadHTML( mb_convert_encoding( $item_output, 'HTML-ENTITIES', 'UTF-8' ) );
		$xpath = new DOMXPath( $dom );

		// Adds mega menu data holder
		$settings = $xpath->query( "//*[@id='menu-item-settings-" . $item->ID . "']" )->item( 0 );

		if ( $settings ) {
			$node            = $dom->createElement( 'span' );
			$node->nodeValue = $mega['content'];
			unset( $mega['content'] );
			$node->setAttribute( 'data-mega', json_encode( $mega ) );
			$node->setAttribute( 'class', 'hidden mega-data' );
			$settings->appendChild( $node );
		}

		// Add settings link
		$cancel = $xpath->query( "//*[@id='cancel-" . $item->ID . "']" )->item( 0 );

		if ( $cancel ) {
			$link            = $dom->createElement( 'a' );
			$link->nodeValue = esc_html__( 'Settings', 'seoplan' );
			$link->setAttribute( 'class', 'item-config-mega opensettings submitcancel hide-if-no-js' );
			$link->setAttribute( 'href', '#' );
			$sep            = $dom->createElement( 'span' );
			$sep->nodeValue = ' | ';
			$sep->setAttribute( 'class', 'meta-sep hide-if-no-js' );
			$cancel->parentNode->insertBefore( $link, $cancel );
			$cancel->parentNode->insertBefore( $sep, $cancel );
		}

		$output .= $dom->saveHTML();
	}
}

/**
 * Class SeoPlan_Mega_Menu_Edit
 *
 * Main class for adding mega setting modal
 */
class SeoPlan_Mega_Menu_Edit {
	/**
	 * Modal screen of mega menu settings
	 *
	 * @var array
	 */
	public $modals = array();

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->modals = apply_filters( 'seoplan_mega_menu_modals', array(
			'menus',
			'title',
			'mega',
			'background',
			'icon',
			'content',
			'design',
			'settings',
		) );

		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_walker' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'admin_footer-nav-menus.php', array( $this, 'modal' ) );
		add_action( 'admin_footer-nav-menus.php', array( $this, 'templates' ) );
		add_action( 'wp_ajax_seoplan_save_menu_item_data', array( $this, 'save_menu_item_data' ) );
		add_filter( 'smm_icons', array( $this, 'flat_icons' ) );
	}

	/**
	 * Change walker class for editing nav menu
	 *
	 * @return string
	 */
	public function edit_walker() {
		return 'SeoPlan_Mega_Menu_Walker_Edit';
	}

	/**
	 * Load scripts on Menus page only
	 *
	 * @param string $hook
	 */
	public function scripts( $hook ) {
		if ( 'nav-menus.php' !== $hook ) {
			return;
		}

		wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );
		wp_register_style( 'flaticons', get_template_directory_uri() . '/css/flaticon.css', array(), '4.6.3' );
		wp_register_style( 'seoplan-mega-menu-admin', get_template_directory_uri() . '/css/admin/mega-menu.css', array(
			'media-views',
			'wp-color-picker',
			'font-awesome',
			'flaticons',
		) );
		wp_enqueue_style( 'seoplan-mega-menu-admin' );

		wp_register_script( 'seoplan-mega-menu-admin', get_template_directory_uri() . '/js/admin/mega-menu.js', array(
			'jquery',
			'jquery-ui-resizable',
			'wp-util',
			'wp-color-picker',
		), null, true );
		wp_enqueue_media();
		wp_enqueue_script( 'seoplan-mega-menu-admin' );

		wp_localize_script( 'seoplan-mega-menu-admin', 'smmModals', $this->modals );
	}

	/**
	 * Prints HTML of modal on footer
	 */
	public function modal() {
		?>
		<div id="smm-settings" tabindex="0" class="smm-settings">
			<div class="smm-modal media-modal wp-core-ui">
				<button type="button" class="button-link media-modal-close smm-modal-close">
					<span class="media-modal-icon"><span class="screen-reader-text"><?php esc_html_e( 'Close', 'seoplan' ) ?></span></span>
				</button>
				<div class="media-modal-content">
					<div class="smm-frame-menu media-frame-menu">
						<div class="smm-menu media-menu"></div>
					</div>
					<div class="smm-frame-title media-frame-title"></div>
					<div class="smm-frame-content media-frame-content">
						<div class="smm-content"></div>
					</div>
					<div class="smm-frame-toolbar media-frame-toolbar">
						<div class="smm-toolbar media-toolbar">
							<div class="smm-toolbar-primary media-toolbar-primary search-form">
								<button type="button" class="button smm-button smm-button-save media-button button-primary button-large"><?php esc_html_e( 'Save Changes', 'seoplan' ) ?></button>
								<button type="button" class="button smm-button smm-button-cancel media-button button-secondary button-large"><?php esc_html_e( 'Cancel', 'seoplan' ) ?></button>
								<span class="spinner"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="media-modal-backdrop smm-modal-backdrop"></div>
		</div>
		<?php
	}

	/**
	 * Prints underscore template on footer
	 */
	public function templates() {
		foreach ( $this->modals as $template ) {
			$file = get_theme_file_path( 'inc/backend/menu-templates/' . $template . '.php' );
			$file = apply_filters( 'seoplan_mega_menu_modal_template_file', $file, $template );

			if ( ! file_exists( $file ) ) {
				continue;
			}
			?>
			<script type="text/html" id="tmpl-seoplan-<?php echo esc_attr( $template ) ?>">
				<?php include( $file ); ?>
			</script>
			<?php
		}
	}

	/**
	 * Ajax function to save menu item data
	 */
	public function save_menu_item_data() {
		$_POST['data'] = stripslashes_deep( $_POST['data'] );
		parse_str( $_POST['data'], $data );
		$updated = $data;

		// Save menu item data
		foreach ( $data['menu-item-mega'] as $id => $meta ) {
			$meta = seoplan_parse_args( $meta, seoplan_get_mega_menu_setting_default() );

			$updated['menu-item-mega'][ $id ] = $meta;

			update_post_meta( $id, '_menu_item_mega', $meta );
		}

		wp_send_json_success( $updated );
	}

	function flat_icons()
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
}
