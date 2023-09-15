
(function ($) {
	function openEditorFunc() {
		$('.upload_image_button').on("click", (function () {
			let frame;
			$button = $(this);
			frame = wp.media({
				title: 'Select or Upload Media For Menu Items',
				button: {
					text: 'Use this media'
			},
				multiple: false 
			});
			
			frame.on( 'select', function() {
				let $attachment = frame.state().get('selection').first().toJSON();
				$button.parent().find('input[type="hidden"]').val( $attachment.id );
				$button.parent().find('img').attr('src', $attachment.url);
		});
			
	  // Finally, open the modal on click
    frame.open();
			return false;
		}));
	}



	function removeImageFunc() {
		$('.remove_image_button').on("click", (function () {
			let r = confirm("You sure?");
			var thisPointer = $(this);
			if (r == true) {
				thisPointer.parent().find('input[type="hidden"]').val('');
				thisPointer.hide();
				thisPointer.parent().find('img').hide();
			}

			return false;
		}));
	}

	$(document).ready(function () {
		openEditorFunc();
		removeImageFunc();
	});
})(jQuery);