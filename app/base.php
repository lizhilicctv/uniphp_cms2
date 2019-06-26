<?php
use UNI\tools\Db;
$_system=Db::name('system')->getall('enname,value');
foreach( $_system as $k => $v){
	$system[$v['enname']]=$v["value"];
}
if($system['value']!='开启'){
	die('网站已经关闭');
}
setSession('system',$system);


