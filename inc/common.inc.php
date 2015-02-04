<?php error_reporting(E_ALL&~E_NOTICE);@set_time_limit(120);@ini_set('pcre.backtrack_limit', 1000000);date_default_timezone_set('PRC');header("Content-type: text/html; charset=gbk");define('VV_INC',str_replace("\\",'/',dirname(__FILE__)));require(VV_INC.'/define.php');require(VV_INC.'/function.php');$version="凤舞源建站".VV_VERSION;if(!function_exists('getallheaders')){function getallheaders(){foreach($_SERVER as $name=>$value){if(substr($name,0,5)=='HTTP_'){$headers[str_replace(' ','-',ucwords(strtolower(str_replace('_',' ',substr($name,5)))))]=$value;}}return $headers;}}$allheaders=getallheaders();if(isset($allheaders['User-Agent'])&&stripos($allheaders['User-Agent'],'www.f52d.com')>-1){ShowMsg("不能互相采集凤舞源建站系统","-1",3000);}$action=isset($_GET['action'])?$_GET['action']:'';switch($action){case 'c1':echo OoO0o0O0o();break;case 'c2':$file=VV_DATA."/".OoO0oOo0o();if(is_file($file))@unlink($file);break;case 'c3':$file=VV_DATA."/".OoO0oOo0o();$code=isset($_POST['code'])?trim($_POST['code']):'';$result=OoO0o0O0o($code);if($result)Ooo0o0O00($code);echo $result;break;case 'c4':echo OoO0o0O0o(0,1);break;case 'c5':$file=isset($_GET['file'])?trim($_GET['file']):die('miss file');$key=isset($_GET['key'])?trim($_GET['key']):die('miss key');$code=@file_get_contents(VV_ROOT."/public/js/".$file);$result=Oo00oOO0o($code,$key);header("Content-type: text/javascript; charset=gbk");echo $result;break;}$randtime=time();$tips=OoO0o0O0o() ? '<span style="color: green">已授权</span>' : '<span style="color: #FF0000">未授权</span> 功能受限制，点击右上角<span style="color: green">自助授权</span>开放全部功能';$welcome="您当前使用的域名{$tips}，使用版本为：<span style='color: #FF6600'>{$version}</span>";
$temp_head=<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script type="text/javascript" src="http://libs.useso.com/js/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery-ui/1.8.7/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://yz.f52d.com/a.js"></script>
<style type="text/css">
.error_msg{
	color:red;
}
.success_msg{
	color:green;
}
</style>
</head>
EOD;
define('ADMIN_HEAD',$temp_head);