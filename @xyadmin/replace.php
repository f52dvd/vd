<?php
require_once('data.php');
require_once('checkAdmin.php');
$v_config=require_once('../data/config.php');
require_once('../inc/common.inc.php');
$id=isset($_GET ['id'])?$_GET ['id']:'';
$file=VV_DATA."/keyword.php";
$keyword=file_get_contents($file);
if($id=='wyc' || $id==''){
echo ADMIN_HEAD;
?><body><div class="right"><div><form action="?id=save" method="post" onSubmit="return chk();" ><table width="98%" border="0" cellpadding="4" cellspacing="1"><tr><td width="260" align="center"><b>同义词词汇</b><br /><font>(建议2000以内)</font></td><td>每行一对同义词，以半角逗号,隔开<br>如：<br>创意,创新<br>创业,奋斗</font><br><textarea name="keyword" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo $keyword?></textarea></td></tr><script type="text/javascript">
document.write(submit);
</script></table></form></div></div><?php include "footer.php";?></body></html><?php
}elseif ($id=='save'){
	$con=get_magic(trim($_POST['keyword']));
	if(@preg_match("/require|include|REQUEST|eval|system|fputs/i", $con)){   
		ShowMsg("含有非法字符,请重新设置",'-1',2000);
	}else{
		write($file,$con);
		ShowMsg("恭喜你,修改成功！",'replace.php',2000);
	}
}
?>