<?php
define('mDB', true);
require_once('inc/config.php');
require_once('inc/cache.php');
require_once('inc/sql.php');
require_once('inc/api.php');
require_once('inc/function.php');
require_once('inc/flood.php');
require_once('inc/setting.php');
$auth	=	filter($_REQUEST['auth']);
$id		=	filter($_REQUEST['id']);
$__['status']	=	0;
if ($auth == 'watch') {
	$image	=	filter($_POST['image']);
	$hash	=	trim($_POST['hash']);
	$subs	=	isset($_POST['subtitle']) ? $_POST['subtitle'] : [];
	$url	=	jcode($hash, 'de');
	if ($url) {
		$sub	=	[];
		$eng	=	'';
		foreach ($subs as $k => $v) {
			$subURL	=	jcode($v['url'], 'de');
			if (!preg_match("#(http|https)://(.*?)#", $subURL)) {
				$subURL	=	$setting['cdn'] . $subURL;
			}
			$sub[$k]['file']	=	$subURL;
			$sub[$k]['label']	=	$v['lang'];
			if (in_array($v['lang'], ['en', 'english', 'English'])) {
				$eng	=	$subURL;
			}
		}
		$vip	=	(($_SESSION['vip'] == 1 && $_SESSION['viptime'] > time()) ? '&vip=' . base64_encode(json_encode(['uid' => $_SESSION['uid'], 'time' => NOW, 'key' => md5($_SESSION['uid'] . 'auth' . NOW)])) : '');
		if (preg_match("#(streamacb.com|stream.vn)#", $url)) {
			$url	.=	(strpos($url, '?') ? '&' : '?') . 'image=' . $image . '&sub64=' . base64_encode(json_encode($sub)) . $vip;
		} elseif (preg_match("#short.ink#", $url, $m)) {
			$url	.=	'?image=' . $image . '&sub=' . $eng . '&lang=English';
		} elseif (preg_match("#youtube.com/watch\?v=([^&]+)#", $url, $m)) {
			$url	=	'//www.youtube.com/embed/' . $m[1];
		}
		$__['status']	=	1;
		$__['embed']	=	$url;
		$__['id']		=	$id;
		$__['sub']		=	$sub;
	}
}
echo json_encode($__);
exit;
