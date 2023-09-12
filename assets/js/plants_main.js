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

// Hamburger

const $ = jQuery;

$(document).ready(() => {
	$(".menu-hamburger-img").click(() => {
		$('body').fadeIn('slow');
		$(".hamburger-menu").addClass("active").slideDown({
			duration: 'slow',
			easing: 'linear'
		});
	});

	$(".close-btn").click(() => {
		$(".hamburger-menu").removeClass("active");
	});

	// Dropdown 
	let nav_item = $(".menus-item-dropdown-section").data('id');

	$('.menus-item-dropdown-section').on('mouseenter', function () {
		$(this).stop().slideDown();
	}).on('mouseleave', function () {
		$(this).stop().slideUp();
	});

	$('#menu-item-' + nav_item).hover(
		function () {
			$('.menus-item-dropdown-section').stop().slideDown('fast');
		},
		function () {
			$('.menus-item-dropdown-section').stop().slideUp();
		}
	);
	
// Dropdown icon
var img = $('<img>', {
	src: '/wp-content/themes/wordpress-theme-plants/assets/img/svg/dropdown-icons/icon.svg',
	alt: 'Dropdown Icon',
});
$('#menu-item-' + nav_item + ' a').after(img);

	


});
