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
    <title>流量节省计算器</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_G['assets']; ?>common/base.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_G['assets']; ?>bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_G['assets']; ?>index/1.0/index.css" />
</head>
<body>

<div id="page">
    <div id="content">
        <form id="J_CalForm" class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded">
            <fieldset>
                <legend>流量节省计算器</legend>
                <div class="control-group">
                    <label class="control-label" for="J_PageSize">原页面大小</label>
                    <div class="controls">
                        <input id="J_PageSize" type="text" name="size" value="<?php echo $size ? $size : ''; ?>" placeholder="原先页面大小或者你节省的大小" /> KB
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="J_SavedSize">节约大小</label>
                    <div class="controls">
                        <input id="J_SavedSize" type="text" name="size_saved" value="<?php echo $size_saved ? $size_saved : ''; ?>" placeholder="节省的大小" /> KB
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="J_PageViews">日均PV</label>
                    <div class="controls">
                        <div class="input-append">
                            <input id="J_PageViews" type="text" name="pv" value="<?php echo $pv ? $pv : ''; ?>" placeholder="每日PV数" />
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
            if(!empty($old_result['expenses'])):
        ?>
                <div id="J_Result" class="expenses-result">
                <?php
                    if(is_null($new_cal)):
                ?>
                        <p>总共需要流量：<em class="total-bandwidth"><?php echo $old_result['total_bandwidth']; ?></em></p>
                        <p>总共需要花费约为<span class="yen">&yen;</span><em class="total-guess"><?php echo $old_result['expenses']['average']; ?></em><span class="unit">/天</span></p>
                <?php
                    else:
                ?>
                        <div class="expenses-compare">
                            <p>
                                流量花费对比：<em class="old"><?php echo $old_result['total_bandwidth']; ?></em> ----> <em class="new"><?php echo $new_result['total_bandwidth']; ?></em>
                            </p>
                            <p>
                                Money花费对比：<em class="old"><span class="yen">&yen;</span><?php echo $old_result['expenses']['average']; ?></em><span class="unit">/天</span> ----> <span class="yen">&yen;</span><em class="new"><?php echo $new_result['expenses']['average']; ?></em><span class="unit">/天</span>
                            </p>
                            <div class="saved">
                                你节约了<span class="yen">&yen;</span><em><?php echo $saved_money; ?></em><span class="unit">/天</span>
                            </div>
                        </div>
<!--                        <p>以前需要流量：<em class="total-bandwidth">--><?php //echo $old_result['total_bandwidth']; ?><!--</em></p>-->
<!--                        <p>以前需要花费约为<span class="yen">&yen;</span><em class="total-guess">--><?php //echo $old_result['expenses']['average']; ?><!--</em><span class="unit">/天</span></p>-->
<!--                        <p>现在需要流量：<em class="total-bandwidth">--><?php //echo $new_result['total_bandwidth']; ?><!--</em></p>-->
<!--                        <p>现在需要花费约为<span class="yen">&yen;</span><em class="total-guess">--><?php //echo $new_result['expenses']['average']; ?><!--</em><span class="unit">/天</span></p>-->
                <?php
                    endif;
                ?>
                    <div id="J_ResultGuess" data-num="<?php echo $saved_money_raw; ?>"></div>
                    <div class="clear">
                        <a id="J_ShowFullResult" class="toggle-result" href="#">显示详细结果<i class="icon-arrow-down"></i></a>
                        <a id="J_HideFullResult" class="toggle-result hide-full-result" href="#">隐藏详细结果<i class="icon-arrow-up"></i></a>
                    </div>
                </div>
        <div id="J_FullResult" class="expenses-full-result<?php if($new_result): ?> expenses-full-compare<?php endif; ?>">
            <h3>详细结果</h3>

            <?php
                if($new_result):
            ?>
                    <blockquote>
                        <p class="ps-words">以下结果中，浅灰色代表节约之前的值，深一些的颜色代表节约之后所需要的值。我们将分两种情况来计算需要的花费。</p>
                    </blockquote>
            <?php endif; ?>
            <?php
            if(!empty($old_result['lists']['server'])):
            ?>
            <h5>如果采用租用服务器</h5>
                <p>需要的峰值端口速率大概为：<?php echo $old_result['need_rate']; ?> Mbps</p>
                <?php
                if($old_result['total_bandwidth_raw'] < 100):
                ?>
                    <p class="text-warning">就这点流量采取租用服务器策略很不划算的。</p>
                <?php
                endif;
                ?>
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
                    foreach($old_result['lists']['server'] as $name => $v):
                        $new_v = !empty($new_result) && !empty($new_result['lists']) ? $new_result['lists']['server'][$name] : false;
                    ?>
                        <tr>
                            <td class="name"><a href="<?php echo $services[$name]['link']; ?>" target="_blank"><?php echo $services[$name]['name']; ?></a></td>
                            <td>
                                <span class="old">&yen;<?php echo $v['server']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['server']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['bandwidth']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['bandwidth']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['total']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['total']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['total_month']; ?> /月</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['total_month']; ?> /月</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['total_year']; ?> /年</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['total_year']; ?> /年</span><?php endif; ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
                <blockquote>
                    <p class="ps-words">以上服务器的配置大概以单台：双核Xeon、内存2G、多线BGP带宽、Linux系统为准；端口速率计算假设每天12小时带宽跑满三分之二的流量，剩余12小时为流量低峰期。</p>
                </blockquote>
            <?php
            endif;
            ?>

            <?php
            if(!empty($old_result['lists']['cdn'])):
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
                        foreach($old_result['lists']['cdn'] as $name => $v):
                            $new_v = !empty($new_result) && !empty($new_result['lists']) ? $new_result['lists']['cdn'][$name] : false;
                    ?>
                        <tr>
                            <td class="name"><a href="<?php echo $services[$name]['link']; ?>" target="_blank"><?php echo $services[$name]['name']; ?></a></td>
                            <td>
                                <span class="old">&yen;<?php echo $v['storage']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['storage']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['bandwidth_in']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['bandwidth_in']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['bandwidth_out']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['bandwidth_out']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['request_get']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['request_get']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['total']; ?> /天</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['total']; ?> /天</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['total_month']; ?> /月</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['total_month']; ?> /月</span><?php endif; ?>
                            </td>
                            <td>
                                <span class="old">&yen;<?php echo $v['total_year']; ?> /年</span>
                                <?php if($new_v !== false): ?><span class="new">&yen;<?php echo $new_v['total_year']; ?> /年</span><?php endif; ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php
            endif;
            ?>
            <blockquote>
                <p class="ps-words">以上计算结果仅供参考，在实际情况中，需要考虑到网站程序、机器性能等多方面因素。本计算结果主要是以静态文件为准；</p>
            </blockquote>
        </div>
        <?php
            endif;
        ?>
    </div>
</div>
<div class="footer">
    <a href="https://github.com/daxingplay/bandwidth-cal" id="github-ribbon">
        <img src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub">
    </a>
</div>

<script type="text/javascript" src="<?php echo $_G['assets']; ?>common/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $_G['assets']; ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $_G['assets']; ?>index/1.0/index.js"></script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-37265516-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>