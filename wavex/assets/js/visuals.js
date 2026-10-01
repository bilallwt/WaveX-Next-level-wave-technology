/**
 * Plays the code-drawn technology visuals while they are on screen and replays them in a loop.
 */
( function () {
	'use strict';

	if ( ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var CYCLE = 11000;

	function setup( el ) {
		if ( el._visReady ) {
			return;
		}
		el._visReady = true;
		var timer = null;

		function play() {
			el.classList.remove( 'is-playing' );
			void el.offsetWidth; // Restart CSS animations.
			if ( ! reduce ) {
				el.classList.add( 'is-playing' );
			}
		}

		function loop() {
			play();
			if ( reduce ) {
				return;
			}
			timer = window.setTimeout( loop, CYCLE );
		}

		new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					if ( ! timer ) {
						loop();
					}
				} else if ( timer ) {
					window.clearTimeout( timer );
					timer = null;
				}
			} );
		}, { threshold: 0.2 } ).observe( el );
	}

	window.wavexVisualsInit = function ( scope ) {
		Array.prototype.forEach.call( ( scope || document ).querySelectorAll( '[data-vis]' ), setup );
	};
	window.wavexVisualsInit( document );
}() );
