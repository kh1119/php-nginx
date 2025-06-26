<?php
require_once('inc/Minifier.php');
require_once('inc/jsPacker.php');
$minifier = new Minifier();
$src	=	trim(urldecode($_GET['src']));
$type	=	trim(urldecode($_GET['type']));
$skin	=	trim(urldecode($_GET['skin']));
if($src) {
	$seconds_to_cache = 3600*24; //1day
	$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
	header("Expires: $ts");
	header("Pragma: cache");
	header("Cache-Control: max-age=$seconds_to_cache");
	if($type == 'css')
		header("Content-type: text/css; charset=utf-8");
	elseif($type == 'js')
		header("Content-type: text/javascript; charset=utf-8");
	
	$item	=	explode(',',$src);
	$minify	=	'';
	foreach($item as $v) {
		$dir	=	dirname(__FILE__)."/theme/{$skin}/{$type}/{$v}.{$type}";
		if(is_file($dir)) {
			$minify	.=	file_get_contents($dir)."\n";
		}
	}
}
if($type == 'css') {
	$minify	=	$minifier->minifyCSS($minify);
	$minify	=	str_replace('../',"/theme/{$skin}/",$minify);
}
elseif($type == 'js') {
	$minify	=	$minifier->minifyJS($minify);
	//$packer = new JavaScriptPacker($minify, 'Normal', false, false);
	//$minify = $packer->pack();
}
echo $minify;
exit;