<?php
// print_r($arr);
if ($arr['slide']) {
?>
	<div class="deslide-wrap">
		<div class="container">
			<div id="slider">
				<div class="swiper-wrapper">
					<?= movies($arr['slide'], 'slide') ?>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-navigation">
					<div class="swiper-button swiper-button-next"><i class="fas fa-angle-right"></i></div>
					<div class="swiper-button swiper-button-prev"><i class="fas fa-angle-left"></i></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
<?php } ?>
<div id="text-home" <?= ((!$arr['slide']) ? 'style="margin-top:-25px"' : '') ?>>
	<div class="container">
		<!--Begin: text home-->
		<div class="text-home">
			<h1 class="A1headline"><?= $setting['h1'] ?></h1>
			<div class="text-home-main"><?= $wdescription ?></div>
			<div class="social-home-block">
				<div class="shb-icon"></div>
				<div class="shb-left"><?= $__l['share.t'] ?></div>
				<div class="sharethis-inline-share-buttons"></div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--/End: text home-->
	</div>
</div>
<?php
if (!$home['status']) $home['status'] = [];
if (in_array('trending', $home['status'])) {
?>
	<div id="manga-trending">
		<div class="container">
			<section class="block_area block_area_trending mb-0">
				<div class="block_area-header">
					<div class="bah-heading">
						<h2 class="cat-heading"><?= $__l['trending'] ?></h2>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="block_area-content">
					<div class="trending-list" id="trending-home">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?= movies($arr['trending'], 'trending') ?>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="trending-navi">
							<div class="navi-next"><i class="fas fa-angle-right"></i></div>
							<div class="navi-prev"><i class="fas fa-angle-left"></i></div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php
}
?>
<?php
if (in_array('genre', $home['status'])) {
	$lgenre	=	true;
?>
	<div class="category_block category_block-home">
		<div class="container">
			<div class="c_b-wrap">
				<div class="c_b-list">
					<div class="cbl-row">
						<div class="item item-focus focus-01"><a href="<?= $res['latest-updated'] ?>" title=""><i class="mr-1">⚡</i><?= $__l['latest-updated'] ?></a></div>
						<div class="item item-focus focus-02"><a href="<?= $res['new-release'] ?>" title=""><i class="mr-1">✌</i><?= $__l['new-release'] ?></a></div>
						<div class="item item-focus focus-04"><a href="<?= $res['most-viewed'] ?>" title=""><i class="mr-1">🔥</i><?= $__l['most-viewed'] ?></a></div>
						<div class="item item-focus focus-05"><a href="<?= $res['completed'] ?>" title=""><i class="mr-1">✅</i><?= $__l['completed'] ?></a></div>
					</div>
					<div class="cbl-row">
						<?php
						foreach ($genre as $v) {
							if ($v['status'] == 1)
								echo '<div class="item"><a href="' . urls($v['slug'], 'genre') . '">' . $v['title'] . '</a></div>';
						}
						?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?= ads('home-1') ?>

<div id="main-wrapper">
	<div class="container">
		<div id="mw-2col">
			<div id="main-content">
				<?php
				$html	=	'';
				foreach ($home['ac'] as $k => $v) {
					if (in_array($v, $home['status']) && !in_array($v, ['slide', 'trending'])) {

						$rUrl	=	'';
						if ($v == 'latest-updated') {
							$rtitle	=	$__l['latest-updated'];
							$rUrl	=	$res['latest-updated'];
						} elseif ($v == 'completed') {
							$rtitle	=	$__l['completed'];
							$rUrl	=	$res['completed'];
						} elseif (preg_match("#^type:([0-9]+)$#", $v, $match)) {
							$rtitle	=	$__l['latest'] . ' ' . $cfnav[$match[1]];
						}
						$html .=	'
						<section class="block_area block_area_home">
							<div class="block_area-header block_area-header-tabs">
									<div class="float-left bah-heading">
										<h2 class="cat-heading" style="margin-top: 20px;">' . $rtitle . '</h2>
									</div>
									<!-- <div class="bah-tab">
											<ul class="nav nav-tabs pre-tabs pre-tabs-min">
													<li class="nav-item"><a data-toggle="tab" href="#latest-chap" class="nav-link active show">Chapter</a></li>
													<li class="nav-item"><a data-toggle="tab" href="#latest-vol" class="nav-link">Volume</a></li>
											</ul>
									</div> -->
									<div class="clearfix"></div>
							</div>
							<div class="tab-content">
									<div id="latest-' . $v . '" class="tab-pane active show">
											<div class="manga_list-sbs">
													<div class="mls-wrap">
														' . movies($arr[$v], ($v == 'newest') ? 'list' : '') . '
															<div class="clearfix"></div>
													</div>
											</div>
									</div>
							</div>
					</section>
					' . (($rUrl) ? '<div class="posts-more"><a class="btn btn-more" href="' . $rUrl . '">' . $__l['more'] . ' <i class="fa fa-angle-down" aria-hidden="true"></i></a></div>' : '') . '
					';
						// if ($v == 'latest-updated') {
						// 	$html .= '<div class="pre-pagination mt-4">' . $pages . '</div>';
						// }
					}
				}
				echo $html;
				?>
			</div>
			<div id="main-sidebar">
				<?= ads('home-2') ?>
				<?php require_once('right.home.php'); ?>kko
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>