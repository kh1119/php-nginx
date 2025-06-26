<?php
if(!defined('mDB')) die("404 ERROR");
class	dbFile {
	public function get($f,$dir='') {
		if($f) {
			if($dir) {
				$fdir	=	substr(md5($f),0,2);
				$f		=	"{$fdir}/{$f}";
			}
			return	unserialize(file_get_contents((($dir)?$dir:DATA_DIR)."/{$f}.txt"));
		}
	}
	public function set($f,$arr=[],$dir='') {
		if($f) {
			if($dir) {
				$data	=	serialize($arr);
				$fdir	=	substr(md5($f),0,2);
				if(!is_dir("{$dir}/{$fdir}")) {
					mkdir("{$dir}/{$fdir}", 0777);
				}
				if($fopen	= 	fopen("{$dir}/{$fdir}/{$f}.txt", "w")){
					fwrite($fopen, $data);
					fclose($fopen);
				}
			}else {
				$data	=	serialize($arr);
				if($fopen	= 	fopen(DATA_DIR."/{$f}.txt", "w")){
					fwrite($fopen, $data);
					fclose($fopen);
				}
			}
		}
	}
	public function delete($f,$dir='') {
		if($f) {
			if($dir) {
				$fdir	=	substr(md5($f),0,2);
				$f		=	"{$fdir}/{$f}";
			}
			if(is_file((($dir)?$dir:DATA_DIR)."/{$f}.txt"))
				unlink((($dir)?$dir:DATA_DIR)."/{$f}.txt");
		}
	}
	function file($f) {
		if($f) {
			if($dir) {
				$fdir	=	substr(md5($f),0,2);
				$f		=	"{$fdir}/{$f}";
			}
			return	file(DATA_DIR."/{$f}.txt");
		}
	}
	function push($f,$arr=[],$dir='') {
		if($arr) {
			if($dir) {
				$fdir	=	substr(md5($f),0,2);
				$f		=	"{$fdir}/{$f}";
			}
			$search	= 	file_get_contents(DATA_DIR."/{$f}.txt");
			$append	=	[];
			foreach($arr as $v) {
				if($v && strpos($search,$v."\n") !== false) {
					
				}else {
					$append[]	=	$v;
				}
			}
			if($append) {
				$fp = fopen(DATA_DIR."/{$f}.txt", 'a');
				fwrite($fp, implode("\n",$append)."\n");
				fclose($fp);
			}
		}
	}
}
$dbF 		= 	new dbFile();