/**
 * Service guide: contents rail with scroll-spy and progress, and collapsible
 * section cards on small screens. Without JavaScript everything stays open.
 */
( function () {
	'use strict';

	function init( guide ) {
	if ( guide.getAttribute( 'data-ready' ) ) {
		return;
	}
	guide.setAttribute( 'data-ready', '1' );

	var mq = window.matchMedia( '(max-width: 900px)' );
	var links = Array.prototype.slice.call( guide.querySelectorAll( '[data-sg-link]' ) );
	var cards = Array.prototype.slice.call( guide.querySelectorAll( '[data-collapsible]' ) );
	var rail = guide.querySelector( '.sg__toc' );
	var prog = guide.querySelector( '.sg__prog' );
	var targets = links.map( function ( a ) {
		return document.getElementById( a.getAttribute( 'href' ).slice( 1 ) );
	} );

	function setOpen( card, open ) {
		var btn = card.querySelector( '.sc__toggle' );
		card.classList.toggle( 'is-collapsed', ! open );
		if ( btn ) {
			btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		}
	}

	function layout() {
		cards.forEach( function ( card, i ) {
			var btn = card.querySelector( '.sc__toggle' );
			if ( btn ) {
				btn.hidden = ! mq.matches;
			}
			setOpen( card, mq.matches ? i === 0 : true );
		} );
	}

	cards.forEach( function ( card ) {
		var head = card.querySelector( '.sc__head' );
		head.addEventListener( 'click', function () {
			if ( mq.matches ) {
				setOpen( card, card.classList.contains( 'is-collapsed' ) );
			}
		} );
	} );

	links.forEach( function ( a, i ) {
		a.addEventListener( 'click', function ( e ) {
			var target = targets[ i ];
			if ( ! target ) {
				return;
			}
			e.preventDefault();
			if ( target.hasAttribute( 'data-collapsible' ) ) {
				setOpen( target, true );
			}
			target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
			if ( window.history && window.history.replaceState ) {
				window.history.replaceState( null, '', a.getAttribute( 'href' ) );
			}
		} );
	} );

	var ticking = false;

	function update() {
		ticking = false;
		var current = 0;
		var line = ( mq.matches ? 130 : 150 );
		targets.forEach( function ( t, i ) {
			if ( t && t.getBoundingClientRect().top <= line ) {
				current = i;
			}
		} );
		links.forEach( function ( a, i ) {
			if ( i === current ) {
				a.setAttribute( 'aria-current', 'true' );
			} else {
				a.removeAttribute( 'aria-current' );
			}
		} );
		if ( mq.matches && rail && links[ current ] ) {
			var a = links[ current ];
			rail.scrollTo( { left: a.offsetLeft - rail.clientWidth / 2 + a.offsetWidth / 2, behavior: 'smooth' } );
		}
		if ( prog ) {
			var box = guide.getBoundingClientRect();
			var total = box.height - window.innerHeight * 0.6;
			var done = Math.min( 1, Math.max( 0, -box.top / Math.max( total, 1 ) ) );
			prog.style.setProperty( '--p', Math.round( done * 100 ) );
		}
	}

	window.addEventListener( 'scroll', function () {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( update );
		}
	}, { passive: true } );
	window.addEventListener( 'resize', function () {
		layout();
		update();
	} );

	layout();
	update();
	}

	window.wavexGuideInit = function ( scope ) {
		Array.prototype.forEach.call( ( scope || document ).querySelectorAll( '[data-guide]' ), init );
	};
	window.wavexGuideInit( document );
}() );
