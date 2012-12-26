<?php
/**
 * @fileoverview 
 * @author daxingplay<daxingplay@gmail.com>
 * @time: 12-12-24 13:36
 * @description
 */

define('CURSCRIPT', 'index');
define('IN_APP', true);

include('./config/services.php');
include('./source/common.php');

$size = floatval($_POST['size']);
$pv = intval($_POST['pv']);
$pv_unit = intval($_POST['pv_unit']);
$pv_unit = $pv_unit ? $pv_unit : 1;
if($size && $pv && $_POST['form_submit'] == 'true'){
//    $total = $size * $pv;
    $real_pv = $pv * $pv_unit;
    $size_mb = $size / 1024;
    $size_gb = $size_mb / 1024;
    $total_mb = $size_mb * $real_pv;
    $total_gb = $size_gb * $real_pv;

    $total_display = '';
    if($total_mb < 10){
        $total_display = number_format($total_mb, 2) . 'MB';
    }else{
        $total_display = number_format($total_gb, 2) . 'GB';
    }

    // 需要的端口速率
    $need_rate = number_format(cal_bandwidth_rate($total_mb), 0);
    $need_rate = $need_rate >= 1 ? $need_rate : 1;

    $expenses = array();
    $expense_sum = 0;

    if(!empty($services)){
        foreach($services as $name => $service){
            $price_array = $service['prices'];
            $type = $service['type'];
            $price = array();
            switch($type){
                case 'cdn':
                    $price = array(
                        'storage' => cal_ladder_price($size_gb, $price_array['storage']),
                        'bandwidth_in' => cal_ladder_price($total_gb, $price_array['bandwidth_in']),
                        'bandwidth_out' => cal_ladder_price($total_gb, $price_array['bandwidth_out']),
                        'request_get' => cal_ladder_price($real_pv, $price_array['request']['get'])
                    );
                    break;
                case 'server':
                    $price = array(
                        'server' => $real_pv / $price_array['server'][0] * $price_array['server'][1],
                        'bandwidth' =>  cal_ladder_price($need_rate, $price_array['bandwidth'])
                    );
                    break;
            }
            $price['total'] = array_sum($price);
            $price['total_month'] = $price['total'] * 30;
            $price['total_year'] = $price['total_month'] * 12;
            $price = format_expenses($price, $price_array['unit']);
            $expenses[$type][$name] = $price;

            $expense_sum += $price['total'];
        }
    }

    $expense_sum = number_format($expense_sum, 2);
    $expense_sum_month = number_format($expense_sum * 30, 2);
    $expense_sum_year = number_format($expense_sum_month * 12, 2);

    $total_services = count($services);
    $expense_average = number_format($expense_sum / $total_services, 2);
}

include('./template/index.tpl.php');