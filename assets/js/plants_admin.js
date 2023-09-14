jQuery(function ($) { // TODO: deprecated -
	$('.upload_image_button').click(function () {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		wp.media.editor.send.attachment = function (props, attachment) {
			$(button).parent().prev().attr('src', attachment.url);
			$(button).prev().val(attachment.id);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}
		wp.media.editor.open(button);
		return false;
	});

	$(".media-toolbar .media-button-insert").on("click", function () {
		$('input[name="save_menu"]').trigger("click");
	});

	$('.remove_image_button').click(function () {
		var r = confirm("You sure?");
		if (r == true) {
			var src = $(this).parent().prev().attr('data-src');
			$(this).parent().prev().attr('src', src);
			$(this).prev().prev().val('');
			$(this).closest('form').submit();
		}
		return false;
	});
});