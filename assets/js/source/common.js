jQuery( document ).ready( function( $ ) {

	var searchForm = $( '.search-form' );

	if ( searchForm.length > 0 ) {
		searchForm.each( function() {
			var width = $( this ).find( '.search-submit' ).outerWidth();
			$( this ).find( '.search-field' ).css( 'padding-right', width );
		} );
	}

	$( 'body' ).on( 'click', '.toggle-icon', function( e ) {

		var on  = $( this ).data( 'icon-on' );
			off = $( this ).data( 'icon-off' );

		if ( $( this ).hasClass( off ) ) {
			$( this ).removeClass( off ).addClass( on );
		} else if ( $( this ).hasClass( on ) ) {
			$( this ).removeClass( on ).addClass( off );
		}

		e.preventDefault();
	} );

	$( '.scroll-top' ).on( 'click', function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 800 );
		return false;
	} );

	$( '.menu-open' ).on( 'click', function() {
		$( '#aside-menu' ).addClass( 'on' );
	} );

	$( '.menu-close' ).on( 'click', function() {
		$( this ).closest( '.aside' ).removeClass( 'on' );
	} );

	$( window ).on( 'scroll', function() {
		if ( $( this ).scrollTop() >= 800 ) {
			$( '.scroll-top-wrap' ).fadeIn( 350 );
		} else {
			$( '.scroll-top-wrap' ).fadeOut( 350 );
		}
	});

	$( 'body' ).on( 'click', '.notification-button-wrap', function( e ) {
		$( this ).parent().remove();
	} );

	window.notificationButton = function() {
		var notification = $( '.notification' );
		if ( notification.length > 0 ) {
			notification.each( function() {
				$( this ).prepend( '<span class="notification-button-wrap"><button class="button button-icon button-none button-sm notification-button icon icon-center icon_xmark" type="button"></button></span>' );
			});
		}
	}

	notificationButton();

	function initMainNavigation( menuContainer ) {

		var menuToggle     = menuContainer.find( '.menu-toggle' );
			header         = menuContainer.find( '.header' );

		menuToggle.click( function() {
			$( this ).add( mainNavigation ).toggleClass( 'on' );
			header.toggleClass( 'header_expanded' );
		} );

		// Init dropdown toggle for sub menu.
		var dropdownToggle = $( '<button />', {
			'class': 'sub-menu-toggle toggle-icon button button-icon button-none button-xs icon icon-center icon-angle-down',
			'aria-expanded': false,
			'data-icon-on': 'icon-angle-up',
			'data-icon-off': 'icon-angle-down',
		} );

		var subMenu = menuContainer.find( '.sub-menu' );

		// subMenu.before( dropdownToggle );
		subMenu.attr( 'aria-expanded', 'false' );
		dropdownToggle.attr( 'aria-haspopup', 'true' );
		dropdownToggle.attr( 'aria-expanded', 'false' );

		menuContainer.find( '.sub-menu-toggle' ).click( function() {
			$( this ).toggleClass( 'on' );
			// $( this ).next( '.sub-menu' ).slideToggle( 'fast' );
			$( this ).closest( '.menu-item-has-children' ).find( '.sub-menu' ).toggleClass( 'on' );
			$( this ).closest( '.menu-item-has-children' ).find( '.sub-menu' ).attr( 'aria-expanded', $( this ).next( '.sub-menu'  ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			$( this ).attr( 'aria-expanded', $( this ).closest( '.menu-item-has-children' ).find( '.sub-menu'  ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		} );

		function onResizeMainMenu() {
			if ( $( window ).width() < 992 || menuContainer.hasClass( 'main-menu_type-close' )) {
				// menuToggle.attr( 'aria-expanded', 'false' );
				// menuContainer.addClass( 'main-menu_burgered' );
			} else {
				// menuToggle.attr( 'aria-expanded', 'true' );
				// menuContainer.removeClass( 'main-menu_burgered' );
			}
		}

		// Initial state.
		onResizeMainMenu();

		// On resize main menu.
		$( window ).on('resize', onResizeMainMenu);

	}

	initMainNavigation( $( '.menu-wrap' ) );

	function initCookieAcceper( cookieAccepter ) {
		var button = cookieAccepter.find( '.cookie-button' );

		if ( cookieAccepter.length === 1 ) {
			if ( null === localStorage.getItem( 'cookieAccept' ) || 'off' === localStorage.getItem( 'cookieAccept' ) ) {

				cookieAccepter.css( 'display', 'block' );

				button.on( 'click', function() {
					localStorage.setItem( 'cookieAccept', 'on' );
					cookieAccepter.css( 'display', 'none' );
				});
			}
		} else {
			if ( 'on' === localStorage.getItem( 'cookieAccept' ) ) {
				localStorage.setItem( 'cookieAccept', 'off' );
			}
		}
	}

	initCookieAcceper( $( '#cookie' ) );

	// Find all YouTube videos.
/*	var $allVideos = $("iframe[src^='https://www.youtube.com']"),

	// The element that is fluid width.
	$fluidEl = $("body");

	// Figure out and save aspect ratio for each video.
	$allVideos.each(function() {
		$(this)
			data('aspectRatio', this.height / this.width)
			// and remove the hard coded width/height
			removeAttr('height')
			removeAttr('width')

			wrap('<div class="video-container"></div>');
	});

	// When the window is resized.
	$(window).resize(function() {
		var newWidth = $fluidEl.width();
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {
			var $el = $(this);
			$el
				width(newWidth)
				height(newWidth * $el.data('aspectRatio'));
		});
	// Kick off one resize to fix all videos on page load.
	}).resize();*/
});