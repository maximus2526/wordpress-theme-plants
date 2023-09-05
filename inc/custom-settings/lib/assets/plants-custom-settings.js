			// Range slider
			const $ = jQuery;

			$(document).ready(() => {
				$("#container-slider").slider( {
					min: 1024, // min value.
					max: 2000, // max value.
					step: 1,
					name: 'plants_options[global_container]',
					value: 1024, // default value of slider.
					slide : function(event, ui) {    
							$("#container-slider-result").text(ui.value + ' px.');    
							$("#container-value-input").val(ui.value);    
					}
				});
				$("#container-slider" ).text($( "#container-slider" ).slider( "container-slider-result" ));  
				$("#container-value-input").val($("#container-slider").slider("value"));  
			}); 