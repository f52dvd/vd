<?php
require(dirname(__FILE__)."/inc/common.inc.php");
require(dirname(__FILE__)."/inc/caiji.class.php");
$v_config=require(VV_DATA."/config.php");
$imgurl = @$_GET['g'];
$imgurl ='http://'.str_replace('http://','',$imgurl);
if($_SERVER['HTTP_REFERER']=='') exit('no');
header("Content-Type: image/jpeg; charset=UTF-8");

$cacheid=md5($imgurl);
$cachefile=getcachefile($cacheid);
$cachetime=$v_config['imgcachetime'];
if($v_config['imgcache'] && OoO0o0O0o()){
	if(!is_file ($cachefile) || (@filemtime($cachefile)+($cachetime*3600))<= time ()){
		$imgbin=$caiji->geturl($imgurl);
		if(!empty($imgbin)){
			write($cachefile,$imgbin);
		}
	}else{
		$imgbin=file_get_contents($cachefile);
	}
}else{
	$imgbin=$caiji->geturl($imgurl);
}
echo $imgbin;