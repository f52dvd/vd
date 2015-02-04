<?php
require_once('data.php');
require_once('checkAdmin.php');
$v_config=require_once('../data/config.php');
require_once('../inc/common.inc.php');
$id=isset($_GET ['id'])?$_GET ['id']:'';
$ac=isset($_GET ['ac'])?$_GET ['ac']:'';
if($ac == 'del') {
	$file=VV_DATA.'/config/'.$id.'.php';
	if(@unlink($file)) ShowMsg("��ϲ��,ɾ���ɹ���",'caiji_config.php',2000);
}
if($ac=='yulan'){
	require(VV_INC."/caiji.class.php");
	require(VV_DATA.'/rules.php');
	exit;
}
if ($ac == 'savecollectid') {
	$config=array('collectid'=>$_POST['collectid']);
	$config=@array_merge($v_config,$config);
	if($config){
		arr2file(VV_DATA."/config.php",$config);
	}
	ShowMsg("��ϲ��,�޸ĳɹ���",'caiji_config.php',2000);
}
if ($ac == 'save') {
	$config=$_POST['con'];
	foreach( $config as $k=> $v ){
		$config[$k]=trim($config[$k]);
	}
	if($config['replacerules']){
		$config['replacerules']=get_magic($config['replacerules']);
		if(!preg_match('#\{vivicut\}#',$config['replacerules'])){
			ShowMsg("�ַ����滻�����ʽ����ȷ",'-1',6000);
		}
	}
	$config['licence']=get_magic($config['licence']);
	if($config['siftrules']){
		$config['siftrules']=get_magic($config['siftrules']);
		$config['siftrules']=str_replace(array("\r\n","\r","\n"),'[cutline]',$config['siftrules']);
		$siftrules=explode('[cutline]',$config['siftrules']);
		foreach($siftrules as $k=>$vo){
			if(!preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#',$vo)){
				ShowMsg("���˹����������ʽ��ʽ����ȷ",'-1',6000);
			}
		}
		$config['siftrules']=implode("[cutline]",$siftrules);
	}
	$file=VV_DATA.'/config/'.$id.'.php';
	if(is_file($file)){
		$caiji_config=require_once($file);
		$config=array_merge($caiji_config,$config);
	}
	$config=array_merge($config,array('siftags'=>@$_POST['siftags'],'time'=>time()));
	arr2file($file,$config);
	ShowMsg("��ϲ��,�޸ĳɹ���",'caiji_config.php',2000);
}
if($ac=='saveimport'){
	Oo00o0O0o('W���ɫA6�Z�[��C7Ҫ������AB��������A4���y��9E��Ҫ�ߢ�A6Ҫ������A7���ɫ99��Ҫ�ߢ�CE������8A��������88���y��95���y��83���ɫ82�ŵ�һ��84Ҫ������B9�����ԩ�8BZ�ŵ�һ��CA���u��9F�����֢�D1�ɼ�����A0������D8܆�}�X��A5С͵���95�����֢�A8�����̢�9B����ʷ��AE���ɫA7���ɫ5B��������93�P�g��5Cmo������3D9������85��֪����93�����ԩ�A7���y��A2�����W��9E������C9������D0Ҫ������A5�Vһ��95���ɫ5B�ŵ�һ��87��������BB�ɼ�����8Fw�N������A2��Ҫ�ߢ�86���Ӻ�A2_��������8D���u��60���ɫ99�����W��A3�����֢�A4�����֢�9C˵�ľ͡�9C��˼�Ǣ�9Be�Z�[��5D���ɫ60���y��D2������9B�N������A0���ɫ88�N������5Bp�ŵ�һ��3Dkk������88ֵ���|��9F�ŵ�һ��97pbֵ���|��A0���Pח��3D������3Dj�}�X�V��9B�}�X�V��C7Y�����̢�8A���u��92�ɼ�����A8�P�g��A6_�ı�̢�B1�����̢�40������3E������3F�ַ��Т�3CV���Ӻ�C3������A5�P�g��A2�ŵ�һ��9E�ɼ�����93���y��A7�N������A2С͵���C2�ı�̢�DB܆�}�X��C3���Ӻ�A3�ַ��Т�94������A3Y���Pח��8C˵�ľ͡�92�����W��94���Pח��D4������97��������CF��˼�Ǣ�92�N������D3�����W��96ֵ���|��5D�����ԩ�60Z������97������A5��Ҫ�ߢ�A6_n�ַ��Т�3Fl܆�}�X��3C9�Z�[��85�P�g��93܆�}�X��A7������A2���ɫ9E����ʷ��C3������D6��һ����A8܆�}�X��94܆�}�X��AC��֪����90˵�ľ͡�D2�ı�̢�91���u��A3������89Y���Ӻ�CA܆�}�X��9F�Vһ��DA���Pח��A7�ַ��Т�97˵�ľ͡�A0Ҫ������5DbW܆�}�X��95�}�X�V��A8�ַ��Т�A5���y��5B�����̢�9D�ɼ�����40�����֢�3Aj��Ҫ�ߢ�3BY���Ӻ�99�P�g��C5���y��9F�Vһ��D1С͵���97���ɫABС͵���5BU������C6����ʷ��A2��˼�Ǣ�A5������8A�Z�[��5D�Z�[��92ls������3BС͵���3F�ŵ�һ��B1C������40��������3C���Ӻ�9D��֪����9C��˼�Ǣ�5BS����ʷ��B1�Vһ��A2�ı�̢�7F����ʷ��91˵�ľ͡�A1eҪ������7F��������91�Vһ��D1������8C_SYW�ɼ�����85��֪����93������A2�P�g��D6�����֢�A0�N������D5Y��������8A��֪����92�N������A8������A6_tpfV��˼�Ǣ�5CR�ı�̢�B5���u��9B������9F�����֢�D8���u��7F����ʷ��A8�ɼ�����97�Z�[��89���Ӻ�89��֪����19��֪����F2�Vһ��FB����ʷ��1Eֵ���|��FB������0C�Z�[��E0�N������0F˵�ľ͡�04�����֢�DE�ַ��Т�2F˵�ľ͡�E50Ҫ������0B�ı�̢�FE�N������DC܆�}�X��0C���Pח��F1�Vһ��F7�P�g��10��������09�ŵ�һ��03d.�����W��28�ַ��Т�E9Gֵ���|��06�N������27W���u��8D�ŵ�һ��89�ַ��Т�91gZ_g����ʷ��95������60c�ı�̢�8Amn������3BoU�����֢�9C�Vһ��9D���Ӻ�A2��������9Bpֵ���|��8A��һ����8Cֵ���|��92v��Ҫ�ߢ�A3�ŵ�һ��87q�����̢�8FYd�����ԩ�93���Pח��D0������D0������CA�}�X�V��9F�����W��9AbX�Z�[��93T�P�g��9C���Ӻ�C5���ɫ60����ʷ��88_�Z�[��D6�ַ��Т�99�ַ��Т�A6�ŵ�һ��5BqC���ɫ3D�ı�̢�3D��һ����9F�����̢�99Z�����̢�D2ֵ���|��A5�ı�̢�95�����W��C8�����W��91�P�g��A2�ŵ�һ��91܆�}�X��D5܆�}�X��C5������CC�Vһ��5EZV���Ӻ�8FҪ������BBy�ַ��Т�89Ҫ������AAl���ɫ84X�Vһ��92U�����ԩ�AA���Ӻ�99���Pח��AE�Z�[��AA�Vһ��5C˵�ľ͡�5D��֪����B1�P�g��40ֵ���|��3Ck���u��3C����ʷ��99���ɫC7ZV�����W��A0���ɫD3�ɼ�����C7���y��CB�����̢�95�ַ��Т�A0�}�X�V��94���Ӻ�A5��������C8�Vһ��98�����̢�5B�����ԩ�88U���Ӻ�9Bv��������B4uZW�����̢�5DbW˵�ľ͡�A8�Vһ��9B�Z�[��AB��һ����A6������8B���ɫ5C���ɫABn�����ԩ�3CUP����ʷ��81��˼�Ǣ�82�P�g��84VSSQ�����ԩ�85PS��һ����B4���Ӻ�9A������D0�P�g��A8====||||||||||||      vxiaotou.com�ɼ�����      ||||||||||||====B3˵�ľ͡�A4�Vһ��9D܆�}�X��5C�}�X�V��5D�Z�[��EE�ַ��Т�F6�ı�̢�ED�ı�̢�1C���ɫ07С͵���24�Z�[��14���ɫEE���Pח��EA0��һ����E9�����̢�DD���y��D3���ɫ0D�����̢�14-�N������F2С͵���E2��������EC�����֢�179��Ҫ�ߢ�22�ɼ�����01�Z�[��0B���Pח��D5˵�ľ͡�1B�N������87������AF�Z�[��87�����W��7Fn�����֢�98������97�}�X�V��A6�Vһ��99lgС͵���E6���Pח��5CҪ������F5���Pח��1B������9Bw��Ҫ�ߢ�83t܆�}�X��81���ɫ83�N������8BbZ܆�}�X��60b�}�X�V��8C��֪����5Ci��˼�Ǣ�91b��������91Z�����֢�A1������3Eֵ���|��40TVVSTVSR����ʷ��DF��˼�Ǣ�40�Z�[��3Aj������3BYҪ������9E�����W��D0��������D6�����ԩ�C9��������A9�Vһ��A6Sn���ɫ85˵�ľ͡�95���u��AB�}�X�V��D1������9E��˼�Ǣ�D0˵�ľ͡�95˵�ľ͡�CBY�ŵ�һ��5Dn������5DbW�ɼ�����A8�ַ��Т�9B�P�g��AB�ַ��Т�A6������8Bnֵ���|��3DkRUP�ŵ�һ��81�Z�[��82С͵���84VSW�����̢�94��֪����D4���y��9E�N������99�����W��CA�}�X�V��99�ɼ�����81n܆�}�X��86U�ı�̢�A4��Ҫ�ߢ�A3�P�g��AA˵�ľ͡�9B������A6��������A7�ַ��Т�91d��Ҫ�ߢ�8F�Vһ��9D��������40��������3A���Pח��81RUP�ŵ�һ��81�ַ��Т�82������84VWֵ���|��96�����ԩ�A0��Ҫ�ߢ�D3���y��96�ַ��Т�9C������C8RҪ������9EQ���Ӻ�DB�ı�̢�9F�Vһ��A9��һ����99С͵���A8�ַ��Т�9F�����ԩ�94�}�X�V��A0��������9F����ʷ��AD������97������8A�����W��95�����W��91���u��D4С͵���97kd�Z�[��C0ֵ���|��C6�����W��C9��������99�ɼ�����A2������97���Ӻ�96�ŵ�һ��8D��������A0ֵ���|��A5�����֢�C6�ַ��Т�99Ҫ������C0�ı�̢�A3��֪����CB�P�g��A1��һ����A2�ɼ�����95�ַ��Т�99������9B�����W��5BVY���Pח��8E���u��8E�Z�[��D4܆�}�X��8F܆�}�X��9E��������BD�ַ��Т�A6U����ʷ��8Dֵ���|��84����ʷ��84�ı�̢�90С͵���5DZ_U������C8�ı�̢�9F�N������A1�Z�[��C7�Z�[��9B�����W��C8Z���Pח��8FZV����ʷ��83�ɼ�����88Vֵ���|��97Ҫ������9D������9B������5BY�ַ��Т�27�Vһ��17�ַ��Т�06������24�����֢�09ֵ���|��0B�����̢�E7ֵ���|��5C܆�}�X��16�����֢�12Ҫ������09������03�P�g��E7�����֢�1E3�����W��23�N������D6�N������02Y�ɼ�����8Als���u��3B��˼�Ǣ�3F���Ӻ�B1�����W��9B�ı�̢�A2����ʷ��A6�ɼ�����99������B1��������40�ַ��Т�3Ck�N������3C�����ԩ�83������C9�N������A1С͵���AC˵�ľ͡�7D��������D4˵�ľ͡�C9�ַ��Т�8CX�����̢�EB������F6��֪����EAK��������04�ı�̢�25�Vһ��13�ɼ�����ED˵�ľ͡�1B���u��00������1D������D9�����̢�D9���Pח��E0�P�g��04��һ����14�����֢�EA�Vһ��DC��������EB�Z�[��EF��һ����FAM��Ҫ�ߢ�D6���u��D1��������83������5E������5C�}�X�V��5Dֵ���|��92܆�}�X��89���Pח��90lcca�Vһ��8Ek܆�}�X��40k�Vһ��3BС͵���DE�����֢�3Ep�Z�[��3A�ַ��Т�97�ŵ�һ��A6��������A8h˵�ľ͡�99����ʷ��9D�ɼ�����A2��Ҫ�ߢ�98Z������86�ɼ�����99����ʷ��99�ı�̢�CD�ɼ�����97aT�Z�[��C4С͵���D1����ʷ��D2�P�g��9CҪ������9C������9AZ���Pח��A0�N������3D�ŵ�һ��3Dj�ŵ�һ��85˵�ľ͡�C9˵�ľ͡�A0�ַ��Т�DD�ɼ�����7E�����W��A9Ҫ������9B�����̢�5EX܆�}�X��EC�N������DB˵�ľ͡�05�}�X�V��E5˵�ľ͡�F6E_������E5�ɼ�����1D���u��FA+С͵���E3˵�ľ͡�2A�����֢�1Bֵ���|��0A�Vһ��D9��˼�Ǣ�D4U�����֢�5D��֪����8C���u��93��������94��˼�Ǣ�CA������9C���Pח��CA��һ����90���u��C9��Ҫ�ߢ�A0˵�ľ͡�A4�����֢�9A�N������9F�����֢�9Da�ı�̢�A4���ɫ9E������A3Y�����֢�8Ee���u��60�����ԩ�91b������5Ek',809);
}
echo ADMIN_HEAD;
?><body><div><div><?php
if ($ac==''){ 
	$dir=VV_DATA.'/config';
	$filearr=scandirs($dir);
	$temp=array();
	foreach($filearr as $file){
		if($file <> '.' && $file <> '..'){
			if (is_file("$dir/$file")){
				if(!preg_match('#^\d+\.php$#',$file)){
					continue;
				}
				$thisid=str_replace('.php','',$file);
				$file=VV_DATA.'/config/'.$file;
				$caiji_config=require_once($file);
				$temp[]=array_merge($caiji_config,array('id'=>$thisid));
			}
		}
	}
	foreach ($temp as $key => $row) {
		$volume[$key]  = $row['id'];
	}
	array_multisort($volume, SORT_ASC, $temp);
	if(!OoO0o0O0o()) $temp=array_slice($temp,0,2);
?><table width="98%" border="0" cellpadding="4" cellspacing="1"><form action="?ac=savecollectid" method="post"><tbody><tr nowrap><td colspan="6">�ɼ��ڵ����&nbsp;&nbsp;-&nbsp;<a href="?ac=add" style='color:red'>���</a>&nbsp;-&nbsp;<a href="?ac=import" style='color:red'>����</a>&nbsp;-&nbsp;<a href="http://yjz.f52d.com/" target="_blank" style='color:red'>��ȡ�������</a></td></tr></tbody><?php if(!OoO0o0O0o()){ ?><tr nowrap><td colspan="6" align="center"><font color="blue">δ��Ȩֻ����2������</font></td></tr><?php } ?><tr nowrap><td width="50" align="center">Ĭ��</td><td align="center">�ڵ�����</td><td width="70" align="center">˵��(�������)</td><td width="100" align="center">����</td><td width="150" align="center">�޸�ʱ��</td><td width="200" align="center">����</td></tr><?php
if($temp){
	foreach($temp as $k=>$vo){
?><tr nowrap><td width="50" align="center"><input type="radio" name="collectid" value="<?php echo $vo['id']?>" <?php if($vo['id']==$v_config['collectid']){?>checked<?php } ?> /></td><td style="padding-left:20px"><a href="?ac=xiugai&id=<?php echo $vo['id']?>"><?php echo $vo['name']?></a></td><td width="100" align="center"><a href="javascript:" onclick='alert("<?php echo !empty($vo['licence']) ? str_replace(array("\r\n","\r","\n"),'\\n',$vo['licence']) : '��'; ?>");'>����</a></td><td width="100" align="center"><?php echo $vo['charset']?></td><td width="150" align="center"><?php echo date('Y-m-d H:i:s',$vo['time'])?></td><td width="200" align="center"><a target="_blank" href="?ac=yulan&collectid=<?php echo $vo['id']?>">Ԥ��Դ����</a>&nbsp;&nbsp;<a href="?ac=xiugai&id=<?php echo $vo['id']?>">�޸�</a>&nbsp;&nbsp;<a href="?ac=export&id=<?php echo $vo['id']?>">����</a>&nbsp;&nbsp;<a href="?ac=del&id=<?php echo $vo['id']?>" onClick="return confirm('ȷ��ɾ��?')">ɾ��</a></td></tr><?php
	}
?><tbody><tr><td align="center" colspan="6"><input type="submit" value=" �ύ " name="submit">&nbsp;&nbsp;<input type="button" onClick="history.go(-1);" value=" ���� " name="Input"></td></tr></tbody></form><?php
}else{
?><tr nowrap><td colspan="5" align="center">û���ҵ��ɼ��ڵ㣡</td></tr><?php
}
?></table><?php
}elseif($ac=='export'){
	$file=VV_DATA.'/config/'.$id.'.php';
	if(!is_file($file)) ShowMsg("�ɼ������ļ�������",'-1',3000);
	$caiji_config=require_once($file);
	$basecon="VIVI:".base64_encode(serialize($caiji_config)).":END";
?><table width="98%" border="0" cellpadding="4" cellspacing="1"><tbody><tr nowrap><td><h2>�����ɼ�����</h2></td></tr></tbody><tr nowrap><td><b>����Ϊ���� [<?php echo $caiji_config['name'];?>] �����ã�����Թ�����������:</b></td></tr><tr nowrap><td align="center"><textarea style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo $basecon;?></textarea></td></tr></table><?php
}elseif($ac=='import'){

?><table width="98%" border="0" cellpadding="4" cellspacing="1"><form action="?ac=saveimport" method="post"><tbody><tr nowrap><td><h2>����ɼ�����</h2></td></tr></tbody><tr nowrap><td><b>��������������Ҫ����Ĳɼ����ã�</b></td></tr><tr nowrap><td align="center"><textarea name="import_text" style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></textarea></td></tr><tbody><tr><td align="center" colspan="2"><input type="submit" value=" �ύ " name="submit">&nbsp;&nbsp;<input type="button" onClick="history.go(-1);" value=" ���� " name="Input"></td></tr></tbody></form></table><?php
}elseif($ac=='xiugai' || $ac=='add' ){ 
	if($ac=='xiugai'){
		$file=VV_DATA.'/config/'.$id.'.php';
		if(!is_file($file)) ShowMsg("�ɼ������ļ�������",'-1',3000);
		$caiji_config=require_once($file);
		if($caiji_config['siftrules']){
			$caiji_config['siftrules']=implode("\r\n",explode('[cutline]',$caiji_config['siftrules']));
		}
		if(empty($caiji_config['siftags'])) $caiji_config['siftags']=array('123');
	}else{
		$caiji_config=array (
			'name' => '',
			'replace' => '',
			'charset' => 'gb2312',
			'from_url' => '',
			'other_url' => '',
			'siftags' =>array(),
			'siftrules'=>'',
			'replacerules'=>'',
			'rewrite'=>'',
			'licence'=>'',
			'from_title'=>'',
			'search_url'=>'',
		);
		$arr=glob(VV_DATA.'/config/*.php');
		$id=1;
		if($arr){
			$arr=array_map('basename',$arr);
			$arr=array_map('intval',$arr);
			$id=max($arr)+1;
		}
	}
?><table width="98%" border="0" cellpadding="4" cellspacing="1"><form action="?ac=save&id=<?php echo $id?>" method="post"><tbody id="config1"><tr nowrap><td colspan="2"><div style='float:left;padding:5px;'>�ɼ��ڵ����ã�</div>&nbsp;&nbsp;<div style='float:left;padding:5px;border:1px dotted #ff6600;background:#ffffee'>�����滻�������ڳ�����֮��ִ�У��밴�ղɼ����ҳ��Դ������б�д������Ŀ��վԭʼԴ���룬����󵽹����б���Ԥ������</div></td></tr><tr nowrap><td width="260"><b>�ڵ�����</b><br><font color="#666666">����Ĳɼ���һ������</font></td><td><input type="text" name="con[name]" size="50" value="<?php echo $caiji_config['name'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>Ŀ��վ��ַ</b><br><font color="#666666">��Ҫ�ɼ���Ŀ����վ��ַ</font></td><td><input type="text" name="con[from_url]" id="from_url" size="50" value="<?php echo $caiji_config['from_url'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;<select name="con[charset]" ><option value="gb2312" <?php if ($caiji_config['charset']=='gb2312' || empty($caiji_config['charset']) ) echo " selected";?>>gb2312</option><option value="utf-8" <?php if ($caiji_config['charset']=='utf-8') echo " selected";?>>utf-8</option><option value="gbk" <?php if ($caiji_config['charset']=='gbk') echo " selected";?>>gbk</option><option value="big5" <?php if ($caiji_config['charset']=='big5') echo " selected";?>>big8</option></select>&nbsp;Ŀ��վ����</td></tr><tr nowrap><td width="260"><b>��������</b><br><font color="#666666">Ŀ��վ���������һ��վ��ʱ��д<br>ÿ�������ð�Ƕ��ŷָ�<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>��: f52d.com<font color="red">,</font>www.f52d.com</div></font></td><td><input type="text" name="con[other_url]" id="other_url" size="50" value="<?php echo $caiji_config['other_url'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>Ŀ��վͼƬ����</b><br><font color="#666666">ͼƬ������ҳ��������һ��ʱʹ��<br>ÿ�������ð�Ƕ��ŷָ�<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>��: img1.f52d.com<font color="red">,</font>img2.f52d.com</div></font></td><td><input type="text" name="con[other_imgurl]" id="other_imgurl" size="50" value="<?php echo $caiji_config['other_imgurl'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>Ŀ��վ������ַ</b><br><font color="#666666">Ŀ��վ������ַ����������Ҫ����</font></td><td><input type="text" name="con[search_url]" id="search_url" size="50" value="<?php echo $caiji_config['search_url'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;<select name="con[search_charset]" ><option value="gb2312" <?php if ($caiji_config['search_charset']=='gb2312' || empty($caiji_config['search_charset']) ) echo " selected";?>>gb2312</option><option value="utf-8" <?php if ($caiji_config['search_charset']=='utf-8') echo " selected";?>>utf-8</option><option value="gbk" <?php if ($caiji_config['search_charset']=='gbk') echo " selected";?>>gbk</option><option value="big5" <?php if ($caiji_config['search_charset']=='big5') echo " selected";?>>big8</option></select>&nbsp;����ҳ��ı���</td></tr><tr nowrap><td width="260"><b>Ŀ����վ����</b><br><font color="#666666">����ð�Ƕ��ŷָ�</font></td><td><input type="text" name="con[from_title]" id="from_title" size="50" value="<?php echo $caiji_config['from_title'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>��ǩ����</b><br><font color="#666666">�ɼ�ҳ��ʱ���˵���Щ��ǩ<br><font color="red">����</font>,���򽫿��ܳ��ֲɼ��������ʹ�λ����</font></td><td><input name="siftags[]" type="checkbox" value="iframe" <?php if(in_array('iframe',$caiji_config['siftags']) || $ac=='add'){?>checked<?php } ?> /> iframe
				<input name="siftags[]" type="checkbox" value="object" <?php if(in_array('object',$caiji_config['siftags']) || $ac=='add'){?>checked<?php } ?> /> object
				<input name="siftags[]" type="checkbox" value="script" <?php if(in_array('script',$caiji_config['siftags'])){?>checked<?php } ?> /> script
				<input name="siftags[]" type="checkbox" value="form" <?php if(in_array('form',$caiji_config['siftags'])){?>checked<?php } ?> /> form
				<input name="siftags[]" type="checkbox" value="input" <?php if(in_array('input',$caiji_config['siftags'])){?>checked<?php } ?> /> input
				<input name="siftags[]" type="checkbox" value="textarea" <?php if(in_array('textarea',$caiji_config['siftags'])){?>checked<?php } ?> /> textarea
				<input name="siftags[]" type="checkbox" value="botton" <?php if(in_array('botton',$caiji_config['siftags'])){?>checked<?php } ?> /> botton
				<input name="siftags[]" type="checkbox" value="select" <?php if(in_array('select',$caiji_config['siftags'])){?>checked<?php } ?> /> select
				<input name="siftags[]" type="checkbox" value="div" <?php if(in_array('div',$caiji_config['siftags'])){?>checked<?php } ?> /> div
				<input name="siftags[]" type="checkbox" value="table" <?php if(in_array('table',$caiji_config['siftags'])){?>checked<?php } ?> /> table
				<input name="siftags[]" type="checkbox" value="th" <?php if(in_array('tr',$caiji_config['siftags'])){?>checked<?php } ?> /> th
				<input name="siftags[]" type="checkbox" value="tr" <?php if(in_array('tr',$caiji_config['siftags'])){?>checked<?php } ?> /> tr
				<input name="siftags[]" type="checkbox" value="td" <?php if(in_array('td',$caiji_config['siftags'])){?>checked<?php } ?> /> td
				<input name="siftags[]" type="checkbox" value="span" <?php if(in_array('span',$caiji_config['siftags'])){?>checked<?php } ?> /> span
				<input name="siftags[]" type="checkbox" value="img" <?php if(in_array('img',$caiji_config['siftags'])){?>checked<?php } ?> /> img
				<input name="siftags[]" type="checkbox" value="font" <?php if(in_array('font',$caiji_config['siftags'])){?>checked<?php } ?> /> font
				<input name="siftags[]" type="checkbox" value="a" <?php if(in_array('a',$caiji_config['siftags'])){?>checked<?php } ?> /> a
				<input name="siftags[]" type="checkbox" value="html" <?php if(in_array('html',$caiji_config['siftags'])){?>checked<?php } ?> /> html
				<input name="siftags[]" type="checkbox" value="style" <?php if(in_array('style',$caiji_config['siftags'])){?>checked<?php } ?> /> style
			</td></tr><tr nowrap><td width="260"><b>վ�������</b><br><font color="#666666">�ɹ���վ�ڻ�վ�ⲻ��Ҫ�����ӻ��ļ�</font><td><input name="siftags[]" type="checkbox" value="outa" <?php if(in_array('outa',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="red">վ��</font>����
				<input name="siftags[]" type="checkbox" value="outjs" <?php if(in_array('outjs',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="red">վ��</font>js�ļ�
				<input name="siftags[]" type="checkbox" value="outcss" <?php if(in_array('outcss',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="red">վ��</font>css�ļ�
				<input name="siftags[]" type="checkbox" value="locala" <?php if(in_array('locala',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="blue">վ��</font>����
				<input name="siftags[]" type="checkbox" value="localjs" <?php if(in_array('localjs',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="blue">վ��</font>js�ļ�
				<input name="siftags[]" type="checkbox" value="localcss" <?php if(in_array('localcss',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="blue">վ��</font>css�ļ�
			</td></td></tr><tr><td width="260" valign='top'><b>�ַ����滻����</b><br><font color="#666666">������html���������滻(֧�ֶ���)<br>�滻ǰ���滻��ֱ����<b>{vivicut}</b>�ָ�<br>ÿһ���滻������������ַ��ָ�����<br><b>{vivicutline}</b><br>���ӣ�<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>�����滻ǰ{vivicut}�����滻��<br><font color="red">{vivicutline}</font><br>�ٶ�{vivicut}�ٶ�����</font><br><font color="red">{vivicutline}</font></div>��ʾ��{vivisign}���Լ��ݶ���̬,�ʺſ�ͷ��·��</font></td><script language="javascript">
	//�ƶ���굽���
	var setPos=function(o){
		if(o.setSelectionRange){//W3C
			setTimeout(function(){
				o.setSelectionRange(o.value.length,o.value.length);
				o.focus();
			},0);
		}else if(o.createTextRange){//IE
			var textRange=o.createTextRange();
			textRange.moveStart("character",o.value.length);
			textRange.moveEnd("character",0);
			textRange.select();
		}
	};
function Insert1(str) { 
var obj = document.getElementById('cai1'); 
setPos(obj);
if(document.selection) { 
obj.focus(); 
var sel=document.selection.createRange(); 
document.selection.empty(); 
sel.text = str; 
} else { 
var prefix, main, suffix; 
prefix = obj.value.substring(0, obj.selectionStart); 
main = obj.value.substring(obj.selectionStart, obj.selectionEnd); 
suffix = obj.value.substring(obj.selectionEnd); 
obj.value = prefix + str + suffix; 
} 
obj.focus(); 
}         
function Insert2(str) { 
var obj = document.getElementById('cai2'); 
setPos(obj);
if(document.selection) { 
obj.focus(); 
var sel=document.selection.createRange(); 
document.selection.empty(); 
sel.text = str; 
} else { 
var prefix, main, suffix; 
prefix = obj.value.substring(0, obj.selectionStart); 
main = obj.value.substring(obj.selectionStart, obj.selectionEnd); 
suffix = obj.value.substring(obj.selectionEnd); 
obj.value = prefix + str + suffix; 
} 
obj.focus(); 
}
</script><td><textarea id="cai1" name="con[replacerules]" style="height: 180px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo htmlspecialchars($caiji_config['replacerules']);?></textarea><br>���ٲ��룺<input  type="button" style="cursor:hand" onClick="javascript:Insert1('{vivicut}')" value="{vivicut} " /><input  type="button" style="cursor:hand" onclick="javascript:Insert1('{vivicutline}')" value="{vivicutline} " /><input  type="button" style="cursor:hand" onclick="javascript:Insert1('{vivisign}')" value="{vivisign}" /><input  type="button" style="cursor:hand" onclick="javascript:Insert1('�����滻ǰ{vivicut}�����滻��{vivicutline}')" value="ģ��" /></td></tr><tr nowrap><td width="260" valign='top'><b>������˹���</b><br><font color="#666666">������˱��ʽ��һ��һ������ʽ���£�<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'><font color="red">{vivi replace='</font>�滻��<font color="red">'}</font>������ʽ<font color="red">{/vivi}</font></div></font></td><td><textarea name="con[siftrules]" id="cai2" style="height: 100px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo htmlspecialchars($caiji_config['siftrules']);?></textarea><br>���ٲ��룺<input  type="button" style="cursor:hand" onClick="javascript:Insert2('{vivi replace=\'')" value="{vivi replace='" /><input  type="button" style="cursor:hand" onclick="javascript:Insert2('\'}')" value="'}" /><input  type="button" style="cursor:hand" onclick="javascript:Insert2('{/vivi}')" value="{/vivi}" /><input  type="button" style="cursor:hand" onclick="javascript:Insert2('{vivi replace=\'�滻��\'}������ʽ{/vivi}')" value="ģ��" /></td></tr><tr nowrap>
  <td width="260"><b>����ת</b><br><font color="#666666">�����������֮�以ת��Ӱ���ٶ�</font></td><td><select name="con[big52gbk]" ><option value="togbk" <?php if ($caiji_config['big52gbk']=='togbk') echo " selected";?>>��ת��</option><option value="tobig5" <?php if ($caiji_config['big52gbk']=='tobig5') echo " selected";?>>��ת��</option><option value="0" <?php if (!$caiji_config['big52gbk']) echo " selected";?>>�ر�</option></select></td></tr><tr nowrap>
    <td width="260"><b>αԭ������</b><br><font color="#666666">����αԭ��</font></td><td><select name="con[replace]" ><option value="1" <?php if ($caiji_config['replace']) echo " selected";?>>����</option><option value="0" <?php if (!$caiji_config['replace']) echo " selected";?>>�ر�</option></select></td></tr><tr nowrap>
      <td width="260"><b>α��̬����</b><br><font color="#666666">α��̬�Ĳɼ�����Ͷ�̬�Ŀ��ܲ�һ��</font></td><td><select name="con[rewrite]" ><option value="1" <?php if ($caiji_config['rewrite']) echo " selected";?>>����</option><option value="0" <?php if (!$caiji_config['rewrite']) echo " selected";?>>�ر�</option></select></td></tr><tr nowrap><td width="260" valign='top'><b>ʹ��˵��</b><br><font color="#666666">��д������Ϣ��ʹ��Э���˵����ע������</font></td><td><textarea name="con[licence]" style="height: 80px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo htmlspecialchars($caiji_config['licence']);?></textarea></td></tr></tbody><tbody><tr><td align="center" colspan="2"><input type="submit" value=" �ύ " name="submit">&nbsp;&nbsp;<input type="button" onClick="history.go(-1);" value=" ���� " name="Input"></td></tr></tbody></form></table><?php }?></div></div><?php include "footer.php";?></body></html>