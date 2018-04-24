<# var itemId = data.data['menu-item-db-id']; #>
<div id="smm-panel-background" class="smm-panel-background smm-panel">
	<p class="background-image">
		<label><?php esc_html_e( 'Background Image', 'seoplan' ) ?></label><br>
		<span class="background-image-preview">
			<# if ( data.megaData.background.image ) { #>
				<img src="{{ data.megaData.background.image }}">
			<# } #>
		</span>

		<button type="button" class="button remove-button <# if ( ! data.megaData.background.image ) { print( 'hidden' ) } #>"><?php esc_html_e( 'Remove', 'seoplan' ) ?></button>
		<button type="button" class="button upload-button" id="background_image-button"><?php esc_html_e( 'Select Image', 'seoplan' ) ?></button>

		<input type="hidden" name="{{ smm.getFieldName( 'background.image', itemId ) }}" value="{{ data.megaData.background.image }}">
	</p>

	<p class="background-color">
		<label><?php esc_html_e( 'Background Color', 'seoplan' ) ?></label><br>
		<input type="text" class="background-color-picker" name="{{ smm.getFieldName( 'background.color', itemId ) }}" value="{{ data.megaData.background.color }}">
	</p>

	<p class="background-repeat">
		<label><?php esc_html_e( 'Background Repeat', 'seoplan' ) ?></label><br>
		<select name="{{ smm.getFieldName( 'background.repeat', itemId ) }}">
			<option value="no-repeat" {{ 'no-repeat' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'No Repeat', 'seoplan' ) ?></option>
			<option value="repeat" {{ 'repeat' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'Tile', 'seoplan' ) ?></option>
			<option value="repeat-x" {{ 'repeat-x' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'Tile Horizontally', 'seoplan' ) ?></option>
			<option value="repeat-y" {{ 'repeat-y' == data.megaData.background.repeat ? 'selected="selected"' : '' }}><?php esc_html_e( 'Tile Vertically', 'seoplan' ) ?></option>
		</select>
	</p>

	<p class="background-position background-position-x">
		<label><?php esc_html_e( 'Background Position', 'seoplan' ) ?></label><br>

		<select name="{{ smm.getFieldName( 'background.position.x', itemId ) }}">
			<option value="left" {{ 'left' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Left', 'seoplan' ) ?></option>
			<option value="center" {{ 'center' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Center', 'seoplan' ) ?></option>
			<option value="right" {{ 'right' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Right', 'seoplan' ) ?></option>
			<option value="custom" {{ 'custom' == data.megaData.background.position.x ? 'selected="selected"' : '' }}><?php esc_html_e( 'Custom', 'seoplan' ) ?></option>
		</select>

		<input
			type="text"
			name="{{ smm.getFieldName( 'background.position.custom.x', itemId ) }}"
			value="{{ data.megaData.background.position.custom.x }}"
			class="{{ 'custom' != data.megaData.background.position.x ? 'hidden' : '' }}">
	</p>

	<p class="background-position background-position-y">
		<select name="{{ smm.getFieldName( 'background.position.y', itemId ) }}">
			<option value="top" {{ 'top' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Top', 'seoplan' ) ?></option>
			<option value="center" {{ 'center' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Middle', 'seoplan' ) ?></option>
			<option value="bottom" {{ 'bottom' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Bottom', 'seoplan' ) ?></option>
			<option value="custom" {{ 'custom' == data.megaData.background.position.y ? 'selected="selected"' : '' }}><?php esc_html_e( 'Custom', 'seoplan' ) ?></option>
		</select>
		<input
			type="text"
			name="{{ smm.getFieldName( 'background.position.custom.y', itemId ) }}"
			value="{{ data.megaData.background.position.custom.y }}"
			class="{{ 'custom' != data.megaData.background.position.y ? 'hidden' : '' }}">
	</p>

	<p class="background-attachment">
		<label><?php esc_html_e( 'Background Attachment', 'seoplan' ) ?></label><br>
		<select name="{{ smm.getFieldName( 'background.attachment', itemId ) }}">
			<option value="scroll" {{ 'scroll' == data.megaData.background.attachment ? 'selected="selected"'  : '' }}><?php esc_html_e( 'Scroll', 'seoplan' ) ?></option>
			<option value="fixed" {{ 'fixed' == data.megaData.background.attachment ? 'selected="selected"'  : '' }}><?php esc_html_e( 'Fixed', 'seoplan' ) ?></option>
		</select>
	</p>

	<p class="background-size">
		<label><?php esc_html_e( 'Background Size', 'seoplan' ) ?></label><br>
		<select name="{{ smm.getFieldName( 'background.size', itemId ) }}">
			<option value=""><?php esc_html_e( 'Default', 'seoplan' ) ?></option>
			<option value="cover" {{ 'cover' == data.megaData.background.size ? 'selected="selected"' : '' }}><?php esc_html_e( 'Cover', 'seoplan' ) ?></option>
			<option value="contain" {{ 'contain' == data.megaData.background.size ? 'selected="selected"' : '' }}><?php esc_html_e( 'Contain', 'seoplan' ) ?></option>
		</select>
	</p>
</div>