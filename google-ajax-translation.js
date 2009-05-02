/**
 * Google AJAX Translation
 * 2008-04-28
 */
function google_translate( lang, type, id ) {
	var text_node = document.getElementById( ( ( 'comment' == type ) ? 'div-' : '' ) + type + '-' + id );
	if ( ! text_node && 'comment' == type ) // some themes do not have the div-comment-id divs
		text_node = document.getElementById( 'comment-' + id );
	if ( text_node ) {
		var loading_id = '#translate_loading_' + type + '_' + id;
		lang = ('he' == lang) ? 'iw' : lang; // Google translate uses the wrong code for Hebrew
		jQuery( text_node ).translate( lang, {
			fromOriginal: true,
			not: '.translate_block',
			start: function() { jQuery( loading_id ).show(); },
			complete: function() { jQuery( loading_id ).hide(); },
			error: function() { jQuery( loading_id ).hide(); }
			} );
	}
	jQuery( '#translate_popup_' + type + '_' + id ).slideUp( 'fast' ); // Close the popup
}

function show_translate_popup( lang, type, id ) {
	var popup_id = document.getElementById( 'translate_popup_' + type + '_' + id );
	if ( popup_id ) {
		if ( 'none' == popup_id.style.display ) {
			jQuery( popup_id ).slideDown( 'fast' );
			if ( 'en' != lang && (! jQuery( popup_id ).hasClass( 'localized' ) ) ) { // If the browser's preferred language isn't English and the popup hasn't already been localized
				localize_languages( lang, popup_id );
			}
		} else {
			jQuery( popup_id ).slideUp( 'fast' );
		}
	}
}

var localized_languages = []; // array that holds localized language names for the entire page

function localize_languages( lang, popup_id ) {
	var language_nodes = jQuery( popup_id ).children( 'a[title]' ).get();
	if ( 0 == localized_languages.length ) { // Have language names not been translated yet? This should only be done once per page
		for ( i in language_nodes ) {
			localized_languages[i] = language_nodes[i].title; // Make array of English language names
		}
		lang = ('he' == lang) ? 'iw' : lang; // Google translate uses the wrong code for Hebrew
		jQuery.translate( localized_languages, 'en', lang, {
				complete: function() {
					localized_languages = this.translation;
					insert_languagetitles( popup_id, language_nodes );
				}
			});
	} else {
		insert_languagetitles( popup_id, language_nodes );
	}
}

function insert_languagetitles( popup_id, language_nodes ) { // copy localized language names into titles
	for ( i in language_nodes ) {
		if ( language_nodes[i].title ) {
			language_nodes[i].title = localized_languages[i];
		}
	}
	jQuery( popup_id ).addClass( 'localized' );
}

jQuery( function() {
	jQuery('.translate_block').show(); // Show 'Translate' buttons after the document is ready
});