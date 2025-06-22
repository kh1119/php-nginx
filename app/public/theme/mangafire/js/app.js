var debug = 0,
  islogin = (isvip = isajax = 0),
  __this = {
    setDb: function (name, value) {
      try {
        return localStorage.setItem(name, value);
      } catch (err) {
        return false;
      }
    },
    getDb: function (name) {
      try {
        return localStorage.getItem(name);
      } catch (err) {
        return false;
      }
    },
    chapter: function () {
      var code = "en";
      if ($("#list-chapter").length) {
        $(".c-select-lang").click(function () {
          var type = $(this).data("type"),
            xcode = $(this).data("code");
          $(this)
            .closest(".chapter-s-lang")
            .find(".active")
            .removeClass("active"),
            $(this).addClass("active"),
            $(this)
              .closest(".chapter-s-lang")
              .find("button>span")
              .text(xcode.toUpperCase()),
            $(this).closest(".tab-pane").find("ul.ulclear").hide(),
            $("#" + xcode + "-" + type + "s").show();
          code = xcode;
        });
        $(".chapter-s-lang").each(function () {
          $(this).find(".c-select-lang").eq(0).trigger("click");
        });

        $(".search-reading-item").keyup(function () {
          var chap = $(this).val().toUpperCase(),
            $evt = $(`#${code}-chaps`).find(`[data-number="${chap}"]`);
          if ($evt.length > 0) {
            $(`#${code}-chaps`).find("li").hide(), $evt.show();
          } else {
            $(`#${code}-chaps`).find("li").show();
          }
        });
        $(".search-reading-item-form").submit(function () {
          $(".search-reading-item").val("");
          return false;
        });
      }
    },
    mdTab: function (tab) {
      $("#modallogin").find(".auth-tab").removeClass("active").addClass("fade");
      $("#modal-tab-" + tab)
        .addClass("active")
        .removeClass("fade");
      return false;
    },
    auth: function () {
      $.post(
        "/json/auth",
        { access_token: config.access },
        function (j) {
          if (j.status == 1) {
            (islogin = 1),
              (isvip = j.vip),
              $("#user").html(
                `
                <div class="header_right-user logged">
                <div class="dropdown left">
                    <div class="btn-avatar" data-toggle="dropdown" aria-expanded="false">
                        <img src="https://img.mreadercdn.com/_m/100x100/100/avatar/dragon_ball/av-db-01.jpeg"
                        alt="${j.uname}">
                    </div>
                    <div id="user_menu" class="dropdown-menu dropdown-menu-right">
                      <div class="dropdown-item">` +
                  (j.vip > 0
                    ? '<span class="ugr vip"><i class="far fa-gem"></i> ' +
                      config.lang.u1 +
                      '</span><span class="uex">' +
                      config.lang.Expired +
                      ": <span>" +
                      (j.vip == 2 ? config.lang.Forever : j.vipdate) +
                      "</span></span>"
                    : '<span class="ugr">' + config.lang.u0 + "</span>") +
                  `</div>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="/profile/">${config.lang.pft}</a>
                      <a class="dropdown-item" href="/favorite/">${config.lang.fav}</a>
                      <!--<a class="dropdown-item" href="/activatekey/">${config.lang.premium}</a>-->

                      <a class="dropdown-item di-bottom" href="/logout/">${config.lang.logout}<i class="fas fa-arrow-right ml-2 mr-1"></i></a>
                    </div>
                </div>
            </div>
            `
              );
            //__this.cron();
          } else {
            $("#user").html(
              `<button data-toggle="modal" data-target="#modallogin" class="btn btn-primary rounded-pill"> <span class="d-none d-sm-inline pl-1 mr-1">${config.lang["login"]}</span> <i class="d-inline d-sm-none fa-solid fa-user-vneck"></i> <i class="d-none d-sm-inline fa-solid fa-sm fa-angle-right"></i> </button>`
            );
          }
        },
        "json"
      );
    },
    like: function () {
      $('[data-ui="like"] [data-action]').each(function () {
        var $a = $(this),
          ac = $a.data("action"),
          id = $a.data("id"),
          $c = $a.parent(),
          ck = $.cookie("mdb-l" + id);
        if (ck) {
          var ex = ck.split("|");
          if (ac == ex[0]) {
            $a.addClass("selected");
            if (config.cache == 1) {
              $c.find('[data-name="rating"]').text(ex[1]);
              $c.find('[data-name="voted"]').text(ex[2]);
            }
          }
        }
      });

      $('[data-ui="like"] [data-action]').click(function (e) {
        var $a = $(this),
          ac = $a.data("action"),
          id = $a.data("id"),
          $c = $a.parent();
        if (!$.cookie("mdb-l" + id) || debug == 1) {
          $a.addClass("selected").html('<i class="fa fa-spinner fa-spin"></i>');
          $.post(
            "/json/" + ac,
            { id: id, access_token: config.access },
            function (j) {
              $c.find('[data-name="rating"]').text(j.data.rating);
              $c.find('[data-name="voted"]').text(j.data.voted);
              $.cookie(
                "mdb-l" + id,
                ac + "|" + j.data.rating + "|" + j.data.voted
              );
              $a.unbind("click");
              $a.find('[data-name="bar"]').animate({ width: j.data.bar + "%" });
              $a.html('<i class="fa fa-check"></i>');
            },
            "json"
          );
        }
        e.preventDefault();
      });
    },
    view: function () {
      if (!$.cookie("mdb-v" + movie.id) || debug == 1) {
        $.post(
          "/json/view?id=" + movie.id,
          { id: movie.id, access_token: config.access },
          function (j) {
            $.cookie("mdb-v" + movie.id, 1);
          },
          "json"
        );
      }
    },
    favorite: function (e, id, remove) {
      if (islogin) {
        $.post(
          "/json/favorite",
          { id, remove, access_token: config.access },
          function (j) {
            if (remove == 1)
              $(e)
                .data("remove", 0)
                .html(
                  ' <i class="fas fa-heart mr-2"></i>' + config.lang.favorite
                );
            else
              $(e)
                .data("remove", 1)
                .html(
                  ' <i class="fas fa-trash mr-2"></i>' + config.lang.remove
                );
          },
          "json"
        );
      } else {
        $("#modallogin").modal("show");
      }
      return false;
    },
    rmfav: function (e, id) {
      if (islogin) {
        $.post(
          "/json/favorite",
          { id: id, remove: 1, access_token: config.access },
          function (j) {
            $(e).closest(".flw-item").fadeOut(500),
              setTimeout(function () {
                $(e).closest(".flw-item").remove();
              }, 3000);
          },
          "json"
        );
      }
    },
    submit: function () {
      $("[data-submit]").unbind("submit");
      $("[data-submit]").submit(function () {
        var data = [],
          form = $(this),
          btn = form.find('[type="submit"]'),
          btnTxt = btn.html(),
          action = form.data("submit");
        data.push({ name: "access_token", value: config.access });
        form.find("input,select,textarea").each(function () {
          var name = $(this).attr("name"),
            value = $(this).val();
          if (name != "undefined") {
            data.push({ name: name, value: encodeURIComponent(value) });
          }
        });
        btn
          .html('<i class="fa fa-spinner fa-spin"></i>')
          .attr("disabled", true);
        setTimeout(function () {
          form.find(".help-block").remove();
          form.find(".has-error").removeClass("has-error");
          form.find(".is-invalid").removeClass("is-invalid");
          $.post(
            "/json/" + action,
            data,
            function (t) {
              console.log(t);
              if (t.status == 1) {
                location.reload();
              } else {
                $.each(t.message, function (k, message) {
                  var block = form.find("[name='" + k + "']").parent();
                  var label =
                    message == 1
                      ? $('th[name="' + k + '"]').text() + " is required"
                      : message;
                  form.find("[name='" + k + "']").addClass("is-invalid");
                  block
                    .addClass("has-error")
                    .append('<span class="help-block">' + label + "</span>");
                });
              }
              btn.html(btnTxt).removeAttr("disabled");
            },
            "json"
          );
        }, 100);
        return false;
      });
    },
    filter: function () {},
    search: function () {
      // Search movie
      var hidden = true;
      $(".suggestion").mouseover(function () {
        hidden = false;
      });

      $(".suggestion").mouseout(function () {
        hidden = true;
      });
      var sajax = 0;
      $('[search_form="true"]>input[name="q"]').keyup(function () {
        if (sajax > 0) return false;
        var keyword = $(this).val();
        if (keyword.trim().length > 2) {
          sajax = 1;
          $.ajax({
            url: "/json/suggest",
            type: "POST",
            dataType: "json",
            data: { q: keyword, access_token: config.access },
            success: function (j) {
              if (j.status == 1) {
                var suggest = "";
                j.items.forEach((v, index) => {
                  suggest += `<li><a href="${v.url}">${v.title}</a></a></li>`;
                  if (index == j.items.length - 1) {
                    suggest +=
                      '<li><a class="nav-bottom" href="/?q=' +
                      keyword.replace(/ /g, "+") +
                      '">' +
                      config.lang.sall +
                      ' <i class="fa fa-angle-right ml-2"></i></a></li>';
                    $(".suggestion").html(suggest);
                  }
                });
                $(".suggestion").show();
              } else {
                $(".suggestion").hide();
              }
              sajax = 0;
            },
          });
        } else {
          $(".suggestion").hide();
        }
      });
      $('[search_form="true"]>input[name="q"]').blur(function () {
        if (hidden) {
          $(".suggestion").hide();
        }
      });
      $('[search_form="true"]>input[name="q"]').focus(function () {
        if ($(".suggestion").text() !== "") {
          $(".suggestion").hide();
        }
      });

      $('[search_form="true"]>input[name="q"]').keypress(function (event) {
        if (event.which == 13) {
          //searchMovie();
        }
      });
    },
    int: function () {
      this.search();
      this.chapter();
      this.auth();
      this.like();
      this.submit();
      try {
        if (Number(movie.id) > 0) {
          this.view();
        }
      } catch (error) {}
    },
  };
$(document).ready(function () {
  __this.int();
  $(".favorite").click(function () {
    __this.favorite(this, $(this).data("id"), $(this).data("remove"));
    return false;
  });
  $("#modallogin").on("shown.bs.modal", function () {
    $("#modallogin").find(".auth-tab").removeClass("active").addClass("fade");
    $("#modal-tab-login").addClass("active").removeClass("fade");
  });
});
if (config.f12) {
  var _0x6e63 = [
      "getTime",
      "debugger",
      "constructor",
      "href",
      "location",
      "https://google.com",
      "script",
      "createElement",
      "textContent",
      "//# sourceMappingURL=",
      "",
      "appendChild",
      "head",
      "remove",
      "(^|[^;]+)\\s*",
      "\\s*=\\s*([^;]+)",
      "match",
      "cookie",
      "pop",
      "id",
      "defineProperty",
      "origin",
      "/map",
      "dir",
      "true",
      "isMap",
    ],
    element = new Image(),
    devtoolsOpen = !1;
  function _time() {
    var e = new Date()[_0x6e63[0]]();
    (function () {})[_0x6e63[2]](_0x6e63[1])(),
      new Date()[_0x6e63[0]]() - e >= 200 &&
        (window[_0x6e63[4]][_0x6e63[3]] = _0x6e63[5]);
  }
  function smap(e) {
    const t = document[_0x6e63[7]](_0x6e63[6]);
    (t[_0x6e63[8]] = `${_0x6e63[9]}${e}${_0x6e63[10]}`),
      document[_0x6e63[12]][_0x6e63[11]](t),
      t[_0x6e63[13]]();
  }
  function getCookieValue(e) {
    var t = document[_0x6e63[17]][_0x6e63[16]](_0x6e63[14] + e + _0x6e63[15]);
    return t ? t[_0x6e63[18]]() : _0x6e63[10];
  }
  Object[_0x6e63[20]](element, _0x6e63[19], {
    get: function () {
      devtoolsOpen = !0;
    },
  }),
    smap(document[_0x6e63[4]][_0x6e63[21]] + _0x6e63[22]),
    setInterval(function () {
      (devtoolsOpen = !1),
        console[_0x6e63[23]](element),
        _0x6e63[24] == getCookieValue(_0x6e63[25])
          ? (window[_0x6e63[4]][_0x6e63[3]] = _0x6e63[5])
          : devtoolsOpen
          ? (window[_0x6e63[4]][_0x6e63[3]] = _0x6e63[5])
          : _time();
    }, 500);
}
