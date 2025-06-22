<?php
define('mDB', true);
require_once('inc/config.php');
// echo $config['host'];
// exit;
require_once('inc/cache.php');
require_once('inc/sql.php');
require_once('inc/api.php');
require_once('inc/function.php');
require_once('inc/setting.php');
require_once('theme/action.tpl.php');

//chuyen link no wwww to www1

if (!empty($www301) && $www301 > 0) {
    $targetSubdomain = 'www' . $www301;

    // Tách phần domain chính (không bao gồm subdomain)
    if (preg_match('/^(?:([a-z0-9]+)\.)?([a-z0-9-]+\.[a-z]{2,})$/i', $_SERVER['HTTP_HOST'], $matches)) {
        $subdomain = $matches[1] ?? '';
        $domain = $matches[2];

        // Nếu subdomain không đúng định dạng cần chuyển hướng
        if ($subdomain !== $targetSubdomain) {
            $redirectHost = $targetSubdomain . '.' . $domain;
            $redirectUrl = "https://{$redirectHost}" . $_SERVER['REQUEST_URI'];

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: {$redirectUrl}");
            exit;
        }
    }
}



//CHUYỂN TÊN MIỀN
if ($setting['301']) {
	$url301	=	$setting['301'] . $arr_request . (($arr_search) ? '?' . $arr_search : '');
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: {$url301}");
	exit;
}
//COOKIE
$cookie = [];
$cookie['wid']		=	(int)$_COOKIE["wid"];
$cookie['whash']	=	filter($_COOKIE['whash']);
if (!$_SESSION['uid'] && $cookie['wid'] && $cookie['whash']) {
	$wpassword	=	jcode($cookie['whash'], 'de', REMOTE_IP);
	$arrcookie	=	$api->call('select', ['data'	=>	[
		[
			'table'	=>	"member",
			'item'	=>	"id,name,email,vip,vip_time,banned",
			'sql'	=>	base64_encode("id = '{$cookie['wid']}' and w = '{$config['host']}' and password = '{$wpassword}' limit 1")
		]
	]], 1)['data'][0][0];
	if ($arrcookie) {
		$_SESSION['uid']		=	(int)$arrcookie['id'];
		$_SESSION['uname']		=	$arrcookie['name'];
		$_SESSION['umail']		=	$arrcookie['email'];
		$_SESSION['vip']		=	(int)$arrcookie['vip'];
		$_SESSION['viptime']	=	(int)$arrcookie['vip_time'];
	}
}
require_once('theme/' . $setting['theme'] . '/theme.tpl.php');
require_once('theme/' . $setting['theme'] . '/main.tpl.php');
if ($setting['Minifier']) {
	require_once('inc/Minifier.php');
	$content = ob_get_contents();
	ob_end_clean();
	$minifier = new Minifier();
	$content = $minifier->minifyHTML($content);
	echo $content;
}
exit();
