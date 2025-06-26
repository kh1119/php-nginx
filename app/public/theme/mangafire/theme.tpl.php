<?php
function ago($date = '')
{
	$time_ago	=	strtotime($date);
	$now	=	time();
	$time = $now - $time_ago;
	$time = ($time < 1) ? 1 : $time;
	$tokens = array(
		//86400 => 'day',
		3600 => 'hour',
		60 => 'minute',
		1 => 'second'
	);
	if ($time < 86400) {
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
		}
	} else
		return	date("M d, Y", $time_ago);
}
function movies($arr = [], $theme = 'movie', $max = [])
{
	global $change, $rmfav, $cfnav, $__l, $cftps;
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
			<a class="unit" href="' . $url . '">
				<div class="poster">
						<div><img src="' . $thumb . '" alt="' . $v['title'] . '" /></div>
				</div>
				<div class="info">
						<h6>' . $v['title'] . '</h6>
						<div>
						' . (($ch['chap']) ? '<span>' . xN($ch['chap'][0]['name']) . '</span>' : '') . '
						' . (($ch['vol']) ? '<span>' . $__l['Vol'] . ' ' . $ch['vol'][0]['name'] . '</span>' : '') . '
						<span>' . implode('/', $ch['lang']) . '</span>
						</div>
				</div>
			</a>
			';
		} elseif ($theme == 'trending') {
			++$st;
			$html	.=	'
			<div class="swiper-slide unit">
				<a href="' . $url . '">
						<b>' . $st . '</b>
						<div class="poster">
								<div><img src="' . $thumb . '" alt="Jujutsu Kaisen" /></div>
						</div>
						<span>' . $v['title'] . '</span>
				</a>
			</div>
			';
		} elseif ($theme == 'slide') {
			$thumb  =  image($v['thumb'], 500, 0);
			$cate	=	explode(',', $vj['genre']);
			$html	.=	'
			<div class="swiper-slide">
				<div class="swiper-inner">
						<div class="bookmark">
								<div class="dropleft width-limit favourite" data-id="42">
										<button class="btn" data-toggle="dropdown" data-placeholder="false"><i class="fa-solid fa-circle-bookmark"></i></button>
										<div class="dropdown-menu dropdown-menu-right folders"></div>
								</div>
						</div>
						<div class="info">
								<div class="above">
									<span>' . $cftps[$v['type']] . '</span>
									<a class="unit" href="' . $url . '">' . $v['title'] . '</a>
								</div>
								<div class="below">
										<span>' . $vj['info'] . '</span>
										<p>
										' . (($ch['chap']) ? '<span>' . xN($ch['chap'][0]['name']) . '</span>' : '') . '
										' . (($ch['vol']) ? '<span>' . $__l['Vol'] . ' ' . $ch['vol'][0]['name'] . '</span>' : '') . '
										<span>' . implode('/', $ch['lang']) . '</span>
										</p>
										' . (($vj['genre']) ? '<div><span>' . implode('</span><span>', $cate) . '</span></div>' : '') . '
								</div>
						</div>
						<a href="' . $url . '" class="poster">
								<div><img src="' . $thumb . '" alt="' . $v['title'] . '" /></div>
						</a>
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
					$chap_url	=	urls($v['slug'] . '/' . $r['lang'] . '/chapter-' . (($change[$cur]) ? '-i' . $change[$cur] : '') . $r['name'], 'post');

					$chap[]	=
						'<li><a href="' . $chap_url . '">
							<span>' . xN($r['name']) . '</span> 
							<span>' . ago($r['modified']) . '</span></a>
						</li>';
					unset($chap_url);
				}
			}
			$vol	=	[];
			if ($ch['vol']) {
				foreach ($ch['vol'] as $r) {
					$vol[]	=
						'<li><a href="' . urls($v['slug'] . '/' . $r['lang'] . '/volume-' . $r['name'], 'post') . '">
							<span>' . $__l['Vol'] . ' ' . $r['name'] . '</span> 
							<span>' . ago($r['modified']) . '</span></a>
						</li>';
				}
			}
			$html  .=  '
			<div class="unit flw-item item-' . $v['id'] . '">
				<div class="inner">
					<a href="' . $url . '" class="poster" data-tip="' . $v['id'] . '">
						<div><img src="' . $thumb . '" alt="' . $v['title'] . '" /></div>
						' . (($ch['lang']) ? '<span class="tick-lang">' . implode('/', $ch['lang']) . '</span>' : '') . '
					</a>
					<div class="info">
							<div><span class="type">'.$cftps[$v['type']].'</span></div>
							' . (($rmfav) ? '<span class="fdi-item rmfav" onclick="__this.rmfav(this,' . $v['id'] . ')"><i class="fa fa-trash mr-2"></i> ' . $__l['remove'] . '</span>' : '') . '
							<a href="' . $url . '" title="' . $v['title'] . '">' . $v['title'] . '</a>
							' . (($chap && $vol) ? '
							<div>
									<span class="type">Manga</span>
									<nav data-tabs=".item-' . $v['id'] . ' .content">
											<span class="tab active" data-name="chap">' . $__l['Chapter'] . '</span> <span class="tab" data-name="vol">' . $__l['Volume'] . '</span>
									</nav>
							</div>
							' : '') . '
							' . (($chap) ? '<ul class="content" data-name="chap">' . implode('', $chap) . '</ul>' : '') . '
							' . (($vol) ? '<ul class="content" data-name="vol" ' . (($chap) ? 'style="display:none"' : '') . '>' . implode('', $vol) . '</div>' : '') . '
					</div>
				</div>
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
