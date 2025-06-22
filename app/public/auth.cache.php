<?php
define('mDB', true);
require_once('inc/config.php');
require_once('inc/function.php');
require_once('inc/cache.php');
$ac		=	filter($_GET['ac']);
if ($ac == 'remove') {
	$key	=	filter($_GET['key']);
	$cache->delete($key);
} elseif ($ac == 'all') {
	$cache->flush();
}
exit;