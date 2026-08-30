(function () {
	'use strict';

	var header = document.getElementById( 'site-header' );
	var nav = document.getElementById( 'primary-nav' );
	var toggle = document.querySelector( '.nav-toggle' );

	if ( toggle && nav ) {
		toggle.addEventListener(
			'click',
			function () {
				var open = nav.classList.toggle( 'is-open' );
				toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			}
		);

		nav.addEventListener(
			'click',
			function ( event ) {
				if ( event.target.closest( 'a' ) ) {
					nav.classList.remove( 'is-open' );
					toggle.setAttribute( 'aria-expanded', 'false' );
				}
			}
		);
	}

	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-stuck', window.scrollY > 12 );
		};

		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	// Highlight the nav item for the section currently on screen.
	var links = Array.prototype.slice.call( document.querySelectorAll( '.site-nav__list a[href*="#"]' ) );

	if ( links.length && 'IntersectionObserver' in window ) {
		var byId = {};

		links.forEach(
			function ( link ) {
				var id = link.href.split( '#' )[1];

				if ( id && document.getElementById( id ) ) {
					byId[ id ] = link.parentElement;
				}
			}
		);

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach(
					function ( entry ) {
						var item = byId[ entry.target.id ];

						if ( item ) {
							item.classList.toggle( 'is-active', entry.isIntersecting );
						}
					}
				);
			},
			{ rootMargin: '-45% 0px -50% 0px' }
		);

		Object.keys( byId ).forEach(
			function ( id ) {
				observer.observe( document.getElementById( id ) );
			}
		);
	}
}());
