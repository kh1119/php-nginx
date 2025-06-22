<?php
$html  =  '';
foreach ($home['rac'] as $k => $v) {
  if (in_array($v, $home['rstatus'])) {
    if ($v == 'genre' && !$lgenre) {
      $genre_html  =  [];
      foreach ($genre as $v) {
        if ($v['status'] == 1)
          $genre_html[]  =  '<div class="item"><a href="' . urls($v['slug'], 'genre') . '">' . $v['title'] . '</a></div>';
      }
      $html .=  '
      <section class="block_area block_area_sidebar block_area-genres">
        <div class="block_area-header">
            <div class="bah-heading">
                <h2 class="cat-heading">' . $__l['genre'] . '</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block_area-content">
            <div class="category_block mb-0">
                <div class="c_b-wrap">
                    <div class="c_b-list active">
                      <div class="cbl-row">
                        <div class="item item-focus focus-01"><a href="' . $res['latest-updated'] . '" title=""><i class="mr-1">⚡</i>' . $__l['latest-updated'] . '</a></div>
                        <div class="item item-focus focus-02"><a href="' . $res['new-release'] . '" title=""><i class="mr-1">✌</i>' . $__l['new-release'] . '</a></div>
                        <div class="item item-focus focus-04"><a href="' . $res['most-viewed'] . '" title=""><i class="mr-1">🔥</i>' . $__l['most-viewed'] . '</a></div>
                        <div class="item item-focus focus-05"><a href="' . $res['completed'] . '" title=""><i class="mr-1">✅</i>' . $__l['completed'] . '</a></div>
                      </div>
                      <div class="cbl-row">' . implode('', $genre_html) . '</div>
                      <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
      </section>
			';
    } else {
      $rUrl  =  '';
      if ($v == 'popular') {
        $rtitle  =  $__l['popular'];
        $rUrl  =  $res['popular'];
      } elseif ($v == 'completed') {
        $rtitle  =  $__l['completed'];
        $rUrl  =  $res['completed'];
      } elseif ($v == 'most-viewed') {
        $rtitle  =  $__l['most-viewed'];
        $rUrl  =  $res['most-viewed'];
      } elseif ($v == 'rand') {
        $rtitle  =  $__l['rtitle'];
      } elseif (preg_match("#^type:([0-9]+)$#", $v, $match)) {
        $rtitle  =  $cfnav[$match[1]];
      }
      if ($v == 'most-viewed') {
        $html .=  '
        <section class="block_area block_area_sidebar block_area-realtime">
          <div class="block_area-header">
              <div class="float-left bah-heading">
                  <h2 class="cat-heading" style="margin-top: 20px;">' . $rtitle . '</h2>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="block_area-content">
            <div class="cbox cbox-list cbox-realtime">
              <div class="cbox-content">
                <div class="tab-content">
                  <div id="chart-today" class="tab-pane show active">
                  <div class="featured-block-ul featured-block-chart">
                    <ul class="ulclear">' . movies($arr['r' . $v], 'top') . '</ul>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        ';
      } else {
        $data = movies($arr['r' . $v], 'right');
        if($data) {
          $html .=  '
          <section class="block_area block_area_sidebar block_area-realtime">
            <div class="block_area-header">
              <div class="float-left bah-heading">
                <h2 class="cat-heading">' . $rtitle . '</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="block_area-content">
              <div class="cbox cbox-list cbox-realtime">
                <div class="featured-block-ul">
                  <ul class="ulclear">
                    ' . movies($arr['r' . $v], 'right') . '
                  </ul>
                </div>
              </div>
            </div>
            ' . (($rUrl) ? '<div class="right-more"><a href="' . $rUrl . '">' . $__l['more'] . ' <i class="fa fa-angle-down" aria-hidden="true"></i></a></div>' : '') . '
          </section>
          ';
        }

      }
    }
  }
}
echo $html;
