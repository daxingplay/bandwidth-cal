<?php
/**
 * @fileoverview 
 * @author daxingplay<daxingplay@gmail.com>
 * @time: 12-12-24 13:59
 * @description
 */

$services = array(
    'aliyun_ec' => array(
        'name' => '阿里云云服务器',
        'link' => '',
        'type' => 'server',
        'prices' => array(
            // 0为能支持的最大PV数，1为这个服务器配置的每日的价钱
            'server' => array('200000', 3999 / 365),
            'bandwidth' => array(
                '1' => 100 / 30
            )
        )
    ),
    'aliyun_oss' => array(
        'name' => '阿里云OSS',
        'link' => 'http://www.aliyun.com/product/oss/',
        'type' => 'cdn',
        'prices' => array(
            'unit' => 'RMB',
            // 硬盘的价格是按天计算的，单位GB
            'storage' => array(
                '1024' => 0.027,
                '51200' => 0.023,
                '102400' => 0.02,
            ),
            'bandwidth_in' => 0,
            // 流出流量是按照GB计算的
            'bandwidth_out' => array(
                '2048' => 0.8,
                '51200' => 0.7,
                '512000' => 0.6
            ),
            'request' => array(
                'get' => 0.06/10000,
                'other' => 0.06/1000
            )
        )
    ),
    'amazon_s3' => array(
        'name' => 'Amazon S3',
        'link' => 'http://aws.amazon.com/s3/',
        'type' => 'cdn',
        'prices' => array(
            'unit' => 'dollar',
            'storage' => array(
                '1024' => 0.095 / 30,
                '51200' => 0.080 / 30,
                '512000' => 0.070 / 30,
                '1024000' => 0.065 / 30,
                '5120000' => 0.060 / 30,
                '10240000' => 0.055 / 30
            ),
            'bandwidth_in' => 0,
            'bandwidth_out' => array(
                '1' => 0,
                '10240' => 0.12,
                '51200' => 0.09,
                '153600' => 0.07,
                '512000' => 0.05
            ),
            'request' => array(
                'get' => 0.01 / 10000
            )
        )
    ),
    'upyun' => array(
        'name' => '又拍云',
        'link' => 'https://www.upyun.com',
        'type' => 'cdn',
        'prices' => array(
            'unit' => 'RMB',
            // 硬盘的价格是按天计算的
            'storage' => array(
                '1' => 10.41 / 365
            ),
            'bandwidth_in' => 0,
            // 流出流量是按照GB计算的
            'bandwidth_out' => array(
                '100' => 0.99,
                '250' => 199 / 250,
                '600' => 600 / 399,
                '1000' => 599 / 1000
            ),
            'request' => array(
                'get' => 0,
                'other' => 0
            )
        )
    )
);