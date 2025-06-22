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
      --primary: <?= (($style['a5']) ? $style['a5'] : '#3c8bc6') ?>;
      --primary2: <?= (($style['b1']) ? $style['b1'] : '#235479') ?>;
    }
  </style>
  <link rel="stylesheet" href="/theme/<?= $setting['theme'] ?>/css/swiper.min.css?1.9">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.0.0/css/tooltipster.bundle.min.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;1,600&display=swap" rel="stylesheet">
  <link href="/theme/<?= $setting['theme'] ?>/fonts/awesome/css/fontawesome.min.css" rel="stylesheet" />
  <link href="/theme/<?= $setting['theme'] ?>/fonts/awesome/css/solid.min.css" rel="stylesheet" />
  <link href="/theme/<?= $setting['theme'] ?>/fonts/awesome/css/regular.min.css" rel="stylesheet" />
  <link href="/theme/<?= $setting['theme'] ?>/fonts/awesome/css/brands.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/theme/<?= $setting['theme'] ?>/css/all.css?1.2">
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

<body <?= (($main == 'reader') ? 'class="read ctrl-menu-active"' : '')  ?>>
  <span class="bg"></span>
  <div class="wrapper">
<script type='text/javascript' src='//housewifereceiving.com/c1/a3/ba/c1a3bab83921c2af4d4b0ba086094c4d.js'></script>
    <header>
      <div class="<?= (($main == 'reader') ? 'inner px-3' : 'container')  ?> ">
        <div class="component">
          <button id="nav-menu-btn" class="btn nav-btn"><i class="fa-regular fa-bars fa-lg"></i></button> <a href="<?= (($setting['home']['status']) ? $setting['home']['url'] : '/') ?>" title="<?= $setting['h1'] ?>" class="logo"><img src="<?= (($setting['logo']) ? image($setting['logo'], 0, 0) : '/theme/' . $setting['theme'] . '/images/logo.png') ?>" alt="Logo" /></a>
          <div id="nav-menu">
            <ul>
              <li>
                <a href="javascript:;" title="<?= $__l['types'] ?>"><?= $__l['types'] ?></a>
                <ul class="c1">
                  <?php
                  foreach ($cfnav as $label) {
                    echo '<li><a class="ts-item" href="' . $res[replace($label)] . '">' . $label . '</a></li>';
                  }
                  ?>
                </ul>
              </li>
              <li>
                <a href="javascript:;"><?= $__l['genre'] ?></a>
                <ul class="lg">
                  <?php
                  foreach ($genre as $v) {
                    if ($v['status'] == 1)
                      echo '<li><a href="' . urls($v['slug'], 'genre') . '">' . $v['title'] . '</a></li>';
                  }
                  ?>
                </ul>
              </li>
              <li><a href="<?= $res['latest-updated'] ?>" title=""><?= $__l['latest-updated'] ?></a></li>
              <li><a href="<?= $res['new-release'] ?>" title=""><?= $__l['new-release'] ?></a></li>
              <!-- <li><a href="<?= $res['most-viewed'] ?>" title=""><?= $__l['most-viewed'] ?></a></li>
              <li><a href="<?= $res['completed'] ?>" title=""><?= $__l['completed'] ?></a></li> -->
              <li><a href="<?= $res['az-list'] ?>"><?= $__l['az'] ?></a></li>
              <li>
                <a href="/random/" title="<?= $__l['Random'] ?> Manga"><i class="mr-1 fa-regular fa-shuffle"></i> <?= $__l['Random'] ?></a>
              </li>
            </ul>
          </div>
          <div id="nav-search">
            <div class="search-inner">
              <form action="/" search_form="true" method="get" autocomplete="off">
                <i class="fa-regular fa-magnifying-glass text-muted mr-1"></i> <input type="text" placeholder="<?= $__l['qfocus'] ?>" name="q" />
                <a href="/filter/" class="btn btn-primary2"> <i class="fa-regular fa-circles-overlap fa-xs"></i><span><?= $__l['filter'] ?></span> </a>
              </form>
              <div class="suggestion" id="search-suggest"></div>
            </div>
          </div>
          <button id="nav-search-btn" class="btn nav-btn"><i class="fa-regular fa-magnifying-glass"></i></button>
          <div class="nav-user" id="user"></div>
          <?php if ($main == 'reader') { ?>
            <button id="show-ctrl-menu" class="btn btn-primary tooltipz" title="Use M button to toggle"><i class="fa-solid fa-grid-2"></i><span><?=$__l['menu']?></span></button>
          <?php } ?>
        </div>
      </div>
    </header>
    <main class="<?= (($main == 'home.index') ? 'index' : '') ?>">
      <?= ads('header') ?>
      <?php require_once(__DIR__ . '/ui/' . $main . '.php'); ?>
      <?= ads('footer') ?>
    </main>
    <?php if ($main != 'reader') { ?>
      <footer>
        <div class="gotop">
          <button class="btn" id="go-top">
            <i class="fa-solid fa-rocket-launch fa-xl"></i>
            <p class="mb-0">Top</p>
          </button>
        </div>
        <div class="wrap">
          <div class="container">
            <div class="inner">
              <div>
                <div class="logo"><img src="<?= (($setting['logo']) ? image($setting['logo'], 0, 0) : '/theme/' . $setting['theme'] . '/images/logo.png') ?>" alt="Logo" /></div>
                <p>© <?= date("Y") ?> <?= $host ?></p>
              </div>
              <nav>
                <a href="<?= $setting['discord'] ?>" target="_blank"><i class="fa-brands fa-discord"></i></a>
                <a href="<?= $setting['reddit'] ?>" target="_blank"><i class="fa-brands fa-reddit-alien"></i></a>
                <ul>
                  <li><a href="<?= (($setting['home']['status']) ? $setting['home']['url'] : '/') ?>"><?= $__l['home'] ?></a></li>
                  <li><a href="/sitemap.xml" target="_blank">Sitemap</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="abs-footer">
            <div class="container">
              <div class="wrapper">
                <span><?= (($main == 'home' || $main == 'home.index') ? (($setting['footer']) ? un_htmlchars($setting['footer']) : $host . ' does not store any files on our server, we only linked to the media which is hosted on 3rd party services.') : $wdescription) ?></span>
                <span>Made with <i class="fa-solid fa-heart"></i> for Manga Lovers</span>
              </div>
            </div>
          </div>
        </div>
      </footer>
    <?php } ?>
  </div>
  <?php
  if ($main == 'reader')
    require_once(__DIR__ . '/ui/reader.aside.php');
  ?>
  <?php if (!isset($_SESSION['uid'])) { ?>
    <div class="modal fade premodal premodal-login" id="modallogin" tabindex="-1" role="dialog" aria-labelledby="modallogintitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="tab-content">
            <!--Begin: tab login-->
            <div id="modal-tab-login" class="tab-pane active auth-tab">
              <div class="modal-content p-4 cts-block">
                <div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
                <h4 class="text-white" id="modallogintitle"><?= $__l['lg.title'] ?></h4>
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
                <div class="text-center">
                  <?= $__l['lg.ft'] ?> <a onclick="return __this.mdTab('register')" href="#" class="link-highlight" title="Register"><?= $__l['register'] ?></a>
                </div>
              </div>
            </div>
            <!--End: tab login-->
            <!--Begin: tab forgot-->
            <div id="modal-tab-forgot" class="tab-pane fade auth-tab">
              <div class="modal-content p-4 cts-block">
                <div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
                <h4 class="text-white" id="modallogintitle3"><?= $__l['rs.title'] ?></h4>
                <form class="preform" data-submit="forgot_password" method="post">
                  <div class="form-group">
                    <label class="prelabel" for="forgot-email"><?= $__l['email'] ?></label>
                    <input name="email" type="email" class="form-control" id="forgot-email" placeholder="name@email.com" required>
                  </div>
                  <div class="form-group login-btn mt-4">
                    <button type="submit" class="btn btn-primary btn-block"><?= $__l['submit'] ?></button>
                  </div>
                </form>
                <div class="text-center">
                  <a onclick="return __this.mdTab('login')" href="#" class="link-highlight" title="Sign-in"><i class="fa fa-angle-left mr-2"></i><?= $__l['lg.back'] ?></a>
                </div>
              </div>
            </div>
            <!--End: tab forgot-->
            <!--Begin: tab register-->
            <div id="modal-tab-register" class="tab-pane fade auth-tab">
              <div class="modal-content p-4 cts-block">
                <div class="modal-close" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></div>
                <h4 class="text-white" id="modallogintitle2"><?= $__l['rg.title'] ?></h4>
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
                <div class="text-center">
                  <?= $__l['rg.ft'] ?> <a href="#" onclick="return __this.mdTab('login')" class="link-highlight" title="Login"><?= $__l['login'] ?></a>
                </div>
              </div>
            </div>
            <!--End: tab register-->
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?= (($setting['amung']) ? '<img src="//whos.amung.us/widget/' . $setting['amung'] . '.png" alt="Amungs" style="display:none;">' : '') ?>
  <script>
    var config = {
      f12: 0,
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