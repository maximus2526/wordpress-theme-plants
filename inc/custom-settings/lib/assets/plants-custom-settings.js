// Range slider
const $ = jQuery;

$(document).ready(() => {
	$(".slider-field").each(function () {
		let this_pointer = $(this);
		let name = this_pointer.find('.jquery-slider').data('name');
		this_pointer.find('.jquery-slider').slider({
			min: this_pointer.find('.jquery-slider').data('min'), 
			max: this_pointer.find('.jquery-slider').data('max'), 
			step: 1,
			name: 'plants_options[' + name + ']', 
			value: $("input[name='plants_options[" + name + "]']").val(),
			slide: function (event, ui) {
				this_pointer.find('.slider-result').text(ui.value + ' px.');
				this_pointer.find('input').val(ui.value);
			}
		});
	});
});

