<style>.mr-tools.mrt-bottom { position: relative !important; left: 0 !important; }</style>
<div id="wrapper" data-reading-id="1725371" data-reading-by="chap" data-lang-code="en" data-manga-id="869">
  <!--Begin: Header-->
  <div id="header" class="header-reader">
    <div class="container">
      <div class="auto-div">
        <a href="/" id="logo" class="mr-0">
          <img src="<?= (($setting['logo']) ? image($setting['logo'], 0, 0) : '/theme/' . $setting['theme'] . '/images/logo.png') ?>" alt="logo">
          <div class="clearfix"></div>
        </a>
        <div class="hr-line"></div>
        <a href="<?= $iurl ?>" class="hr-manga">
          <h2 class="manga-name"><?= $mv['title'] ?></h2>
        </a>
        <div class="hr-navigation">
          <div class="rt-item rt-read">
            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn">
              <div class="d-block"><?= $__l['reading.title'] ?></div>
              <span class="name" id="reading-by"><?= $__l['By'] ?> <?= $__l[ucwords($__type)] ?></span><span class="m-show"><?= $__l['Reading'] ?></span><i class="fas fa-angle-down ml-2"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
              <?php if ($arr['chapters']['chap']) { ?>
                <a class="dropdown-item select-reading-by" href="<?= urls($mv['slug'] . '/' . $__lang . '/chapter-1', 'post') ?>"><?= $__l['By'] ?> <?= $__l['Chapter'] ?></a>
              <?php }
              if ($arr['chapters']['vol']) { ?>
                <a class="dropdown-item select-reading-by" href="<?= urls($mv['slug'] . '/' . $__lang . '/volume-1', 'post') ?>"><?= $__l['By'] ?> <?= $__l['Volume'] ?></a>
              <?php } ?>
            </div>
          </div>
          <div id="reading-list" style="display: initial">
            <div class="rt-item rt-lang">
              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn" id="c-selected-lang"><span class="rl-hide"><?= $__l['Language'] ?>: </span><span class="rl-lang-text">EN</span><i class="fas fa-angle-down ml-2"></i></button>
              <div class="dropdown-menu lang-options dropdown-menu-model" aria-labelledby="ssc-list">
                <?php
                foreach ($arr['chapters'][$uiType] as $lang => $chap) {
                  echo '<a class="dropdown-item c-select-lang lang-item" href="javascript:;" data-type="chap" data-code="' . $lang . '">[' . strtoupper($lang) . '] ' . $language[$lang] . ' (' . count($chap) . ' ' . $__l[ucwords($__type) . 's'] . ')</a>';
                }
                ?>
              </div>
            </div>
            <div class="rt-item rt-chap show" id="dropdown-chapters">
              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn">
                <?= (($__type == 'vol') ? $__l[ucwords($__type)] . ' <span id="current-chapter"></span><i class="fas fa-angle-down ml-2"></i>' : str_replace('{1}', '<span id="current-chapter"></span>', $setting['prefix']) . '<i class="fas fa-angle-down ml-2"></i>') ?>
              </button>
              <div class="dropdown-menu dropdown-menu-model dropdown-menu-fixed" aria-labelledby="ssc-list" x-placement="top-start">
                <div class="chapter-list-read">
                  <div class="chapter-section">
                    <div class="chapter-s-search">
                      <form class="preform search-reading-item-form">
                        <div class="css-icon"><i class="fas fa-search"></i></div>
                        <input class="form-control search-reading-item" type="text" placeholder="<?= $__l['cfocus'] ?>" autofocus="autofocus" autocomplete="off">
                      </form>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="chapters-list-ul">
                    <?php
                    foreach ($arr['chapters'][$uiType] as $lang => $chap) {
                      echo '<ul class="ulclear reading-list lang-chapters" style="display:none" id="' . $lang . '-chapters">';
                      foreach ($chap as $name => $v) {
                        $cur  =  pUrl($mv['slug'] . '/' . $lang . '/' . $__type . '-' . $name);
                        if ($change[$cur]) {
                          $chap_url  =  urls($mv['slug'] . '/' . $lang . '/' . $__type . '-' . $name . '-i' . $change[$cur], 'post');
                        } else {
                          $chap_url  =  urls($mv['slug'] . '/' . $lang . '/' . $__type . '-' . $name, 'post');
                        }
                        echo '
										<li class="item reading-item chapter-item" data-id="' . $v['id'] . '" data-number="' . $name . '">
											<a href="' . $chap_url . '" class="item-link" title="' . $__l[ucwords($__type)] . ' ' . $name . (($v['title']) ? ': ' . $v['title'] : '') . '">
												<span class="arrow mr-2"><i class="far fa-file-alt"></i></span>
												<span class="name">' . (($__type == 'vol') ? $__l[ucwords($__type)] . ' ' : '') . xN($name) . (($v['title']) ? ': ' . $v['title'] : '') . '</span>
												<span class="item-read"><i class="fas fa-glasses mr-1"></i> ' . $__l['Read'] . '</span>
											</a>
											<div class="clearfix"></div>
										</li>
										';
                      }
                      echo '</ul>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="rt-item rt-navi">
            <button type="button" class="btn btn-navi" onclick="read.prev()"><i class="fas fa-arrow-left mr-2"></i>
            </button>
          </div>
          <div class="rt-item rt-navi right">
            <button type="button" class="btn btn-navi" onclick="read.next()"><i class="fas fa-arrow-right ml-2"></i>
            </button>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="float-right hr-right">
          <?php if ($setting['comment'] > 0) { ?>
            <div class="hr-comment mr-2">
              <a href="javascript:;" class="btn btn-sm hrr-btn">
                <i class="far fa-comment-alt"></i>
                <span class="number">0</span>
                <span class="hrr-name"><?= $__l['comment'] ?></span>
              </a>
              <div class="clearfix"></div>
            </div>
          <?php } ?>
          <div class="hr-setting mr-2">
            <a class="btn btn-sm hrr-btn"><i class="fas fa-cog"></i><span class="hrr-name"><?= $__l['Settings'] ?></span></a>
            <div class="clearfix"></div>
          </div>
          <div class="hr-info mr-2">
            <a href="<?= $iurl ?>" class="btn btn-sm hrr-btn"><i class="fas fa-info"></i><span class="hrr-name"><?= $__l['Manga.Detail'] ?></span></a>
            <div class="clearfix"></div>
          </div>
          <div class="hr-fav" id="reading-list-info"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="ad-toggle"><i class="fas fa-expand-arrows-alt"></i></div>
    </div>
  </div>
  <!--End: Header-->
  <div class="clearfix"></div>
  <div class="mr-tools mrt-top">
    <div class="container">
      <div class="read_tool">
        <div class="float-left">
          <?php if ($build['pl'] == 'comic') { ?>
            <div class="rt-item">
              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn"><?= $__l['Font.family'] ?>: <span id="current-font"><?= $__l['Default'] ?></span> <i class="fas fa-angle-down ml-2"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                <?php
                $fonts = [
                  ''  =>  $__l['Default'],
                  "'Palatino Linotype', serif" => 'Palatino Linotype',
                  "Bookerly, serif" => 'Bookerly',
                  "Minion, serif" => 'Minion',
                  "'Segoe UI', sans-serif" => 'Segoe UI',
                  "Roboto, sans-serif" => 'Roboto',
                  "'Roboto Condensed', sans-serif" => 'Roboto Condensed',
                  "'Patrick Hand', sans-serif" => 'Patrick Hand',
                  "'Noticia Text', sans-serif" => 'Noticia Text',
                  "'Times New Roman', serif" => 'Times New Roman',
                  "Verdana, sans-serif" => 'Verdana',
                  "Tahoma, sans-serif" => 'Tahoma',
                  "Arial, sans-serif" => 'Arial',
                ];
                foreach ($fonts as $k => $v) {
                  echo '<a class="dropdown-item font-item" data-value="' . $k . '">' . $v . '</a>';
                }
                ?>
              </div>
            </div>
            <div class="rt-item">
              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn"><?= $__l['Font.size'] ?>: <span id="current-size">17</span> <i class="fas fa-angle-down ml-2"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                <?php
                for ($i = 14; $i <= 40; $i++) {
                  echo '<a class="dropdown-item size-item" data-value="' . $i . '">' . $i . '</a>';
                }
                ?>
              </div>
            </div>
          <?php } else { ?>
            <div class="rt-item">
              <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn"><?= $__l['Reading.Mode'] ?>: <span id="current-mode"><?= $__l['All.Page'] ?></span> <i class="fas fa-angle-down ml-2"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-model" aria-labelledby="ssc-list">
                <a class="dropdown-item mode-item" data-value="vertical" href="#"><?= $__l['All.Page'] ?></a>
                <a class="dropdown-item mode-item" data-value="horizontal" href="#"><?= $__l['One.Page'] ?></a>
              </div>
            </div>
          <?php } ?>
          <div class="clearfix"></div>
        </div>
        <div class="float-right">
          <div class="rt-item" id="rt-close">
            <button type="button" class="btn"><i class="fas fa-times mr-2"></i><?= $__l['close'] ?></button>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div id="images-content">
    <div id="first-read" style="display: none;">
      <div id="main-wrapper" class="page-layout page-read mb-0">

      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php if ($setting['comment'] > 0) { ?>
    <div id="read-comment">
      <div class="rc-close"><span aria-hidden="true">×</span></div>
      <div class="comments-wrap">
        <div class="sc-header">
          <div class="sc-h-title"><?= $__l['comment'] ?></div>
          <div class="clearfix"></div>
        </div>
        <div id="content-comments">
          <?php if ($setting['comment'] == 2) { ?>
            <div id="disqus_thread"></div>
            <script>
              var disqus_config = function() {
                this.page.url = '<?= $url ?>';
                this.page.identifier = 'Movies-<?= $mv['id'] ?>';
              };
              (function() {
                var d = document,
                  s = d.createElement('script');
                s.src = 'https://<?= $setting['comment_id'] ?>.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
              })();
            </script>
          <?php } else { ?>
            <div class="fb-comments" data-href="<?= $url ?>" data-width="100%" data-numposts="5"></div>
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="TwyqvOnA"></script>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>

</div>
<script>
  let manga = {
    id: '<?= $mv['id'] ?>',
    type: '<?= $__type ?>',
    lang: '<?= $__lang ?>',
    name: '<?= $__name ?>',
    url: '<?= $wurl ?>',
    value: {
      vertical: '<?= $__l['All.Page'] ?>',
      horizontal: '<?= $__l['One.Page'] ?>',
      Default: '<?= $__l['Default'] ?>',
      pl: '<?= $build['pl'] ?>'
    },
    max: 5,
    server: '<?= (($int['proxy'])?$int['proxy']:'ax03.site') ?>'
  };
</script>