<?php
define('mDB',true);
require_once('inc/config.php');
require_once('inc/cache.php');
require_once('inc/sql.php');
require_once('inc/api.php');
require_once('inc/function.php');
require_once('inc/setting.php');
header("content-type: text/xml; charset=utf-8");

function ban($url='') {
	global $config,$ban;
	if(!$ban||!$url) return false;
	$url=explode($config['host'],$url)[1];
	if($ban && $ban[$url]) {
		return true;
	}
}

$act	=	filter($_GET['ip']);
$num	= 	2000;
if($act) {
	$xml	=	"<?xml version=\"1.0\" encoding=\"utf-8\"?>
	<?xml-stylesheet type=\"text/xsl\" href=\"".https('/sitemap.xsl')."\"?>
	<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
		<url>
			<loc>".https('/')."</loc>
			<changefreq>always</changefreq>
			<priority>1.0</priority>
		</url>\n";
}
if($act=='posts') {
	
	$page 		= intval($_GET['p']);
	if (!$page) $page = 1;
	$limit 		= ($page-1)*$num;
	if($limit<0) $limit=0;
		
	$arr	=	$api->call("select",['data'	=> [[
		"item"	=>	base64_encode("id,slug,created"),
		"table"	=>	"post",
		"sql"	=>	base64_encode("status = 1 order by created asc limit {$limit},{$num}")
	]]],1)['data'][0];
	foreach($arr as $r) {
		$pid	=	pUrl($r['slug']);
		$url	=	urls($r['slug'].(($change[$pid])?'.'.$change[$pid]:''),'post');
		if(!ban($url)) {
			$xml	.=	"
			<url>
				<loc>{$url}</loc>
				<lastmod>".date("c",strtotime($r['created']))."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.8</priority>
			</url>\n";
		}
	}
}
elseif($act=='country') {
	$arr	=	$api->call("select",['data'	=> [[
		"item"	=>	base64_encode("slug,time"),
		"table"	=>	"meta",
		"sql"	=>	base64_encode("type = 'country' order by title asc")
	]]],1)['data'][0];
	foreach($arr as $r) {
		$url	=	urls($r['slug'],'country');
		$xml	.=	"
			<url>
				<loc>{$url}</loc>
				<lastmod>".date("c",strtotime($r['time']))."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.8</priority>
			</url>\n";
	}
}
elseif($act=='genre') {
	$arr	=	$api->call("select",['data'	=> [[
		"item"	=>	base64_encode("slug,time"),
		"table"	=>	"meta",
		"sql"	=>	base64_encode("type = 'genre' order by title asc")
	]]],1)['data'][0];
	foreach($arr as $r) {
		$url	=	urls($r['slug'],'genre');
		$xml	.=	"
			<url>
				<loc>{$url}</loc>
				<lastmod>".date("c",strtotime($r['time']))."</lastmod>
				<changefreq>daily</changefreq>
				<priority>0.8</priority>
			</url>\n";
	}
}
else {
	$xml	=	"<?xml version=\"1.0\" encoding=\"UTF-8\"?><?xml-stylesheet type=\"text/xsl\" href=\"".https('/sitemap.xsl')."\"?><sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";

	$arr	=	$api->call("select",['data'	=> [
		[
			"item"	=>	base64_encode("created as time"),
			"table"	=>	"post",
			"sql"	=>	base64_encode("status = 1 order by created asc limit 1")
		],
		[
			"item"	=>	base64_encode("time"),
			"table"	=>	"meta",
			"sql"	=>	base64_encode("type = 'genre' order by time desc limit 1")
		],
		[
			"item"	=>	base64_encode("time"),
			"table"	=>	"meta",
			"sql"	=>	base64_encode("type = 'country' order by time desc limit 1")
		]
	]],1)['data'];

		$xml	.=	"<sitemap>
				<loc>".https("/sitemap/genre.xml")."</loc>
				<lastmod>".date("c",strtotime($arr[1][0]['time']))."</lastmod>
			</sitemap>";
		if($build['database'] == 'movie') {
			$xml	.=	"<sitemap>
			<loc>".https("/sitemap/country.xml")."</loc>
				<lastmod>".date("c",strtotime($arr[2][0]['time']))."</lastmod>
			</sitemap>";
		}

		$total		=	$api->call("total",[
			"item"	=>	"id",
			"table"	=>	"post",
			"sql"	=>	base64_encode("status = 1")
		],1)['total'];
		$limit 		= 	ceil($total/$num);
		for($i=1;$i<=$limit;$i++) {
			$xml	.=	"<sitemap>
				<loc>".https("/sitemap/posts".(($limit==1)?'':'-'.$i).".xml")."</loc>
				<lastmod>".date("c",strtotime($arr[0][0]['time']))."</lastmod>
			</sitemap>";
		}
	
	$xml	.=	"</sitemapindex>";	
}
if($act) {
	$xml	.=	"</urlset>";
}
echo $xml;
exit();
?>