/**
 * WaveX Studio: service navigator, typed example code, restartable scene animations
 * and the interactive WordPress block demo.
 */
( function () {
	'use strict';

	function initStudio( root ) {

	var tabs = Array.prototype.slice.call( root.querySelectorAll( '.studio__tab' ) );
	var panels = Array.prototype.slice.call( root.querySelectorAll( '.studio__panel' ) );
	var pills = Array.prototype.slice.call( root.querySelectorAll( '.sx__pill' ) );
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var SLIDE = 10000;
	var REPLAY = 11500; // Restart the same scene when it has finished.
	var replayTimer = null;
	var typer = null;
	var auto = null;
	var userTouched = false;
	var visible = false;
	var started = false;
	var current = 0;

	/* ---------- WordPress drag-and-drop demo ---------- */
	function initWp( demo ) {
		var stage = demo.parentNode;
		var canvas = demo.querySelector( '[data-wp-canvas]' );
		var ghost = demo.querySelector( '[data-wp-ghost]' );
		var cursor = demo.querySelector( '[data-wp-cursor]' );
		var done = demo.querySelector( '[data-wp-done]' );
		var chips = demo.querySelectorAll( '[data-block]' );
		var timers = [];
		var touched = false;
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
			touched = false;
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
				touched = true;
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
				touched = true;
				cancelAuto();
				addBlock( chip.getAttribute( 'data-block' ) );
			} );
		} );

		demo.querySelector( '[data-wp-reset]' ).addEventListener( 'click', function () {
			touched = false;
			reset();
		} );
		demo.querySelector( '[data-wp-publish]' ).addEventListener( 'click', function () {
			touched = true;
			cancelAuto();
			publish();
		} );

		return { run: runAuto, stop: cancelAuto, isTouched: function () { return touched; } };
	}

	var wpApi = null;
	panels.forEach( function ( panel ) {
		var demo = panel.querySelector( '[data-wp-demo]' );
		if ( demo ) {
			wpApi = initWp( demo );
			panel._wp = wpApi;
		}
	} );

	function esc( s ) {
		return s.replace( /&/g, '&amp;' ).replace( /</g, '&lt;' ).replace( />/g, '&gt;' );
	}

	// Small highlighter for one line (also works on partially typed text).
	function highlightLine( text ) {
		var re = /(\/\/.*|\/\*[\s\S]*?(?:\*\/|$)|&lt;!--[\s\S]*?(?:--&gt;|$))|("[^"\n]*"?|'[^'\n]*'?)|\b(const|function|return|await|if|export|default|new)\b|(&lt;\/?[a-zA-Z][\w-]*)/g;
		return esc( text ).replace( re, function ( m, c, s, k ) {
			if ( c ) { return '<span class="tk-c">' + m + '</span>'; }
			if ( s ) { return '<span class="tk-s">' + m + '</span>'; }
			if ( k ) { return '<span class="tk-p">' + m + '</span>'; }
			return '<span class="tk-v">' + m + '</span>';
		} );
	}

	// Whole code block as one block-level span per line; the line being typed glows.
	function renderCode( text, typing ) {
		var lines = text.split( '\n' );
		return lines.map( function ( line, i ) {
			var cur = typing && i === lines.length - 1;
			return '<span class="cl' + ( cur ? ' is-cur' : '' ) + '">' + ( highlightLine( line ) || '&nbsp;' ) + ( cur ? '<span class="studio__caret"></span>' : '' ) + '</span>';
		} ).join( '' );
	}

	function stopTyping() {
		if ( typer ) {
			window.clearTimeout( typer );
			typer = null;
		}
	}

	var SPEED = 20; // ms per typed character.
	var FLIGHT = 0.75; // seconds a spark takes to reach the stage.
	var CAST = '.mk-pop, .mk-note, .mk-bars i, .mk-mkt__chart i, .mk-maint__list b';

	// A glowing spark that flies from the code to a piece of the stage.
	function spark( panel, fromX, fromY, target, delay ) {
		if ( ! target || ! target.getBoundingClientRect || ! panel.animate ) {
			return;
		}
		var pr = panel.getBoundingClientRect();
		var tr = target.getBoundingClientRect();
		var x1 = fromX - pr.left;
		var y1 = fromY - pr.top;
		var x2 = tr.left + tr.width / 2 - pr.left;
		var y2 = tr.top + Math.min( tr.height / 2, 40 ) - pr.top;
		var lift = Math.max( 40, Math.abs( x2 - x1 ) * 0.18 );
		var count = 5;
		for ( var n = 0; n < count; n++ ) {
			var dot = document.createElement( 'span' );
			dot.className = 'fx-spark';
			var size = 10 - n * 1.4;
			dot.style.width = size + 'px';
			dot.style.height = size + 'px';
			panel.appendChild( dot );
			var jitter = ( Math.random() - 0.5 ) * 14;
			var anim = dot.animate( [
				{ transform: 'translate(' + x1 + 'px,' + y1 + 'px) scale(.4)', opacity: 0 },
				{ transform: 'translate(' + ( x1 + ( x2 - x1 ) * 0.5 ) + 'px,' + ( Math.min( y1, y2 ) - lift + jitter ) + 'px) scale(1)', opacity: 1, offset: 0.5 },
				{ transform: 'translate(' + x2 + 'px,' + y2 + 'px) scale(.6)', opacity: 0.2 }
			], { duration: FLIGHT * 1000, delay: delay * 1000 + n * 60, easing: 'cubic-bezier(.4,.1,.3,1)', fill: 'both' } );
			anim.onfinish = ( function ( el ) {
				return function () { el.remove(); };
			}( dot ) );
		}
	}

	// Plan which piece of the stage each code line "casts", and when it appears.
	function plan( panel, lines ) {
		var stage = panel.querySelector( '.stage' );
		var items = [];
		if ( stage ) {
			Array.prototype.forEach.call( stage.querySelectorAll( CAST ), function ( el ) {
				if ( el.closest( '[data-wp-canvas]' ) ) {
					return;
				}
				if ( el._d0 === undefined ) {
					el._d0 = parseFloat( el.style.getPropertyValue( '--d' ) ) || 0;
				}
				items.push( el );
			} );
			items.sort( function ( a, b ) { return a._d0 - b._d0; } );
		}

		var ends = [];
		var total = 0;
		lines.forEach( function ( line, i ) {
			total += line.length + ( i < lines.length - 1 ? 1 : 0 );
			ends.push( total );
		} );

		var casts = lines.map( function () { return []; } );
		items.forEach( function ( el, idx ) {
			var k = Math.min( lines.length - 1, Math.floor( idx * lines.length / items.length ) );
			var t = ends[ k ] * SPEED / 1000 + FLIGHT;
			el.style.setProperty( '--d', t.toFixed( 2 ) + 's' );
			casts[ k ].push( el );
		} );
		return { ends: ends, casts: casts, stage: stage };
	}

	function typeCode( panel ) {
		var out = panel.querySelector( '.studio__code' );
		var lines;
		try {
			lines = JSON.parse( panel.getAttribute( 'data-code' ) || '[]' );
		} catch ( e ) {
			lines = [];
		}
		var full = lines.join( '\n' );
		var status = panel.querySelector( '.code__file' );
		if ( status && ! status.getAttribute( 'data-label' ) ) {
			status.setAttribute( 'data-label', status.textContent );
		}
		stopTyping();

		if ( reduce || ! lines.length ) {
			out.innerHTML = renderCode( full, false );
			return;
		}

		var info = plan( panel, lines );
		var nextLine = 0;
		var i = 0;
		if ( status ) {
			status.textContent = 'casting…';
		}
		if ( info.stage ) {
			info.stage.classList.remove( 'is-cast' );
		}

		( function tick() {
			i += 1;
			out.innerHTML = renderCode( full.slice( 0, i ), true );

			// A line has just been completed: send sparks to what it creates.
			while ( nextLine < lines.length && i >= info.ends[ nextLine ] ) {
				var lineEls = out.querySelectorAll( '.cl' );
				var lr = lineEls[ nextLine ] ? lineEls[ nextLine ].getBoundingClientRect() : out.getBoundingClientRect();
				var fx = Math.min( lr.right - 12, lr.left + 14 + lines[ nextLine ].length * 7.4 );
				var fy = lr.top + lr.height / 2;
				info.casts[ nextLine ].forEach( function ( el, n ) {
					spark( panel, fx, fy, el, n * 0.08 );
				} );
				if ( info.casts[ nextLine ].length && info.stage ) {
					window.setTimeout( function () {
						info.stage.classList.add( 'is-cast' );
					}, FLIGHT * 1000 );
				}
				nextLine += 1;
			}

			if ( i < full.length ) {
				typer = window.setTimeout( tick, SPEED );
			} else {
				out.innerHTML = renderCode( full, false );
				if ( status ) {
					window.setTimeout( function () {
						status.textContent = '\u2713 ' + 'done';
					}, FLIGHT * 1000 + 300 );
				}
			}
		}() );
	}

	function restart( panel ) {
		panel.classList.remove( 'is-playing' );
		Array.prototype.forEach.call( panel.querySelectorAll( '.fx-spark' ), function ( el ) { el.remove(); } );
		if ( reduce ) {
			typeCode( panel );
			return;
		}
		// Compute the casting plan first so delays are set before animations start.
		typeCode( panel );
		void panel.offsetWidth; // Restart CSS animations.
		panel.classList.add( 'is-playing' );
	}

	function setTiming( on ) {
		tabs.forEach( function ( tab, n ) {
			tab.classList.remove( 'is-timing' );
			if ( on && n === current ) {
				void tab.offsetWidth;
				tab.classList.add( 'is-timing' );
			}
		} );
	}

	function schedule() {
		if ( tabs.length < 2 ) {
			return;
		}
		if ( auto ) {
			window.clearTimeout( auto );
			auto = null;
		}
		if ( reduce || userTouched || ! visible ) {
			setTiming( false );
			return;
		}
		setTiming( true );
		auto = window.setTimeout( function () {
			show( current + 1, false );
		}, SLIDE );
	}

	function stopAuto() {
		userTouched = true;
		if ( auto ) {
			window.clearTimeout( auto );
			auto = null;
		}
		setTiming( false );
	}

	function keepInView( tab ) {
		var nav = tab.parentNode;
		if ( nav.scrollHeight > nav.clientHeight + 2 ) {
			nav.scrollTo( { top: tab.offsetTop - nav.clientHeight / 2 + tab.offsetHeight / 2, behavior: 'smooth' } );
		} else if ( nav.scrollWidth > nav.clientWidth + 2 ) {
			nav.scrollTo( { left: tab.offsetLeft - nav.clientWidth / 2 + tab.offsetWidth / 2, behavior: 'smooth' } );
		}
	}

	function scheduleReplay() {
		if ( replayTimer ) {
			window.clearTimeout( replayTimer );
			replayTimer = null;
		}
		if ( reduce ) {
			return;
		}
		replayTimer = window.setTimeout( function () {
			var panel = panels[ current ];
			// Only replay while on screen, and never over something the visitor is playing with.
			if ( visible && panel && ! ( panel._wp && panel._wp.isTouched() ) ) {
				restart( panel );
				if ( panel._wp ) {
					panel._wp.run();
				}
			}
			scheduleReplay();
		}, REPLAY );
	}

	function show( index, focus ) {
		var count = Math.max( tabs.length, 1 );
		current = ( index + count ) % count;
		var grp = tabs[ current ] ? tabs[ current ].getAttribute( 'data-group' ) : null;
		if ( grp ) {
			root.setAttribute( 'data-active-group', grp );
		}
		pills.forEach( function ( pill ) {
			pill.setAttribute( 'aria-pressed', pill.getAttribute( 'data-group' ) === grp ? 'true' : 'false' );
		} );
		tabs.forEach( function ( tab, n ) {
			var on = n === current;
			tab.setAttribute( 'aria-selected', on ? 'true' : 'false' );
			tab.setAttribute( 'tabindex', on ? '0' : '-1' );
			panels[ n ].hidden = ! on;
			if ( grp && ! root.hasAttribute( 'data-all-tabs' ) ) {
				tab.hidden = tab.getAttribute( 'data-group' ) !== grp;
			}
			if ( ! on && panels[ n ]._wp ) {
				panels[ n ]._wp.stop();
			}
		} );
		// Spell circle: show the chosen service in the core and cast a burst.
		if ( tabs[ current ] && root.querySelector( '[data-mg-name]' ) ) {
			var tabEl = tabs[ current ];
			var nameEl = root.querySelector( '[data-mg-name]' );
			var iconEl = root.querySelector( '[data-mg-icon]' );
			var grpEl = root.querySelector( '[data-mg-group]' );
			var label = tabEl.querySelector( '.studio__tab-label' );
			var icon = tabEl.querySelector( '.studio__tab-icon' );
			var gl = root.querySelector( '.sx__pill[data-group="' + grp + '"]' );
			if ( nameEl && label ) { nameEl.textContent = label.textContent; }
			if ( iconEl && icon ) { iconEl.innerHTML = icon.innerHTML; }
			if ( grpEl && gl ) { grpEl.textContent = gl.textContent.replace( /\d+\s*$/, '' ).trim(); }
			var circle = root.querySelector( '.mg__circle' );
			if ( circle && ! reduce ) {
				circle.classList.remove( 'is-cast' );
				void circle.offsetWidth;
				circle.classList.add( 'is-cast' );
			}
		}
		if ( focus && tabs[ current ] ) {
			tabs[ current ].focus();
		}
		if ( tabs[ current ] ) {
			keepInView( tabs[ current ] );
		}
		restart( panels[ current ] );
		if ( panels[ current ]._wp ) {
			panels[ current ]._wp.run();
		}
		schedule();
		scheduleReplay();
	}

	tabs.forEach( function ( tab, n ) {
		tab.addEventListener( 'click', function () {
			stopAuto();
			show( n, false );
		} );
		tab.addEventListener( 'keydown', function ( e ) {
			var next = null;
			if ( e.key === 'ArrowDown' || e.key === 'ArrowRight' ) { next = n + 1; }
			if ( e.key === 'ArrowUp' || e.key === 'ArrowLeft' ) { next = n - 1; }
			if ( e.key === 'Home' ) { next = 0; }
			if ( e.key === 'End' ) { next = tabs.length - 1; }
			if ( next !== null ) {
				e.preventDefault();
				stopAuto();
				show( next, true );
			}
		} );
	} );

	pills.forEach( function ( pill ) {
		pill.addEventListener( 'click', function () {
			var g = pill.getAttribute( 'data-group' );
			for ( var i = 0; i < tabs.length; i++ ) {
				if ( tabs[ i ].getAttribute( 'data-group' ) === g ) {
					stopAuto();
					show( i, false );
					return;
				}
			}
		} );
	} );

	root.addEventListener( 'pointerdown', stopAuto );

	// Play only while the section is on screen.
	if ( 'IntersectionObserver' in window ) {
		new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				visible = entry.isIntersecting;
				if ( visible && ! started ) {
					started = true;
					show( 0, false );
				} else {
					schedule();
				}
			} );
		}, { threshold: 0.2 } ).observe( root );
	} else {
		visible = true;
		show( 0, false );
	}
	}

	window.wavexStudioInit = function ( scope ) {
		Array.prototype.forEach.call( ( scope || document ).querySelectorAll( '[data-studio], [data-studio-single]' ), initStudio );
	};
	window.wavexStudioInit( document );
}() );
