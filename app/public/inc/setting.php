<?php
if (!defined('mDB')) die("404 ERROR");
$int		=	$api->call('setting', ['w' => $config['host']]);
if (!$int['setting']['theme']) {
	$int		=	$api->call('setting', ['w' => $config['host']], 1);
}
$__change	=	$cache->get("{$config['host']}.change.link");
//if($filter['debug']) unset($__change);
if($__change) {
	$int['change']	=	unserialize($__change)['change'];
}else {
	$__change	=	$api->sending('change.link');
	if($__change) {
		$cache->set("{$config['host']}.change.link",$__change);
		$int['change']	=	unserialize($__change)['change'];
		//if($filter['debug']) print_r($int['change']);
		
	}
}

$setting	=	$int['setting'];
$build	=	$int['build'];
$change		=	$int['change'];
$style		=	$int['style'];
$ban		=	$int['ban'];
$vipk		=	$int['vip'];
$hide		=	$int['hide'];
$ads		=	$int['ads'];
$seo		=	$int['seo'];
$genre		=	$int['genre'];
$country	=	$int['country'];
$req		=	$int['setting']['url'];
$res		=	$int['setting']['urls'];
$home		=	$int['home'];
$server	=	$int['server'];
$language	=	[];
$www301 = $setting['www301'] ? $setting['www301'] : 0;

foreach($int['cogs']['lang'] as $r) {
	$language[$r['code']]	=	$r['title'];
}
if (!$setting) {
	header("HTTP/1.0 404 Not Found");
	die("HTTP/1.0 404 Not Found");
}
if (preg_match("#([A-Za-z0-9]+):([A-Za-z0-9]+)#", $setting['theme'], $xth)) {
	$setting['theme']	=	$xth[1];
	$setting['themex']	=	$xth[2];
}
foreach ($req as $k => $v) {
	if ($v['url']) {
		if (!$req[$k]['url'][0])
			$req[$k]['url'][0]	=	"/{$k}/";
		if (!$req[$k]['url'][1])
			$req[$k]['url'][1]	=	"/";
	}
}
foreach ($res as $k => $v) {
	if (!$res[$k])
		$res[$k]	=	"/{$k}/";
}
if (!$setting['page'])
	$setting['page']	=	32;
if (!$setting['relate'])
	$setting['relate']	=	16;
//database
$cfnav	=	array_map('filter', explode(',', $int['build']['type']));
$cfst	=	array_map('filter', explode(',', $int['build']['status']));
$cftps	=	[];
foreach ($cfnav as $v) {
	$sl	=	replace($v);
	$cftps[$sl]	=	$v;
	if (!$res[$sl])
		$res[$sl]	=	"/{$sl}/";
	unset($sl);
}
$__l	=	$int['lang'];
if (!$setting['home']['url'])
	$setting['home']['url']	=	'/home/';

if (!$setting['prefix'])
	$setting['prefix']	=	'Chap {1}';

function get_tags_title($title = '', $year = '', $tags = [], $html = 0, $join = ', ', $a = '', $b = '')
{
	$tags	=	array_filter($tags);
	if ($title && $tags) {
		$title	=	mb_strtolower($title);
		$arr	=	[];
		foreach ($tags as $x => $tag) {
			$tag	=	str_replace(['[title]', '[year]'], [$title, $year], $tag);
			if ($html == 1) {
				$urls	=	urls(replace(un_htmlchars($tag)), 'tag');
				$arr[]	=	"<a href=\"{$urls}\" title=\"{$tag}\">{$a}{$tag}{$b}</a>";
			} else {
				$arr[]	=	$tag;
			}
		}
		return implode($join, $arr);
	}
}
function get_tags($tag = '', $name = 'tag', $html = 0, $join = ', ', $a = '', $b = '')
{
	if ($tag) {
		$tags	=	array_filter(array_map('trim', explode(',', $tag)));
		$arr	=	[];
		foreach ($tags as $x => $title) {
			if ($html == 1) {
				$urls	=	urls(replace($title), $name);
				$arr[]	=	"<a href=\"{$urls}\" title=\"{$title}\">{$a}{$title}{$b}</a>";
			} else {
				$arr[]	=	$title;
			}
		}
		return implode($join, $arr);
	}
}
$cf_server	=	[];
foreach ($server as $k => $v) {
	if ($v['type'] == 'CACHE' && $v['status'] == 1) {
		$cf_server[$k]	=	$v['url'];
	}
};
if (!$cf_server) {
	$cf_server = [
		2 => 'http://54.36.122.6',
		3 => 'http://54.36.122.9',
		4 => 'http://51.75.146.132'
	];
}