// Range slider

(function ($) {
	function sliderHandlerFunc() {
		$(".slider-field").each(function () {
			let $thisPointer = $(this);
			let $slider = $thisPointer.find('.jquery-slider');
			let $name = $slider.data('name');
			$thisPointer.find($slider ).slider({
				min: $slider.data('min'),
				max: $slider.data('max'),
				step: 1,
				name: $slider.next().attr('name'),
				value: $slider.next().val(),
				slide: function (event, ui) {
					$thisPointer.find('.slider-result').text(ui.value + ' px.');
					$thisPointer.find('input').val(ui.value);
				}
			});
		});
	}
	$(document).ready(function () {
		sliderHandlerFunc();
	});
})(jQuery);