<?php
$HTTP_ACCESS  =  filter($_SERVER['HTTP_ACCESS']);
if(!$HTTP_ACCESS) {
  $HTTP_ACCESS  = filter($_REQUEST['access_token']);
}
$HTTP_REFERER  =  filter($_SERVER['HTTP_REFERER']);
$HTTP_ORIGIN  =  filter($_SERVER['HTTP_ORIGIN']);
list($uri, $sesion_id, $remote)  =  array_map('filter',explode('|', jcode($HTTP_ACCESS, 'de')));
// print_r([$uri,$sesion_id,$remote]);
// print_r([$HTTP_REFERER,$_COOKIE['PHPSESSID'],$REMOTE_IP]);
// exit;
if (
  $REMOTE_IP !=  $remote ||
  $_COOKIE['PHPSESSID'] != $sesion_id ||
  !preg_match("#{$uri}#", $HTTP_REFERER) ||
  !preg_match("#{$_SERVER['HTTP_HOST']}#", $HTTP_ORIGIN)
) {
  header('HTTP/1.0 403 Forbidden');
  exit;
}
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
