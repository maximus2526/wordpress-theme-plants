
(function ($) {
	function openEditorFunc() {
		$('.upload_image_button').on("click", (function () {
			let $frame;
			$button = $(this);
			$frame = wp.media({
				title: 'Select or Upload Media For Menu Items',
				button: {
					text: 'Use this media'
				},
				multiple: false
			});

			$frame.open();

			$frame.on('select', function () {
				let $attachment = $frame.state().get('selection').first().toJSON();
				let $attachmentImg = $button.parent().find('img');
				$button.parent().find('input[type="hidden"]').val($attachment.id);
				if ( $attachmentImg.length > 0 ) {
					$attachmentImg.removeAttr('srcset').attr('src', $attachment.url);
				} else {
					let $image = new Image();
					$image.height = 50;
					$image.width = 50;
					$image.src = $attachment.url;
					$button.parent().prepend($image).show();
					$button.parent().find('.remove_image_button').show();
				}
			});
			return false;
		}));
	}



	function removeImageFunc() {
		$('.remove_image_button').on("click", (function () {
			let $r = confirm("You sure?");
			var $thisPointer = $(this);
			if ($r == true) {
				$thisPointer.parent().find('input[type="hidden"]').val('');
				$thisPointer.hide();
				$thisPointer.parent().find('img').remove();
			}
			return false;
		}));
		
	}
	
		


	$(document).ready(function () {
		openEditorFunc();
		removeImageFunc();
	});
})(jQuery);