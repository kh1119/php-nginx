window.addEventListener("popstate", (event) => {
  try {
    //console.log(event.state)
    if (event.state)
      read.load(event.state.lang, event.state.name, event.state.url, false);
  } catch (error) {}
});

var lid = 0,
  ajax = $("#ajax-loader"),
  read = {
    setDb: function (name, value) {
      try {
        return sessionStorage.setItem(name, value);
      } catch (err) {
        return false;
      }
    },
    getDb: function (name) {
      try {
        return sessionStorage.getItem(name);
      } catch (err) {
        return false;
      }
    },
    size: function () {
      let value = __this.getDb("__size");
      $("#iv-comic").css({ "font-size": value + "px" });
      $("#current-size").text(value);
    },
    font: function () {
      let value = __this.getDb("__font");
      if (value == "") {
        $("#current-font").text(manga.value["Default"]);
      } else {
        $("#iv-comic").css({ "font-family": value });
        $("#current-font").text(value);
      }
    },
    run: function () {
      if ($(window).width() < 1200) {
        __this.setDb("__ctrl", 0);
      }
      if (__this.getDb("__ctrl") == "0") {
        $("body").removeClass("ctrl-menu-active");
        $("#ctrl-menu").removeClass("active");
      } else {
        __this.setDb("__ctrl", 1);
      }
      $("#show-ctrl-menu,#ctrl-menu-close").click(function () {
        if (__this.getDb("__ctrl") == 1) {
          $("body").removeClass("ctrl-menu-active");
          $("#ctrl-menu").removeClass("active");
          __this.setDb("__ctrl", 0);
        } else {
          $("body").addClass("ctrl-menu-active");
          $("#ctrl-menu").addClass("active");
          __this.setDb("__ctrl", 1);
        }
      });

      $(".number-toggler").click(function () {
        $("#number-panel").toggleClass("active");
      });
      $("#page-close").click(function () {
        $("#number-panel").removeClass("active");
      });
      $(".comment-toggler").click(function () {
        $("#comment-panel").toggleClass("active");
      });
      $("#comment-close").click(function () {
        $("#comment-panel").removeClass("active");
      });

      if (manga.value["pl"] == "manga") {
        if (!__this.getDb("__mode")) {
          __this.setDb("__mode", "vertical");
          $("#first-read").show();
        }
      }
      $(".mode-item").click(function () {
        __this.setDb("__mode", $(this).data("value"));
        location.reload();
      });
      if (__this.getDb("__mode")) {
        let value = __this.getDb("__mode");
        $("#current-mode").text(manga.value[value]);
      }

      $(".size-item").click(function () {
        __this.setDb("__size", $(this).data("value"));
        read.size();
      });

      $(".font-item").click(function () {
        __this.setDb("__font", $(this).data("value"));
        read.font();
      });
      $(".hr-setting>.btn").click(function () {
        $(".read_tool").toggleClass("active");
      });
      $(".hr-comment>.btn").click(function () {
        $(".page-reader").toggleClass("show-comment");
      });
      $("#read-comment>.rc-close").click(function () {
        $(".page-reader").removeClass("show-comment");
      });
      $("#rt-close").click(function () {
        $(".read_tool").removeClass("active");
      });
      $(".ad-toggle").click(function () {
        $(".page-reader").toggleClass("pr-full");
      });
      $(".chapters-list-ul .reading-item>a").click(function () {
        let url = $(this).attr("href"),
          name = $(this).parent().data("number"),
          lang = $(".c-select-lang.active").data("code");
        read.load(lang, name, url, true);
        return false;
      });
      $(".c-select-lang").click(function () {
        var type = $(this).data("type"),
          xcode = $(this).data("code");

        $("#c-selected-lang>.rl-lang-text").text(xcode.toUpperCase()),
          $("ul.lang-chapters").hide(),
          $("#" + xcode + "-chapters").show(),
          $(".c-select-lang").removeClass("active"),
          $(this).addClass("active");
        code = xcode;
      });

      $(".search-reading-item2").keyup(function () {
        var chap = $(this).val().toUpperCase(),
          $evt = $(`#${code}-chapters`).find(`[data-number="${chap}"]`);
        if ($evt.length > 0) {
          $(`#${code}-chapters`).find("li").hide(), $evt.show();
        } else {
          $(`#${code}-chapters`).find("li").show();
        }
      });
      $(".search-reading-item-form").submit(function () {
        $(".search-reading-item2").val("");
        if ($(".reading-item.highlight>a").length) {
          $(".reading-item.highlight>a").trigger("click");
        }
        return false;
      });
      $(`.c-select-lang[data-code="${manga.lang}"]`).trigger("click");
      this.load(manga.lang, manga.name, manga.url, true);
    },
    blod: function (buffer) {
      return new Promise((resolve) => {
        var blodURL = URL.createObjectURL(new Blob([new Uint8Array(buffer)]));
        resolve(blodURL);
      });
    },
    buffer: function () {
      if (lid > 0) return;
      let $image = $("#images-content").find("[data-auth]:not(.loader)").eq(0);
      if ($image.length) {
        var data = $image.addClass("loader").data("auth"),
          width = $image.data("width"),
          key = `${manga.id}_${manga.name}_${$image.index()}`,
          server = "//api-x0." + manga.server;
        // server =
        //   "//api-x0" +
        //   (Math.floor(Math.random() * 20) + 1) +
        //   "." +
        //   manga.server;
        // server = "http://127.0.0.1:4444";
        $.ajax({
          // type: "POST",
          // url: server + "/collect",
          // data: JSON.stringify({ data, width }),
          type: "GET",
          url: server + "/hash",
          data: { h: data },
          contentType: "application/json",
          dataType: "json",
          success: function (j) {
            if (j.buffer.length) {
              let image = "",
                blod = [];
              j.buffer.forEach(async (v, xj) => {
                if (v == null) {
                  image +=
                    '<span class="images-error">Image loading error</span>';
                  $image.append(
                    `<span class="images-error">Image loading error</span>`
                  );
                } else {
                  var blodURL = await read.blod(v.buffer.data);
                  image += `<img src="${blodURL}" class="image-vertical">`;
                }
                if (xj == j.buffer.length - 1) {
                  $image.html(image);
                }
              });
              //read.setDb(key, JSON.stringify(j.buffer.data));
            }
            lid = 0;
          },
          error: function (j) {
            lid = 0;
          },
        });
      }
    },
    load: function (lang, name, url, popstate) {
      lid = 0;
      $(".chapter-item").removeClass("active highlight");
      $(`#${lang}-chapters`)
        .find(`.chapter-item[data-number="${name}"]`)
        .addClass("active");
      $("#current-chapter").text(name);
      $(document).trigger("click");
      let mode = __this.getDb("__mode"),
        id = $(`#${lang}-chapters li[data-number="${name}"]`).data("id");
      ajax.show();
      if (mode) {
        $.get(
          "/json/chapter",
          { mode, id },
          function (j) {
            if (j.status == 1) {
              $("#images-content").html(j.html);
              setTimeout(function () {
                read.buffer();
              }, 100);
              $("#page-wrapper").animate(
                {
                  scrollTop: 0,
                },
                200
              );
              read.size();
              read.font();
              ajax.hide();
            }
          },
          "json"
        );
      }
      if (popstate == true) history.pushState({ lang, name, url }, "", url);
    },
    next: function () {
      var $next;
      var $selected = $(".reading-item.active");
      $next = $selected.prev("li").length
        ? $selected.prev("li")
        : $selected
            .closest("ul")
            .find("li")
            .eq($selected.closest("ul").find("li").length - 1);
      $next.find("a").trigger("click");
    },
    prev: function () {
      var $prev;
      var $selected = $(".reading-item.active");
      $prev = $selected.next("li").length
        ? $selected.next("li")
        : $selected.closest("ul").find("li").eq(0);
      $selected.removeClass("active");
      $prev.find("a").trigger("click");
    },
    hozNextImage: function () {
      var $selected = $(".iv-card.active");
      if ($selected.next("div.iv-card").length) {
        $selected.removeClass("active");
        let index = Number($selected.next("div.iv-card").index()) + 1;
        $selected.next("div.iv-card").addClass("active");
        $(".hoz-current-index").text(index < 10 ? "0" + index : index);
      }
    },
    hozPrevImage: function () {
      var $selected = $(".iv-card.active");
      if ($selected.prev("div.iv-card").length) {
        $selected.removeClass("active");
        let index = Number($selected.prev("div.iv-card").index()) + 1;
        $selected.prev("div.iv-card").addClass("active");
        $(".hoz-current-index").text(index < 10 ? "0" + index : index);
      }
    },
  };
read.run();

$(document).click(function (event) {
  if (!$(event.target).closest("#number-panel,.number-toggler").length) {
    $("#number-panel").removeClass("active");
  }
  if ($(event.target).closest("#vertical-content").length) {
    var w = $(window).width(),
      $wd = $("#page-wrapper"),
      htop = $(window).height() / 2;
    if (htop > event.pageY) {
      $wd.animate(
        {
          scrollTop: $wd.scrollTop() - htop,
        },
        200
      );
    } else {
      $wd.animate(
        {
          scrollTop: $wd.scrollTop() + htop,
        },
        200
      );
    }
  }
});
var message = "";
function clickIE() {
  if (document.all) {
    message;
    return false;
  }
}
function clickNS(e) {
  if (document.layers || (document.getElementById && !document.all)) {
    if (e.which == 2 || e.which == 3) {
      message;
      return false;
    }
  }
}
if (document.layers) {
  document.captureEvents(Event.MOUSEDOWN);
  document.onmousedown = clickNS;
} else {
  document.onmouseup = clickNS;
  document.oncontextmenu = clickIE;
  document.onselectstart = clickIE;
}
document.oncontextmenu = new Function("return false");
$("#page-wrapper").scroll(function () {
  let $image = $("#images-content").find("[data-auth]:not(.loader)").eq(0),
    top = $("#page-wrapper").scrollTop(),
    fh = 600;
  console.log(top);
  if ($image.length) {
    if (top > $image.offset().top - fh) {
      read.buffer();
    }
  }
});
