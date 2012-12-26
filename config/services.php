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
        'link' => '#',
        'type' => 'server',
        'prices' => array(
            // 0为能支持的最大PV数，1为这个服务器配置的每日的价钱
            'server' => array(200000, 3999 / 365),
            'bandwidth' => array(
                '1' => 100 / 30
            )
        )
    ),
    'grandcloud_server' => array(
        'name' => '盛大云云主机',
        'link' => '#',
        'type' => 'server',
        'prices' => array(
            'server' => array(200000, 0.33 * 24),
            'bandwidth' => array(
                '2' => 0.3 * 24,
                '5' => 0.6 * 24,
                '10' => 1.1 * 24,
                '20' => 2.1 * 24,
                '50' => 5.1 * 24,
                '100' => 10.1 * 24,
                '200' => 20.1 * 24
            )
        )
    ),
    'fdcservers' => array(
        'name' => '美国FDC',
        'link' => '#',
        'type' => 'server',
        'prices' => array(
            'unit' => 'dollar',
            'server' => array(200000, 69 / 30),
            'bandwidth' => array(
                '10' => 0,
                '100' => 40 / 30,
                '1000' => 140 / 30
            )
        )
    ),
    'old_server' => array(
        'name' => '传统服务器',
        'link' => '#',
        'type' => 'server',
        'prices' => array(
            'server' => array(200000, 6000 / 365),
            'bandwidth' => array(
                '1' => 300 / 30
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
    ),
    'grandcloud_yunfenfa' => array(
        'name' => '盛大云云分发',
        'link' => 'http://www.grandcloud.cn/index/price#price_yunfenfa',
        'type' => 'cdn',
        'prices' => array(
            'unit' => 'RMB',
            // 硬盘的价格是按天计算的
            'storage' => array(
                '1' => 1 / 30
            ),
            'bandwidth_in' => 0,
            // 流出流量是按照GB计算的
            'bandwidth_out' => array(
                '1' => 1.4,
                '11' => 1,
                '61' => 0.7,
                '261' => 0.5,
                '1285' => 0.4,
                '11525' => 0.35,
                '62725' => 0.32,
                '165125' => 0.3
            ),
            'request' => array(
                'get' => array(
                    '10000' => 0.1 /10000,
                    '1000000' => 0.05 / 10000,
                    '10000000' => 0.02 / 10000,
                    '100000000' => 0.009 / 10000,
                    '1000000000' => 0.006 / 10000,
                ),
                'other' => 0
            )
        )
    )
);