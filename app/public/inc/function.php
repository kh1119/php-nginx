<?php
if (!defined('mDB')) die("404 Not Found");
function image_replace($src = '')
{
	global $config;
	if ($config['change']) {
		foreach ($config['change'] as $k => $v) {
			$src	=	str_replace($k, $v, $src);
		}
	}
	return $src;
}
function image_chap($src = '')
{
	if (preg_match("#/files/(.*)#i", $src, $m)) {
		$src	=	$m[1];
	}
	return $src;
}

function un_htmlchars($str)
{
	return htmlspecialchars_decode($str, ENT_QUOTES);
}
function htmlchars($str)
{
	return htmlspecialchars($str, ENT_QUOTES);
}

function get_ascii($st)
{
	$vietChar 	= 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|í|ì|ỉ|ĩ|ị|ý|ỳ|ỷ|ỹ|ỵ|đ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ó|Ò|Ỏ|Õ|Ọ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Í|Ì|Ỉ|Ĩ|Ị|Ý|Ỳ|Ỷ|Ỹ|Ỵ|Đ';
	$engChar	= 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|i|i|i|i|i|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|I|I|I|I|I|Y|Y|Y|Y|Y|D';
	$arrVietChar 	= explode("|", $vietChar);
	$arrEngChar		= explode("|", $engChar);
	return str_replace($arrVietChar, $arrEngChar, $st);
}
function replace($text)
{
	$text	=	filter($text);
	$text	=	get_ascii($text);
	$text 	= 	str_replace(
		[' ', '?', '=', '_', '+', '~', '"', "'", '%', '$', '#', '@', '!', '&', '*', '[', ']', '(', ')', '/', ':', ';', '|', '\\', '“', '˜', '`', '│', '–', '«', '»', '’', '”', '“', '.', ','],
		'-',
		$text
	);
	$text 	=	preg_replace('~-+~', '-', $text);
	$text 	=	preg_replace(['/[ -]+/', '/^-|-$/'], ['-', ''], $text);
	$text 	=	mb_strtolower($text, 'UTF-8');
	return $text;
}
if (!function_exists('mb_ucwords') && function_exists('mb_convert_case')) {
	function mb_ucwords($string)
	{
		return mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
	}
}
// function replace($string)
// {
// 	$string = filter($string);
// 	$string = str_replace("/", "-", $string);
// 	$string = strtolower(get_ascii($string));
// 	$string = preg_replace(
// 		array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
// 		array('', '-', ''),
// 		un_htmlchars($string)
// 	);
// 	return $string;
// }
function mysql_escape($inp)
{
	return str_replace(array('\\', "\0", "'", "\x1a"), array('\\\\', '\\0', "’", '\\Z'), $inp);
	return $inp;
}
function filter($data, $n = 0)
{
	$data = trim(urldecode($data));
	if ($n == 0) {
		$data = strip_tags($data);
	}
	$data = mysql_escape($data);
	return $data;
}
function htmlpage($ttrow, $limit, $page, $url = '')
{
	$total = ceil($ttrow / $limit);
	if ($total <= 1) return '';
	$main = '<ul class="pagination">';
	if ($page <> 1) {
		$main .= "<li class=\"page-item\"><a href=\"" . $url . ($page - 1) . "\" class=\"page-link\" data-page=\"" . ($page - 1) . "\" title=\"Prev\">←</a></li>";
	}
	for ($num = 1; $num <= $total; $num++) {
		if ($num < $page - 1 || $num > $page + 4)
			continue;
		if ($num == $page)
			$main .= "<li class=\"page-item active\"><span class=\"page-link\">{$num}</span></li>";
		else {
			$main .= "<li class=\"page-item\"><a href=\"" . ($url . $num) . "\" class=\"page-link\" data-page=\"{$num}\" title=\"Trang {$num}\">{$num}</a></li>";
		}
	}
	if ($page <> $total) {
		$main .= "<li class=\"page-item\"><a href=\"" . ($url . ($page + 1)) . "\" class=\"page-link __next\" data-page=\"" . ($page + 1) . "\" title=\"Next\">→</a></li>";
	}
	$main .= '</ul>';
	return $main;
}
function https($uri = '')
{
	global $setting;
	return (($setting['ssl']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $uri;
}
function sec2hms($secs)
{
	$secs = round($secs);
	$secs = abs($secs);
	$hours = floor($secs / 3600) . 'h';
	if ($hours == '0h') $hours = '';
	$minutes = floor(($secs / 60) % 60) . 'm';
	if ($minutes == '0m') $minutes = '';
	$seconds = $secs % 60;
	return $hours . ' ' . $minutes . ' ' . $seconds . 's';
}
function image($src = '', $w = 125, $h = 0, $img = 'no-thumb')
{
	global $server, $setting;
	if (preg_match("#^{([0-9]+)}/(.*)#", $src, $match)) {
		$id		=	(int)$match[1];
		$url	=	$setting['cdn'] ? $setting['cdn'] : $server[$id]['url'];
		$src	=	'/' . $match[2];
	}


	if (!$src)
		return	$url . '/theme/' . $setting['theme'] . '/images/' . $img . '.jpg';
	if (preg_match("#^/upload/(.*)#", $src, $match)) {
		$src	=	$url . "/thumb/{$w}" . (($h > 0) ? '-' . $h : '') . "{$src}";
	} elseif (!preg_match("#//(.*)/#", $src, $match)) {
		$src	=	https("/thumb/{$w}" . (($h > 0) ? '-' . $h : '') . "{$src}");
	}
	return $src;
}
function urls($slug, $name, $id = 0)
{
	global $req;
	$url	=	$req[$name]['url'][0] . $slug . (($id) ? '-' . $id : '') . $req[$name]['url'][1];
	return https($url);
}
function isMobile()
{
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function isBot()
{
	if (preg_match('/AhrefsSiteAudit|baidu|bingbot|facebookexternalhit|googlebot|-google|ia_archiver|msnbot|naverbot|pingdom|seznambot|slurp|teoma|twitter|yandex|yeti/i', $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	} else {
		return false;
	}
}
function jcode($string, $action = 'en', $secret_key = 'truong')
{
	$output = false;
	$encrypt_method = 	"AES-256-CBC";
	$secret_iv 		= 	'2022';
	$key 			= 	hash('sha256', $secret_key);
	$iv 			= 	substr(hash('sha256', $secret_iv), 0, 16);
	if ($action == 'en') {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if ($action == 'de') {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}
function zero($x = '0')
{
	if ($x < 10)
		$x = '0' . $x;
	return $x;
}
function pUrl($slug)
{
	global $req;
	return "{$req['post']['url'][0]}{$slug}{$req['post']['url'][1]}";
}
function cutStr($str = '', $n_chars = 120, $crop_str = '...')
{
	$str	=	un_htmlchars($str);
	$str	=	strip_tags($str);

	$buff = strip_tags($str);
	if (strlen($buff) > $n_chars) {
		$cut_index = strpos($buff, ' ', $n_chars);
		$buff = substr($buff, 0, ($cut_index === false ? $n_chars : $cut_index + 1)) . $crop_str;
	}
	return $buff;
}
function rgb($hex = '')
{
	list($r, $g, $b) = array_map(
		function ($c) {
			return hexdec(str_pad($c, 2, $c));
		},
		str_split(ltrim($hex, '#'), strlen($hex) > 4 ? 2 : 1)
	);
	$rgb  = "{$r},{$g},{$b}";
	return $rgb;
}
function slugTitle($str = '')
{
	return mb_ucwords(str_replace('-', ' ', $str), 'UTF-8');
}
function xN($name = '')
{
	global $setting;
	return str_replace('{1}', $name, $setting['prefix']);
}
