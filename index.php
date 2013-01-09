<?php
/**
 * @fileoverview 
 * @author daxingplay<daxingplay@gmail.com>
 * @time: 12-12-24 13:36
 * @description
 */

define('CURSCRIPT', 'index');
define('IN_APP', true);

include('./source/common.php');
include('./source/class/cal.class.php');

$size = floatval($_POST['size']);
$size_saved = floatval($_POST['size_saved']);
$pv = intval($_POST['pv']);
$pv_unit = intval($_POST['pv_unit']);
$pv_unit = $pv_unit ? $pv_unit : 1;
if($size && $pv && $_POST['form_submit'] == 'true'){
//    $total = $size * $pv;
    $real_pv = $pv * $pv_unit;

    $old_cal = new cal($real_pv, $size);
    $new_cal = null;

    $old_result = $old_cal->result;

    if($size_saved){
        $new_cal = new cal($real_pv, ($size - $size_saved));
        $new_result = $new_cal->result;

        $saved_bandwidth = format_bandwidth($old_result['total_bandwidth'] - $new_result['total_bandwidth'], 'm');
        $saved_money_raw = $old_result['expenses_raw']['average'] - $new_result['expenses_raw']['average'];
        $saved_money = number_format($saved_money_raw, 2);
    }

//    $size_mb = $size / 1024;
//    $size_gb = $size_mb / 1024;
//    $total_mb = $size_mb * $real_pv;
//    $total_gb = $size_gb * $real_pv;
//
//    $total_display = '';
//    if($total_mb < 10){
//        $total_display = number_format($total_mb, 2) . 'MB';
//    }else{
//        $total_display = number_format($total_gb, 2) . 'GB';
//    }
//
//    $need_rate = number_format(cal_bandwidth_rate($total_mb), 0);
//    $need_rate = $need_rate >= 1 ? $need_rate : 1;
//
//    $expenses = array();
//    $expense_sum = 0;
//
//    if(!empty($services)){
//        foreach($services as $name => $service){
//            $price_array = $service['prices'];
//            $type = $service['type'];
//            $price = array();
//            switch($type){
//                case 'cdn':
//                    $price = array(
//                        'storage' => cal_ladder_price($size_gb, $price_array['storage']),
//                        'bandwidth_in' => cal_ladder_price($total_gb, $price_array['bandwidth_in']),
//                        'bandwidth_out' => cal_ladder_price($total_gb, $price_array['bandwidth_out']),
//                        'request_get' => cal_ladder_price($real_pv, $price_array['request']['get'])
//                    );
//                    break;
//                case 'server':
//                    $price = array(
//                        'server' => ceil($real_pv / $price_array['server'][0]) * $price_array['server'][1],
//                        'bandwidth' =>  cal_ladder_price($need_rate, $price_array['bandwidth'])
//                    );
//                    break;
//            }
//            $price['total'] = array_sum($price);
//            $price['total_month'] = $price['total'] * 30;
//            $price['total_year'] = $price['total_month'] * 12;
//
//            $expense_sum += $price['total'];
//
//            $price = format_expenses($price, $price_array['unit']);
//            $expenses[$type][$name] = $price;
//        }
//    }
//
//    $total_services = count($services);
//    $expense_average = number_format($expense_sum / $total_services, 2);
//
//    $expense_sum = number_format($expense_sum, 2);
//    $expense_sum_month = number_format($expense_sum * 30, 2);
//    $expense_sum_year = number_format($expense_sum_month * 12, 2);
}

include('./template/index.tpl.php');