/**
 * Services overview: filter the cards as the visitor types.
 */
( function () {
	'use strict';

	var root = document.querySelector( '[data-services]' );
	if ( ! root ) {
		return;
	}
	var input = root.querySelector( '[data-sv-filter]' );
	var empty = root.querySelector( '[data-sv-empty]' );
	var areas = Array.prototype.slice.call( root.querySelectorAll( '[data-sv-area]' ) );
	if ( ! input ) {
		return;
	}

	input.addEventListener( 'input', function () {
		var q = input.value.trim().toLowerCase();
		var any = false;
		areas.forEach( function ( area ) {
			var shown = 0;
			Array.prototype.forEach.call( area.querySelectorAll( '[data-sv-item]' ), function ( item ) {
				var match = ! q || item.getAttribute( 'data-text' ).indexOf( q ) !== -1;
				item.hidden = ! match;
				if ( match ) {
					shown++;
				}
			} );
			area.hidden = shown === 0;
			any = any || shown > 0;
		} );
		if ( empty ) {
			empty.hidden = any;
		}
	} );
}() );
