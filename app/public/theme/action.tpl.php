<?php
if (!defined('mDB')) die("404 ERROR");
if (substr($arr_request, -1, 1) != '/' && substr($arr_request, -5, 5) != '.html' && substr($arr_request, -4, 4) != '.htm') {
	header("location: {$arr_request}/" . (($arr_search) ? '?' . $arr_search : ''));
	exit;
}
$year	=	date("Y");
$ui		=	0;
$breadcrumb	=	$schema	=	[];
$arr_request	=	filter($arr_request);
if ($ban && $ban[$arr_request]) {
	$main 	=	404;
	$ui		=	1;
}
if (!$ui) {
	$schema[]	=	[
		"@context"	=>	"https://schema.org",
		"@type"	=>	"WebSite",
		"url"	=>	https('/'),
		"potentialAction"	=>	[
			"@type"	=>	"SearchAction",
			"target"	=>	https('/?q={q}'),
			"query-input"	=>	"required name=q"
		]
	];
	$host		=	explode('.', $config['host']);
	$host		=	mb_ucwords((count($host) > 2) ? $host[1] : $host[0]);
	$main		=	'404';
	//user
	if ($arr_request == '/random/') {
		$arr	=	$api->call('get.random', [], 1);
		if ($arr['slug']) {
			$url	=	urls($arr['slug'], 'post');
			header("location: {$url}");
			exit;
		}
	}
	if ($arr_request == '/logout/') {
		unset($_SESSION['uid']);
		unset($_SESSION['uname']);
		unset($_SESSION['umail']);
		unset($_SESSION['vip']);
		unset($_SESSION['viptime']);
		setcookie("wid", null, -1, '/');
		setcookie("whash", null, -1, '/');
		header("location: /");
		exit;
	} elseif (preg_match("#^/(profile|favorite|premium|activatekey|activatehash)/$#", $arr_request, $match)) {
		$slug	=	filter($match[1]);
		if (preg_match("#^/(profile|favorite|activatehash)/$#", $arr_request, $match)) {
			$main	=	'profile';
			if ($match[1] == 'activatehash') {
				$hash	=	filter($filter['hash']);
				if (!$hash && !$_SESSION['uid']) {
					$main	=	'404';
				} else {
					$arr	=	$api->call('user', [
						'action'	=>	'hash',
						'data'		=>	['hash' => $hash]
					], 1);
					if (!$arr['status']) {
						$main	=	'404';
					}
				}
				$title	=	'Set new password';
			} elseif ($match[1] == 'favorite') {
				$rmfav	=	1;
				$arr	=	$api->call('get.favorite', ['uid' => (int)$_SESSION['uid']], 1);
				$title	=	$__l['fav.t'];
			} elseif ($match[1] == 'profile') {
				$title	=	$__l['pf.t'];
			}
		} elseif (preg_match("#^/(premium|activatekey)/$#", $arr_request, $match)) {
			$main	=	'vip';
			if ($match[1] == 'premium')
				$title	=	'Become a VIP User';
			else
				$title	=	'Activate your VIP Key';
		}
		$wtitle	=	"{$title} - {$setting['sub']}";
	}
	//view post
	elseif (preg_match("#^{$req['post']['url'][0]}(.*?){$req['post']['url'][1]}$#", $arr_request, $match)) {
		$slug		=	filter($match[1]);
		if (preg_match("#(.*?)/([a-z]{2})/(chapter|volume)-([a-z0-9\.\-]+)#", $slug, $m)) {
			$slug	=	filter($m[1]);
			$__lang	=	filter($m[2]);
			$__type	=	filter($m[3]);
			$__name	=	filter($m[4]);
			$uiType	=	[
				'chapter'	=>	'chap',
				'volume'	=>	'vol',
			];
			$uiType	=	$uiType[$__type];

		}else {
			if (preg_match("#(.*?)\.(.*)#", $slug, $m)) {
				$slug	=	filter($m[1]);
				$change_slug	=	filter($m[2]);
			}
		}

		$arr	=	$api->call('info', ['slug' => $slug, 'limit' => $setting['relate']]);
		// print_r($arr);
		if ($arr['data']) {
			if ($arr['chapters']['chap']) {
				$first = array_key_first($arr['chapters']['chap']);
				$last	=	array_key_last($arr['chapters']['chap'][$first]);
				$read_url	=	urls($slug . '/' . $first . '/chapter-' . $last, 'post');
				//chap mới
				$new_chap = array_key_first($arr['chapters']['chap'][$first]);
			} elseif ($arr['chapters']['vol']) {
				$first = array_key_first($arr['chapters']['vol']);
				$last	=	array_key_last($arr['chapters']['vol'][$first]);
				$read_url	=	urls($slug . '/' . $first . '/volume-' . $last, 'post');
				$new_chap = array_key_first($arr['chapters']['vol'][$first]);
			}
			if ($filter['read'] && $read_url) {
				header("Location: " . $read_url);
				exit();
			}
			$mv		=	$arr['data'];
			$data	=	$mv['data'];
			$url	=	https($arr_request);
			//page reader
			if ($__lang) {
				if (preg_match("#(.*?)-i([0-9]+)#", $__name, $m)) {
					$__name	=	filter($m[1]);
					$change_slug	=	filter($m[2]);
				}
				$pUrl	=	"{$req['post']['url'][0]}{$mv['slug']}/{$__lang}/{$__type}-{$__name}{$req['post']['url'][1]}";
				
				if ($change[$pUrl]) {
					if ($change_slug != $change[$pUrl]) {
						header("HTTP/1.1 301 Moved Permanently");
						header("Location: " . urls($mv['slug'] . "/{$__lang}/{$__type}-{$__name}-i" . $change[$pUrl], 'post'));
						exit();
					}
				}else {
					if($change_slug) {
						header("HTTP/1.1 301 Moved Permanently");
						header("Location: " . urls($mv['slug'] . "/{$__lang}/{$__type}-{$__name}", 'post'));
						exit();
					}
				}
				
			}else {
				$pUrl	=	pUrl($slug);
				//kiểm tra link đổi
				if ($change[$pUrl]) {
					if ($change_slug != $change[$pUrl]) {
						header("HTTP/1.1 301 Moved Permanently");
						header("Location: " . urls($mv['slug'] . '.' . $change[$pUrl], 'post'));
						exit();
					}
					//$mv['slug']	.=	'.' . $change[$pUrl];
				}else {
					if($change_slug) {
						header("HTTP/1.1 301 Moved Permanently");
						header("Location: " . urls($mv['slug'], 'post'));
						exit();
					}
				}
			}
			$title		=	$mv['title'];
			$poster		=	image($mv['thumb'], 640);
			$breadcrumb[]	=	[
				'name'	=>	$cfnav[$mv['type']],
				'url'	=>	https($res[replace($cfnav[$mv['type']])])
			];
			$breadcrumb[]	=	[
				'name'	=>	un_htmlchars($mv['title']),
				'url'	=>	$url
			];
			$mv['avg']	=	($mv['avg']) ? $mv['avg'] : 0;
			$mv['vote']	=	($mv['vote']) ? $mv['vote'] : 0;

			$genres	=	$data['genre'];
			$tag	=	$data['tag'];
			$info	=	cutStr($data['info']);
			$onLabel	=	[$__l['ongoing'], $__l['completed']];
			$main		=	'info';
			$wurl	=	urls($slug, 'post');
			if ($__lang) {
				$main		=	'reader';
				$iurl	=	urls($slug.(($change[pUrl($slug)])?'.'.$change[pUrl($slug)]:''), 'post');
				$wurl	=	https($arr_request);
			}


			$schema[] = [
				"@context" => "http://schema.org",
				"@type" => "Book",
				"name" => $title,
				"url" => $url,
				"description" =>	$info,
				"dateCreated"	=>	date("c", strtotime($mv['created'])),
				"aggregateRating" => [
					"@type" => "AggregateRating",
					"bestRating" => 10,
					"ratingCount" => ($mv['voted']) ? $mv['voted'] : 1,
					"ratingValue" => ($mv['rating']) ? $mv['rating'] : '9.5'
				],
				"image" => $image,
				"sameAs" => $mv['url'],
				"author" => $data['author']
			];
			$wtitle	=	"{$title} - {$setting['h1']}";
			$wkeyword	=	"{$title},{$genres},{$countrys},{$tag}";
			$wdescription	=	($data['info']) ? $data['info'] : $title;

			//SEO META
			if ($main	==	'reader') {
				if ($req['post']['title2'])
					$wtitle	=	str_replace(
						['[title]', '[year]', '[genre]', '[country]', '[tag]', '[info]', '[chap]'],
						[$title, $year, $genres, $countrys, $tag, $info, $__name],
						$req['post']['title2']
					);
				if ($req['post']['keyword2'])
					$wkeyword	=	str_replace(
						['[title]', '[year]', '[genre]', '[country]', '[tag]', '[info]', '[chap]'],
						[$title, $year, $genres, $countrys, $tag, $info, $__name],
						$req['post']['keyword2']
					);
				if ($req['post']['description2'])
					$wdescription	=	str_replace(
						['[title]', '[year]', '[genre]', '[country]', '[tag]', '[info]', '[chap]'],
						[$title, $year, $genres, $countrys, $tag, $info, $__name],
						$req['post']['description2']
					);
			} else {
				if ($req['post']['title'])
					$wtitle	=	str_replace(
						['[title]', '[year]', '[genre]', '[country]', '[tag]', '[info]', '[chap]'],
						[$title, $year, $genres, $countrys, $tag, $info, $new_chap],
						$req['post']['title']
					);
				if ($req['post']['keyword'])
					$wkeyword	=	str_replace(
						['[title]', '[year]', '[genre]', '[country]', '[tag]', '[info]', '[chap]'],
						[$title, $year, $genres, $countrys, $tag, $info, $new_chap],
						$req['post']['keyword']
					);
				if ($req['post']['description'])
					$wdescription	=	str_replace(
						['[title]', '[year]', '[genre]', '[country]', '[tag]', '[info]', '[chap]'],
						[$title, $year, $genres, $countrys, $tag, $info, $new_chap],
						$req['post']['description']
					);
			}
		} else {
			$main	=	404;
		}
	}
	//home
	elseif (
		$arr_request == '/' && !$setting['home']['status'] && !$filter['q'] ||
		$setting['home']['status'] == 1 && $arr_request == $setting['home']['url']
	) {
		$main	=	'home';
		$arr	=	$api->call('home', []);
	}
	//home search
	elseif ($arr_request == '/' && $setting['home']['status'] == 1  && !$filter['q']) {
		$main	=	'home.index';
		//SEO META
		if ($setting['home']['title'])
			$wtitle	=	$setting['home']['title'];
		if ($setting['home']['keyword'])
			$wkeyword	=	$setting['home']['keyword'];
		if ($setting['home']['description'])
			$wdescription	=	$setting['home']['description'];
	} else {
		if ($arr_request == '/az-list/') {
			$main	=	'list';
			$type	=	'az';
			$title	=	$__l['az'];
		} elseif ($arr_request == '/filter/') {
			$main	=	'filter';
			$type	=	'filter';
			$title	=	$__l['filter'];
			if (!$filter) {
				$filter['all']	=	1;
			}
		} elseif (preg_match("#^(" . implode('|', $res) . ")$#", filter($arr_request), $match)) {
			$main	=	'list';
			$slug	=	filter($match[1]);
			$wurl	=	$slug;
			$slug	=	array_search($slug, $res);
		} elseif ($arr_request == '/' && $filter['q']) {
			$main	=	'list';
			$slug	=	filter($filter['q']);
			$type	=	'search';
			$wurl	=	'/?q=' . str_replace(' ', '+', $slug);
		} else {
			$tagTitle	=	'';
			foreach ($req as $k => $v) {
				if ($v['url']) {
					if (preg_match("#^{$v['url'][0]}(.*?){$v['url'][1]}$#", $arr_request, $match)) {
						$slug	=	filter($match[1]);
						$type	=	filter($k);
						$main	=	'list';
						$wurl	=	"{$v['url'][0]}{$slug}{$v['url'][1]}";
						if ($type == 'tag') {
							//check change link
							if (preg_match("#(.*?).i([0-9]+)#", $slug, $m)) {
								$slug	=	filter($m[1]);
								$change_slug	=	filter($m[2]);
							}
							$pUrl	=	"{$req['tag']['url'][0]}{$slug}{$req['tag']['url'][1]}";
							//echo $pUrl;exit;
							if ($change[$pUrl]) {
								if ($change_slug != $change[$pUrl]) {
									header("HTTP/1.1 301 Moved Permanently");
									header("Location: {$req['tag']['url'][0]}{$slug}.i{$change[$pUrl]}{$req['tag']['url'][1]}");
									exit();
								}
							}
							foreach ($setting['tags'] as $keywords) {
								$keywordz	=	str_replace('-', ' ', $slug);
								$keywords	=	str_replace(['[title]', '[year]'], ['(.*?)', '([0-9]+)'], $keywords);
								if (preg_match("#^{$keywords}$#i", $keywordz, $qs)) {
									$tagTitle	=	filter($qs[1]);
									break;
								}
							}
						}
						break;
					}
				}
			}
		}
		if ($main) {
			$page	=	(int)$filter['p'];
			if (!$page)
				$page	=	1;
			$data	=	[
				'slug'	=>	$slug,
				'type'	=>	$type,
				'filter'	=>	$filter,
				'p'	=>	$page,
				'num'	=>	$setting['page'],
				'tagTitle'	=>	$tagTitle
			];
			$arr	=	$api->call('list', $data);
			if (!$title)
				$title	=	mb_ucwords(($arr['lang']) ? $__l[$arr['lang']] : $arr['title']);
			if ($arr['data']) {
				$pages	=	htmlpage($arr['total'], $setting['page'], $page, $wurl . ((strpos($wurl, '?')) ? '&' : '?') . "p=");
			}

			$breadcrumb[]	=	[
				'name'	=>	$title,
				'url'	=>	https($arr_request)
			];

			//SEO META
			$wtitle	=	"{$title} - {$setting['h1']}";
			if ($type) {
				if ($req[$type]['title'])
					$wtitle	=	str_replace(['[title]', '[year]'], [$title, $year], $req[$type]['title']);
				if ($req[$type]['keyword'])
					$wkeyword	=	str_replace(['[title]', '[year]'], [$title, $year], $req[$type]['keyword']);
				if ($req[$type]['description'])
					$wdescription	=	str_replace(['[title]', '[year]'], [$title, $year], $req[$type]['description']);
			}
		}

		//print_R($req);
	}

	//SEO META ALL
	if ($seo[$arr_request]['title'])
		$wtitle	=	$seo[$arr_request]['title'];
	if ($seo[$arr_request]['keywords'])
		$wkeyword	=	$seo[$arr_request]['keywords'];
	if ($seo[$arr_request]['description'])
		$wdescription	=	$seo[$arr_request]['description'];

	$wsite	=	$config['host'];
	if (!$wtitle)
		$wtitle	=	$req['home']['title'];
	if (!$wkeyword)
		$wkeyword	=	$req['home']['keyword'];
	if (!$wdescription)
		$wdescription	=	$req['home']['description'];
	if (!$wurl)
		$wurl	=	https($arr_request);
	if (!$wimage)
		$wimage	=	($setting['cover']) ? image($setting['cover'], 0, 0) : https('/theme/' . $setting['theme'] . '/images/default.jpg');

	if ($breadcrumb) {
		$itemList[]	=	[
			"@type"	=>	"ListItem",
			"position"	=>	1,
			"name"	=>	'Home',
			"item"	=>	https('/')
		];
		$stt	=	2;
		foreach ($breadcrumb as $v) {
			$itemList[]	=	[
				"@type"	=>	"ListItem",
				"position"	=>	$stt,
				"name"	=>	$v['name'],
				"item"	=>	$v['url']
			];
			++$stt;
		}
		$schema[]	=	    [
			"@context"			=>	"https://schema.org",
			"@type"				=>	"BreadcrumbList",
			"itemListElement"	=>	$itemList
		];
	}
}
if ($main == 404) {
	header("HTTP/1.0 404 Not Found");
	$wtitle	=	"404 Not Found";
}
// echo $main;exit;
