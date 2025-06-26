<?php
if (!defined('mDB')) die("404 Not Found!");

class cache
{
	public function set($cache_key, $data)
	{
		$cache_dir	=	substr($cache_key, 1, 2);
		$cache_file	=	"{$_SERVER['DOCUMENT_ROOT']}/.cache/{$cache_dir}/{$cache_key}.ip";
		if ($cache_dir) {
			if (!is_dir("{$_SERVER['DOCUMENT_ROOT']}/.cache")) {
				@mkdir("{$_SERVER['DOCUMENT_ROOT']}/.cache", 0777);
			}
			if (!is_dir("{$_SERVER['DOCUMENT_ROOT']}/.cache/{$cache_dir}")) {
				@mkdir("{$_SERVER['DOCUMENT_ROOT']}/.cache/{$cache_dir}", 0777);
			}
		}
		if ($data) {
			$cached = fopen($cache_file, 'w');
			fwrite($cached, $data);
			fclose($cached);
		}
		return $data;
	}
	public function get($cache_key, $time = 7200)
	{
		$cache_dir	=	substr($cache_key, 1, 2);
		$cache_file	=	"{$_SERVER['DOCUMENT_ROOT']}/.cache/{$cache_dir}/{$cache_key}.ip";
		if (file_exists($cache_file) && filemtime($cache_file) > (time() - $time)) {
			return file_get_contents($cache_file);
		} else {
			return false;
		}
	}
	public function rmcache($dir = '', $remove = false)
	{
		if (!$dir)
			$dir = $_SERVER['DOCUMENT_ROOT'] . "/.cache/";
		$structure = glob(rtrim($dir, "/") . '/*');
		if (is_array($structure)) {
			foreach ($structure as $file) {
				if (is_dir($file))
					$this->rmcache($file, true);
				else if (is_file($file))
					unlink($file);
			}
		}
		if ($remove)
			rmdir($dir);
	}
	public function delete($cache_key)
	{
		$cache_dir	=	substr($cache_key, 1, 2);
		$cache_file	=	"{$_SERVER['DOCUMENT_ROOT']}/.cache/{$cache_dir}/{$cache_key}.ip";
		if (is_file($cache_file))
			unlink($cache_file);
	}
	public function flush()
	{
		$this->rmcache();
	}
}
$cache	=	new cache();
