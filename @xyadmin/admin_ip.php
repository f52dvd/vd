<?php
require_once('data.php');
require_once('checkAdmin.php');
$v_config=require_once('../data/config.php');
require_once('../inc/common.inc.php');
$id=isset($_GET ['id'])?$_GET ['id']:'';
$file=VV_DATA."/banip.php";
$ip=@file_get_contents($file);
if($id==''){
echo ADMIN_HEAD;
?><body><div><div><form action="?id=save" method="post" onSubmit="return chk();" ><table width="98%" border="0" cellpadding="4" cellspacing="1"><tr><td width="260" ><b>IP��ַ</b><br>���κ��IP�����ܷ���ǰ̨ҳ��<br>ÿ��һ��IP��ַ��֧��ͨ���*<br>�磺127.0.0.*</font><br></td><td><textarea name="ip" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo $ip?></textarea></td></tr><script type="text/javascript">
document.write(submit);
</script></table></form></div></div><?php include "footer.php";?></body></html><?php
}elseif ($id=='save'){
	$con=get_magic(trim($_POST['ip']));
	if(@preg_match("/require|include|REQUEST|eval|system|fputs/i", $con)){   
		ShowMsg("���зǷ��ַ�,����������",'-1',2000);
	}else{
		write($file,$con);
		ShowMsg("��ϲ��,�޸ĳɹ���",'admin_ip.php',2000);
	}
}
?>