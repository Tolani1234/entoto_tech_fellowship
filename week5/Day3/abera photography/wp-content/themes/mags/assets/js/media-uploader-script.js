jQuery( document ).ready( function ( $ ) {

	var custom_image_uploader,
		custom_video_uploader;

	// function for Image Uploader.
	jQuery('body').on( 'click', '.custom_image_upload', function (e) {
		var ei_this = jQuery( this ),
			image_input   = ei_this.parent().find( '.custom_media_input' ),
			media_preview = ei_this.parent().find( '.custom_media_preview' );

		e.preventDefault();

		// Creating the Media Modal.
		custom_image_uploader = wp.media( {
			title  : ei_this.data( 'title' ),
			button : {
				text : ei_this.data( 'update-btn' )
			},
			library : {
				type : 'image'
			}
		} );

		// running callback when image is selected
		custom_image_uploader.on( 'select', function () {
			// Get the attachment from the media modal.
			var attachment = custom_image_uploader.state().get( 'selection' ).first().toJSON();

			// input value update and preview change.
			image_input.val( attachment.url ).change();
			media_preview.find( 'img' ).remove();
			media_preview.append( '<img src="' + attachment.url + '" style="max-width:100%" alt="">' );
		} );

		// open the media modal.
		custom_image_uploader.open();
	} );


	// function for Video Uploader.
	jQuery('body').on( 'click', '.custom_video_upload', function (e) {
		var ev_this = jQuery( this ),
			video_input   = ev_this.parent().find( '.custom_media_input' );

		e.preventDefault();

		// Creating the Media Modal.
		custom_video_uploader = wp.media( {
			title  : ev_this.data( 'title' ),
			button : {
				text : ev_this.data( 'update-btn' )
			},
			library : {
				type : 'video'
			}
		} );

		// running callback when image is selected
		custom_video_uploader.on( 'select', function () {
			// Get the attachment from the media modal.
			var attachment = custom_video_uploader.state().get( 'selection' ).first().toJSON();

			// input value update.
			video_input.val( attachment.url ).change();
		} );

		// open the media modal.
		custom_video_uploader.open();
	} );


} );