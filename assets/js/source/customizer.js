/*
** Scripts within the customizer controls window.
*/

(function( $ ) {
	wp.customize.bind( 'ready', function() {

/*		function aesthetix_sortable( id ) {
			console.log( id );
			var items = [];
			$('.sortable-list').find( 'li.visible' ).each(function() {
				items.push( $( this ).text().trim() );
			});
			$('.sortable-list').next().val( JSON.stringify( items ) ).trigger( 'change' );
		}

		$('.sortable-list').sortable({
			update: aesthetix_sortable( $( this ) ),
		});
*/

		$('.sortable-list').sortable({
			update: function(event, ui) {
				var items = [];
				$(this).find( 'li.visible' ).each(function() {
					items.push( $(this).data( 'key' ).trim() );
				});
				$(this).next().val( items.join(',') ).trigger( 'change' );
			}
		});

		$( '.dashicons-visibility' ).on( 'click', function( e ) {
			var items = [];
				_this = $( this );
			_this.toggleClass( 'visible invisible' );
			_this.parent().toggleClass( 'visible invisible' );
			_this.closest( '.sortable-list' ).find( 'li.visible' ).each(function() {
				items.push( $(this).data( 'key' ).trim() );
			});
			_this.closest( '.sortable-list' ).next().val( items.join(',') ).trigger( 'change' );
		} );

		// Label.
		function aesthetix_customizer_title( id, title ) {

			if ( id === 'custom_logo' || id === 'site_icon' || id === 'background_image' ) {
				$( '#customize-control-' + id ).before( '<li class="tab-title customize-control">' + title + '</li>' );
			} else {
				$( '#customize-control-aesthetix_options-' + id ).before( '<li class="tab-title customize-control">' + title + '</li>' );
			}
			
		}

		// Checkbox lock section.
		function aesthetix_customizer_checkbox_lock_section( id ) {

			var id = '#customize-control-aesthetix_options-' + id;

			$( id ).addClass( 'tab-title' );

			// On change.
			$( id ).find( 'input[type="checkbox"]' ).change(function() {
				if ( $(this).is( ':checked' ) ) {
					$(this).closest( 'li' ).nextUntil( '.tab-title' ).not( '.section-meta, .tab-title' + id ).find( '.control-lock' ).remove();
				} else {
					$(this).closest( 'li' ).nextUntil( '.tab-title' ).not( '.section-meta, .tab-title' + id ).append( '<div class="control-lock"></div>' );
				}
			});

			// On load.
			if ( ! $( id ).find( 'input[type="checkbox"]' ).is( ':checked' ) ) {
				$( id ).closest( 'li' ).nextUntil( '.tab-title' ).not( '.section-meta, .tab-title' + id ).append( '<div class="control-lock"></div>' );
			}

		}

		// Checkbox lock next.
		function aesthetix_customizer_checkbox_lock_next( id ) {

			var id = '#customize-control-aesthetix_options-' + id;

			// On change.
			$( id ).find( 'input[type="checkbox"]' ).change(function() {
				if ( $(this).is( ':checked' ) ) {
					$(this).closest( 'li' ).next().not( '.section-meta, .tab-title' + id ).append( '<div class="control-lock"></div>' );
				} else {
					$(this).closest( 'li' ).next().not( '.section-meta, .tab-title' + id ).find( '.control-lock' ).remove();
				}
			});

			// On load.
			if ( $( id ).find( 'input[type="checkbox"]' ).is( ':checked' ) ) {
				$( id ).closest( 'li' ).next().not( '.section-meta, .tab-title' + id ).append( '<div class="control-lock"></div>' );
			}

		}

		// Checkbox lock.
		function aesthetix_customizer_checkbox_lock( id, title, count ) {

			var id = '#customize-control-aesthetix_options-' + id;
			var cnt = count;
			var sect = title;

			if ( sect === true ) {
				$( id ).addClass( 'customize-control-label' );
			}

			// On change.
			$( id ).find( 'input[type="checkbox"]' ).change(function() {
				if ( $(this).is( ':checked' ) ) {
					$(this).closest( 'li' ).nextAll().slice( 0, + cnt ).find( '.control-lock' ).remove();
				} else {
					$(this).closest( 'li' ).nextAll().slice( 0, + cnt ).append( '<div class="control-lock"></div>' );
				}
			});

			// On load.
			if ( ! $( id ).find( 'input[type="checkbox"]' ).is( ':checked' ) ) {
				$( id ).closest( 'li' ).nextAll().slice( 0, + cnt ).append( '<div class="control-lock"></div>' );
			}

		}

		aesthetix_customizer_checkbox_lock( 'general_breadcrumbs_display', true, 1 );
		aesthetix_customizer_checkbox_lock( 'general_scroll_top_display', true, 1 );
		aesthetix_customizer_checkbox_lock( 'single_post_meta_display', true, 5 );
		aesthetix_customizer_checkbox_lock( 'single_post_entry_footer_display', true, 3 );
		aesthetix_customizer_checkbox_lock( 'archive_page_meta_display', true, 7 );
		aesthetix_customizer_checkbox_lock( 'archive_page_detail', true, 2 );

	});
})( jQuery );
