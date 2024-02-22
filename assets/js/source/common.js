$ = jQuery;

$( document ).ready( function() {

	if ( $( '.search-form' ).length > 0 ) {
		$( '.search-form' ).each( function() {
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

	$( 'body' ).on( 'click', '.dropdown-button', function( e ) {

		$( this ).toggleClass( 'on' );
		$( this ).next( '.dropdown-content' ).toggleClass( 'on' );

		e.preventDefault();
	} );

	$( '.menu-open' ).on( 'click', function() {
		$( '#aside-menu' ).addClass( 'on' );
	} );

	$( '.menu-close' ).on( 'click', function() {
		$( this ).closest( '.aside' ).removeClass( 'on' );
	} );

	$( '.scroll-top' ).on( 'click', function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 800 );
		return false;
	} );

	$( 'body' ).on( 'click', '.notification-button', function( e ) {
		$( this ).closest( '.notification' ).remove();
	} );
} );

$( window ).on( 'load', function() {
	headerMobileButtons();
	initStickySidebar();
	initCookieAcceper();
	notificationButton();
} );

$( window ).on( 'resize', function() {
	headerMobileButtons();
	initStickySidebar();
} );

$( window ).on( 'scroll', function() {
	if ( $( this ).scrollTop() >= 800 ) {
		$( '.scroll-top-wrap' ).fadeIn( 350 );
	} else {
		$( '.scroll-top-wrap' ).fadeOut( 350 );
	}
} );

// Notification Button.
function notificationButton() {

	var notification = $( '.notification' );

	if ( notification.length > 0 ) {
		notification.each( function() {
			$( this ).prepend( '<span class="notification-button-wrap"><button class="notification-button button-icon-reset button-reset icon icon-md icon-reset icon-xmark" type="button"></button></span>' );
		} );
	}
}

// Sticky Sidebar.
function initStickySidebar() {

	var sidebar = $( '.sidebar-main' );

	if ( sidebar.hasClass( 'sidebar-stuck' ) ) {

		var sidebarOffset = 10;

		if ( $( '#wpadminbar' ).length > 0 ) {
			sidebarOffset = 40;
		}

		sidebar.stick_in_parent( {
			parent: '#section-content',
			offset_top: sidebarOffset,
		} );

		if ( $( this ).width() < 992 ) {
			sidebar.trigger( 'sticky_kit:detach' );
		}
	}
}

// Cookie.
function initCookieAcceper() {

	var cookieAccepter = $( '#cookie' );

	if ( cookieAccepter.length === 1 ) {

		var button = cookieAccepter.find( '.cookie-button' );

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

// Header Mobile Buttons.
// TODO Переделать
function headerMobileButtons() {

	var sumWidth = 0;

	$( '.widgets-header-mobile-right .widget' ).each( function() {
		sumWidth += $( this ).width();
	} );

	if ( sumWidth > $( '.widgets-header-mobile-right' ).width() ) {
		$( '.widgets-header-mobile-right .button' ).each( function() {
			$( this ).addClass( 'button-icon' ).removeClass( 'icon-before' ).empty();
		} );
	}
}
