( function ( $ )
{
	'use strict';
	$( 'body' ).on( 'click', '.icon-selector i', function(e)
	{
		e.preventDefault();
		var $el = $( this ),
			icon = $el.data( 'icon' );
		$el.closest( 'div' ).prev( 'input.icon-data' ).val( icon ).siblings( '.icon-preview' ).children( 'i' ).attr( 'class', icon );
		$el.addClass( 'selected' ).siblings( '.selected' ).removeClass( 'selected' );
	} );

	$( 'body' ).on( 'click', '.clear-icon-selected', function ( e )
	{
		e.preventDefault();
		var current = $( this );
		current.siblings( 'i' ).removeClass().parent().siblings( 'input.icon-data' ).val('');
	} )

	$( 'body' ).on( 'keyup', '.icon-search', function()
	{
		var search = $( this ).val(),
			$icons = $( this ).siblings( '.icon-selector' ).children();

		if ( !search ) {
			$icons.show();
			return;
		}

		$icons.hide().filter( function() {
			return $( this ).data( 'icon' ).indexOf( search ) >= 0;
		} ).show();
	} );
} )( jQuery );
