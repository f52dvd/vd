<html><head><title>凤舞源建站管理系统</title><meta http-equiv="Content-Type" content="text/html; charset=gb2312"><script language="JavaScript">
function chk(){
	if(document.login.adminname.value==""){
		alert("用户名不能为空");
		return false;
	}else if(document.login.password.value==""){
		alert("密码不能为空");
		return false;
	}
}
</script></head><body><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center"><table width="502" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td><font size="+6">凤舞源建站</font></td></tr><tr><td height="134" align="center"bgcolor="#129456"><form method='post' action='login.php' name="login"><?php //检测后台目录是否更名
$cururl = $_SERVER['SCRIPT_NAME'];
if(preg_match('/admin\/index/i',$cururl))
{
    $redmsg ='<div class=\'loginsafe\'>您的后台目录包含admin，为了您的网站安全,凤舞源建站建议您将后台目录修改成其它名称！
</div>';
}
else
{
    $redmsg = '';
}
echo $redmsg;
?><table width="400" border="0" align="right" cellpadding="0" cellspacing="4"><tr><td width="74" height="25" align="center">用户名称：</td><td width="314"><input class='in_p' type='text' name='adminname' id="adminname"onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr><td height="25" align="center">密  码：</td><td><input type='password' class='in_p' name='password' id="password" onFocus="this.style.borderColor='#20CC00'" onBlur="this.style.borderColor='#d2dcdc'" ></td></tr><td height="25" align="center">&nbsp;</td><td><input name="action" type='hidden' value='login'><input name="submit" type='image' src="http://i2.tietuku.com/e79cc5f723ab495b.png" x=10 y=10 id="submit" class="noborder"></td></tr></table></form></td></tr></table></td></tr></table><span style="display:none"></span></body></html>