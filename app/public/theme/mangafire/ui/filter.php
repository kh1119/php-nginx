<div class="container">
  <section class="mt-5">
    <div class="head">
      <h2><?= $__l['Filter.Results'] ?></h2>
    </div>

    <form id="filters" method="get" autocomplete="off">
      <div>
        <div class="cmb-item cmb-type">
          <div>
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

        </div>
        <div class="cmb-item cmb-status">
          <div>
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
          </div>
        </div>

        <div class="cmb-item cmb-language">
          <div>
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
          </div>
        </div>
        <div class="cmb-item">
          <div>
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
          </div>
        </div>
        <div>
          <div class="dropdown responsive">
            <button data-toggle="dropdown"><span class="value" data-placeholder="Type" data-label-placement="true"><?= $__l['genre'] ?></span></button>
            <div class="dropdown-menu noclose lg c4 dropdown-menu-right dropdown-menu-md-left">
              <ul class="genre">
                <?php
                foreach ($genre as $v) {
                  if ($v['status'] == 1) {
                    echo '
                  <li><input id="genre-' . $v['id'] . '" name="genre[]" ' . ((in_array($v['id'], (array)$filter['genre'])) ? 'checked' : '') . ' type="checkbox" value="' . $v['id'] . '"><label for="genre-' . $v['id'] . '">' . $v['title'] . '</label></li>';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div>
          <button class="btn btn-primary"><i class="fa-regular fa-circles-overlap fa-xs"></i> <span><?= $__l['filter'] ?></span> <i class="ml-2 bi bi-intersect"></i></button>
        </div>
      </div>
    </form>
    <?= ads('list-1') ?>
    <?php if ($arr['data']) { ?>
      <div class="original card-lg">
        <?= movies($arr['data']) ?>
      </div>
      <nav class="navigation"><?= $pages ?></nav>
    <?php } else { ?>
      <div class="notice"><?= $__l['nodb'] ?></div>
    <?php } ?>
    <?= ads('list-2') ?>
  </section>
</div>