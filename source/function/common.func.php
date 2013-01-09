<?php
/**
 * @fileoverview 
 * @author ��Ӣ��daxingplay��<daxingplay@gmail.com>
 * @time: 12-12-24 14:19
 * @description
 */

function getglobal($key, $group = null) {
    global $_G;
    $key = explode('/', $group === null ? $key : $group.'/'.$key);
    $v = &$_G;
    foreach ($key as $k) {
        if (!isset($v[$k])) {
            return null;
        }
        $v = &$v[$k];
    }
    return $v;
}

/**
 * @param $size
 * @param string $unit, (k, m, g) in short for kb, mb, gb.
 * @return string
 */
function format_bandwidth($size, $unit = 'k'){
    $size_mb = $unit == 'k' ? $size / 1024 : ($unit == 'm' ? $size : $size * 1024);
    return $size_mb < 10240 ? number_format($size_mb, 2) . 'MB' : number_format($size_mb / 1024, 2) . 'GB';
}

function cal_ladder_price($size, $price_array){
    $total = 0;
    $last_limit = 0;
    $left = $size;
    if(is_array($price_array)){
        foreach($price_array as $limit => $price){
            $limit = floatval($limit);
            $price = floatval($price);
            if($size >= $limit){
                $total += ($limit - $last_limit) * $price;
                $last_limit = $limit;
                $left -= $limit;
            }else{
                $total += ($size - $last_limit) * $price;
                $left = 0;
                break;
            }
        }
        if($left > 0){
            $total += $left * $price_array[$last_limit];
        }
    }else{
        $total = $size * floatval($price_array);
    }
    return $total;
}

function format_to_rmb($price, $unit = ''){
    switch($unit){
        case 'dollar':
            $price = $price * 6.2;
            break;
    }
    return $price;
}

function format_expenses($expense, $unit = ''){
    foreach($expense as $k => $v){
        $v = format_to_rmb($v, $unit);
        $v = number_format($v, 2);
        if($v <= 0){
            $v = 0;
        }
        $expense[$k] = $v;
    }
    return $expense;
}

function cal_bandwidth_rate($total_mb){
    return $total_mb / 3 * 2 / 12 / 60 / 60 * 8 * 1.5;
}

function _get_script_url() {
    $php_self = '';
    $scriptName = basename($_SERVER['SCRIPT_FILENAME']);
    if(basename($_SERVER['SCRIPT_NAME']) === $scriptName) {
        $php_self = $_SERVER['SCRIPT_NAME'];
    } else if(basename($_SERVER['PHP_SELF']) === $scriptName) {
        $php_self = $_SERVER['PHP_SELF'];
    } else if(isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $scriptName) {
        $php_self = $_SERVER['ORIG_SCRIPT_NAME'];
    } else if(($pos = strpos($_SERVER['PHP_SELF'],'/'.$scriptName)) !== false) {
        $php_self = substr($_SERVER['SCRIPT_NAME'],0,$pos).'/'.$scriptName;
    } else if(isset($_SERVER['DOCUMENT_ROOT']) && strpos($_SERVER['SCRIPT_FILENAME'],$_SERVER['DOCUMENT_ROOT']) === 0) {
        $php_self = str_replace('\\','/',str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']));
        $php_self[0] != '/' && $php_self = '/'.$php_self;
    } else {
        system_error('request_tainting');
    }
    return $php_self;
}