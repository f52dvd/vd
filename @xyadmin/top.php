<?php
require_once('data.php');
require_once('checkAdmin.php');
?><html><head><title>����Դ��վ��̨����ϵͳ ������� v</title><meta http-equiv="Content-Type" content="text/html; charset=gb2312"></head><body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="600">����Դ��վ��̨����ϵͳ</td><td valign="top"><a href="../" target="_blank">�鿴��ҳ</a> | <a href="http://yjz.f52d.com/" target="_blank">�ٷ���ҳ</a> | <!--<a href="update.php?t=update" target="content">��ϵ����</a>--><a href="http://yjz.f52d.com/shouquan/" target="_blank"><?php 
$f5shouquan=file_get_contents('http://mp.weixin.qq.com/s?__biz=MzA5OTU2NDExMg==&mid=200291326&idx=6&sn=09b60e5dbaf577acc1a52d69de0441dc#rd');if (strpos($f5shouquan,$_SERVER['HTTP_HOST'])==true){echo '����Ȩ';}
else {echo 'δ��Ȩ';};
?></a> | <a href="logout.php" onClick="return confirm('ȷ���˳�?')" target="_top">�˳���̨</a></td></tr></table></td></tr></table></body></html>