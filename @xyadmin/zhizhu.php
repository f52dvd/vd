<?php
require_once('data.php');
require_once('checkAdmin.php');
$v_config=require_once('../data/config.php');
require_once('../inc/common.inc.php');
if(isset($_GET['del']) && $_GET['del']=='yes'){
	@unlink(VV_DATA."/zhizhu.txt");
	ShowMsg("蜘蛛访问清除完毕！",'zhizhu.php',2000);
}
echo ADMIN_HEAD;
?><body><div><div class="right_main"><table width="98%" border="0" cellpadding="4" cellspacing="1"><tr nowrap><td colspan="5" id="a"><h2>蜘蛛访问记录( <a href="?del=yes">点此清除记录</a> )</h2></td></tr><tr nowrap><td width="50" height="30"><div align="center">ID</div></td><td width="70"><div align="center">蜘蛛</div></td><td width="120"><div align="center">蜘蛛IP</div></td><td>来访页面</td><td width="200">来访时间</td></tr><?php
if(file_exists(VV_DATA."/zhizhu.txt")){
	$list=file(VV_DATA."/zhizhu.txt");
	$l=count($list);
	if( $l!=0 ){
		for ($i=0; $i<$l; $i++) {
		   $detail=explode("---",$list[$i]);
		   echo '<tr class="firstalt"><td>'.$i.'</td><td >'.$detail[1].'</td><td >'.$detail[0].'</td><td><a target="_blank" href="'.$detail[2].'">'.$detail[2].'</a></td><td>'.$detail[3].'</td></tr>'."\r\n";
		   if(empty($detail[0]) || $detail[0]=='') break;  
		}
	}else{
		echo '<tr align=center class="firstalt"><td colspan=5>暂时还没有蜘蛛访问</td></tr>';
	}
}else{
		echo '<tr align=center class="firstalt"><td colspan=5>暂时还没有蜘蛛访问</td></tr>';
}
?></table></div></div><?php include "footer.php"; ?></body></html>