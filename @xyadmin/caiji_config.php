<?php
require_once('data.php');
require_once('checkAdmin.php');
$v_config=require_once('../data/config.php');
require_once('../inc/common.inc.php');
$id=isset($_GET ['id'])?$_GET ['id']:'';
$ac=isset($_GET ['ac'])?$_GET ['ac']:'';
if($ac == 'del') {
	$file=VV_DATA.'/config/'.$id.'.php';
	if(@unlink($file)) ShowMsg("恭喜你,删除成功！",'caiji_config.php',2000);
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
	ShowMsg("恭喜你,修改成功！",'caiji_config.php',2000);
}
if ($ac == 'save') {
	$config=$_POST['con'];
	foreach( $config as $k=> $v ){
		$config[$k]=trim($config[$k]);
	}
	if($config['replacerules']){
		$config['replacerules']=get_magic($config['replacerules']);
		if(!preg_match('#\{vivicut\}#',$config['replacerules'])){
			ShowMsg("字符串替换规则格式不正确",'-1',6000);
		}
	}
	$config['licence']=get_magic($config['licence']);
	if($config['siftrules']){
		$config['siftrules']=get_magic($config['siftrules']);
		$config['siftrules']=str_replace(array("\r\n","\r","\n"),'[cutline]',$config['siftrules']);
		$siftrules=explode('[cutline]',$config['siftrules']);
		foreach($siftrules as $k=>$vo){
			if(!preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#',$vo)){
				ShowMsg("过滤规则的正则表达式格式不正确",'-1',6000);
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
	ShowMsg("恭喜你,修改成功！",'caiji_config.php',2000);
}
if($ac=='saveimport'){
	Oo00o0O0o('W最出色A6鸝鸞垿C7要爨厵「AB灥在音㈩A4字飝〈9E比要高③A6要爨厵「A7最出色99比要高③CE语言名8A灥在音㈩88字飝〈95字飝〈83最出色82放到一「84要爨厵「B9都来自﹢8BZ放到一「CA能黸半9F的名字ⅸD1采集鱻﹃A0语言名D8軉纝蠿㈢A5小偷万㈩95的名字ⅸA8个音程⑦9B是有史㈣AE最出色A7最出色5B灥在音㈩93驪靏百5Cmo语言名3D9。于是85度知道Ⅶ93都来自﹢A7字飝〈A2语言鸚⑨9E语言名C9语言名D0要爨厵「A5豓一起ⅷ95最出色5B放到一「87于以来〉BB采集鱻﹃8Fw驨囖两〈A2比要高③86个加号A2_于以来〉8D能黸半60最出色99语言鸚⑨A3的名字ⅸA4的名字ⅸ9C说的就〈9C意思是Ⅳ9Be鸝鸞垿5D最出色60字飝〈D2语言名9B驨囖两〈A0最出色88驨囖两〈5Bp放到一「3Dkk语言名88值加纜﹁9F放到一「97pb值加纜﹁A0，齈讞㈧3D。于是3Dj纝蠿蠽」9B纝蠿蠽」C7Y个音程⑦8A能黸半92采集鱻﹃A8驪靏百A6_的编程㈠B1个音程⑦40语言名3E现在我3F乐符中㈨3CV个加号C3。于是A5驪靏百A2放到一「9E采集鱻﹃93字飝〈A7驨囖两〈A2小偷万㈩C2的编程㈠DB軉纝蠿㈢C3个加号A3乐符中㈨94。于是A3Y，齈讞㈧8C说的就〈92语言鸚⑨94，齈讞㈧D4语言名97灥在音㈩CF意思是Ⅳ92驨囖两〈D3语言鸚⑨96值加纜﹁5D都来自﹢60Z语言名97。于是A5比要高③A6_n乐符中㈨3Fl軉纝蠿㈢3C9鸝鸞垿85驪靏百93軉纝蠿㈢A7语言名A2最出色9E是有史㈣C3语言名D6把一个ⅰA8軉纝蠿㈢94軉纝蠿㈢AC度知道Ⅶ90说的就〈D2的编程㈠91能黸半A3语言名89Y个加号CA軉纝蠿㈢9F豓一起ⅷDA，齈讞㈧A7乐符中㈨97说的就〈A0要爨厵「5DbW軉纝蠿㈢95纝蠿蠽」A8乐符中㈨A5字飝〈5B个音程⑦9D采集鱻﹃40的名字ⅸ3Aj比要高③3BY个加号99驪靏百C5字飝〈9F豓一起ⅷD1小偷万㈩97最出色AB小偷万㈩5BU语言名C6是有史㈣A2意思是ⅣA5语言名8A鸝鸞垿5D鸝鸞垿92ls现在我3B小偷万㈩3F放到一「B1C现在我40灥在音㈩3C个加号9D度知道Ⅶ9C意思是Ⅳ5BS是有史㈣B1豓一起ⅷA2的编程㈠7F是有史㈣91说的就〈A1e要爨厵「7F灥在音㈩91豓一起ⅷD1。于是8C_SYW采集鱻﹃85度知道Ⅶ93语言名A2驪靏百D6的名字ⅸA0驨囖两〈D5Y灥在音㈩8A度知道Ⅶ92驨囖两〈A8语言名A6_tpfV意思是Ⅳ5CR的编程㈠B5能黸半9B语言名9F的名字ⅸD8能黸半7F是有史㈣A8采集鱻﹃97鸝鸞垿89个加号89度知道Ⅶ19度知道ⅦF2豓一起ⅷFB是有史㈣1E值加纜﹁FB现在我0C鸝鸞垿E0驨囖两〈0F说的就〈04的名字ⅸDE乐符中㈨2F说的就〈E50要爨厵「0B的编程㈠FE驨囖两〈DC軉纝蠿㈢0C，齈讞㈧F1豓一起ⅷF7驪靏百10于以来〉09放到一「03d.语言鸚⑨28乐符中㈨E9G值加纜﹁06驨囖两〈27W能黸半8D放到一「89乐符中㈨91gZ_g是有史㈣95语言名60c的编程㈠8Amn。于是3BoU的名字ⅸ9C豓一起ⅷ9D个加号A2灥在音㈩9Bp值加纜﹁8A把一个ⅰ8C值加纜﹁92v比要高③A3放到一「87q个音程⑦8FYd都来自﹢93，齈讞㈧D0现在我D0现在我CA纝蠿蠽」9F语言鸚⑨9AbX鸝鸞垿93T驪靏百9C个加号C5最出色60是有史㈣88_鸝鸞垿D6乐符中㈨99乐符中㈨A6放到一「5BqC最出色3D的编程㈠3D把一个ⅰ9F个音程⑦99Z个音程⑦D2值加纜﹁A5的编程㈠95语言鸚⑨C8语言鸚⑨91驪靏百A2放到一「91軉纝蠿㈢D5軉纝蠿㈢C5现在我CC豓一起ⅷ5EZV个加号8F要爨厵「BBy乐符中㈨89要爨厵「AAl最出色84X豓一起ⅷ92U都来自﹢AA个加号99，齈讞㈧AE鸝鸞垿AA豓一起ⅷ5C说的就〈5D度知道ⅦB1驪靏百40值加纜﹁3Ck能黸半3C是有史㈣99最出色C7ZV语言鸚⑨A0最出色D3采集鱻﹃C7字飝〈CB个音程⑦95乐符中㈨A0纝蠿蠽」94个加号A5灥在音㈩C8豓一起ⅷ98个音程⑦5B都来自﹢88U个加号9Bv灥在音㈩B4uZW个音程⑦5DbW说的就〈A8豓一起ⅷ9B鸝鸞垿AB把一个ⅰA6。于是8B最出色5C最出色ABn都来自﹢3CUP是有史㈣81意思是Ⅳ82驪靏百84VSSQ都来自﹢85PS把一个ⅰB4个加号9A现在我D0驪靏百A8====||||||||||||      vxiaotou.com采集程序      ||||||||||||====B3说的就〈A4豓一起ⅷ9D軉纝蠿㈢5C纝蠿蠽」5D鸝鸞垿EE乐符中㈨F6的编程㈠ED的编程㈠1C最出色07小偷万㈩24鸝鸞垿14最出色EE，齈讞㈧EA0把一个ⅰE9个音程⑦DD字飝〈D3最出色0D个音程⑦14-驨囖两〈F2小偷万㈩E2灥在音㈩EC的名字ⅸ179比要高③22采集鱻﹃01鸝鸞垿0B，齈讞㈧D5说的就〈1B驨囖两〈87。于是AF鸝鸞垿87语言鸚⑨7Fn的名字ⅸ98现在我97纝蠿蠽」A6豓一起ⅷ99lg小偷万㈩E6，齈讞㈧5C要爨厵「F5，齈讞㈧1B现在我9Bw比要高③83t軉纝蠿㈢81最出色83驨囖两〈8BbZ軉纝蠿㈢60b纝蠿蠽」8C度知道Ⅶ5Ci意思是Ⅳ91b于以来〉91Z的名字ⅸA1现在我3E值加纜﹁40TVVSTVSR是有史㈣DF意思是Ⅳ40鸝鸞垿3Aj现在我3BY要爨厵「9E语言鸚⑨D0于以来〉D6都来自﹢C9灥在音㈩A9豓一起ⅷA6Sn最出色85说的就〈95能黸半AB纝蠿蠽」D1语言名9E意思是ⅣD0说的就〈95说的就〈CBY放到一「5Dn现在我5DbW采集鱻﹃A8乐符中㈨9B驪靏百AB乐符中㈨A6语言名8Bn值加纜﹁3DkRUP放到一「81鸝鸞垿82小偷万㈩84VSW个音程⑦94度知道ⅦD4字飝〈9E驨囖两〈99语言鸚⑨CA纝蠿蠽」99采集鱻﹃81n軉纝蠿㈢86U的编程㈠A4比要高③A3驪靏百AA说的就〈9B语言名A6于以来〉A7乐符中㈨91d比要高③8F豓一起ⅷ9D灥在音㈩40于以来〉3A，齈讞㈧81RUP放到一「81乐符中㈨82语言名84VW值加纜﹁96都来自﹢A0比要高③D3字飝〈96乐符中㈨9C。于是C8R要爨厵「9EQ个加号DB的编程㈠9F豓一起ⅷA9把一个ⅰ99小偷万㈩A8乐符中㈨9F都来自﹢94纝蠿蠽」A0于以来〉9F是有史㈣AD。于是97现在我8A语言鸚⑨95语言鸚⑨91能黸半D4小偷万㈩97kd鸝鸞垿C0值加纜﹁C6语言鸚⑨C9于以来〉99采集鱻﹃A2现在我97个加号96放到一「8D灥在音㈩A0值加纜﹁A5的名字ⅸC6乐符中㈨99要爨厵「C0的编程㈠A3度知道ⅦCB驪靏百A1把一个ⅰA2采集鱻﹃95乐符中㈨99。于是9B语言鸚⑨5BVY，齈讞㈧8E能黸半8E鸝鸞垿D4軉纝蠿㈢8F軉纝蠿㈢9E于以来〉BD乐符中㈨A6U是有史㈣8D值加纜﹁84是有史㈣84的编程㈠90小偷万㈩5DZ_U语言名C8的编程㈠9F驨囖两〈A1鸝鸞垿C7鸝鸞垿9B语言鸚⑨C8Z，齈讞㈧8FZV是有史㈣83采集鱻﹃88V值加纜﹁97要爨厵「9D现在我9B。于是5BY乐符中㈨27豓一起ⅷ17乐符中㈨06。于是24的名字ⅸ09值加纜﹁0B个音程⑦E7值加纜﹁5C軉纝蠿㈢16的名字ⅸ12要爨厵「09现在我03驪靏百E7的名字ⅸ1E3语言鸚⑨23驨囖两〈D6驨囖两〈02Y采集鱻﹃8Als能黸半3B意思是Ⅳ3F个加号B1语言鸚⑨9B的编程㈠A2是有史㈣A6采集鱻﹃99语言名B1于以来〉40乐符中㈨3Ck驨囖两〈3C都来自﹢83语言名C9驨囖两〈A1小偷万㈩AC说的就〈7D灥在音㈩D4说的就〈C9乐符中㈨8CX个音程⑦EB现在我F6度知道ⅦEAK灥在音㈩04的编程㈠25豓一起ⅷ13采集鱻﹃ED说的就〈1B能黸半00现在我1D。于是D9个音程⑦D9，齈讞㈧E0驪靏百04把一个ⅰ14的名字ⅸEA豓一起ⅷDC灥在音㈩EB鸝鸞垿EF把一个ⅰFAM比要高③D6能黸半D1于以来〉83语言名5E语言名5C纝蠿蠽」5D值加纜﹁92軉纝蠿㈢89，齈讞㈧90lcca豓一起ⅷ8Ek軉纝蠿㈢40k豓一起ⅷ3B小偷万㈩DE的名字ⅸ3Ep鸝鸞垿3A乐符中㈨97放到一「A6于以来〉A8h说的就〈99是有史㈣9D采集鱻﹃A2比要高③98Z语言名86采集鱻﹃99是有史㈣99的编程㈠CD采集鱻﹃97aT鸝鸞垿C4小偷万㈩D1是有史㈣D2驪靏百9C要爨厵「9C语言名9AZ，齈讞㈧A0驨囖两〈3D放到一「3Dj放到一「85说的就〈C9说的就〈A0乐符中㈨DD采集鱻﹃7E语言鸚⑨A9要爨厵「9B个音程⑦5EX軉纝蠿㈢EC驨囖两〈DB说的就〈05纝蠿蠽」E5说的就〈F6E_现在我E5采集鱻﹃1D能黸半FA+小偷万㈩E3说的就〈2A的名字ⅸ1B值加纜﹁0A豓一起ⅷD9意思是ⅣD4U的名字ⅸ5D度知道Ⅶ8C能黸半93于以来〉94意思是ⅣCA。于是9C，齈讞㈧CA把一个ⅰ90能黸半C9比要高③A0说的就〈A4的名字ⅸ9A驨囖两〈9F的名字ⅸ9Da的编程㈠A4最出色9E现在我A3Y的名字ⅸ8Ee能黸半60都来自﹢91b语言名5Ek',809);
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
?><table width="98%" border="0" cellpadding="4" cellspacing="1"><form action="?ac=savecollectid" method="post"><tbody><tr nowrap><td colspan="6">采集节点管理&nbsp;&nbsp;-&nbsp;<a href="?ac=add" style='color:red'>添加</a>&nbsp;-&nbsp;<a href="?ac=import" style='color:red'>导入</a>&nbsp;-&nbsp;<a href="http://yjz.f52d.com/" target="_blank" style='color:red'>获取更多规则</a></td></tr></tbody><?php if(!OoO0o0O0o()){ ?><tr nowrap><td colspan="6" align="center"><font color="blue">未授权只能有2条规则</font></td></tr><?php } ?><tr nowrap><td width="50" align="center">默认</td><td align="center">节点名称</td><td width="70" align="center">说明(点击↓↓)</td><td width="100" align="center">编码</td><td width="150" align="center">修改时间</td><td width="200" align="center">操作</td></tr><?php
if($temp){
	foreach($temp as $k=>$vo){
?><tr nowrap><td width="50" align="center"><input type="radio" name="collectid" value="<?php echo $vo['id']?>" <?php if($vo['id']==$v_config['collectid']){?>checked<?php } ?> /></td><td style="padding-left:20px"><a href="?ac=xiugai&id=<?php echo $vo['id']?>"><?php echo $vo['name']?></a></td><td width="100" align="center"><a href="javascript:" onclick='alert("<?php echo !empty($vo['licence']) ? str_replace(array("\r\n","\r","\n"),'\\n',$vo['licence']) : '无'; ?>");'>点我</a></td><td width="100" align="center"><?php echo $vo['charset']?></td><td width="150" align="center"><?php echo date('Y-m-d H:i:s',$vo['time'])?></td><td width="200" align="center"><a target="_blank" href="?ac=yulan&collectid=<?php echo $vo['id']?>">预览源代码</a>&nbsp;&nbsp;<a href="?ac=xiugai&id=<?php echo $vo['id']?>">修改</a>&nbsp;&nbsp;<a href="?ac=export&id=<?php echo $vo['id']?>">导出</a>&nbsp;&nbsp;<a href="?ac=del&id=<?php echo $vo['id']?>" onClick="return confirm('确定删除?')">删除</a></td></tr><?php
	}
?><tbody><tr><td align="center" colspan="6"><input type="submit" value=" 提交 " name="submit">&nbsp;&nbsp;<input type="button" onClick="history.go(-1);" value=" 返回 " name="Input"></td></tr></tbody></form><?php
}else{
?><tr nowrap><td colspan="5" align="center">没有找到采集节点！</td></tr><?php
}
?></table><?php
}elseif($ac=='export'){
	$file=VV_DATA.'/config/'.$id.'.php';
	if(!is_file($file)) ShowMsg("采集配置文件不存在",'-1',3000);
	$caiji_config=require_once($file);
	$basecon="VIVI:".base64_encode(serialize($caiji_config)).":END";
?><table width="98%" border="0" cellpadding="4" cellspacing="1"><tbody><tr nowrap><td><h2>导出采集规则</h2></td></tr></tbody><tr nowrap><td><b>以下为规则 [<?php echo $caiji_config['name'];?>] 的配置，你可以共享给你的朋友:</b></td></tr><tr nowrap><td align="center"><textarea style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo $basecon;?></textarea></td></tr></table><?php
}elseif($ac=='import'){

?><table width="98%" border="0" cellpadding="4" cellspacing="1"><form action="?ac=saveimport" method="post"><tbody><tr nowrap><td><h2>导入采集规则</h2></td></tr></tbody><tr nowrap><td><b>请在下面输入你要导入的采集配置：</b></td></tr><tr nowrap><td align="center"><textarea name="import_text" style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></textarea></td></tr><tbody><tr><td align="center" colspan="2"><input type="submit" value=" 提交 " name="submit">&nbsp;&nbsp;<input type="button" onClick="history.go(-1);" value=" 返回 " name="Input"></td></tr></tbody></form></table><?php
}elseif($ac=='xiugai' || $ac=='add' ){ 
	if($ac=='xiugai'){
		$file=VV_DATA.'/config/'.$id.'.php';
		if(!is_file($file)) ShowMsg("采集配置文件不存在",'-1',3000);
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
?><table width="98%" border="0" cellpadding="4" cellspacing="1"><form action="?ac=save&id=<?php echo $id?>" method="post"><tbody id="config1"><tr nowrap><td colspan="2"><div style='float:left;padding:5px;'>采集节点设置：</div>&nbsp;&nbsp;<div style='float:left;padding:5px;border:1px dotted #ff6600;background:#ffffee'>过滤替换规则是在程序处理之后执行，请按照采集后的页面源代码进行编写，不是目标站原始源代码，保存后到规则列表中预览代码</div></td></tr><tr nowrap><td width="260"><b>节点名称</b><br><font color="#666666">给你的采集起一个名字</font></td><td><input type="text" name="con[name]" size="50" value="<?php echo $caiji_config['name'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>目标站地址</b><br><font color="#666666">需要采集的目标网站地址</font></td><td><input type="text" name="con[from_url]" id="from_url" size="50" value="<?php echo $caiji_config['from_url'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;<select name="con[charset]" ><option value="gb2312" <?php if ($caiji_config['charset']=='gb2312' || empty($caiji_config['charset']) ) echo " selected";?>>gb2312</option><option value="utf-8" <?php if ($caiji_config['charset']=='utf-8') echo " selected";?>>utf-8</option><option value="gbk" <?php if ($caiji_config['charset']=='gbk') echo " selected";?>>gbk</option><option value="big5" <?php if ($caiji_config['charset']=='big5') echo " selected";?>>big8</option></select>&nbsp;目标站编码</td></tr><tr nowrap><td width="260"><b>其他域名</b><br><font color="#666666">目标站多个域名绑定一个站点时填写<br>每个域名用半角逗号分隔<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>如: f52d.com<font color="red">,</font>www.f52d.com</div></font></td><td><input type="text" name="con[other_url]" id="other_url" size="50" value="<?php echo $caiji_config['other_url'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>目标站图片域名</b><br><font color="#666666">图片域名与页面域名不一致时使用<br>每个域名用半角逗号分隔<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>如: img1.f52d.com<font color="red">,</font>img2.f52d.com</div></font></td><td><input type="text" name="con[other_imgurl]" id="other_imgurl" size="50" value="<?php echo $caiji_config['other_imgurl'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>目标站搜索地址</b><br><font color="#666666">目标站搜索地址，有域名的要带上</font></td><td><input type="text" name="con[search_url]" id="search_url" size="50" value="<?php echo $caiji_config['search_url'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" >&nbsp;<select name="con[search_charset]" ><option value="gb2312" <?php if ($caiji_config['search_charset']=='gb2312' || empty($caiji_config['search_charset']) ) echo " selected";?>>gb2312</option><option value="utf-8" <?php if ($caiji_config['search_charset']=='utf-8') echo " selected";?>>utf-8</option><option value="gbk" <?php if ($caiji_config['search_charset']=='gbk') echo " selected";?>>gbk</option><option value="big5" <?php if ($caiji_config['search_charset']=='big5') echo " selected";?>>big8</option></select>&nbsp;搜索页面的编码</td></tr><tr nowrap><td width="260"><b>目标网站名称</b><br><font color="#666666">多个用半角逗号分隔</font></td><td><input type="text" name="con[from_title]" id="from_title" size="50" value="<?php echo $caiji_config['from_title'];?>" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ></td></tr><tr nowrap><td width="260"><b>标签过滤</b><br><font color="#666666">采集页面时过滤掉这些标签<br><font color="red">慎用</font>,否则将可能出现采集不完整和错位现象</font></td><td><input name="siftags[]" type="checkbox" value="iframe" <?php if(in_array('iframe',$caiji_config['siftags']) || $ac=='add'){?>checked<?php } ?> /> iframe
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
			</td></tr><tr nowrap><td width="260"><b>站内外过滤</b><br><font color="#666666">可过滤站内或站外不必要的链接或文件</font><td><input name="siftags[]" type="checkbox" value="outa" <?php if(in_array('outa',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="red">站外</font>链接
				<input name="siftags[]" type="checkbox" value="outjs" <?php if(in_array('outjs',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="red">站外</font>js文件
				<input name="siftags[]" type="checkbox" value="outcss" <?php if(in_array('outcss',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="red">站外</font>css文件
				<input name="siftags[]" type="checkbox" value="locala" <?php if(in_array('locala',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="blue">站内</font>链接
				<input name="siftags[]" type="checkbox" value="localjs" <?php if(in_array('localjs',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="blue">站内</font>js文件
				<input name="siftags[]" type="checkbox" value="localcss" <?php if(in_array('localcss',$caiji_config['siftags'])){?>checked<?php } ?> /><font color="blue">站内</font>css文件
			</td></td></tr><tr><td width="260" valign='top'><b>字符串替换规则</b><br><font color="#666666">常用于html或广告代码的替换(支持多行)<br>替换前和替换后直接用<b>{vivicut}</b>分隔<br>每一对替换后面用下面的字符分隔开来<br><b>{vivicutline}</b><br>例子：<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'>我是替换前{vivicut}我是替换后<br><font color="red">{vivicutline}</font><br>百度{vivicut}百度你妹</font><br><font color="red">{vivicutline}</font></div>提示：{vivisign}可以兼容动静态,问号开头的路径</font></td><script language="javascript">
	//移动光标到最后
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
</script><td><textarea id="cai1" name="con[replacerules]" style="height: 180px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo htmlspecialchars($caiji_config['replacerules']);?></textarea><br>快速插入：<input  type="button" style="cursor:hand" onClick="javascript:Insert1('{vivicut}')" value="{vivicut} " /><input  type="button" style="cursor:hand" onclick="javascript:Insert1('{vivicutline}')" value="{vivicutline} " /><input  type="button" style="cursor:hand" onclick="javascript:Insert1('{vivisign}')" value="{vivisign}" /><input  type="button" style="cursor:hand" onclick="javascript:Insert1('我是替换前{vivicut}我是替换后{vivicutline}')" value="模版" /></td></tr><tr nowrap><td width="260" valign='top'><b>正则过滤规则</b><br><font color="#666666">正则过滤表达式，一行一个，格式如下：<br><div style='padding:5px;border:1px dotted #ff6600;background:#f6f6f6'><font color="red">{vivi replace='</font>替换后<font color="red">'}</font>正则表达式<font color="red">{/vivi}</font></div></font></td><td><textarea name="con[siftrules]" id="cai2" style="height: 100px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo htmlspecialchars($caiji_config['siftrules']);?></textarea><br>快速插入：<input  type="button" style="cursor:hand" onClick="javascript:Insert2('{vivi replace=\'')" value="{vivi replace='" /><input  type="button" style="cursor:hand" onclick="javascript:Insert2('\'}')" value="'}" /><input  type="button" style="cursor:hand" onclick="javascript:Insert2('{/vivi}')" value="{/vivi}" /><input  type="button" style="cursor:hand" onclick="javascript:Insert2('{vivi replace=\'替换后\'}正则表达式{/vivi}')" value="模版" /></td></tr><tr nowrap>
  <td width="260"><b>繁简互转</b><br><font color="#666666">繁体简体中文之间互转，影响速度</font></td><td><select name="con[big52gbk]" ><option value="togbk" <?php if ($caiji_config['big52gbk']=='togbk') echo " selected";?>>繁转简</option><option value="tobig5" <?php if ($caiji_config['big52gbk']=='tobig5') echo " selected";?>>简转繁</option><option value="0" <?php if (!$caiji_config['big52gbk']) echo " selected";?>>关闭</option></select></td></tr><tr nowrap>
    <td width="260"><b>伪原创开关</b><br><font color="#666666">开启伪原创</font></td><td><select name="con[replace]" ><option value="1" <?php if ($caiji_config['replace']) echo " selected";?>>开启</option><option value="0" <?php if (!$caiji_config['replace']) echo " selected";?>>关闭</option></select></td></tr><tr nowrap>
      <td width="260"><b>伪静态开关</b><br><font color="#666666">伪静态的采集规则和动态的可能不一样</font></td><td><select name="con[rewrite]" ><option value="1" <?php if ($caiji_config['rewrite']) echo " selected";?>>开启</option><option value="0" <?php if (!$caiji_config['rewrite']) echo " selected";?>>关闭</option></select></td></tr><tr nowrap><td width="260" valign='top'><b>使用说明</b><br><font color="#666666">填写作者信息、使用协议或说明、注意事项</font></td><td><textarea name="con[licence]" style="height: 80px; width: 550px" onFocus="this.style.borderColor='#00CC00'" onBlur="this.style.borderColor='#dcdcdc'" ><?php echo htmlspecialchars($caiji_config['licence']);?></textarea></td></tr></tbody><tbody><tr><td align="center" colspan="2"><input type="submit" value=" 提交 " name="submit">&nbsp;&nbsp;<input type="button" onClick="history.go(-1);" value=" 返回 " name="Input"></td></tr></tbody></form></table><?php }?></div></div><?php include "footer.php";?></body></html>