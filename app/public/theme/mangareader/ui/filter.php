<div id="main-wrapper" class="layout-page page-az page-filter">
  <div class="container">
    <div class="prebreadcrumb">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/"><?= $__l['home'] ?></a></li>
          <?php
          foreach ($breadcrumb as $k => $v) {
            echo '<li class="breadcrumb-item ' . (($k == count($breadcrumb) - 1) ? 'active' : '') . '"><a href="' . $v['url'] . '" title="' . $v['name'] . '">' . $v['name'] . '</a></li>';
          }
          ?>
        </ol>
      </nav>
    </div>
    <div class="page-search-wrap">
      <!--Begin: Section film list-->
      <section class="block_area block_area_search">
        <div id="filter-block">
          <form method="get">
            <div id="cate-filter" class="category_filter">
              <div class="category_filter-content mb-5">
                <div class="cfc-min-block">
                  <div class="ni-head mb-3"><strong><?= $__l['filter'] ?></strong></div>
                  <div class="cmb-item cmb-type">
                    <div class="ni-head"><?= $__l['type'] ?></div>
                    <div class="nl-item">
                      <div class="nli-select">
                        <select class="custom-select" name="type">
                          <option value="all"><?= $__l['all'] ?></option>
                          <?php
                          if ($filter['type'] == "")
                            $filter['type']  =  'all';
                          foreach ($cfnav as $vid => $vtitle) {
                            echo '<option ' . (($filter['type'] == "{$vtitle}") ? 'selected' : '') . ' value="' . $vtitle . '">' . $vtitle . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="cmb-item cmb-status">
                    <div class="ni-head"><?= $__l['status'] ?></div>
                    <div class="nl-item">
                      <div class="nli-select">
                        <select class="custom-select" name="status">
                          <option value="all"><?= $__l['all'] ?></option>
                          <?php
                          if ($filter['status'] == "")
                            $filter['status']  =  'all';
                          foreach ($cfst as $vid => $vtitle) {
                            echo '<option ' . (($filter['status'] == "{$vtitle}") ? 'selected' : '') . ' value="' . $vtitle . '">' . $vtitle . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="cmb-item cmb-language">
                    <div class="ni-head"><?= $__l['Language'] ?></div>
                    <div class="nl-item">
                      <div class="nli-select">
                        <select class="custom-select" name="language">
                          <option value="all"><?= $__l['all'] ?></option>
                          <?php
                          if ($filter['language'] == "")
                            $filter['language']  =  'all';
                          foreach ($language as $vid => $vtitle) {
                            echo '<option ' . (($filter['language'] == "{$vid}") ? 'selected' : '') . ' value="' . $vid . '">' . $vtitle . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="cmb-item">
                    <div class="ni-head"><?= $__l['Sort'] ?></div>
                    <div class="nl-item">
                      <div class="nli-select">
                        <select class="custom-select" name="sort">
                          <option value="default"><?= $__l['Default'] ?></option>
                          <option <?= (($filter['sort'] == "latest-updated") ? 'selected' : '') ?> value="latest-updated"><?= $__l['latest-updated'] ?></option>
                          <option <?= (($filter['sort'] == "most-viewed") ? 'selected' : '') ?> value="most-viewed"><?= $__l['most-viewed'] ?></option>
                          <option <?= (($filter['sort'] == "title-az") ? 'selected' : '') ?> value="title-az"><?= $__l['title-az'] ?></option>
                          <option <?= (($filter['sort'] == "title-za") ? 'selected' : '') ?> value="title-za"><?= $__l['title-za'] ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                </div>

                <div class="cfc-min-block cfc-min-block-genres mt-3">
                  <div class="ni-head mb-3"><strong><?= $__l['genre'] ?></strong></div>
                  <div class="cmbg-wrap">
                    <?php
                    foreach ($genre as $v) {
                      if ($v['status'] == 1) {
                        echo '
                        <div class="item f-genre-item">
                          <label>
                            <input name="genre[]" ' . ((in_array($v['id'], (array)$filter['genre'])) ? 'checked' : '') . ' type="checkbox" value="' . $v['id'] . '">
                            <span>' . $v['title'] . '</span>
                          </label>
                        </div>
                        ';
                      }
                    }
                    ?>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="cfc-button mt-4">
                  <button class="btn btn-focus new-btn"><strong><?= $__l['filter'] ?></strong></button>
                  <div class="clearfix"></div>
                </div>
              </div>

            </div>
            <div class="manga_list-sbs">
              <div class="block_area-header">
                <div class="bah-heading">
                  <h2 class="cat-heading"><?= $__l['Filter.Results'] ?></h2>
                </div>
                <div class="clearfix"></div>
              </div>
              <?php if ($arr['data']) { ?>
                <div class="mls-wrap">
                  <?= movies($arr['data']) ?>
                  <div class="clearfix"></div>
                </div>
                <div class="pre-pagination mt-4">
                  <?= $pages ?>
                </div>
              <?php } else { ?>
                <div class="notice"><?= $__l['nodb'] ?></div>
              <?php } ?>
            </div>
          </form>
        </div>
      </section>
    </div>
  </div>
</div>