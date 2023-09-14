
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
		$("header .menus-item-dropdown-section").each(function () {
			let $this_pointer = $(this);
			let $nav_item = $this_pointer.data('id');
			let $menu_item = $('#menu-item-' + $nav_item);
			$menu_item.on('mouseenter', function () {
				$this_pointer.stop().slideDown('fast');
			}
			);
			$menu_item.on('mouseleave', function () {
				$this_pointer.stop().slideUp();
			}
			);
		});
	}



	$(document).ready(function () {
		hamburgerFunc();
		dropdownFunc();
	});
})(jQuery);
