<!DOCTYPE html>
<html lang="<?= $setting['lang'] ?>">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <title><?= $wtitle ?></title>
  <meta name="robots" content="<?= (($main == '404') ? 'noindex,nofollow' : 'index,follow') ?>" />
  <meta name="keywords" content="<?= $wkeyword ?>" />
  <meta name="description" content="<?= $wdescription ?>" />
  <meta name="revisit-after" content="1 days">
  <meta property="og:site_name" content="<?= $wsite ?>" />
  <meta property="og:url" content="<?= $wurl ?>" />
  <meta property="og:title" content="<?= $wtitle ?>" />
  <meta property="og:description" content="<?= $wdescription ?>" />
  <meta property="og:image" content="<?= $wimage ?>" />
  <meta name="theme-color" content="<?= (($style['a5']) ? $style['a5'] : '#5f25a6') ?>">
  <link rel="dns-prefetch" href="//www.google-analytics.com">
  <link rel="dns-prefetch" href="//www.gstatic.com">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="dns-prefetch" href="//fonts.googleapis.com">
  <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
  <link rel="dns-prefetch" href="//s7.addthis.com">
  <link rel="dns-prefetch" href="//connect.facebook.net">
  <link rel="dns-prefetch" href="//graph.facebook.com">
  <link rel="canonical" href="<?= $wurl ?>" />
  <link rel="icon" type="image/png" href="<?= (($setting['favicon']) ? image($setting['favicon'], 0, 0) : '/theme/' . $setting['theme'] . '/images/favicon.png') ?>" />
  <style>
    <?php
    if ($style['a5']) {
      $rgb  = rgb($style['a5']);
    }
    ?>:root {
      --a: <?= (($style['a5']) ? $style['a5'] : '#5f25a6') ?>;
      --b: <?= (($style['b1']) ? $style['b1'] : '#ffd702') ?>;
    }
  </style>
  <!-- <link rel="stylesheet" href="/minifier/<?= $setting['theme'] ?>/bootstrap.min,fontawesome.min,swiper.min,style.min.css?v=<?= $config['ver'] ?>"> -->
  <link rel="stylesheet" href="/theme/<?= $setting['theme'] ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="/theme/<?= $setting['theme'] ?>/css/fontawesome.min.css">
  <link rel="stylesheet" href="/theme/<?= $setting['theme'] ?>/css/swiper.min.css?1.9">
  <link rel="stylesheet" href="/theme/<?= $setting['theme'] ?>/css/style.min.css?2.0.2">
  <?php
  if ($schema) {
    foreach ($schema as $v) {
      echo '<script type="application/ld+json">' . json_encode($v) . '</script>';
    }
  }
  ?>
  <?php require_once('custom.css.php'); ?>
  <?php if ($setting['analytic']) { ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $setting['analytic'] ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', '<?= $setting['analytic'] ?>');
    </script>
  <?php } ?>
  <?= ads('js-head') ?>
</head>

<body <?= (($main == 'reader') ? 'class="page-reader"' : (($main == 'home.index') ? 'class="body-home"' : ''))  ?>>
  <?php
  if ($main == 'reader') {
    require_once(__DIR__ . '/ui/reader.php');
  } else { ?>
    <div id="sidebar_menu_bg"></div>
    <div id="sidebar_menu">
      <a class="sb-uimode" href="javascript:;" id="sb-toggle-mode"><i class="fas fa-moon mr-2"></i><span class="text-dm"><?= $__l['dark.mode'] ?></span><span class="text-lm"><?= $__l['light.mode'] ?></span></a>
      <button class="btn toggle-sidebar"><i class="fas fa-angle-left"></i></button>
      <ul class="nav sidebar_menu-list">
        <li class="nav-item"><a class="nav-link" href="<?= (($setting['home']['status']) ? $setting['home']['url'] : '/') ?>"><?= $__l['home'] ?></a></li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:;" title="<?= $__l['types'] ?>"><?= $__l['types'] ?></a>
          <div class="types-sub">
            <?php
            foreach ($cfnav as $label) {
              echo '<a class="ts-item" href="' . $res[replace($label)] . '">' . $label . '</a>';
            }
            ?>
          </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="<?= $res['latest-updated'] ?>" title=""><?= $__l['latest-updated'] ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $res['new-release'] ?>" title=""><?= $__l['new-release'] ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $res['most-viewed'] ?>" title=""><?= $__l['most-viewed'] ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $res['completed'] ?>" title=""><?= $__l['completed'] ?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $res['az-list'] ?>"><?= $__l['az'] ?></a></li>
        <li class="nav-item">
          <div class="nav-link"><strong><?= $__l['genre'] ?></strong></div>
          <div class="sidebar_menu-sub">
            <ul class="nav sub-menu">
              <?php
              foreach ($genre as $v) {
                if ($v['status'] == 1)
                  echo '<li class="nav-item"><a class="nav-link" href="' . urls($v['slug'], 'genre') . '">' . $v['title'] . '</a></li>';
              }
              ?>
            </ul>
            <div class="clearfix"></div>
          </div>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div id="wrapper">
      <div id="sub-header" class="home-sub-header">
        <div class="container">
          <div class="sh-left">
            <div class="float-left">
              <a href="/random/" class="sh-item">
                <i class="fas fa-glasses mr-2"></i><?= $__l['Random'] ?>
              </a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="sh-right">
            <div class="float-left">
              <div class="sh-item mr-3">
                <strong>Follow us :</strong>
              </div>
              <a target="_blank" href="<?= $setting['reddit'] ?>" class="sh-item mr-3">
                <i class="fab fa-reddit-alien mr-2"></i>Reddit
              </a>
              <a target="_blank" href="<?= $setting['twitter'] ?>" class="sh-item mr-3">
                <i class="fab fa-twitter mr-2"></i>Twitter
              </a>
              <a target="_blank" href="<?= $setting['discord'] ?>" class="sh-item">
                <i class="fab fa-discord mr-2"></i>Discord
              </a>
              <div class="clearfix"></div>
            </div>
            <div class="spacing"></div>
            <div class="float-right">
              <a class="sh-item sb-uimode" id="toggle-mode">
                <i class="fas fa-moon mr-2"></i><span class="text-dm"><?= $__l['dark.mode'] ?></span><span class="text-lm"><?= $__l['light.mode'] ?></span>
              </a>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div id="header" class="<?= (($main == 'home') ? 'home-header' : '') ?> <?= (($main == 'home.index') ? 'home-header mb-0' : '') ?>">
        <div class="container">
          <div id="mobile_menu"><i class="fa fa-bars"></i></div>
          <div id="mobile_search"><i class="fa fa-search"></i></div>
          <a id="logo" href="<?= (($setting['home']['status']) ? $setting['home']['url'] : '/') ?>" title="<?= $setting['h1'] ?>">
            <img src="<?= (($setting['logo']) ? image($setting['logo'], 0, 0) : '/theme/' . $setting['theme'] . '/images/logo.png') ?>" alt="Logo">
            <div class="clearfix"></div>
          </a>
          <div id="header_menu">
            <ul class="nav header_menu-list">
              <li class="nav-item"><a href="/completed" title="Completed">Completed</a></li>
              <li class="nav-item">
                <a href="javascript:;" title="<?= $__l['types'] ?>"><?= $__l['types'] ?><i class="fas fa-angle-down ml-2"></i></a>
                <div class="header_menu-sub" style="display: none;">
                  <ul class="sub-menu">
                    <?php
                    foreach ($cfnav as $label) {
                      echo '<li><a href="' . $res[replace($label)] . '">' . $label . '</a></li>';
                    }
                    ?>
                  </ul>
                  <div class="clearfix"></div>
                </div>
              </li>
              <li class="nav-item"><a href="<?= $res['az-list'] ?>"><?= $__l['az'] ?></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div id="header_right">
            <div id="search">
              <div class="search-content">
                <form action="/" search_form="true" method="get" autocomplete="off">
                  <a href="/filter/" class="filter-icon"><?= $__l['filter'] ?></a>
                  <input type="text" name="q" class="form-control search-input" placeholder="<?= $__l['qfocus'] ?>">
                  <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
                <div class="nav search-result-pop" id="search-suggest">
                  <div class="loading-relative" id="search-loading" style="min-height:60px;display: none;">
                    <div class="loading">
                      <div class="span1"></div>
                      <div class="span2"></div>
                      <div class="span3"></div>
                    </div>
                  </div>
                  <div class="result" style="display:none;"></div>
                </div>
              </div>
            </div>

            <div id="login-state" style="float: left;"></div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="clearfix"></div>
      <?= ads('header') ?>
      <?php require_once(__DIR__ . '/ui/' . $main . '.php'); ?>
      <?= ads('footer') ?>
      <div id="footer">
        <div id="footer-about">
          <div class="container">
            <div class="footer-top">
              <a href="/" class="footer-logo">
                <img src="<?= (($setting['logo']) ? image($setting['logo'], 0, 0) : '/theme/' . $setting['theme'] . '/images/logo.png') ?>" alt="Logo">
                <div class="clearfix"></div>
              </a>
            </div>
            <div class="footer-links">
              <ul class="ulclear">
                <li><a href="<?= (($setting['home']['status']) ? $setting['home']['url'] : '/') ?>"><?= $__l['home'] ?></a></li>
                <li><a href="/sitemap.xml" target="_blank">Sitemap</a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="about-text"><?= (($main=='home' || $main=='home.index')?(($setting['footer']) ? un_htmlchars($setting['footer']) : $host . ' does not store any files on our server, we only linked to the media which is hosted on 3rd party services.'):$wdescription) ?></div>
            <div class="flink">
              <?php
              if ($setting['link']) {
                foreach ($setting['link'] as $v) {
                  echo '<a title="' . $v['title'] . '" href="' . $v['url'] . '">' . $v['title'] . '</a>';
                }
              }
              ?>
            </div>
            <p class="copyright">© <?= $host ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (!isset($_SESSION['uid'])) { ?>
    <div class="modal fade premodal premodal-login" id="modallogin" tabindex="-1" role="dialog" aria-labelledby="modallogintitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="tab-content">
            <!--Begin: tab login-->
            <div id="modal-tab-login" class="tab-pane active auth-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="modallogintitle"><?= $__l['lg.title'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="preform" data-submit="login" method="post">
                  <div class="form-group">
                    <label class="prelabel" for="email"><?= $__l['email'] ?></label>
                    <input name="name" type="text" class="form-control" id="email" placeholder="name@email.com" required>
                  </div>
                  <div class="form-group">
                    <label class="prelabel" for="password"><?= $__l['pwd'] ?></label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                  </div>
                  <div class="form-check custom-control custom-checkbox">
                    <div class="float-left">
                      <input name="remember" name="remember" type="checkbox" class="custom-control-input" id="remember">
                      <label class="custom-control-label" for="remember"><?= $__l['remember'] ?></label>
                    </div>
                    <div class="float-right">
                      <a onclick="return __this.mdTab('forgot')" href="#" class="link-highlight text-forgot"><?= $__l['forgot'] ?></a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="form-group login-btn mt-4">
                    <button type="submit" class="btn btn-primary btn-block"><?= $__l['login'] ?></button>
                  </div>
                </form>
              </div>
              <div class="modal-footer text-center">
                <?= $__l['lg.ft'] ?> <a onclick="return __this.mdTab('register')" href="#" class="link-highlight" title="Register"><?= $__l['register'] ?></a>
              </div>
            </div>
            <!--End: tab login-->
            <!--Begin: tab forgot-->
            <div id="modal-tab-forgot" class="tab-pane fade auth-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="modallogintitle3"><?= $__l['rs.title'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="preform" data-submit="forgot_password" method="post">
                  <div class="form-group">
                    <label class="prelabel" for="forgot-email"><?= $__l['email'] ?></label>
                    <input name="email" type="email" class="form-control" id="forgot-email" placeholder="name@email.com" required>
                  </div>
                  <div class="form-group login-btn mt-4">
                    <button type="submit" class="btn btn-primary btn-block"><?= $__l['submit'] ?></button>
                  </div>
                </form>
              </div>
              <div class="modal-footer text-center">
                <a onclick="return __this.mdTab('login')" href="#" class="link-highlight" title="Sign-in"><i class="fa fa-angle-left mr-2"></i><?= $__l['lg.back'] ?></a>
              </div>
            </div>
            <!--End: tab forgot-->
            <!--Begin: tab register-->
            <div id="modal-tab-register" class="tab-pane fade auth-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="modallogintitle2"><?= $__l['rg.title'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="preform" data-submit="register" method="post">
                  <div class="form-group">
                    <label class="prelabel" for="re-username"><?= $__l['yname'] ?></label>
                    <input name="name" type="text" class="form-control" id="re-username" placeholder="Name" required>
                  </div>
                  <div class="form-group">
                    <label class="prelabel" for="re-email"><?= $__l['email'] ?></label>
                    <input name="email" type="email" class="form-control" id="re-email" placeholder="name@email.com" required>
                  </div>
                  <div class="form-group">
                    <label class="prelabel" for="re-password"><?= $__l['pwd'] ?></label>
                    <input name="password" type="password" class="form-control" id="re-password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label class="prelabel" for="re-confirmpassword"><?= $__l['pwd.c'] ?></label>
                    <input name="re-password" type="password" class="form-control" id="re-confirmpassword" placeholder="Confirm Password" autocomplete="off" required>
                  </div>
                  <div class="form-group login-btn mt-4">
                    <button type="submit" class="btn btn-primary btn-block"><?= $__l['register'] ?></button>
                  </div>
                </form>
              </div>
              <div class="modal-footer text-center">
                <?= $__l['rg.ft'] ?> <a href="#" onclick="return __this.mdTab('login')" class="link-highlight" title="Login"><?= $__l['login'] ?></a>
              </div>
            </div>
            <!--End: tab register-->
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?=(($setting['amung'])?'<img src="//whos.amung.us/widget/' . $setting['amung'] . '.png" alt="Amungs" style="display:none;">':'')?>
  <script>
    var config = {
      f12: <?= (int)$setting['f12'] ?>,
      access: '<?= jcode("{$arr_request}|{$_COOKIE['PHPSESSID']}|{$REMOTE_IP}") ?>',
      lang: {
        favorite: '<?= $__l['favorite'] ?>',
        remove: '<?= $__l['remove'] ?>',
        u0: '<?= $__l['u.0'] ?>',
        u1: '<?= $__l['u.1'] ?>',
        Forever: '<?= $__l['Forever'] ?>',
        Expired: '<?= $__l['Expired'] ?>',
        pft: '<?= $__l['pf.t'] ?>',
        fav: '<?= $__l['fav.t'] ?>',
        premium: '<?= $__l['premium'] ?>',
        logout: '<?= $__l['logout'] ?>',
        login: '<?= $__l['login'] ?>',
        sall: '<?= $__l['s.all'] ?>',
      }
    };
  </script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/popper.min.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/lazysizes.min.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/js.cookie.min.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/swiper.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/app.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/share.min.js"></script>
  <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/main.js?1.8"></script>
  <?php if ($main == 'reader') { ?>
    <script type="text/javascript" src="/theme/<?= $setting['theme'] ?>/js/read.min.js?2.0.1"></script>
  <?php } ?>
  <?= ads('js-body') ?>
</body>

</html>