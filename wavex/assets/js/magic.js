/**
 * WaveX "see how it works" demo: tabs, typed example code and restartable scene animations.
 */
( function () {
	'use strict';

	var root = document.querySelector( '[data-magic]' );
	if ( ! root ) {
		return;
	}

	var tabs = Array.prototype.slice.call( root.querySelectorAll( '[role="tab"]' ) );
	var panels = Array.prototype.slice.call( root.querySelectorAll( '[role="tabpanel"]' ) );
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var typer = null;
	var auto = null;
	var userTouched = false;
	var current = 0;

	function esc( s ) {
		return s.replace( /&/g, '&amp;' ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' );
	}

	// Very small highlighter that also works on partially typed text.
	function highlight( text ) {
		var re = /(\/\/.*|\/\*[\s\S]*?(?:\*\/|$)|&lt;!--[\s\S]*?(?:--&gt;|$))|("[^"\n]*"?|'[^'\n]*'?)|\b(const|function|return|await|if|export|default|new)\b|(&lt;\/?[a-zA-Z][\w-]*)/g;
		return esc( text ).replace( re, function ( m, c, s, k, t ) {
			if ( c ) { return '<span class="tk-c">' + m + '</span>'; }
			if ( s ) { return '<span class="tk-s">' + m + '</span>'; }
			if ( k ) { return '<span class="tk-p">' + m + '</span>'; }
			return '<span class="tk-v">' + m + '</span>';
		} );
	}

	function stopTyping() {
		if ( typer ) {
			window.clearTimeout( typer );
			typer = null;
		}
	}

	function typeCode( panel ) {
		var out = panel.querySelector( '.magic__code' );
		var lines;
		try {
			lines = JSON.parse( panel.getAttribute( 'data-code' ) || '[]' );
		} catch ( e ) {
			lines = [];
		}
		var full = lines.join( '\n' );
		stopTyping();

		if ( reduce ) {
			out.innerHTML = highlight( full );
			return;
		}

		var i = 0;
		( function tick() {
			i += 1;
			out.innerHTML = highlight( full.slice( 0, i ) ) + '<span class="magic__caret"></span>';
			if ( i < full.length ) {
				typer = window.setTimeout( tick, 22 );
			} else {
				out.innerHTML = highlight( full );
			}
		}() );
	}

	function restart( panel ) {
		panel.classList.remove( 'is-playing' );
		void panel.offsetWidth; // Restart CSS animations.
		if ( ! reduce ) {
			panel.classList.add( 'is-playing' );
		}
		typeCode( panel );
	}

	function show( index, focus ) {
		current = ( index + tabs.length ) % tabs.length;
		tabs.forEach( function ( tab, n ) {
			var on = n === current;
			tab.setAttribute( 'aria-selected', on ? 'true' : 'false' );
			tab.setAttribute( 'tabindex', on ? '0' : '-1' );
			panels[ n ].hidden = ! on;
		} );
		if ( focus ) {
			tabs[ current ].focus();
		}
		restart( panels[ current ] );
	}

	function startAuto() {
		if ( reduce || userTouched || auto ) {
			return;
		}
		auto = window.setInterval( function () {
			show( current + 1, false );
		}, 11000 );
	}

	function stopAuto() {
		userTouched = true;
		if ( auto ) {
			window.clearInterval( auto );
			auto = null;
		}
	}

	tabs.forEach( function ( tab, n ) {
		tab.addEventListener( 'click', function () {
			stopAuto();
			show( n, false );
		} );
		tab.addEventListener( 'keydown', function ( e ) {
			var next = null;
			if ( e.key === 'ArrowRight' ) { next = n + 1; }
			if ( e.key === 'ArrowLeft' ) { next = n - 1; }
			if ( e.key === 'Home' ) { next = 0; }
			if ( e.key === 'End' ) { next = tabs.length - 1; }
			if ( next !== null ) {
				e.preventDefault();
				stopAuto();
				show( next, true );
			}
		} );
	} );

	root.addEventListener( 'pointerdown', stopAuto );

	// Start the first scene (and autoplay) only when the section is on screen.
	if ( 'IntersectionObserver' in window ) {
		var seen = false;
		new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting && ! seen ) {
					seen = true;
					show( 0, false );
					startAuto();
				}
			} );
		}, { threshold: 0.25 } ).observe( root );
	} else {
		show( 0, false );
	}
}() );
