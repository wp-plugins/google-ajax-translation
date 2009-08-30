/**
 * Google AJAX Translation
 * 2008-08-30
 */

jQuery( function() {
	jQuery('.translate_block').show(); // Show [Translate] buttons after the document is ready
});

function google_translate( lang, type, id ) {
	var text_node = document.getElementById( ( ( 'comment' == type ) ? 'div-' : '' ) + type + '-' + id ),
		loading_id;
	if ( ! text_node && 'comment' == type ) // some themes do not have the div-comment-id divs
		text_node = document.getElementById( 'comment-' + id );
	if ( text_node ) {
		loading_id = '#translate_loading_' + type + '-' + id;
		if ( 'he' == lang ) // Google translate uses the wrong code for Hebrew
			lang = 'iw';
		jQuery( text_node ).translate( lang, {
			fromOriginal: true,
			not: '.translate_block',
			start: function() { jQuery( loading_id ).show(); },
			complete: function() { jQuery( loading_id ).hide(); },
			error: function() { jQuery( loading_id ).hide(); }
			} );
	}
	jQuery( '#translate_popup' ).slideUp( 'fast' ); // Close the popup
}

function localize_languages( browser_lang, popup_id ) {
	var language_nodes = jQuery( '#translate_popup a' ).get(),
		llangs = [], // array that holds localized language names
		i;
	for ( i in language_nodes ) {
		llangs[i] = language_nodes[i].title; // Make array of English language names
	}
	jQuery.translate( llangs, 'en', ( ( 'he' == browser_lang ) ? 'iw' : browser_lang ), { // Google translate uses the wrong code for Hebrew
		complete: function() {
			llangs = this.translation;
			for ( i in language_nodes ) { // copy localized language names into titles
				language_nodes[i].title = llangs[i];
			}
			jQuery( popup_id ).data( 'localized', true );
		}
	});
}

function show_translate_popup( browser_lang, type, id ) {
	var popup_id = document.getElementById( 'translate_popup' ),
		jQ_button_id = jQuery( '#translate_button_' + type + '-' + id ),
		newleft = Math.round( jQ_button_id.offset().left ),
		newtop = Math.round( jQ_button_id.offset().top + jQ_button_id.outerHeight(true) ),
		popup_position = jQuery( popup_id ).position();
	if ( popup_id ) {
		if ( 'none' == popup_id.style.display || popup_position.left != newleft || popup_position.top != newtop ) { // check for hidden popup or incorrect placement
			popup_id.style.display = 'none';
			jQuery( popup_id ).css( 'left', newleft ).css( 'top', newtop ); // move popup to correct position
			jQuery( popup_id ).slideDown( 'fast' );
			jQuery( '#translate_popup .languagelink' ).each( function() { // bind click event onto all the anchors
				jQuery( this ).unbind( 'click' ).click( function () {
					google_translate( this.lang, type, id );
					return false;
				});
			});
			if ( 'en' != browser_lang && ( ! jQuery( popup_id ).data( 'localized' ) ) ) { // If the browser's preferred language isn't English and the popup hasn't already been localized
				localize_languages( browser_lang, popup_id );
			}
		} else {
			jQuery( popup_id ).slideUp( 'fast' );
		}
	}
}