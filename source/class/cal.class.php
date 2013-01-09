<?php
/**
 * @fileoverview 
 * @author daxingplay<daxingplay@gmail.com>
 * @time: 13-1-7 10:17
 * @description
 */

class cal {

    var $result = array();
    var $expenses = array();
    var $services = array();
    var $total_service;

    function cal($real_pv, $size_kb){
        $this->services = getglobal('services');
        $this->total_service = count($this->services);
        $this->_cal($real_pv, $size_kb);
        $this->_formate_result();
    }

    private function _cal($real_pv, $size_kb){
        $size_mb = $size_kb / 1024;
        $size_gb = $size_mb / 1024;
        $total_mb = $size_mb * $real_pv;
        $total_gb = $size_gb * $real_pv;

        $need_rate = $this->_cal_bandwidth_rate($total_mb);
        $need_rate = $need_rate >= 1 ? $need_rate : 1;

        $expenses = array();
        $expense_sum = 0;

        if(!empty($this->services)){
            foreach($this->services as $name => $service){
                $price_array = $service['prices'];
                $type = $service['type'];
                $price = array();
                switch($type){
                    case 'cdn':
                        $price = array(
                            'storage' => $this->_cal_ladder_price($size_gb, $price_array['storage']),
                            'bandwidth_in' => $this->_cal_ladder_price($total_gb, $price_array['bandwidth_in']),
                            'bandwidth_out' => $this->_cal_ladder_price($total_gb, $price_array['bandwidth_out']),
                            'request_get' => $this->_cal_ladder_price($real_pv, $price_array['request']['get'])
                        );
                        break;
                    case 'server':
                        $price = array(
                            'server' => ceil($real_pv / $price_array['server'][0]) * $price_array['server'][1],
                            'bandwidth' =>  $this->_cal_ladder_price($need_rate, $price_array['bandwidth'])
                        );
                        break;
                }
                $price['total'] = array_sum($price);
                $price['total_month'] = $price['total'] * 30;
                $price['total_year'] = $price['total_month'] * 12;

                $expense_sum += $price['total'];

                $price = $this->_format_expenses($price, $price_array['unit']);
                $expenses[$type][$name] = $price;
            }
        }

        $this->result = array(
            'expenses_raw' => array(
                'average' => $expense_sum / $this->total_service,
                'sum' => array(
                    'total' => $expense_sum,
                    'month' => $expense_sum * 30,
                    'year' => $expense_sum * 360
                )
            ),
            'lists' => $expenses,
            'total_bandwidth_raw' => $total_mb,
            'total_bandwidth' => format_bandwidth($total_mb),
            'need_rate_raw' => $need_rate,
            'need_rate' => ceil($need_rate)
        );

//        $expense_average = number_format($expense_sum / $this->total_service, 2);
//
//        $expense_sum = number_format($expense_sum, 2);
//        $expense_sum_month = number_format($expense_sum * 30, 2);
//        $expense_sum_year = number_format($expense_sum_month * 12, 2);
    }

    private function _cal_bandwidth_rate($total_mb){
        return $total_mb / 3 * 2 / 12 / 60 / 60 * 8 * 1.5;
    }

    private function _cal_ladder_price($size, $price_array){
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

    private function _format_to_rmb($price, $unit = ''){
        switch($unit){
            case 'dollar':
                $price = $price * 6.2;
                break;
        }
        return $price;
    }

    private function _format_expenses($expense, $unit = ''){
        foreach($expense as $k => $v){
            $v = $this->_format_to_rmb($v, $unit);
            $v = number_format($v, 2);
            if($v <= 0){
                $v = 0;
            }
            $expense[$k] = $v;
        }
        return $expense;
    }

    private function _formate_number($arr, $length = 2){
        if(is_array($arr)){
            foreach($arr as $k => $v){
                $arr[$k] = $this->_formate_number($v, $length);
            }
            return $arr;
        }else{
            return number_format($arr, $length);
        }
    }

    private function _formate_result(){
        foreach($this->result as $k => $v){
            if(strpos($k, '_raw') !== false){
                $new_k = str_replace('_raw', '', $k);
                // don not format again if new key exists.
                $this->result[$new_k] = $this->result[$new_k] ? $this->result[$new_k] : $this->_formate_number($v);
            }
        }
//        $this->result['expenses'] = $this->_formate_number($this->result['expenses_raw']);
//        $this->result['need_rate'] = $this->_formate_number($this->result['need_rate']);
    }
}