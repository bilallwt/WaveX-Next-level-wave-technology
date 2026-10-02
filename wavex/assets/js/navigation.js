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

	// Footer link groups: always open on wide screens, accordion on small ones.
	var footCols = document.querySelectorAll( '.ft__col' );
	var wide = window.matchMedia( '(min-width: 801px)' );
	function syncFooter() {
		Array.prototype.forEach.call( footCols, function ( d ) {
			if ( wide.matches ) {
				d.open = true;
			} else if ( ! d.hasAttribute( 'data-seen' ) ) {
				d.open = false;
			}
			d.setAttribute( 'data-seen', '1' );
		} );
	}
	Array.prototype.forEach.call( footCols, function ( d ) {
		d.querySelector( 'summary' ).addEventListener( 'click', function ( e ) {
			if ( wide.matches ) {
				e.preventDefault();
			}
		} );
	} );
	syncFooter();
	window.addEventListener( 'resize', syncFooter );

	var items = nav.querySelectorAll( '.has-mega' );

	// Mega menu: hover or focus a category on the left to show its links on the right.
	Array.prototype.forEach.call( nav.querySelectorAll( '[data-mx]' ), function ( mx ) {
		var tabs = mx.querySelectorAll( '.mx2__tab' );
		var panes = mx.querySelectorAll( '.mx2__pane' );
		function activate( i ) {
			Array.prototype.forEach.call( tabs, function ( t, n ) {
				t.classList.toggle( 'is-active', n === i );
				t.setAttribute( 'aria-selected', n === i ? 'true' : 'false' );
			} );
			Array.prototype.forEach.call( panes, function ( p, n ) {
				p.classList.toggle( 'is-active', n === i );
			} );
		}
		Array.prototype.forEach.call( tabs, function ( t, n ) {
			[ 'mouseenter', 'focus', 'click' ].forEach( function ( ev ) {
				t.addEventListener( ev, function () { activate( n ); } );
			} );
		} );
		mx.setAttribute( 'data-ready', '1' );
		activate( 0 );
	} );

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

	var headerEl = document.getElementById( 'site-header' );

	function setDrawer( open ) {
		if ( open && headerEl ) {
			nav.style.setProperty( '--hh', Math.max( 0, Math.round( headerEl.getBoundingClientRect().bottom ) ) + 'px' );
		}
		nav.classList.toggle( 'is-open', open );
		document.body.classList.toggle( 'nav-open', open );
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

	// Close the drawer when a link inside it is used, or when the layout goes back to desktop.
	nav.addEventListener( 'click', function ( e ) {
		var link = e.target.closest ? e.target.closest( 'a[href]' ) : null;
		if ( link && nav.classList.contains( 'is-open' ) ) {
			setDrawer( false );
		}
	} );
	window.addEventListener( 'resize', function () {
		if ( window.innerWidth > 1024 && nav.classList.contains( 'is-open' ) ) {
			setDrawer( false );
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

	// Header shadow after scrolling.
	var header = document.getElementById( 'site-header' );
	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}
}() );
