<?php
/**
 * --------------------------
 * 小偷网站定制
 * qq:996948519
 * ---------------------------
 */
class caiji {
	public $keyfile;
	public $jsfile;
	function replace($str) {
		if (is_file($this -> keyfile)) {
			$arr = file($this -> keyfile);
			$arr = str_replace(array("\r\n", "\n", "\r"), '', $arr);
			foreach($arr as $k => $v) {
				if (trim($v) == '') break;
				list($l, $r) = explode(',', $v);
				if (function_exists('mb_string')) {
					mb_regex_encoding("gb2312");
					$str = mb_ereg_replace($l, $r, $str);
				} else {
					$str = str_replace($l, $r, $str);
				} 
			} 
		} 
		return $str;
	} 
	function strcut($start, $end, $str, $lt = false, $gt = false) {
		if ($str == '') return '$false$';
		$strarr = explode($start, $str);
		if ($strarr[1]) {
			$strarr2 = explode($end, $strarr[1]);
			$return = $strarr2[0];
			if ($lt) $return = $start . $return;
			if ($gt) $return = $return . $end;
		} else {
			return '$false$';
		} 
		return $return;
	} 
	function geturl($url, $timeout = 25) {
		$user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36";
		$cookie = '_lang=zh_CN:GBK; t=ba6a2a7ea0ebd4f0dbef8d54d73b7a7b;';
		$data = array();
		global $v_config;
		if (function_exists('curl_init') && function_exists('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			if (!ini_get("safe_mode") && !ini_get('open_basedir')) {
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			}
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
			curl_setopt($ch, CURLOPT_REFERER, $url);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
			$data = curl_exec($ch);
			$ContentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$lasturl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
			if (preg_match('~^(application|video)~i', $ContentType)) {
				header('HTTP/1.1 301 Moved Permanently');
				header("Location:$lasturl");
				exit;
			} 
			curl_close($ch);
		} else if (function_exists('fsockopen') || function_exists('pfsockopen')) {
			$arr = parse_url($url);
			$path = $arr['path']?$arr['path']:"/";
			$host = $arr['host'];
			$port = isset($arr['port'])?$arr['port']:80;
			if ($arr['query']) {
				$path .= "?" . $arr['query'];
			} 
			if (function_exists('fsockopen')) {
				$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
			} else {
				$fp = pfsockopen($host, $port, $errno, $errstr, $timeout);
			} 
			if (!$fp) {
				die("$errstr ($errno)");
			} 
			stream_set_timeout($fp, $timeout);
			$out = "GET {$path} HTTP/1.0\r\n";
			$out .= "Host: {$host}\r\n";
			$out .= "User-Agent: {$user_agent}\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "Accept-Encoding: identity\r\n";
			$out .= "Referer: {$url}\r\n";
			$out .= "Cookie: {$cookie}\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fputs($fp, $out);
			$data = "";
			$httpCode = substr(fgets($fp, 13), 9, 3);
			while ($line = @fgets($fp, 2048)) {
				$data .= $line;
			} 
			fclose($fp);
			if (preg_match("/Content-Length:.?(\d+)/", $data, $matches)) {
				$data = substr($data, strlen($data) - $matches[1]);
			} else {
				$data = substr($data, strpos($data, '<'));
			} 
		} else {
			if (ini_get('allow_url_fopen')) {
				for($i = 0;$i < 3;$i++) {
					if (function_exists('stream_context_create')) {
						$opt = array('http' => array('timeout' => $timeout, 'header' => "User-Agent: {$user_agent}\r\nCookie: {$cookie}\r\nReferer: {$url}"));
						$context = stream_context_create($opt);
						$data = file_get_contents('compress.zlib://' . $url, false, $context) or die('服务器不支持采集');
					} else {
						$data = file_get_contents('compress.zlib://' . $url) or die('服务器不支持采集');
					} 
					if ($data) {
						$httpCode = substr($http_response_header[0], 9, 3);
						break;
					} 
				} 
			} else {
				die('服务器未开启php采集函数');
			} 
		} 
		if ($httpCode >= 400) {
			header("HTTP/1.1 404 Not Found");
			if($v_config['web_404_url']) header("Location: ".$v_config['web_404_url']);
			exit;
		}
		$rdata=@$this->gzdecode($data);
		if($rdata=='') $rdata=$data;
		return $rdata;
	}
	function post($url,$params=array()){
		if(empty($params)) return $this->geturl($url);
		$opt=array('http'=>array('method'=>'POST','timeout'=>25,'header' => "User-Agent: {$user_agent}\r\nCookie: {$cookie}\r\nReferer: {$url}"));
		$opt['http']=array_merge($opt['http'],array('content'=>http_build_query($params)));
		$context=stream_context_create($opt);
		$data=file_get_contents($url,false,$context);
		unset($http_response_header[0]);
//		exit($data);
//		foreach($http_response_header as $k=>$vo){
//			header($vo);
//		}
		if(stripos(implode('',$http_response_header),'application/json')){
			header('Content-Type:application/json; charset=utf-8');
			if(stripos($data,'\u60a8\u5df2\u7ecf\u9605\u8bfb\u5230\u6700\u540e\u4e00\u7ae0\u4e86\uff0c\u8c22\u8c22\uff01')){
				exit('{"Content":"<div id=\"endBox\" class=\"textbox\"><div id=\"alpha\"><\/div><div class=\"reader_last_tit\"><div class=\"readlast_inner\"><h3 class=\"gray\">\u60a8\u5df2\u7ecf\u9605\u8bfb\u5230\u6700\u540e\u4e00\u7ae0\u4e86\uff0c\u8c22\u8c22\uff01<\/h3><\/div><\/div><\/div>"}');
			}
			exit($data);
		}
		if($data) return $data;
		return 'error';
	}
	function __construct() {
		$this -> keyfile = VV_DATA . "/keyword.php";
	} 
	function gzdecode ($data) {
		$flags = ord(substr($data, 3, 1));
		$headerlen = 10;
		$extralen = 0;
		$filenamelen = 0;
		if ($flags &4) {
			$extralen = unpack('v' , substr($data, 10, 2));
			$extralen = $extralen[1];
			$headerlen += 2 + $extralen;
		} 
		if ($flags &8) // Filename
			$headerlen = strpos($data, chr(0), $headerlen) + 1;
		if ($flags &16) // Comment
			$headerlen = strpos($data, chr(0), $headerlen) + 1;
		if ($flags &2) // CRC at end of file
			$headerlen += 2;
		$unpacked = @gzinflate(substr($data, $headerlen));
		if ($unpacked === false)
			$unpacked = $data;
		return $unpacked;
	} 
} 
$caiji = new caiji;