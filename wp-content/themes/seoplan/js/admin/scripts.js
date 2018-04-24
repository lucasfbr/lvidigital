/**
 * Execute
 */
( function ( $ )
{
    "use strict";

    /**
     * Metabox display field when select post type
     */
    var postFormatContainer = $( '#post-formats-select' ),
        postType = postFormatContainer.find( 'input[type=radio]' ),
        metaboxContainer = $( '#post-format-settings' );
    postType.on( 'change', function ( e )
    {
        var current = $( this );
        metaboxContainer.hide();
        if( metaboxContainer.find( '.rwmb-field' ).hasClass( current.val() ) )
        {
            metaboxContainer.show();
        }
        metaboxContainer.find( '.rwmb-field' ).hide();
        metaboxContainer.find( '.' + current.val() ).show();
    } )
    postType.filter( ':checked' ).trigger( 'change' );
} )( jQuery );
