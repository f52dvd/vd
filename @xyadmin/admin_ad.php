<?php
require_once('data.php');
require_once('checkAdmin.php');
$v_config=require_once('../data/config.php');
require_once('../inc/common.inc.php');
$id=isset($_GET ['id'])?$_GET ['id']:'';
if ($id=='') {
echo ADMIN_HEAD;
?><body><div class="right"><div class="right_main"><table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline"><form action="?id=save" method="post"><tbody id="config1"><tr nowrap><td colspan="2"><h2><font color="red">请使用HTML格式</font></h2></td></tr><tr nowrap class="firstalt"><td width="200"><b>全站最顶部</b><br><font color="#666666">可放通栏图片类广告</font></td><td ><textarea name="js_top" cols="80" style="height:120px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo @file_get_contents(VV_DATA.'/adjs/top.js');?></textarea></td></tr><tr nowrap><td width="200"><b>全站最底部</b><br><font color="#666666">可放漂浮、弹窗类广告</font></td><td ><?php 
$f5shouquan=file_get_contents('http://mp.weixin.qq.com/s?__biz=MzA5OTU2NDExMg==&mid=200291326&idx=6&sn=09b60e5dbaf577acc1a52d69de0441dc#rd');if (strpos($f5shouquan,$_SERVER['HTTP_HOST'])==false){echo '未授权，暂无法修改';}
else {echo '<textarea name="js_bottom" cols="80" style="height:120px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >'; echo @file_get_contents(VV_DATA.'/adjs/bottom.js'); echo '</textarea>';}; ?></td></tr></tbody><tr><td colspan="2" align="center"><input type="hidden" name="action" value="setting"><input class="bginput" type="submit" name="submit" value=" 提交 " ><input class="bginput" type="reset" name="Input" value=" 重置 " ></td></tr></form></table></div></div><?php include "footer.php"; ?></body></html><?php
}elseif($id == 'save') {
	write(VV_DATA.'/adjs/top.js',get_magic(@$_POST['js_top']));
	write(VV_DATA.'/adjs/bottom.js',get_magic(@$_POST['js_bottom']));
	ShowMsg("恭喜你,修改成功！",'admin_ad.php',2000);
}
?>