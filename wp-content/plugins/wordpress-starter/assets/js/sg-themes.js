/*global ajaxurl*/
;(function( $ ) {
	$(document).ready(function() {
		let hash = window.location.hash.substr(1);

		if ( hash ) {
			$( '.sg-tab-' + hash )
				.addClass( 'sg-tabs_content--active' )
				.siblings()
					.removeClass( 'sg-tabs_content--active' );

			$( '.sg-tabs__tab' ).removeClass( 'sg-tabs__tab--active' );
			$( '[data-tab="' + hash + '"]' ).addClass( 'sg-tabs__tab--active' );
		}

		$('.sg-button-close').on( 'click', function (e) {
			e.preventDefault();

			$('.sg-modals').removeClass( 'visible' );
			$('.sg-dialog-wrapper').removeClass( 'visible' );
			$('.theme-preview-iframe').attr( 'src', '' );
			$('.sg-current-modal').removeClass('sg-current-modal');
			$('.sg-modals .sg-theme-install, .sg-modals .sg-recommended-theme-button').show();
		} )


		$('.filter-drawer .apply-filters').on( 'click', function (e) {
			let tags = filtersChecked();
			e.preventDefault();
			e.stopPropagation();

			let type = $( '.sg-tabs_content--active .sg-tab-content' ).data( 'tab-content' );

			$.post({
				type : "GET",
				url : ajaxurl,
				data : {
					action: "ajax_themes",
					type: type,
					tag: tags,
					elemendId: type,
				},
				success: function( response ) {
					console.log(response);
					$( '[data-tab-content=' + type + ']' ).html( response );
					preview()
				}
			})

			$('.filter-drawer').removeClass('visible');

		} )

		// $('.sg-tab-recommended').on('click', '.sg-recommended-theme-button', function (e) {
		// 	e.preventDefault();

		// 	$.post({
		// 		type : "POST",
		// 		url : 'https://wpwizardapi.siteground.com/installation',
		// 		data : {
		// 			"theme": $(this).data('id'),
		// 			"ip": '127.0.0.1'
		// 		},
		// 		success: function( apiData ) {
		// 			install( apiData, 0 )
		// 		}
		// 	})
		// })


		$( '.sg-tabs_content, .sg-modals' ).on( 'click', '.sg-recommended-theme-button', function (e) {
			e.preventDefault();
			e.stopPropagation();
			
			let id = $(this).data( 'id' );

			// $('.sg-modals .theme-preview-iframe').attr( 'src', previewUrl );
			$('.sg-modals').addClass( 'visible' );
			$('.sg-dialog-wrapper').removeClass('visible');
			$('.sg-dialog-confirmation').addClass( 'visible' );
			$('.sg-button-modal-install').data('id', id);
		})

		$( '.sg-modals' ).on('click', '.sg-button-modal-install', function (e) {
			e.preventDefault();
			let importSampleData = $(this).data('sample');

			$('.sg-dialog-confirmation').removeClass( 'visible' );
			$('.sg-dialog-progress').addClass( 'visible' );

			$.post({
				type : "POST",
				url : 'https://wpwizardapi.siteground.com/installation',
				data : {
					"theme": $(this).data('id'),
					"ip": '127.0.0.1'
				},
				success: function( apiData ) {
					if ( importSampleData == 1 ) {
						reset();
					}
					install( apiData, 0, importSampleData, 1 )
				}
			})
		})

		function install( data, index, sample, progress ) {
			if ( data[index] == undefined ) {
				return complete();
			}

			progress = progress + ( 100 / data.length ) - 2;

			$('.sg-progress__indicator').css('transform', 'translateX(-' + (100 - progress) + '%)');

			let endpoint = '/install/';

			let installationMessage = i18_strings.installing + ' ' + data[index]['name'];

			if ( 'sample-data' == data[index].type && sample == 0 ) {
				index++
				install( data, index, sample, progress );
			}


			if ( 'sample-data' == data[index].type && sample == 1 ) {
				installationMessage = i18_strings.importing_sample_data;
				endpoint = '/import-sample-data/';              
			}

			let statusData = {
				status: 'inprogress',
				installationPercent: Math.round(progress),
				installationMessage: installationMessage
			}

			$('.status-message').text( installationMessage );

			$.post({
				type : "POST",
				url : centralData.restNamespace + endpoint,
				data : data[index],
				headers: {
					'X-WP-Nonce': centralData.rest_nonce
				},
				success: function( response ) {
					index++;
					install( data, index, sample, progress )
				}
			})
		}

		$('.sg-modal-close').on( 'click', function (e) {
			e.preventDefault();
			$('.sg-modals').removeClass( 'visible' );
			$('.sg-dialog-wrapper').removeClass( 'visible' );
		} )

		$('.drawer-toggle').on('click', function (e) {
			e.preventDefault();
			$('.filter-drawer').toggleClass('visible');
		})

		preview()

		$( '.sg-tabs__tab' ).click( function( event ) {
			event.preventDefault();
			event.stopPropagation();
			changeTab( this )
		})

		$( '.sg-tabs_content' ).on( 'click', '.sg-theme-install', function (e) {
			e.preventDefault();
			e.stopPropagation();
			let button  = $(this);
			button.find( '.sg-button__content' ).text( i18_strings.installing );

			$.post({
				type : "POST",
				url : ajaxurl,
				data : {
					action: "install-theme",
					_ajax_nonce: button.data( 'nonce' ),
					slug: button.data( 'slug' ),
				},
				success: function( response ) {
					button.attr( 'href', response.data.activateUrl );
					button.find( '.sg-button__content' ).text( i18_strings.activate );
					button.addClass('sg-theme-activate').removeClass('sg-theme-install');
				}
			})
		})
		$( '.sg-modals' ).on( 'click', '.sg-theme-install', function (e) {
			e.preventDefault();
			e.stopPropagation();
			let button  = $(this);
			button.find( '.sg-button__content' ).text( i18_strings.installing );

			$.post({
				type : "POST",
				url : ajaxurl,
				data : {
					action: "install-theme",
					_ajax_nonce: button.data( 'nonce' ),
					slug: button.data( 'slug' ),
				},
				success: function( response ) {
					button.hide();
					button.find( '.sg-button__content' ).text( i18_strings.install );
					$('.sg-current-modal').attr( 'href', response.data.activateUrl );
					$('.sg-current-modal')
						.find( '.sg-button__content' )
						.text( i18_strings.activate );
					$('.sg-current-modal')
						.addClass('sg-theme-activate')
						.removeClass('sg-theme-install');
				}
			})
		})

		$( '.sg-tabs_content' ).on( 'click', '.sg-theme-activate', function (e) {
			e.preventDefault();
			e.stopPropagation();
			let button  = $(this);
			button.find( '.sg-button__content' ).text( i18_strings.activating );
			
			$.post({
				type : "POST",
				url : button.attr('href'),
				success: function( response ) {
					location.reload();
				}
			})
		})

		$( '.sg-button-load-more' ).on( 'click', function (e) {
			e.preventDefault();
			e.stopPropagation();

			$('.sg-load-more-section').addClass( 'visible' );
			let button  = $(this);
				page_id = $(this).attr( 'data-page' ) ;
				type    = $( '.sg-tabs_content--active .sg-tab-content' ).data( 'tab-content' );
				data = {
					action: "ajax_themes",
					page_id: page_id,
					type: type,
					elemendId: type,
				}

			if ( $('#s').val() ) {
				data.s = $( '#s' ).val();
				data.searchType = $( '#typeselector' ).val();
			}
			
			loadMoreThemes( data, button );
		})

		$('.sg-button-search').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			$('.sg-load-more-section').addClass( 'visible' );

			let tabId = 'default'
				button = $( '#' + tabId + ' .sg-button-load-more' );
				data = {
					action: "ajax_themes",
					page_id: 1,
					type: 'default',	
					elemendId: tabId,
					s: $('#s').val(),
					searchType: $( '#typeselector' ).val()
				}

			$( '[data-tab-content=' + tabId + ']' ).html('');

			loadMoreThemes( data, button );
			changeTab( $( '[data-tab="' + tabId + '"]' ) );
		})
	})

	function loadMoreThemes( data, element ) {
		$.post({
			type : "GET",
			url : ajaxurl,
			data : data,
			success: function( response ) {
				$('.sg-load-more-section').removeClass( 'visible' );
				$( '[data-tab-content=' + data.elemendId + ']' ).append( response );
				element
					.removeAttr( 'data-page' )
					.attr( 'data-page', ( parseInt( data.page_id ) + 1 ) );

				preview()
			}
		})
	}

	function changeTab( tab ) {
		$(tab)
			.addClass( 'sg-tabs__tab--active' )
			.siblings()
				.removeClass( 'sg-tabs__tab--active' );

		let contentId = $(tab).attr('data-tab');


		$( '.sg-tab-' + contentId )
			.addClass( 'sg-tabs_content--active' )
			.siblings()
				.removeClass( 'sg-tabs_content--active' );

		window.location.hash = contentId
	}

	function preview() {
		$('.theme-preview').on( 'click', function (e) {
			e.preventDefault()
			let installButton = $(this).parent().find('.sg-theme-install');
			let previewUrl = $(this).attr( 'href' );
			let id = $(this).parent().find('.sg-recommended-theme-button').data( 'id' );

			installButton.addClass('sg-current-modal');

			if( typeof(id) !== 'undefined' ) {
				$('.sg-modals .sg-theme-install').addClass( 'sg-recommended-theme-button' );
				$('.sg-modals .sg-recommended-theme-button')
					.data( 'id', id )
					.attr( 'data-id', id );
				$('.sg-modals .sg-theme-install').removeAttr( 'href' )
					.removeAttr( 'data-slug' )
					.removeAttr( 'data-nonce' );
			} else {
				let button = $(this).parent().find('.sg-theme-install');

				if ( installButton.length === 0 ){
					$('.sg-modals .sg-theme-install').hide();
				}

				$('.sg-modals .theme-preview-iframe').attr( 'src', previewUrl );
				$('.sg-modals .sg-theme-install').attr( 'href', button.attr('href') )
					.attr( 'data-slug', button.data('slug') )
					.attr( 'data-nonce', button.data('nonce') );
				$('.sg-modals .sg-recommended-theme-button')
					.removeAttr( 'data-id' )
					.removeClass( 'sg-recommended-theme-button' );
			}

			$('.sg-modals .theme-preview-iframe').attr( 'src', previewUrl );
			$('.sg-modals').addClass( 'visible' );
			$('.iframe-holder').addClass( 'visible' );
		} )
	}

	function reset() {
		$.post({
			type : "GET",
			url : centralData.restNamespace + '/reset/',
			headers: {
				'X-WP-Nonce': centralData.rest_nonce
			}
		})
	}
	function complete() {
		$.post({
			type : "POST",
			url : centralData.restNamespace + '/complete/',
			headers: {
				'X-WP-Nonce': centralData.rest_nonce
			}
		});

		$('.sg-dialog-wrapper').removeClass( 'visible' );
		$('.sg-dialog-success').addClass( 'visible' );
	}

	function filtersChecked() {
		var items = $( '.filter-group' ).find( ':checkbox' ),
			tags = [];

		_.each( items.filter( ':checked' ), function( item ) {
			tags.push( $( item ).prop( 'value' ) );
		});

		// When no filters are checked, restore initial state and return.
		if ( tags.length === 0 ) {
			$( '.filter-drawer .apply-filters' ).find( 'span' ).text( '' );
			$( '.filter-drawer .clear-filters' ).hide();
			$( 'body' ).removeClass( 'filters-applied' );
			return false;
		}

		$( '.filter-drawer .apply-filters' ).find( 'span' ).text( tags.length );
		$( '.filter-drawer .clear-filters' ).css( 'display', 'inline-block' );

		return tags;
	}
})( jQuery )
