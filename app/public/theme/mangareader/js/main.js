var uiMode = localStorage.getItem("uiMode");
const body = document.body,
  btnMode = document.getElementById("toggle-mode"),
  sbBtnMode = document.getElementById("sb-toggle-mode");

function activeUiMode() {
  if (uiMode === "dark") {
    btnMode && btnMode.classList.add("active");
    sbBtnMode && sbBtnMode.classList.add("active");
    body.classList.add("darkmode");
  } else {
    btnMode && btnMode.classList.remove("active");
    sbBtnMode && sbBtnMode.classList.remove("active");
    body.classList.remove("darkmode");
  }
}

if (uiMode) {
  activeUiMode();
} else {
  window.matchMedia("(prefers-color-scheme: dark)").matches
    ? (uiMode = "dark")
    : (uiMode = "light");
  activeUiMode();
}
[btnMode, sbBtnMode].forEach((item) => {
  if (item) {
    item.addEventListener("click", function () {
      this.classList.contains("active")
        ? (uiMode = "light")
        : (uiMode = "dark");
      localStorage.setItem("uiMode", uiMode);
      activeUiMode();
    });
  }
});
$(window).scroll(function () {});
$(window).resize(function () {});
$(document).ready(function () {
  let url = window.location.pathname;
  // $("#mMenu ul>li>a").each(function () {
  //   if ($(this).attr("href") === url) {
  //     $("#mMenu ul>li>a.active").removeClass("active");
  //     $(this).addClass("active");
  //   }
  // });

  if ($("#slider").length > 0) {
    new Swiper("#slider", {
      slidesPerView: 1,
      pagination: {
        el: ".swiper-pagination",
      },
      autoplay: {
        delay: 4000,
      },
      simulateTouch: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  }
  if ($("#trending-home>div").length > 0) {
    new Swiper("#trending-home>div", {
      slidesPerView: 6,
      spaceBetween: 20,
      breakpoints: {
        1100: { slidesPerView: 6, spaceBetween: 10 },
        830: { slidesPerView: 5, spaceBetween: 10 },
        640: { slidesPerView: 3, spaceBetween: 5 },
        0: { slidesPerView: 2 },
      },
      navigation: {
        nextEl: ".navi-next",
        prevEl: ".navi-prev",
      },
    });
  }

  $("#header_menu ul>li")
    .bind("mouseover", function () {
      $(this).find(".header_menu-sub").css("display", "block");
    })
    .bind("mouseout", function () {
      $(this).find(".header_menu-sub").css("display", "none");
    });

  $("#mobile_menu").click(function () {
    $("body").addClass("body-hidden"),
      $("#sidebar_menu_bg,#sidebar_menu,#mobile_menu").addClass("active");
  });

  $(".toggle-sidebar").click(function () {
    $("body").removeClass("body-hidden"),
      $("#sidebar_menu_bg,#sidebar_menu,#mobile_menu").removeClass("active");
  });
  $("#mobile_search").click(function () {
    $("#search").toggleClass("active");
  });

  $(".detail-toggle").click(function () {
    if ($(".anis-content.active").length > 0) {
      $(".detail-toggle,.anis-content").removeClass("active");
    } else {
      $(".detail-toggle,.anis-content").addClass("active");
    }
  });
  //search chap
  $(".search-reading-item2").keyup(function () {
    var chap = $(this).val().toUpperCase(),
      code = $(".c-select-lang.active").data("code"),
      $evt = $(`#${code}-chaps`).find(`[data-number="${chap}"]`);
    $(`#${code}-chaps`).find(".highlight").removeClass("highlight");
    if ($evt.length > 0) {
      var container = $(`#${code}-chaps`);
      container.animate(
        {
          scrollTop:
            $evt.offset().top - container.offset().top + container.scrollTop(),
        },
        200
      );
      $evt.addClass("highlight");
    }
  });
});

$(document).click(function (event) {
  if (
    !$(event.target).closest("#sidebar_menu").length &&
    !$(event.target).closest("#mobile_menu").length
  ) {
    if ($("body").hasClass("body-hidden"))
      $("body").removeClass("body-hidden"),
        $("#sidebar_menu_bg,#sidebar_menu,#mobile_menu").removeClass("active");
  }
});
$(document).scroll(function (event) {
  var top = $(window).scrollTop();
  if (top > 100) {
    $(".mr-tools.mrt-bottom")
      .show()
      .css({ bottom: $("#vertical-content").length ? 0 : 55 });
  } else {
    $(".mr-tools.mrt-bottom").hide();
  }
});
