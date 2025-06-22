<div class="m-content">
  <div id="page-wrapper">
    <div id="images-content"></div>
  </div>
  <div class="sub-panel scroll-sm" id="number-panel">
    <div class="head">
      <span></span>
      <button class="close-primary btn btn-secondary1" id="page-close"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
    <div class="chapter-list-read">
      <div class="chapter-section">
        <div class="chapter-s-search">
          <form class="preform search-reading-item-form">
            <div class="css-icon"><i class="fas fa-search"></i></div>
            <input class="form-control search-reading-item2" type="text" placeholder="<?= $__l['cfocus'] ?>" autofocus="autofocus" autocomplete="off">
          </form>
        </div>
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
												<span class="name">' . (($__type == 'vol') ? $__l[ucwords($__type)] . ' ' : '') . xN($name) . (($v['title']) ? ': ' . $v['title'] : '') . '</span>
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
  <div class="sub-panel scroll-sm" id="page-panel">
    <div class="head">
      <span></span> <button class="close-primary btn btn-secondary1" id="page-close"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
    <ul id="page-items"></ul>


  </div>
  <?php if ($setting['comment'] > 0) { ?>
    <div class="sub-panel scroll-sm" id="comment-panel">
      <div class="head">
        <b><?= $__l['comment'] ?></b>
        <div class="close-primary btn btn-secondary1" id="comment-close"><i class="fa-solid fa-chevron-right"></i></div>
      </div>
      <div class="body p-3">
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
  <?php } ?>
</div>
<div id="ctrl-menu" class="active">
  <div class="head">
    <a href="<?= $iurl ?>"><?= $mv['title'] ?></a>
    <div class="close-primary btn btn-secondary1 tooltipz" id="ctrl-menu-close" title="Use M button to toggle"><i class="fa-solid fa-chevron-right"></i></div>
  </div>
  <button class="chapvol-switch">
    <div>
      <p><?= $__l['reading.title'] ?></p>
      <b><?= $__l['By'] ?> <span class="current-viewtype"><?= $__l[ucwords($__type)] ?></span></b>
    </div>
    <i class="fa-light fa-arrows-rotate"></i>
  </button>
  <div class="dropdown mb-2" id="reading-list">
    <button class="justify-content-center" data-toggle="dropdown" data-placeholder="false" id="c-selected-lang"><i class="fa-regular fa-earth-americas"></i> <span class="mx-1"><?= $__l['Language'] ?>: </span> <b class="rl-lang-text lang-view"></b></button>
    <div class="lang-options dropdown-menu w-100 dropdown-menu-right">
      <?php
      foreach ($arr['chapters'][$uiType] as $lang => $chap) {
        echo '<a class="dropdown-item c-select-lang lang-item" href="javascript:;" data-type="chap" data-code="' . $lang . '">[' . strtoupper($lang) . '] ' . $language[$lang] . ' (' . count($chap) . ' ' . $__l[ucwords($__type) . 's'] . ')</a>';
      }
      ?>
    </div>
  </div>
  <!-- <nav>
    <button id="page-go-left"><i class="fa-regular fa-chevron-left"></i></button>
    <button class="page-toggler">
      <b>Page <span class="current-page"></span></b> <i class="fa-solid fa-sort fa-sm"></i>
    </button>
    <button id="page-go-right"><i class="fa-regular fa-chevron-right"></i></button>
  </nav> -->
  <nav>
    <button id="number-go-left" onclick="read.prev()"><i class="fa-regular fa-chevron-left"></i></button>
    <button class="number-toggler">
      <b class="current-type-number text-title">
        <?= (($__type == 'vol') ? $__l[ucwords($__type)] . ' <span id="current-chapter"></span>' : str_replace('{1}', '<span id="current-chapter"></span>', $setting['prefix']) . '') ?>
      </b> <i class="fa-solid fa-sort fa-sm"></i>
    </button>
    <button id="number-go-right" onclick="read.next()"><i class="fa-regular fa-chevron-right"></i></button>
  </nav>
  <?php if ($setting['comment'] > 0) { ?>
    <button id="comment-toggler" class="jb-btn">
      <i class="fa-light fa-message-dots fa-flip-horizontal fa-lg"></i> <span><?= $__l['comment'] ?></span>
    </button>
  <?php } ?>
  <a href="<?= $iurl ?>" class="jb-btn"> <i class="fa-light fa-lg fa-circle-info"></i> <span><?= $__l['Manga.Detail'] ?></span> </a>
  <hr />
  <div class="btn-options mb-2 tooltipz" data-name="header_visible" title="Use H button to toggle.">
    <div data-value="hidden">
      <button class="justify-content-between"><span>Header Hidden</span><i class="fa-light fa-square fa-lg"></i></button>
    </div>
    <div data-value="sticky">
      <button class="justify-content-between"><span>Header Sticky</span><i class="fa-light fa-window-maximize fa-lg"></i></button>
    </div>
  </div>
  <!-- <button class="jb-btn" data-toggle="modal" data-target=".advanced-settings"><span><?= $__l['Settings'] ?></span><i class="fa-light fa-sliders fa-lg"></i></button> -->
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