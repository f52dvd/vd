<?php if(!defined('VV_INC'))exit(header("HTTP/1.1 403 Forbidden"));if($v_config['sifton']&&OoO0o0O0o()){$sifturl=explode('[cutline]',$v_config['sifturl']);foreach($sifturl as $k=>$vo){if($vo==$geturl){header("location: {$v_config['web_url']}");exit();}}}$debug=array();run_time(true);if($searchurl)$geturl=$searchurl;if($v_config['cacheon']&&OoO0o0O0o()){if(!is_file($cachefile)||(@filemtime($cachefile)+($cachetime*3600))<=time()){$str=$caiji->post($geturl,$_POST);$strhead=$caiji->strcut('<head>','</head>',$str);if(preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs',$strhead))$caiji_config['charset']='utf-8';if($caiji_config['charset']!='gbk'&&$caiji_config['charset']!='gb2132'){if(PATH_SEPARATOR==':'){$str=mb_convert_encoding($str,"gbk",$caiji_config['charset']);}else{$str=iconv($caiji_config['charset'],"gbk//IGNORE",$str);}$str=preg_replace('#content=\s*(["|\']*)\s*text/html;\s*charset[^"\']+\\1#i','content="text/html; charset=gbk"',$str);$str=preg_replace('#<meta charset="[^"]+">#i','<meta charset="gbk">',$str);$str=preg_replace('#<meta charset=\'[^\']+\'>#i','<meta charset="gbk">',$str);}if(!empty($str)){write($cachefile,$str);}else{$str=file_get_contents($cachefile);write($cachefile,$str);}}else{$str=file_get_contents($cachefile);}}else{$str=$caiji->post($geturl,$_POST);$strhead=$caiji->strcut('<head>','</head>',$str);if(preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs',$strhead))$caiji_config['charset']='utf-8';if($caiji_config['charset']!='gbk'&&$caiji_config['charset']!='gb2132'){if(PATH_SEPARATOR==':'){$str=mb_convert_encoding($str,"gbk",$caiji_config['charset']);}else{$str=iconv($caiji_config['charset'],"gbk//IGNORE",$str);}$str=preg_replace('#content=\s*(["|\']*)\s*text/html;\s*charset[^"\']+\\1#i','content="text/html; charset=gbk"',$str);}}$debug[]='采集用时：'.run_time().'<br>';run_time(1);$titlearr=explode(',',$caiji_config['from_title']);foreach($titlearr as $k=>$vo){$str=str_ireplace($vo,$v_config['web_name'],$str);}$str=str_ireplace($caiji_config['search_url'],WEB_ROOT.'/search.php',$str);$str=str_ireplace($server_url,'',$str);if($caiji_config['other_url']){$other_url=explode(',',$caiji_config['other_url']);foreach($other_url as $k=>$vo){$str=str_ireplace('http://'.$vo,'',$str);}}$str=preg_replace("/<base[^>]+>/si","",$str);$str=preg_replace("/<(applet.*?)>(.*?)<(\/applet.*?)>/si","",$str);$str=preg_replace("/<(\/?applet.*?)>/si","",$str);$str=preg_replace("/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si","",$str);$str=preg_replace("/<(\/?noframes.*?)>/si","",$str);$allhref=$allcss=$alljs=$allimg=$newhref=$newcss=$newjs=$newimg=array();$allhref=getallhref($str);$allimg=getallimg($str);$alljs=getalljs($str);$allcss=getallcss($str);$allhref=array_diff($allhref,$allcss,$alljs,$allimg);$debug[]='获取所有资源链接用时：'.run_time().'<br>';run_time(1);foreach($allimg as $k=>$vo){if(substr($vo,0,7)!='http://'&&substr($vo,0,6)!='ftp://'){if(substr($vo,0,1)=='/'){$vo=substr($vo,1);}else{$vo=$urlpath.$vo;}$newpic[]=$sign.$vo;}else{if($caiji_config['other_imgurl']){$other_url=explode(',',$caiji_config['other_imgurl']);foreach($other_url as $kk=>$vv){if(stripos($vo,$vv)>-1)$vo=WEB_ROOT.'/img.php?tid='.$collectid.'&code='.rawurlencode(strrev(base64_encode($vo)));}}$newpic[]=$vo;}}$str=str_replace($allimg,$newpic,$str);$debug[]='替换所有图片为外链用时：'.run_time().'<br>';run_time(1);foreach($alljs as $k=>$vo){if(substr($vo,0,7)!='http://'&&substr($vo,0,6)!='ftp://'&&substr($vo,0,7)!='https:/'){if(substr($vo,0,1)=='/'){$vo=substr($vo,1);}else{$vo=$urlpath.$vo;}if(in_array('localjs',$caiji_config['siftags'])){$newjs[]='none';continue;}$newjs[]=$sign.$vo;}else{if(in_array('outjs',$caiji_config['siftags'])){$newjs[]='none';continue;}$newjs[]=$vo;}}$str=str_replace($alljs,$newjs,$str);$debug[]='替换所有JS为外链用时：'.run_time().'<br>';run_time(1);foreach($allcss as $k=>$vo){if(substr($vo,0,7)!='http://'&&substr($vo,0,6)!='ftp://'&&substr($vo,0,7)!='https:/'){if(substr($vo,0,1)=='/'){$vo=substr($vo,1);}else{$vo=$urlpath.$vo;}if(in_array('localcss',$caiji_config['siftags'])){$newcss[]='none';continue;}$newcss[]=$sign.$vo;}else{if(in_array('outcss',$caiji_config['siftags'])){$newcss[]='none';continue;}$newcss[]=$vo;}}$str=str_replace($allcss,$newcss,$str);$debug[]='替换所有css为外链用时：'.run_time().'<br>';run_time(1);sort($allhref);$debug[]='内链总数：'.count($allhref).'<br>';foreach($allhref as $k=>$vo){if(strlen($vo)<=1||stripos($vo,'javascript:')>-1)continue;if(substr($vo,0,7)!='http://'&&substr($vo,0,6)!='ftp://'&&substr($vo,0,7)!='https:/'){if(in_array('locala',$caiji_config['siftags'])){$str=preg_replace("~href\s*=\s*([\"|']?){$vo}\\1~i",'href="none"',$str);continue;}if(substr($vo,0,1)=='/'){$vo=substr($vo,1);}$regx_vo=$urlpath.$vo;$vo=preg_quote($vo);$vo=str_replace('~','\\~',$vo);if(!preg_match('#/#',$vo)){$str=preg_replace("~href\s*=\s*([\"|']?){$vo}\\1~i",'href="'.$sign.$regx_vo.'"',$str);}}else{if(in_array('outa',$caiji_config['siftags']))$str=preg_replace("~href\s*=\s*([\"|']?){$vo}\\1~i",'href="none"',$str);}}$debug[]='替换所有内链用时：'.run_time().'<br>';run_time(1);$str=preg_replace('#<(a[^>]+)href\s*=\s*(["|\']?)\s*/#i','<\\1href=\\2'.$sign,$str);$str=preg_replace('#<(a[^>]+)href\s*=\s*(["|\']?)\s*\?\\2#i','<\\1href=\\2'.$v_config['web_url'].'\\2',$str);$str=str_ireplace('href=""','href="'.$v_config['web_url'].'"',$str);$str=str_ireplace('href=\'\'','href="'.$v_config['web_url'].'"',$str);$str=str_ireplace('href="'.$sign.'"','href="'.$v_config['web_url'].'"',$str);$str=str_ireplace('href=\''.$sign.'\'','href="'.$v_config['web_url'].'"',$str);$str=str_ireplace($server_url.'/http://','http://',$str);$str=str_ireplace('php?src=?/','php?src=/',$str);if($caiji_config['siftags']){if(in_array('iframe',$caiji_config['siftags']))$str=preg_replace("/<(iframe.*?)>(.*?)<(\/iframe.*?)>/si","",$str);if(in_array('object',$caiji_config['siftags']))$str=preg_replace("/<(object.*?)>(.*?)<(\/object.*?)>/si","",$str);if(in_array('script',$caiji_config['siftags']))$str=preg_replace("/<(script.*?)>(.*?)<\/script>/si","",$str);if(in_array('form',$caiji_config['siftags']))$str=preg_replace("~<(|/)form([^>]*)>~i","",$str);if(in_array('input',$caiji_config['siftags']))$str=preg_replace("~<input([^>]*)>~i","",$str);if(in_array('textarea',$caiji_config['siftags']))$str=preg_replace("/<(textarea.*?)>(.*?)<\/textarea>/si","",$str);if(in_array('botton',$caiji_config['siftags']))$str=preg_replace("/<(botton.*?)>(.*?)<\/botton>/si","",$str);if(in_array('select',$caiji_config['siftags']))$str=preg_replace("/<(select.*?)>(.*?)<\/select>/si","",$str);if(in_array('div',$caiji_config['siftags']))$str=preg_replace("~<(|/)div([^>]*)>~i","",$str);if(in_array('table',$caiji_config['siftags']))$str=preg_replace("~<(|/)table([^>]*)>~i","",$str);if(in_array('tr',$caiji_config['siftags']))$str=preg_replace("~<(|/)tr([^>]*)>~i","",$str);if(in_array('td',$caiji_config['siftags']))$str=preg_replace("~<(|/)td([^>]*)>~i","",$str);if(in_array('th',$caiji_config['siftags']))$str=preg_replace("~<(|/)th([^>]*)>~i","",$str);if(in_array('span',$caiji_config['siftags']))$str=preg_replace("~<(|/)span([^>]*)>~i","",$str);if(in_array('img',$caiji_config['siftags']))$str=preg_replace("~<img([^>]+)>~i","",$str);if(in_array('font',$caiji_config['siftags']))$str=preg_replace("~<(|/)font([^>]*)>~i","",$str);if(in_array('a',$caiji_config['siftags']))$str=preg_replace("~<(|/)a([^>]*)>~i","",$str);if(in_array('html',$caiji_config['siftags']))$str=preg_replace("~<(|/)html([^>]*)>~i","",$str);if(in_array('style',$caiji_config['siftags']))$str=preg_replace("/<(style.*?)>(.*?)<\/style>/si","",$str);}$newcssimg=array();$regx="~url\s*\(\s*([\"|']?)\s*(.+)\s*\\1\)~i";if(preg_match_all($regx,$str,$match)){$match[2]=array_map('trim',array_unique($match[2]));foreach($match[2]as $k=>$vo){if(substr($vo,0,7)!='http://'&&substr($vo,0,6)!='ftp://'&&strlen($vo)>4){if(substr($vo,0,1)=='/'){$vo=substr($vo,1);}else if(substr($vo,0,3)=='../'){$vo=$urlpath.$vo;}else{$vo=$urlpath.$vo;}$newcssimg[]=$sign.$vo;}else{$newcssimg[]=$vo;}}$str=str_replace($match[2],$newcssimg,$str);}if($caiji_config['replacerules']){$replacerules=explode('{vivicutline}',$caiji_config['replacerules']);$replacerules=array_map('trim',$replacerules);foreach($replacerules as $k=>$vo){list($fromstr,$tostr)=array_map('trim',explode('{vivicut}',$vo));$fromstr=str_replace('{vivisign}',$sign,$fromstr);$tostr=str_replace('{vivisign}',WEB_ROOT.'/',$tostr);$str=str_replace($fromstr,$tostr,$str);}}if($caiji_config['siftrules']){$siftrules=explode('[cutline]',$caiji_config['siftrules']);foreach($siftrules as $k=>$vo){preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#',$vo,$match);if(isset($match[2])&&!empty($match[2])){$match[2]=str_replace('~','\~',$match[2]);$match[2]=str_replace('"','\"',$match[2]);$str=preg_replace("~".$match[2]."~iUs",$match[1],$str);}}}if($caiji_config['replace']&&OoO0o0O0o()){$str=$caiji->replace($str);}$debug[]='自定义过滤用时：'.run_time().'<br>';run_time(1);if($caiji_config['big52gbk']&&OoO0o0O0o()){if(preg_match_all("#>\s*(\S*)\s*<#Us",$str,$arr)){$arr[1]=array_unique($arr[1]);$gbarr=$big5arr=array();include(VV_DATA.'/big5.php');if($caiji_config['big52gbk']=='togbk')$func='simplified';if($caiji_config['big52gbk']=='tobig5')$func='traditionalized';foreach($arr[1]as $k=>$vo){if(preg_match('/[^\x00-\x80]/',$vo)){$gbarr[]=$arr[1][$k];$big5arr[]=$func($arr[1][$k]);}}$str=str_replace($gbarr,$big5arr,$str);}}$topad=@file_get_contents(VV_DATA.'/adjs/top.js');$bottomad=@file_get_contents(VV_DATA.'/adjs/bottom.js');if($topad){$topad='<p align="center">'.$topad.'</p>';}if($bottomad){$bottomad='<p align="center">'.$bottomad.'</p>';}if(empty($_SERVER['QUERY_STRING'])){$str=preg_replace('#name\s*=\s*(["|\']*)keywords\\1\s*content=\s*(["|\']*)[^"\']+\\2#i','name="keywords" content="'.$v_config['web_keywords'].'"',$str);$str=preg_replace('#name\s*=\s*(["|\']*)description\\1\s*content=\s*(["|\']*)[^"\']+\\2#i','name="description" content="'.$v_config['web_description'].'"',$str);$str=preg_replace('#<title>(.*)</title>#i','<title>'.$v_config['web_name'].'</title>',$str);if(is_file(VV_DATA.'/flink.php')){$flinks=file_get_contents(VV_DATA.'/flink.php');if($flinks){$flinks=str_ireplace(array("\r\n","\r","\n"),'&nbsp;&nbsp;',$flinks);$str=str_ireplace('</body>',$flinks.'</body>',$str);}}}$str=preg_replace("~<(script[^>]+)src\s*=\s*([\"|']?)none\\2([^>]*)>(.*?)<\/script>~si","",$str);$str=preg_replace("~<(a[^>]+)href\s*=\s*([\"|']?)none\\2([^>]*)>(.*?)<\/a>~si","\\4",$str);$str=preg_replace('/<(body[^>]*)>/','<\\1>'.$topad,$str);$str=str_ireplace('</body>',$v_config['web_tongji'].$bottomad.'</body>',$str);$debug[]='最后：'.run_time().'<br>';if(@$_GET['debug']==1)P($debug);