<?php
if (!defined('mDB')) die("404 ERROR");
class __api
{
	function sending($api = '', $post = [], $timeout = 10)
	{
		global $config, $filter;
		if (!empty($config['host'])) {
			// Nếu host bắt đầu bằng www + số thì loại bỏ phần đó
			$config['host'] = preg_replace('/^www\d+\./i', '', $config['host']);
		}
		$curl 	= curl_init();
		$url		=	API_URL . '/api/' . $api . '?key=' . API_KEY . '&w=' . $config['host'];
		// if($filter['debug']==1) {
		// 	echo $url . "\n" . json_encode($post) . "\n\n";
		// }
		echo $url . "&" . http_build_query($post) . "\n\n";
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2");
		curl_setopt($curl, CURLOPT_HEADER,  false);
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_ENCODING, "gzip,deflate");
		curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$data 		= 	curl_exec($curl);
		//echo $data;
		curl_close($curl);
		return $data;
	}
	function call($api, $post = [], $noCache = 0)
	{
		global $cache, $config;
		if (!$config['cache'])
			$noCache	=	1;
		if ($noCache > 0) {
			$data	=	$this->sending($api, $post);
			$data	=	json_decode($data, true);
		} else {
			$cache_arr	=	$post;
			$cache_key	=	md5($api . $config['host'] . json_encode($post));
			//echo $api.json_encode($post)."\n";echo $cache_key;exit;
			$cache_kdb	=	$cache->get($cache_key, ($api == 'chap.info') ? 1800 : 7200);
			if ($cache_kdb) {
				$data	=	json_decode($cache_kdb, true);
				if (!$data) {
					$data	=	$this->sending($api, $post);
					$data	=	json_decode($data, true);
				}
			} else {
				$data	=	$this->sending($api, $post);
				if ($data) {
					$cache->set($cache_key, $data);
				}
				$data	=	json_decode($data, true);
			}
		}
		return $data;
	}
	function encrypt($string, $action = 'en', $secret_key = '12b989f2159a41b4e9da1d9909a27122')
	{
		$encrypt_method	= "AES-256-CBC";
		$iv = substr($secret_key, 0, 16);

		if ($action == 'en') {
			$output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $iv);
			$output = base64_encode($output);
			$output = str_replace('=', '', $output);
		} else if ($action == 'de') {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $secret_key, 0, $iv);
		}
		return $output;
	}
}
$api = new __api();
