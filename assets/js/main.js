const swiper = new Swiper('.swiper', {
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    autoHeight: true,
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
  });

const swiper_banner = new Swiper('.swiper-banner', {
    slidesPerView: 1,
    loop: true,
  });