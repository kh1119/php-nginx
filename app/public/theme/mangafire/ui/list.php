<div class="container">
	<section class="mt-5">
		<div class="head">
			<h1><?= $title ?></h1>
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