<?php
function genresR()
{
  global $lgenre, $genre, $__l, $res;
  $html  =  '';
  if (!$lgenre) {
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
  }
  return $html;
}
echo genresR();
