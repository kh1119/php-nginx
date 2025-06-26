$(window).scroll(function () {});
$(window).resize(function () {});
$(document).ready(function () {
  let url = window.location.pathname;
  $("#go-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 500);
    return false;
  });

  if ($("#top-trending").length > 0) {
    new Swiper("#top-trending .swiper", {
      slidesPerView: 3,
      breakpoints: {
        1100: { slidesPerView: 3 },
        830: { slidesPerView: 2 },
        640: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
      pagination: {
        el: ".swiper-pagination",
      },
      autoplay: {
        delay: 4000,
      },
      simulateTouch: true,
      navigation: {
        nextEl: ".trending-button-next",
        prevEl: ".trending-button-prev",
      },
    });
  }
  if ($("#most-viewed").length > 0) {
    new Swiper("#most-viewed .swiper", {
      slidesPerView: 7,
      spaceBetween: 20,
      breakpoints: {
        1100: { slidesPerView: 7, spaceBetween: 10 },
        830: { slidesPerView: 5, spaceBetween: 10 },
        640: { slidesPerView: 3, spaceBetween: 5 },
        0: { slidesPerView: 2 },
      },
      pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
      },
    });
  }
  if ($(".home-swiper").length > 0) {
    new Swiper(".home-swiper .swiper", {
      slidesPerView: 7,
      spaceBetween: 20,
      breakpoints: {
        1100: { slidesPerView: 7, spaceBetween: 10 },
        830: { slidesPerView: 5, spaceBetween: 10 },
        640: { slidesPerView: 3, spaceBetween: 5 },
        0: { slidesPerView: 2 },
      },
      pagination: {
        el: ".completed-pagination",
        clickable: true,
      },
    });
  }
  $("#nav-menu-btn").click(function () {
    $("#nav-menu").toggleClass("active");
  });
  $("#nav-search-btn").click(function () {
    $("#nav-search").addClass("active");
  });
});

$(document).click(function (event) {
  if (
    !$(event.target).closest("#nav-search-btn").length &&
    !$(event.target).closest("#nav-search>.search-inner").length
  ) {
    $("#nav-search").removeClass("active");
  }
  if (
    !$(event.target).closest("#nav-menu-btn").length &&
    !$(event.target).closest("#nav-menu").length
  ) {
    $("#nav-menu").removeClass("active");
  }
});
