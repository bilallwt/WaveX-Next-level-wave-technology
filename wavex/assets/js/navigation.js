/**
 * WaveX navigation: mobile drawer and mega menu toggles.
 * Menus also open on hover/focus via CSS on desktop; this adds click/keyboard support.
 */
( function () {
	'use strict';

	var nav = document.getElementById( 'primary-nav' );
	var burger = document.querySelector( '.nav-toggle' );
	if ( ! nav || ! burger ) {
		return;
	}

	var items = nav.querySelectorAll( '.has-mega' );

	function closeAll( except ) {
		items.forEach( function ( item ) {
			if ( item === except ) {
				return;
			}
			item.classList.remove( 'is-open' );
			var t = item.querySelector( '.primary-nav__toggle' );
			if ( t ) {
				t.setAttribute( 'aria-expanded', 'false' );
			}
		} );
	}

	function setDrawer( open ) {
		nav.classList.toggle( 'is-open', open );
		burger.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		if ( ! open ) {
			closeAll();
		}
	}

	burger.addEventListener( 'click', function () {
		setDrawer( burger.getAttribute( 'aria-expanded' ) !== 'true' );
	} );

	items.forEach( function ( item ) {
		var toggle = item.querySelector( '.primary-nav__toggle' );
		if ( ! toggle ) {
			return;
		}
		toggle.addEventListener( 'click', function () {
			var open = ! item.classList.contains( 'is-open' );
			closeAll( item );
			item.classList.toggle( 'is-open', open );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );
	} );

	nav.addEventListener( 'click', function ( e ) {
		var btn = e.target.closest ? e.target.closest( '.mega__close' ) : null;
		if ( ! btn ) {
			return;
		}
		var item = btn.closest( '.has-mega' );
		closeAll();
		if ( item ) {
			item.classList.add( 'is-suppressed' );
			item.addEventListener( 'mouseleave', function once() {
				item.classList.remove( 'is-suppressed' );
				item.removeEventListener( 'mouseleave', once );
			} );
		}
		if ( document.activeElement && document.activeElement.blur ) {
			document.activeElement.blur();
		}
	} );

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' ) {
			closeAll();
			setDrawer( false );
		}
	} );

	document.addEventListener( 'click', function ( e ) {
		if ( ! nav.contains( e.target ) && ! burger.contains( e.target ) ) {
			closeAll();
		}
	} );
}() );
