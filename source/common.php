<?php

error_reporting(0);

define('APP_ROOT', substr(dirname(__FILE__), 0, -6));

include (APP_ROOT.'./source/function/common.func.php');

if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0") || strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")){
    exit('对不起，本工具不支持这些低端浏览器，请使用高级浏览器');
}

global $_G;
$_G = array();
$_G['PHP_SELF'] = htmlspecialchars(_get_script_url());
$_G['basescript'] = CURSCRIPT;
$_G['basefilename'] = basename($_G['PHP_SELF']);
$sitepath = substr($_G['PHP_SELF'], 0, strrpos($_G['PHP_SELF'], '/'));
if(defined('IN_API')) {
    $sitepath = preg_replace("/\/api\/?.*?$/i", '', $sitepath);
} elseif(defined('IN_ARCHIVER')) {
    $sitepath = preg_replace("/\/archiver/i", '', $sitepath);
}
$_G['siteurl'] = htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].$sitepath.'/');

$url = parse_url($_G['siteurl']);
$_G['siteroot'] = isset($url['path']) ? $url['path'] : '';
$_G['siteport'] = empty($_SERVER['SERVER_PORT']) || $_SERVER['SERVER_PORT'] == '80' ? '' : ':'.$_SERVER['SERVER_PORT'];

if(defined('SUB_DIR')) {
    $_G['siteurl'] = str_replace(SUB_DIR, '/', $_G['siteurl']);
    $_G['siteroot'] = str_replace(SUB_DIR, '/', $_G['siteroot']);
}

$_G['assets'] = $_G['siteurl'].'assets/';