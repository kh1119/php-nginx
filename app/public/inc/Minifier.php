<?php
class Minifier
{
	public function minifyHTML($buffer)
	{
		$this->zlibCompression();
		if ($this->isHTML($buffer)) {
			$search = array(
				'/\>[^\S ]+/s',     // strip whitespaces after tags, except space
				'/[^\S ]+\</s',     // strip whitespaces before tags, except space
				'/(\s)+/s',         // shorten multiple whitespace sequences
				'/<!--(.|\s)*?-->/' // Remove HTML comments
			);
			$replace = array(
				'>',
				'<',
				'\\1',
				''
			);
			$buffer = preg_replace($search, $replace, $buffer);
		}
		return $buffer;
	}
	public function minifyCSS($buffer)
	{
		$this->zlibCompression();
		return preg_replace(array('#\/\*[\s\S]*?\*\/#', '/\s+/'), array('', ' '), str_replace(array("\n", "\r", "\t"), '', $buffer));
	}
	public function minifyJS($buffer)
	{
		$this->zlibCompression();
		return preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $buffer);
		//return str_replace(array("\n", "\r", "\t"), '', preg_replace(array('#\/\*[\s\S]*?\*\/|([^:]|^)\/\/.*$#m', '/\s+/'), array('', ' '), $buffer));
	}
	private function isHTML($string)
	{
		return preg_match('/<html.*>/', $string) ? true : false;
	}
	private function zlibCompression()
	{
		if (ini_get('zlib.output_compression')) {
			ini_set("zlib.output_compression", 1);
			ini_set("zlib.output_compression_level", "9");
		}
	}
}
