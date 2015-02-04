<?php

if (!defined('VV_INC')) exit(header("HTTP/1.1 403 Forbidden"));
banip();
$v_config = require(VV_DATA . "/config.php");
include(VV_INC . "/delcache.php");
$ac = isset($_GET['ac']) ?$_GET['ac'] : '';
$collectid = $v_config['collectid'];
if ($ac == 'yulan') {
	$collectid = intval(@$_GET['collectid']);
	$v_config['cacheon'] = false;
} else if ($_COOKIE['collectid'] != '') {
	$collectid = intval($_COOKIE['collectid']);
	$v_config['cacheon'] = false;
} 
$caiji_config = require(VV_DATA . "/config/{$collectid}.php");
$_SERVER['QUERY_STRING'] = convert_encode($_SERVER['QUERY_STRING'], $caiji_config['charset']);
$charset = (SCRIPT == 'search' && $caiji_config['search_charset']) ?$caiji_config['search_charset'] : $caiji_config['charset'];
$temp=array();
if (!empty($_POST)) {
	foreach($_POST as $k => $vo) {
		$k=convert_encode($k, $charset);
		$temp[$k]=convert_encode($vo, $charset);
	} 
} 
$_POST=$temp;
$temp=array();
foreach($_GET as $k => $vo) {
	$k=convert_encode($k, $charset);
	$temp[$k]=convert_encode($vo, $charset);
} 
$_GET=$temp;
if ($ac == 'yulan') {
	if (isset($_GET['url'])) $caiji_config['from_url'] = $_GET['url'];
} 
$parse_url = parse_url($caiji_config['from_url']);
$port = isset($parse_url['port'])?$parse_url['port']:'';
$server_url = 'http://' . $parse_url['host'];
if ($port) $server_url = $server_url . ':' . $port;
$str = '';
$sign = $v_config['web_remark'] ? '/'.$v_config['web_remark'].'/': '/';
$temp_url = parse_url($v_config['web_url']);
define('WEB_ROOT', substr($temp_url['path'], 0, -1));
if (!$caiji_config['rewrite'] || !OoO0o0O0o()) {
	$sign = '?';
	if (SCRIPT == 'search') $sign = 'index.php?';
} 
if (empty($_SERVER['QUERY_STRING'])) {
	$cachefile = VV_CACHE . '/index.html';
	$cachetime = $v_config['indexcache'];
	$geturl = $caiji_config['from_url'];
} else {
	if (substr($_SERVER['QUERY_STRING'], 0, 1) == '/') $_SERVER['QUERY_STRING'] = substr($_SERVER['QUERY_STRING'], 1);
	$geturl = $server_url . '/' . $_SERVER['QUERY_STRING'];
	$cacheid = md5($geturl);
	$cachefile = getcachefile($cacheid);
	$cachetime = $v_config['othercache'];
} 
if (SCRIPT == 'search') {
	if (!empty($_POST)) {
		$searchurl = $caiji_config['search_url'];
	} else {
		unset($_GET['action']);
		$getstr = http_build_query($_GET);
		$search_sign = stripos($caiji_config['search_url'], '?') > -1 ?'&': '?';
		$searchurl = $caiji_config['search_url'] . $search_sign . $getstr;
	} 
	if (substr($searchurl, 0, 7) != 'http://' && substr($searchurl, 0, 8) != 'https://') {
		$searchurl = $server_url . '/' . $searchurl;
	} 
	$cacheid = !empty($_POST) ?md5($searchurl . http_build_query($_POST)) : md5($searchurl);
	$cachefile = getcachefile($cacheid);
	$cachetime = $v_config['othercache'];
} 
$extarr = array('php', 'html', 'shtml', 'htm', 'jsp', 'xhtml', 'asp', 'aspx', 'action', 'xml', 'css');
foreach($extarr as $vo) {
	$geturl = str_replace('.' . $vo . '&', '.' . $vo . '?', $geturl);
} 
if ($ac == 'yulan') {
	$geturl = $caiji_config['from_url'];
} 
unset($parse_url);
$parse_url = parse_url($geturl);
$urlpath = $parse_url['path'];
$urlpathext = pathinfo($parse_url['path'], PATHINFO_EXTENSION);
if (empty($urlpathext)) {
	if (substr($urlpath, -1) != '/') $urlpath .= '/';
} else {
	$urlpathinfo = pathinfo($parse_url['path']);
	$urldirname = $urlpathinfo['dirname'];
	$urlbasename = $urlpathinfo['basename'];
	$urlpath = str_replace($urlbasename, '', $parse_url['path']);
	if ($urldirname != '\\') $urlpath = $urldirname . '/';
} 
if (substr($urlpath, 0, 1) == '/') {
	$urlpath = substr($urlpath, 1);
} 
$urlext = pathinfo($parse_url['path'], PATHINFO_EXTENSION);
$imgarr = array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico');
if (@is_file(VV_ROOT . '/' . $_SERVER['QUERY_STRING'])) {
	if (in_array($urlext, $imgarr)) header("Content-type: image/{$urlext}; charset=gbk");
	if ($urlext == 'js') header("Content-type: text/javascript; charset=gbk");
	if ($urlext == 'css') header("Content-type: text/css; charset=gbk");
	echo @file_get_contents(VV_ROOT . '/' . $_SERVER['QUERY_STRING']);
	exit();
} 
if (in_array($urlext, $imgarr)) {
	if ($v_config['imgcache'] && OoO0o0O0o()) {
		$cachetime = $v_config['imgcachetime'];
		$extarr = array_merge($extarr, $imgarr);
		header("Content-type: image/{$urlext}; charset=gbk");
		$cachefile = VV_CACHE . "/img/" . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), 0, 16) . '.img';
		if ($cachetime && (!is_file ($cachefile) || (@filemtime($cachefile) + ($cachetime * 3600)) <= time ())) {
			$str = $caiji -> geturl($geturl);
			if (!empty($str)) {
				write($cachefile, $str);
			} else {
				$str = file_get_contents($cachefile);
				write($cachefile, $str);
			} 
		} else {
			$str = file_get_contents($cachefile);
		} 
		exit($str);
	} 
} 
if ($urlext == 'css') {
	header("Content-type: text/css; charset=gbk");
	$cachetime = $v_config['csscachetime'];
	$cachefile = getcsscachefile($cacheid);
} 
if ($urlext <> '' && !in_array($urlext, $extarr)) {
	header('HTTP/1.1 301 Moved Permanently');
	header("Location:$geturl");
	exit;
} 
include(VV_DATA . '/rules_get.php');
if ($ac == 'yulan') {
	$str = htmlspecialchars($str);
	$str = "	<script type=\"text/javascript\" src=\"../public/js/syntaxhighlighter/scripts/shCore.js\"></script>
	<script type=\"text/javascript\" src=\"../public/js/syntaxhighlighter/scripts/shBrushXml.js\"></script>
	<link type=\"text/css\" rel=\"stylesheet\" href=\"../public/js/syntaxhighlighter/styles/shCore.css\"/>
	<link type=\"text/css\" rel=\"stylesheet\" href=\"../public/js/syntaxhighlighter/styles/shThemeEditplus.css\"/>
	<script type=\"text/javascript\">
		SyntaxHighlighter.config.clipboardSwf = '../public/js/syntaxhighlighter/scripts/clipboard.swf';
		SyntaxHighlighter.config.tagName = 'textarea';
		SyntaxHighlighter.all();
	</script>
	<table width=\"99%\" border=\"0\" cellpadding=\"4\" cellspacing=\"1\" class=\"tableoutline\">
	<tbody>
		<tr nowrap class=\"tb_head\">
			<td><h2>源代码查看</h2></td>
		</tr>
	</tbody>
	<tr nowrap class=\"firstalt\">
		<td><b>以下为采集规则 [{$caiji_config['name']}] 的源代码，你可以根据这个编写过滤规则:</b></td>
	</tr>
	<tr nowrap class=\"firstalt\">
		<form method=\"get\" action=\"caiji_config.php\">
		<input type=\"hidden\" name=\"ac\" value=\"{$ac}\" />
		<input type=\"hidden\" name=\"collectid\" value=\"{$collectid}\" />
		<td><input type=\"text\" name=\"url\" size=\"80\" value=\"{$caiji_config['from_url']}\" onFocus=\"this.style.borderColor='#00CC00'\" onBlur=\"this.style.borderColor='#999999'\" > <input type=\"submit\" value=\"查看源代码\" /></td>
		</form>
	</tr>
	<tr nowrap class=\"firstalt\">
		<td><textarea style=\"height:500px\" class=\"brush: html;auto-links:false;\">{$str}</textarea></td>
	</tr>
</table>
</body>
</html>";
	$str = ADMIN_HEAD . $str;
} 
echo $str;