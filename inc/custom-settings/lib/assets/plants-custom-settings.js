// Range slider
const $ = jQuery;

$(document).ready(() => {
	$(".jquery-slider").each(function () {
		$(this).slider({
			min: 1024, // min value.
			max: 2000, // max value.
			step: 1,
			name: 'plants_options[global_container]',
			value: $("input[name='plants_options[global_container]'").val(), // default value of slider.
			slide: function (event, ui) {
				$(".slider-result").text(ui.value + ' px.');
				$(".slider-field input").val(ui.value);
			}
		});
	})
}); 