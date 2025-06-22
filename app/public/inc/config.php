<?php
if (!defined('mDB')) die("404 Not Found!");
session_start();
if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler');
	else ob_start();
} else ob_start();
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
if (isset($_SERVER['HTTP_X_REAL_IP'])) {
	$REMOTE_IP = $_SERVER['HTTP_X_REAL_IP'];
} else {
	$REMOTE_IP = $_SERVER['REMOTE_ADDR'];
}
if (!$_SERVER['HTTP_USER_AGENT'] || !$_SERVER['REMOTE_ADDR']) exit();
define('NOW',		time());
define('REMOTE_IP',	$REMOTE_IP);
define('DATA_DIR',	$_SERVER['DOCUMENT_ROOT'] . '/.db');
if (!is_dir(DATA_DIR)) mkdir(DATA_DIR, 0755, true);
define('DATA_LOG',	$_SERVER['DOCUMENT_ROOT'] . '/.logs');
if (!is_dir(DATA_LOG)) mkdir(DATA_LOG, 0755, true);

define('API_URL',	'https://mgotdb.view47.com'); // server master
define('API_KEY',	'55ec434dfd43c0ab4a415e83f04df305');  //api key ket noi
$config	=	[
	'host'	=>	'abbc.com',
	'ver'		=>	'1.1',
	'cache'	=>	0,
	//doi domain server anh mgojpdb.b-cdn.net
	'change'	=>	[
		'cd.mangadbz.top' => 'sv1.freeimgmg.online',
		'mgojp.mangadb.shop' => 'sv1.freeimgmg.online',
		'imgs2.streamlover.xyz' => 'sv1.freeimgmg.online',
		'imgs3.streamlover.xyz' => 'sv1.freeimgmg.online'
	],
	//proxy cache
	'proxy' => 0, // 1 = bật proxy cache
	'proxy_cache'	=>	[
		'mg01.online',
		'mg01.shop',
		'mg01.site',
		'mg02.shop',
		'mg02.store',
		'mg03.store',
		'mg03.shop',
		'mg03.site',
		'mg04.store',
		'mg04.site'
	],
	//ads chapter banner
	'ad' => [
		'top'	=>	'',
		'center' =>	'',
		'bot'	=>	'',
	]
];
$arr_request	=	trim($_SERVER['REQUEST_URI']);
if (preg_match("#(.*)\?(.*)#", $arr_request, $match)) {
	$arr_request	=	trim($match[1]);
	$arr_search		=	trim(html_entity_decode($match[2]));
	if ($arr_search)
		parse_str($arr_search, $filter);
}
$value	=	array_map('trim', explode('/', $arr_request));
