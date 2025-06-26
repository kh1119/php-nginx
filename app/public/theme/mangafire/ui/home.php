<?php
if ($arr['slide']) {
?>
	<div id="top-trending">
		<div class="container">
			<div class="swiper trending swiper-container">
				<div class="swiper-wrapper">
					<?= movies($arr['slide'], 'slide') ?>
				</div>
				<div class="trending-button-next"></div>
				<div class="trending-button-prev"></div>
			</div>

		</div>
	</div>
<?php } ?>
<div class="container">
	<div class="alert bg-secondary text-center">
		<div class="text-home">
			<h1 class="A1headline"><?= $setting['h1'] ?></h1>
			<div class="text-home-main"><?= $wdescription ?></div>
			<div class="social-home-block">
				<div class="shb-icon"></div>
				<div class="shb-left"><?= $__l['share.t'] ?></div>
				<div class="sharethis-inline-share-buttons"></div>
			</div>
		</div>
	</div>
	<?php
	if (!$home['status']) $home['status'] = [];
	if (in_array('trending', $home['status'])) {
	?>
		<section class="home-swiper" id="most-viewed">
			<div class="head">
				<h2><?= $__l['trending'] ?></h2>
			</div>
			<div class="swiper-container">
				<div class="swiper">
					<div class="card-md swiper-wrapper">
						<?= movies($arr['trending'], 'trending') ?>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</section>
	<?php
	}
	?>
	<?php
	if (in_array('genre', $home['status'])) {
		$lgenre	=	true;
		$genre_html  =  [];
		foreach ($genre as $v) {
			if ($v['status'] == 1)
				$genre_html[]  =  '<div class="item"><a href="' . urls($v['slug'], 'genre') . '">' . $v['title'] . '</a></div>';
		}
		echo '
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
	}
	?>
	<?= ads('home-1') ?>
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
				<section class="s' . $v . '">
					<div class="head">
						<h2>' . $rtitle . '</h2>
						' . (($rUrl) ? '<div class="posts-more"><a class="btn btn-more" href="' . $rUrl . '">' . $__l['more'] . ' <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>' : '') . '
					</div>
					<div class="original card-lg">
						' . movies($arr[$v], ($v == 'newest') ? 'list' : '') . '
					</div>
				</section>
			';
		}
	}
	echo $html;
	?>
	<?= ads('home-2') ?>
	<?php require_once('right.home.php'); ?>
</div>