<?php
/**
 * @fileoverview 
 * @author daxingplay<daxingplay@gmail.com>
 * @time: 12-12-24 15:24
 * @description
 */
if(!defined('IN_APP')){
    exit('Access Denied.');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>流量计算器</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_G['assets']; ?>common/base.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_G['assets']; ?>bootstrap/css/bootstrap.min.css" />
</head>
<body>

<div id="page">
    <div id="content">
        <form id="J_CalForm" class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded">
            <fieldset>
                <legend>流量计算器</legend>
                <div class="control-group">
                    <label class="control-label" for="J_PageSize">页面大小</label>
                    <div class="controls">
                        <input id="J_PageSize" type="text" name="size" value="<?php echo $size; ?>" placeholder="填写页面大小，也可以填写你节省的大小" /> KB
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="J_PageViews">日均PV</label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="J_PageViews" type="text" name="pv" value="<?php echo $pv; ?>" placeholder="每日PV数" />
                            <input id="J_PVUnitInput" type="hidden" name="pv_unit" value="<?php echo $pv_unit; ?>" />
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span id="J_PVUnitShow" class="result">
                                        <?php
                                        switch($pv_unit){
                                            case 1000:
                                                echo '千';
                                                break;
                                            case 10000:
                                                echo '万';
                                                break;
                                            case 100000:
                                                echo '十万';
                                                break;
                                            case 1000000:
                                                echo '百万';
                                                break;
                                            case 10000000:
                                                echo '千万';
                                                break;
                                            case 100000000:
                                                echo '亿';
                                                break;
                                            default:
                                                break;
                                        }
                                        ?>次
                                    </span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="J_PVUnitDropDown" class="dropdown-menu">
                                    <li><a href="#" data-value="1">次</a></li>
                                    <li><a href="#" data-value="1000">千次</a></li>
                                    <li><a href="#" data-value="10000">万次</a></li>
                                    <li><a href="#" data-value="100000">十万次</a></li>
                                    <li><a href="#" data-value="1000000">百万次</a></li>
                                    <li><a href="#" data-value="10000000">千万次</a></li>
                                    <li><a href="#" data-value="100000000">亿次</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="hidden" name="form_submit" value="true" />
                        <button type="submit" class="btn">计算</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <?php
            if(!empty($expenses)):
        ?>
        <div class="expenses">
            <h3>计算结果</h3>
            <p>总共需要流量：<?php echo $total_display; ?></p>

            <?php
            if(!empty($expenses['server'])):
            ?>
            <h5>如果采用租用服务器</h5>
                <p>需要的峰值端口速率大概为：<?php echo $need_rate; ?> Mbps</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>服务商</th>
                            <th>服务器租用</th>
                            <th>带宽</th>
                            <th colspan="3">总共</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($expenses['server'] as $name => $v):
                    ?>
                        <tr>
                            <td><a href="<?php echo $services[$name]['link']; ?>" target="_blank"><?php echo $services[$name]['name']; ?></a></td>
                            <td>&yen;<?php echo $v['server']; ?> /天</td>
                            <td>&yen;<?php echo $v['bandwidth']; ?> /天</td>
                            <td>&yen;<?php echo $v['total']; ?> /天</td>
                            <td>&yen;<?php echo $v['total_month']; ?> /月</td>
                            <td>&yen;<?php echo $v['total_year']; ?> /年</td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
                <p>PS: 以上服务器的配置大概以单台：双核、内存2G、硬盘150G为准；</p>
            <?php
            endif;
            ?>

            <?php
            if(!empty($expenses['cdn'])):
            ?>
                <h5>如果采用CDN服务</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>服务商</th>
                        <th>数据存储</th>
                        <th>流入流量</th>
                        <th>流出流量</th>
                        <th>请求</th>
                        <th colspan="3">总计</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($expenses['cdn'] as $name => $v):
                    ?>
                        <tr>
                            <td><a href="<?php echo $services[$name]['link']; ?>" target="_blank"><?php echo $services[$name]['name']; ?></a></td>
                            <td>&yen;<?php echo $v['storage']; ?> /天</td>
                            <td>&yen;<?php echo $v['bandwidth_in']; ?> /天</td>
                            <td>&yen;<?php echo $v['bandwidth_out']; ?> /天</td>
                            <td>&yen;<?php echo $v['request_get']; ?> /天</td>
                            <td>&yen;<?php echo $v['total']; ?> /天</td>
                            <td>&yen;<?php echo $v['total_month']; ?> /月</td>
                            <td>&yen;<?php echo $v['total_year']; ?> /年</td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php
            endif;
            ?>
        </div>
        <?php
            endif;
        ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo $_G['assets']; ?>common/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $_G['assets']; ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $_G['assets']; ?>index/1.0/index.js"></script>
</body>
</html>