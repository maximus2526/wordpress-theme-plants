
const swiper = new Swiper(
	'.swiper',
	{
		// If we need pagination
		pagination: {
			el: '.swiper-pagination',
		},

		// Navigation arrows
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},

		spaceBetween: 100,

		breakpoints: {
			768: {
				slidesPerView: 'auto',
				spaceBetween: 8
			},
			991: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			1192: {
				slidesPerView: 5,
				spaceBetween: 20
			}
		}
	}
);

const swiper_banner = new Swiper(
	'.swiper-banner',
	{
		slidesPerView: 1,
		loop: true,
	}
);

(function ($) {
	function hamburgerFunc() {
		$(".menu-hamburger-img").on('click', function () {
			$('body').fadeIn('slow');
			$(".hamburger-menu").addClass("active").slideDown({
				duration: 'slow',
				easing: 'linear'
			});
		});

		$(".close-btn").on('click', function () {
			$(".hamburger-menu").removeClass("active");
		});
	}

	function dropdownFunc() {
		// Dropdown 
		let nav_item = $(".menus-item-dropdown-section").data('id');

		$('.menus-item-dropdown-section').on('mouseenter', function () {
			$(this).stop().slideDown();
		}).on('mouseleave', function () {
			$(this).stop().slideUp();
		});

		$('#menu-item-' + nav_item).on('mouseenter', function () {
			$('.menus-item-dropdown-section').stop().slideDown('fast');
		}).on('mouseleave', function () {
			$('.menus-item-dropdown-section').stop().slideUp();
		});


		// Dropdown icon
		$('#menu-item-' + nav_item + ' a').addClass('dropdown-icon');
	}

	$(document).ready(function () {
		hamburgerFunc();
		dropdownFunc();
	});
})(jQuery);
