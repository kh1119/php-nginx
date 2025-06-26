<?php
function movies($arr = [], $theme = 'movie', $max = [])
{
	global $change, $rmfav, $cfnav, $__l;
	$st = 0;
	$html = '';
	$label	=	[$__l['ongoing'], $__l['completed']];
	foreach ($arr as $i => $v) {
		$vj = json_decode($v['data'], true);
		$ch	=	json_decode($v['chap'], true);
		$pid	=	pUrl($v['slug']);
		$url  =  urls($v['slug'] . (($change[$pid]) ? '.' . $change[$pid] : ''), 'post');
		$thumb  =  image($v['thumb'], 220, 0);
		if ($theme == 'list') {
			$vj['info']	=	cutStr($vj['info'], 120);
		}
		if ($ch['lang'])
			$ch['lang']	=	array_map('strtoupper', $ch['lang']);

		if ($theme == 'top' || $theme == 'right') {
			if ($vj['genre']) {
				$cate	=	[];
				foreach (explode(',', $vj['genre']) as $r) {
					$cate[]	=	'<a href="' . urls($r, 'genre') . '">' . $r . '</a>';
				}
			}
			$html	.=	'
			<li class="item-top">
				'.(($theme == 'top')?'<div class="ranking-number"><span>' . (($i < 8) ? '0' : '') . ($i + 1) . '</span></div>':'').'
				<a href="' . $url . '" class="manga-poster">
					<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $thumb . '" class="manga-poster-img lazyload" alt="' . $v['title'] . '">
				</a>
				<div class="manga-detail">
					<h3 class="manga-name"><a href="' . $url . '" title="' . $v['title'] . '">' . $v['title'] . '</a></h3>
					<div class="fd-infor">
						' . (($ch['lang']) ? '<span class="fdi-item">' . implode('/', $ch['lang']) . '</span><span class="dot"></span>' : '') . '
						' . (($vj['genre']) ? '<div class="fdi-item fdi-cate"><span>' . implode(', ', $cate) . '</span></div>' : '') . '
						'.(($theme == 'top')?'<span class="fdi-item fdi-view">' . number_format($v['view']) . ' ' . $__l['view'] . '</span>':'').'
						<div class="d-block" style="min-height: 20px;">
							' . (($ch['chap']) ? '<span class="fdi-item fdi-chapter"><a href="' . urls($v['slug'] . '/' . $ch['chap'][0]['lang'] . '/chapter-' . $ch['chap'][0]['name'], 'post') . '"><i class="far fa-file-alt mr-2"></i>' . xN($ch['chap'][0]['name']) . '</a></span>' : '') . '
							' . (($ch['vol']) ? '<span class="fdi-item fdi-chapter"><a href="' . urls($v['slug'] . '/' . $ch['vol'][0]['lang'] . '/volume-' . $ch['vol'][0]['name'], 'post') . '"><i class="far fa-file-alt mr-2"></i>' . $__l['Vol'] . ' ' . $ch['vol'][0]['name'] . '</a></span>' : '') . '
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</li>
			';
		}
		elseif ($theme == 'trending') {
			$html	.=	'
			<div class="swiper-slide">
				<div class="item">
						<div class="manga-poster">
								<a class="link-mask" href="' . $url . '"></a>
								' . (($ch['lang']) ? '<span class="tick tick-item tick-lang">' . implode('/', $ch['lang']) . '</span>' : '') . '
								<div class="mp-desc">
										<p class="alias-name mb-2"><strong>' . $v['title'] . '</strong></p>
										' . (($ch['lang']) ? '<p><i class="fas fa-globe mr-2"></i>' . implode('/', $ch['lang']) . '</p>' : '') . '
										' . (($ch['chap']) ? '<p><a href="' . urls($v['slug'] . '/' . $ch['chap'][0]['lang'] . '/chapter-' . $ch['chap'][0]['name'], 'post') . '"><i class="far fa-file-alt mr-2"></i><strong>' . xN($ch['chap'][0]['name']) . '</strong></a></p>' : '') . '
										' . (($ch['vol']) ? '<p><a href="' . urls($v['slug'] . '/' . $ch['vol'][0]['lang'] . '/volume-' . $ch['vol'][0]['name'], 'post') . '"><i class="far fa-file-alt mr-2"></i><strong>' . $__l['Vol'] . ' ' . $ch['vol'][0]['name'] . '</strong></a></p>' : '') . '
										<div class="mpd-buttons">
												<a href="' . $url . '?read=1" class="btn btn-primary btn-sm btn-block"><i class="fas fa-glasses mr-2"></i>' . $__l['Read.Now'] . '</a>
												<a href="' . $url . '" class="btn btn-light btn-sm btn-block"><i class="fas fa-info-circle mr-2"></i>' . $__l['Info'] . '</a>
										</div>
								</div>
								<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $thumb . '" class="manga-poster-img lazyload" alt="' . $v['title'] . '">
						</div>
						<div class="number"><span>' . (($i < 8) ? '0' : '') . ($i + 1) . '</span>
								<div class="anime-name">' . $v['title'] . '</div>
						</div>
						<div class="clearfix"></div>
				</div>
		</div>
			';
		} elseif ($theme == 'slide') {
			$thumb  =  image($v['thumb'], 500, 0);
			$cate	=	explode(',', $vj['genre']);
			$html	.=	'
			<div class="swiper-slide">
				<div class="deslide-item">
					<a href="' . $url . '" class="deslide-cover">
						<img class="manga-poster-img lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $thumb . '" alt="' . $v['title'] . '"></a>
					<div class="deslide-poster">
						<a href="' . $url . '" class="manga-poster">
							<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $thumb . '" class="manga-poster-img lazyload" alt="' . $v['title'] . '">
						</a>
					</div>
					<div class="deslide-item-content">
						' . (($ch['chap']) ? '<div class="desi-sub-text">' . xN($ch['chap'][0]['name']) . '</div>' : '') . '
						<div class="desi-head-title">
							<a title="' . $v['title'] . '" href="' . $url . '">' . $v['title'] . '</a>
						</div>
						<div class="sc-detail">
							<div class="scd-item mb-3">' . $vj['info'] . '</div>
							' . (($vj['genre']) ? '<div class="scd-item scd-genres"><span>' . implode('</span><span>', $cate) . '</span></div>' : '') . '
							<div class="clearfix"></div>
						</div>
						<div class="desi-buttons">
							<a href="' . $url . '?read=1" class="btn btn-slide-read mr-2"><i class="fas fa-glasses mr-2"></i> ' . $__l['Read.Now'] . '</a>
							<a href="' . $url . '" class="btn btn-slide-info"><i class="fas fa-info-circle mr-2"></i>' . $__l['Info'] . '</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			';
		} else {
			if ($vj['genre']) {
				$cate	=	[];
				foreach (explode(',', $vj['genre']) as $r) {
					$cate[]	=	'<a href="' . urls($r, 'genre') . '">' . $r . '</a>';
				}
			}
			$chap	=	[];
			if ($ch['chap']) {
				foreach ($ch['chap'] as $r) {
					$cur	=	pUrl($v['slug'] . '/' . $r['lang'] . '/chapter-' . $r['name']);
					$chap_url	=	urls($v['slug'] . '/' . $r['lang'] . '/chapter-'. $r['name'].(($change[$cur])?'-i'.$change[$cur]:''), 'post');

					
					$chap[]	=
						'<div class="fdl-item">
							<div class="chapter">
									<a href="' . $chap_url . '">
											<i class="far fa-file-alt mr-2"></i>' . xN($r['name']) . '
									</a>
							</div>
							<div class="release-time"></div>
							<div class="clearfix"></div>
						</div>';
					unset($chap_url);
				}
			}
			$vol	=	[];
			if ($ch['vol']) {
				foreach ($ch['vol'] as $r) {
					$vol[]	=
						'<div class="fdl-item">
							<div class="chapter">
									<a href="' . urls($v['slug'] . '/' . $r['lang'] . '/volume-' . $r['name'], 'post') . '">
											<i class="fas fa-book mr-2"></i>' . $__l['Vol'] . ' ' . $r['name'] . '
									</a>
							</div>
							<div class="release-time"></div>
							<div class="clearfix"></div>
						</div>';
				}
			}
			$html  .=  '
			<div class="item item-spc flw-item">
				<a class="manga-poster" href="' . $url . '">
				' . (($ch['lang']) ? '<span class="tick tick-item tick-lang">' . implode('/', $ch['lang']) . '</span>' : '') . '
					<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . $thumb . '" class="manga-poster-img lazyload" alt="' . $v['title'] . '">
				</a>
				<div class="manga-detail">
						<h3 class="manga-name">
								<a href="' . $url . '" title="' . $v['title'] . '">' . $v['title'] . '</a>
						</h3>
						<div class="fd-infor">
								<span class="fdi-item fdi-cate">' . (($cate)?implode(', ', $cate):'') . '</span>
								' . (($rmfav) ? '<span class="fdi-item rmfav" onclick="__this.rmfav(this,' . $v['id'] . ')"><i class="fa fa-trash mr-2"></i> ' . $__l['remove'] . '</span>' : '') . '
								<div class="clearfix"></div>
						</div>
						' . (($chap && $vol) ? '
						<div class="item-spc-tabs">
							<ul class="nav s-tabs">
									<li class="nav-item"><a data-toggle="tab" href="#spc-chap-' . $v['id'] . '" class="nav-link active show">' . $__l['Chapter'] . '</a>
									</li>
									<li class="nav-item"><a data-toggle="tab" href="#spc-vol-' . $v['id'] . '" class="nav-link">' . $__l['Volume'] . '</a>
									</li>
							</ul>
						</div>
						<div class="tab-content"><div id="spc-chap-' . $v['id'] . '" class="tab-pane active show">
						' : '') . '
						' . (($chap) ? '<div class="fd-list">' . implode('', $chap) . '</div>' : '') . '
						' . (($chap && $vol) ? '</div><div id="spc-vol-' . $v['id'] . '" class="tab-pane">' : '') . '
						' . (($vol) ? '<div class="fd-list">' . implode('', $vol) . '</div>' : '') . '
						' . (($chap && $vol) ? '</div></div>' : '') . '
				</div>
				<div class="clearfix"></div>
			</div>
			';
		}
	}
	return $html;
}
function ads($vt = '')
{
	global $ads;
	if (!$vt) return false;
	$ads[$vt]  =  str_replace(['&lt;', '&gt;', '&quot;', "&#039;"], ['<', '>', '"', "'"], $ads[$vt]);
	$ads[$vt]  =  str_replace('\\n', "\n", $ads[$vt]);
	if (!$ads[$vt] || ($_SESSION['vip'] == 1 && $_SESSION['viptime'] > time())) return false;
	if (in_array($vt, ['js-head', 'js-body'])) {
		$hmtl    =  str_replace('’', "'", $ads[$vt]);
	} else {
		$hmtl  =  "<div class=\"__ia ia-" . md5(rand(1000, 9999)) . "-{$vt}\">{$ads[$vt]}</div>";
	}
	return $hmtl;
}
