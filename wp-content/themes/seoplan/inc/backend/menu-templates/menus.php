<# if ( data.depth == 0 ) { #>
	<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Mega Menu Content', 'seoplan' ) ?>" data-panel="mega"><?php esc_html_e( 'Mega Menu', 'seoplan' ) ?></a>
	<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Mega Menu Background', 'seoplan' ) ?>" data-panel="background"><?php esc_html_e( 'Background', 'seoplan' ) ?></a>
	<div class="separator"></div>
	<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Icon', 'seoplan' ) ?>" data-panel="icon"><?php esc_html_e( 'Icon', 'seoplan' ) ?></a>
<# } else if ( data.depth == 1 ) { #>
	<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Menu Setting', 'seoplan' ) ?>" data-panel="settings"><?php esc_html_e( 'Settings', 'seoplan' ) ?></a>
	<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Design', 'seoplan' ) ?>" data-panel="design"><?php esc_html_e( 'Design', 'seoplan' ) ?></a>
	<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Content', 'seoplan' ) ?>" data-panel="content"><?php esc_html_e( 'Content', 'seoplan' ) ?></a>
	<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Icon', 'seoplan' ) ?>" data-panel="icon"><?php esc_html_e( 'Icon', 'seoplan' ) ?></a>
<# } else { #>
	<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Menu Content', 'seoplan' ) ?>" data-panel="content"><?php esc_html_e( 'Content', 'seoplan' ) ?></a>
	<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu Icon', 'seoplan' ) ?>" data-panel="icon"><?php esc_html_e( 'Icon', 'seoplan' ) ?></a>
<# } #>
