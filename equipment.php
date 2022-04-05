<?php

header("Content:Content-type:text/html;charset=utf-8");

//   // 作用取得客户端的ip、地理位置、浏览器、以及访问设备

class get_equipment_info{

////获得访客浏览器类型

function GetBrowser(){

if(!empty($_SERVER['HTTP_USER_AGENT']))

{

$br = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/MSIE/i',$br)){

$br = 'MSIE';

}

elseif (preg_match('/Firefox/i',$br)){

$br = 'Firefox';

}elseif (preg_match('/Chrome/i',$br)){

$br = 'Chrome';

}elseif (preg_match('/Safari/i',$br)){

$br = 'Safari';

}elseif (preg_match('/Opera/i',$br)){

$br = 'Opera';

}else {

$br = 'Other';

}

return json_encode("浏览器为".$br);

}else{

return "获取浏览器信息失败！";}

}

////获得访客浏览器语言

function GetLang()

{

if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){

$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

$lang = substr($lang,0,5);

if(preg_match("/zh-cn/i",$lang)){

$lang = "简体中文";

}elseif(preg_match("/zh/i",$lang)){

$lang = "繁体中文";

}else{

$lang = "English";

}

return json_encode("浏览器语言为".$lang);

}else{

return "获取浏览器语言失败！";

}

}

//获取客户端操作系统信息包括win10

function GetOs(){

$agent = $_SERVER['HTTP_USER_AGENT'];

$os = false;

if (preg_match('/win/i', $agent) && strpos($agent, '95'))

{

$os = 'Windows 95';

}

else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))

{

$os = 'Windows ME';

}

else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))

{

$os = 'Windows 98';

}

else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))

{

$os = 'Windows Vista';

}

else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))

{

$os = 'Windows 7';

}

else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))

{

$os = 'Windows 8';

}else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))

{

$os = 'Windows 10';#添加win10判断

}else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))

{

$os = 'Windows XP';

}

else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))

{

$os = 'Windows 2000';

}

else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))

{

$os = 'Windows NT';

}

else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))

{

$os = 'Windows 32';

}

else if (preg_match('/linux/i', $agent))

{

$os = 'Linux';

}

else if (preg_match('/unix/i', $agent))

{

$os = 'Unix';

}

else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))

{

$os = 'SunOS';

}

else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))

{

$os = 'IBM OS/2';

}

else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))

{

$os = 'Macintosh';

}

else if (preg_match('/PowerPC/i', $agent))

{

$os = 'PowerPC';

}

else if (preg_match('/AIX/i', $agent))

{

$os = 'AIX';

}

else if (preg_match('/HPUX/i', $agent))

{

$os = 'HPUX';

}

else if (preg_match('/NetBSD/i', $agent))

{

$os = 'NetBSD';

}

else if (preg_match('/BSD/i', $agent))

{

$os = 'BSD';

}

else if (preg_match('/OSF1/i', $agent))

{

$os = 'OSF1';

}

else if (preg_match('/IRIX/i', $agent))

{

$os = 'IRIX';

}

else if (preg_match('/FreeBSD/i', $agent))

{

$os = 'FreeBSD';

}

else if (preg_match('/teleport/i', $agent))

{

$os = 'teleport';

}

else if (preg_match('/flashget/i', $agent))

{

$os = 'flashget';

}

else if (preg_match('/webzip/i', $agent))

{

$os = 'webzip';

}

else if (preg_match('/offline/i', $agent))

{

$os = 'offline';

}

else

{

$os = '未知操作系统';

}

return json_encode("系统为".$os);

}

//获得访客真实ip

function Getip()

{

if (! empty($_SERVER["HTTP_CLIENT_IP"])) {

$ip = $_SERVER["HTTP_CLIENT_IP"];

}

if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { // 获取代理ip

$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

}

if ($ip) {

$ips = array_unshift($ips, $ip);

}

$count = count($ips);

for ($i = 0; $i < $count; $i ++) {

if (! preg_match("/^(10|172\.16|192\.168)\./i", $ips[$i])) { // 排除局域网ip

$ip = $ips[$i];

break;

}

}

$tip = empty($_SERVER['REMOTE_ADDR']) ? $ip : $_SERVER['REMOTE_ADDR'];

if ($tip == "127.0.0.1") { // 获得本地真实IP

return $this- get_onlineip();

} else {

return $tip;

}

}

// //根据ip获得访客所在地地名

function Getaddress($ip = '')

{

if (empty($ip)) {

$ip = $this- Getip();

}

$ipadd = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=" . $ip); // 根据新浪api接口获取

if ($ipadd) {

$charset = iconv("gbk", "utf-8", $ipadd);

preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $charset, $ipadds);

return $ipadds; // 返回一个二维数组

} else {

return "addree is none";

}

}

//获得本地真实IP

function get_onlineip()

{

$mip = file_get_contents("http://city.ip138.com/city0.asp");

if ($mip) {

preg_match("/\[.*\]/", $mip, $sip);

$p = array(

"/\[/",

"/\]/"

);

return preg_replace($p, "", $sip[0]);

} else {

return "获取本地IP失败！";

}

}

}

$info = new get_equipment_info();

echo json_decode($info -  GetLang());

echo json_decode($info -  GetOs());

echo json_decode($info -  GetBrowser());

print_r($info -  Getaddress());

echo $info -  Getip();

echo $info -  get_onlineip();

die;
