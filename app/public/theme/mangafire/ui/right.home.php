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
      <section class="area-genres">
			<div class="head">
				<h2>' . $__l['genre'] . '</h2>
			</div>
			<div class="category_block">
				<div class="c_b-wrap">
					<div class="c_b-list active">
							<div class="item item-focus focus-01"><a href="' . $res['latest-updated'] . '" title=""><i class="mr-1">⚡</i>' . $__l['latest-updated'] . '</a></div>
							<div class="item item-focus focus-02"><a href="' . $res['new-release'] . '" title=""><i class="mr-1">✌</i>' . $__l['new-release'] . '</a></div>
							<div class="item item-focus focus-04"><a href="' . $res['most-viewed'] . '" title=""><i class="mr-1">🔥</i>' . $__l['most-viewed'] . '</a></div>
							<div class="item item-focus focus-05"><a href="' . $res['completed'] . '" title=""><i class="mr-1">✅</i>' . $__l['completed'] . '</a></div>
						' . implode('', $genre_html) . '
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
      $data = movies($arr['r' . $v], 'trending');
      if ($data) {
        $html .=  '
        <section class="home-swiper">
          <div class="head">
              <h2>' . $rtitle . '</h2>
              ' . (($rUrl) ? '<div class="right-more"><a href="' . $rUrl . '">' . $__l['more'] . ' <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>' : '') . '
          </div>
          <div class="swiper-container">
              <div class="swiper completed">
                <div class="card-md swiper-wrapper">
                  ' . movies($arr['r' . $v], 'trending') . '
                </div>
                <div class="completed-pagination"></div>
              </div>
          </div>
        </section>
        ';
      }
    }
  }
}
echo $html;
