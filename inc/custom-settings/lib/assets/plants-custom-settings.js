// Range slider
const $ = jQuery;

$(document).ready(() => {
	$(".jquery-slider").each(function () {
		let prefix = $(this).data('prefix'); // ДИВИСЬ ПРО $(this)!
		let name =  $(this)(".value-changer input").data('name');
		alert (name);
		$(this).slider({
			min: $("#" + prefix + "-slider-field input").data('min'), // min value.
			max: $("#" + prefix + "-slider-field input").data('max'), // max value.
			step: 1,
			name: 'plants_options[' + name + ']',
			value: $("input[name='plants_options[" + name + "]'").val(), // default value of slider.
			slide: function (event, ui) {
				$("#" + prefix + "-slider-result").text(ui.value + ' px.');
				$("#" + prefix + "-slider-field input").val(ui.value);
			}
		});
	})
}); 