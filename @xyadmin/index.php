<html><head><title>����Դ��վ����ϵͳ</title><meta http-equiv="Content-Type" content="text/html; charset=gb2312"><script language="JavaScript">
function chk(){
	if(document.login.adminname.value==""){
		alert("�û�������Ϊ��");
		return false;
	}else if(document.login.password.value==""){
		alert("���벻��Ϊ��");
		return false;
	}
}
</script></head><body><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center"><table width="502" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><font size="+6">����Դ��վ</font></td></tr><tr><td height="134" align="center"bgcolor="#129456"><form method='post' action='login.php' name="login"><?php //����̨Ŀ¼�Ƿ����
$cururl = $_SERVER['SCRIPT_NAME'];
if(preg_match('/admin\/index/i',$cururl))
{
    $redmsg ='<div class=\'loginsafe\'>���ĺ�̨Ŀ¼����admin��Ϊ��������վ��ȫ,����Դ��վ����������̨Ŀ¼�޸ĳ��������ƣ�
</div>';
}
else
{
    $redmsg = '';
}
echo $redmsg;
?><table width="400" border="0" align="right" cellpadding="0" cellspacing="4"><tr><td width="74" height="25" align="center">�û����ƣ�</td><td width="314"><input class='in_p' type='text' name='adminname' id="adminname"onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr><td height="25" align="center">��  �룺</td><td><input type='password' class='in_p' name='password' id="password" onFocus="this.style.borderColor='#20CC00'" onBlur="this.style.borderColor='#d2dcdc'" ></td></tr><td height="25" align="center">&nbsp;</td><td><input name="action" type='hidden' value='login'><input name="submit" type='image' src="http://i2.tietuku.com/e79cc5f723ab495b.png" x=10 y=10 id="submit" class="noborder"></td></tr></table></form></td></tr></table></td></tr></table><span style="display:none"></span></body></html>