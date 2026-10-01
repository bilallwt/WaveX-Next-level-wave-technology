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


	/* ---------- WordPress drag-and-drop demo ---------- */
	function initWp( demo ) {
		var stage = demo.parentNode;
		var canvas = demo.querySelector( '[data-wp-canvas]' );
		var ghost = demo.querySelector( '[data-wp-ghost]' );
		var cursor = demo.querySelector( '[data-wp-cursor]' );
		var done = demo.querySelector( '[data-wp-done]' );
		var chips = demo.querySelectorAll( '[data-block]' );
		var timers = [];
		var dragging = null;
		var moved = false;
		var MAX = 6;

		function later( fn, ms ) {
			timers.push( window.setTimeout( fn, ms ) );
		}

		function cancelAuto() {
			timers.forEach( window.clearTimeout );
			timers = [];
			ghost.hidden = true;
			cursor.hidden = true;
		}

		function html( type ) {
			var map = {
				heading: '<i class="mk-line" style="--w:55%;height:14px;background:#0f1b4d"></i>',
				image: '<i class="mk-ph"></i>',
				text: '<i class="mk-line" style="--w:92%"></i><i class="mk-line" style="--w:78%"></i><i class="mk-line" style="--w:60%"></i>',
				button: '<i class="mk-pill"></i>',
				gallery: '<i class="mk-gal"><b></b><b></b><b></b></i>'
			};
			return map[ type ] || '';
		}

		function addBlock( type, index ) {
			var empty = canvas.querySelector( '.mk-wpe__empty' );
			if ( empty ) {
				empty.remove();
			}
			var blocks = canvas.querySelectorAll( '.mk-blk' );
			if ( blocks.length >= MAX ) {
				return;
			}
			var el = document.createElement( 'div' );
			el.className = 'mk-blk mk-blk--' + type;
			el.innerHTML = html( type );
			if ( typeof index === 'number' && blocks[ index ] ) {
				canvas.insertBefore( el, blocks[ index ] );
			} else {
				canvas.appendChild( el );
			}
			done.hidden = true;
		}

		function reset() {
			cancelAuto();
			canvas.innerHTML = '<p class="mk-wpe__empty">' + canvas.getAttribute( 'data-empty' ) + '</p>';
			done.hidden = true;
		}
		canvas.setAttribute( 'data-empty', canvas.textContent.trim() );

		function publish() {
			if ( canvas.querySelector( '.mk-blk' ) ) {
				done.hidden = false;
			}
		}

		function rel( x, y ) {
			var r = stage.getBoundingClientRect();
			return { x: x - r.left, y: y - r.top };
		}

		function place( el, x, y, animate ) {
			el.style.transition = animate ? 'transform .9s cubic-bezier(.6,.05,.3,1)' : 'none';
			el.style.transform = 'translate(' + x + 'px,' + y + 'px)';
		}

		function autoStep( types, n ) {
			if ( n >= types.length ) {
				later( publish, 700 );
				return;
			}
			var chip = demo.querySelector( '[data-block="' + types[ n ] + '"]' );
			var cr = chip.getBoundingClientRect();
			var from = rel( cr.left + cr.width / 2, cr.top + cr.height / 2 );
			var kr = canvas.getBoundingClientRect();
			var count = canvas.querySelectorAll( '.mk-blk' ).length;
			var to = rel( kr.left + kr.width / 2, kr.top + 50 + count * 54 );

			ghost.textContent = chip.textContent;
			ghost.hidden = false;
			cursor.hidden = false;
			place( ghost, from.x - 40, from.y - 16, false );
			place( cursor, from.x, from.y, false );
			void ghost.offsetWidth;
			later( function () {
				place( ghost, to.x - 40, to.y - 16, true );
				place( cursor, to.x, to.y, true );
			}, 250 );
			later( function () {
				addBlock( types[ n ] );
				ghost.hidden = true;
			}, 1250 );
			later( function () {
				cursor.hidden = true;
				autoStep( types, n + 1 );
			}, 1750 );
		}

		function runAuto() {
			reset();
			if ( reduce ) {
				[ 'heading', 'image', 'button' ].forEach( function ( t ) { addBlock( t ); } );
				publish();
				return;
			}
			later( function () {
				autoStep( [ 'heading', 'image', 'text', 'button' ], 0 );
			}, 500 );
		}

		// Manual drag and drop (mouse, touch, pen).
		function indexAt( y ) {
			var blocks = canvas.querySelectorAll( '.mk-blk' );
			for ( var i = 0; i < blocks.length; i++ ) {
				var r = blocks[ i ].getBoundingClientRect();
				if ( y < r.top + r.height / 2 ) {
					return i;
				}
			}
			return blocks.length;
		}

		function overCanvas( x, y ) {
			var r = canvas.getBoundingClientRect();
			return x >= r.left && x <= r.right && y >= r.top && y <= r.bottom;
		}

		function onMove( e ) {
			if ( ! dragging ) {
				return;
			}
			if ( ! moved && Math.abs( e.clientX - dragging.x ) + Math.abs( e.clientY - dragging.y ) < 6 ) {
				return;
			}
			moved = true;
			var p = rel( e.clientX, e.clientY );
			ghost.hidden = false;
			ghost.textContent = dragging.label;
			place( ghost, p.x - 40, p.y - 16, false );
			canvas.classList.toggle( 'is-over', overCanvas( e.clientX, e.clientY ) );
		}

		function onUp( e ) {
			document.removeEventListener( 'pointermove', onMove );
			document.removeEventListener( 'pointerup', onUp );
			document.removeEventListener( 'pointercancel', onUp );
			canvas.classList.remove( 'is-over' );
			ghost.hidden = true;
			if ( dragging && moved && overCanvas( e.clientX, e.clientY ) ) {
				addBlock( dragging.type, indexAt( e.clientY ) );
			}
			dragging = null;
		}

		chips.forEach( function ( chip ) {
			chip.addEventListener( 'pointerdown', function ( e ) {
				if ( e.button !== 0 ) {
					return;
				}
				cancelAuto();
				moved = false;
				dragging = { type: chip.getAttribute( 'data-block' ), label: chip.textContent, x: e.clientX, y: e.clientY };
				document.addEventListener( 'pointermove', onMove );
				document.addEventListener( 'pointerup', onUp );
				document.addEventListener( 'pointercancel', onUp );
			} );
			chip.addEventListener( 'click', function () {
				if ( moved ) {
					moved = false;
					return;
				}
				cancelAuto();
				addBlock( chip.getAttribute( 'data-block' ) );
			} );
		} );

		demo.querySelector( '[data-wp-reset]' ).addEventListener( 'click', reset );
		demo.querySelector( '[data-wp-publish]' ).addEventListener( 'click', function () {
			cancelAuto();
			publish();
		} );

		return { run: runAuto, stop: cancelAuto };
	}

	var wpApi = null;
	panels.forEach( function ( panel ) {
		var demo = panel.querySelector( '[data-wp-demo]' );
		if ( demo ) {
			wpApi = initWp( demo );
			panel._wp = wpApi;
		}
	} );

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
		panels.forEach( function ( p ) {
			if ( p._wp && p !== panels[ current ] ) {
				p._wp.stop();
			}
		} );
		restart( panels[ current ] );
		if ( panels[ current ]._wp ) {
			panels[ current ]._wp.run();
		}
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
