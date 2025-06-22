<div class="prebreadcrumb">
	<div class="container">
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
</div>
<div id="main-wrapper" class="page-layout page-category">
	<div class="container">
		<div id="mw-2col">
			<div id="main-content">
				<section class="block_area block_area_category">
					<div class="block_area-header">
						<div class="bah-heading float-left">
							<h1 class="cat-heading"><?= $title ?></h1>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php if ($type == 'az') { ?>
						<div class="category_block">
							<div class="c_b-wrap">
								<div class="c_b-list active alphabet-list">
									<div class="cbl-row">
										<div class="item <?= ((!$filter['letter'] || $filter['letter'] == '0-9') ? 'active' : '') ?>"><a href="<?= $res['az-list'] ?>">0-9</a></div>
										<?php
										foreach (range('A', 'Z') as $letters) {
											echo '<div class="item ' . (($filter['letter'] == $letters) ? 'active' : '') . '"><a href="' . $res['az-list'] . '?letter=' . $letters . '">' . $letters . '</a></div>';
										}
										?>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					<?= ads('list-1') ?>
					<?php if ($arr['data']) { ?>
						<div class="manga_list-sbs">
							<div class="mls-wrap">
								<?= movies($arr['data']) ?>
								<div class="clearfix"></div>
							</div>
							<div class="pre-pagination mt-4">
								<?= $pages ?>
							</div>
						</div>
					<?php } else { ?>
						<div class="notice"><?= $__l['nodb'] ?></div>
					<?php } ?>
				</section>
			</div>
			<div id="main-sidebar">
				<?= ads('list-2') ?>
				<?php require_once('right.php'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>