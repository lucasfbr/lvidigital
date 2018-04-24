<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-fields">
		<button type="submit" name="searchBtn" class="ti-search"><svg viewBox="0 0 20 20"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search"></use> </svg></button>
		<input type="text" placeholder="<?php esc_html_e( 'Enter text here...', 'seoplan' ); ?>" name="s" class="search-field">
		<span class="close-search-popup"><svg viewBox="0 0 14 14"> <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close-delete-small"></use> </svg></span>
	</div>
</form>
