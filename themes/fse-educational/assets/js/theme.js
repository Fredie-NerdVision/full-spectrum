/* global window, document */
(function () {
	'use strict';

	var header = document.getElementById( 'site-header' );
	var nav = document.getElementById( 'primary-nav' );
	var toggle = document.querySelector( '.nav-toggle' );

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var open = nav.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );

		nav.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( 'a' ) ) {
				nav.classList.remove( 'is-open' );
				toggle.setAttribute( 'aria-expanded', 'false' );
			}
		} );
	}

	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-stuck', window.scrollY > 12 );
		};

		onScroll();
		window.addEventListener( 'scroll', onScroll, { passive: true } );
	}

	var sections = Array.prototype.slice.call( document.querySelectorAll( '.services[id], .credentials[id], .contact[id]' ) );
	var links = Array.prototype.slice.call( document.querySelectorAll( '.site-nav__list a[href*="#"]' ) );

	if ( ! sections.length || ! links.length || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	var observer = new window.IntersectionObserver(
		function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( ! entry.isIntersecting ) {
					return;
				}

				links.forEach( function ( link ) {
					var parent = link.parentElement;
					var matches = link.hash === '#' + entry.target.id;

					if ( parent ) {
						parent.classList.toggle( 'is-active', matches );
					}
				} );
			} );
		},
		{ rootMargin: '-45% 0px -50% 0px' }
	);

	sections.forEach( function ( section ) {
		observer.observe( section );
	} );
})();
