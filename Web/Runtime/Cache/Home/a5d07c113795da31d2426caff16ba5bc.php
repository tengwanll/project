<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>index</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../public/libs/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/panxu/Public/Home/css/public.css">
    <link rel="stylesheet" type="text/css" href="/panxu/Public/Home/index/css/index.css">
</head>

<body>
    <div class="container-fluid">
        <header class="header row">
            <div class="wrap">
                <div class="logo">
                    <a href="#">
                        <!-- <img src="../pic/news_img.jpg"> -->
                        <h1>佰昊生物</h1>
                        <p>Hk's son biological</p>
                    </a>
                </div>
                <div class="search">
                    <div>
                        <input type="text" placeholder="关键字/关键词">
                        <button><span class="fa fa-search"></span></button>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li>
                            <a href="#">首页</a>
                        </li>
                        <li>
                            <a href="#">关于佰昊</a>
                        </li>
                        <li class="active">
                            <a href="#">服务项目</a>
                            <ul class="list-unstyled">
                                <li><a href="#">基因组学生物技术服务</a></li>
                                <li><a href="#">蛋白质组学生物技术服务</a></li>
                                <li><a href="#">细胞学生物技术服务</a></li>
                                <li><a href="#">生物信息数据分析服务</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">特色项目</a>
                            <ul class="list-unstyled">
                                <li><a href="#">高通量测序</a></li>
                                <li><a href="#">蛋白芯片</a></li>
                                <li><a href="#">高通量测序</a></li>
                                <li><a href="#">蛋白芯片</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">企业资讯</a>
                            <ul class="list-unstyled">
                                <li><a href="#">促销活动</a></li>
                                <li><a href="#">新闻动态</a></li>
                                <li><a href="#">实验室展示</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">联系我们</a>
                            <ul class="list-unstyled">
                                <li><a href="#">在线留言</a></li>
                                <li><a href="#">人才招聘</a></li>
                                <li><a href="#">联系方式</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- ==================== -->
        <!-- 以上部分为header模板 -->
        <!-- ==================== -->
        <!-- 首屏欢迎图 -->
        <div class="welcome row section">
            <div class="wrap">
                <div class="info">
                    <h2 class="en">QUEST GENOMICS</h2>
                    <h2 class="cn">医疗权威认证、RUO升级IVD、临检应用</h2>
                </div>
                <div class="announgement">
                    <h3>
                        <span class="en">ANNOUNGEMENT</span>
                        <span class="cn">企业公告</span>
                    </h3>
                    <div>
                        <span class="en"><?php echo ($notice['english_notice']); ?></span>
                        <span class="cn"><?php echo ($notice['notice']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- 项目介绍 -->
        <div class="project row section">
            <div class="wrap">
                <ul class="tabs">
                    <li class="active">
                        <a href="#">
                            <h4>服务项目</h4>
                            <p>service</p>
                            <span class="fa fa-angle-right"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4>特殊服务</h4>
                            <p>special</p>
                            <span class="fa fa-angle-right"></span>
                        </a>
                    </li>
                </ul>
                <ul class="infoList">

                    <?php if(is_array($normalService)): foreach($normalService as $key=>$service): ?><li>
                        <span class="fa fa-car"></span>
                        <h6><?php echo ($service['title']); ?></h6>
                        <p><?php echo ($service['description']); ?></p>
                    </li><?php endforeach; endif; ?>
                   
                </ul>
            </div>
            <div class="pr">
                <span class="fa fa-angle-down"></span>
            </div>
        </div>
        <!-- 资讯 -->
        <div class="news row section">
            <div class="wrap">
                <ul class="tabs">
                    <li class="active">
                        <a href="#">
                            <h4>最新资讯</h4>
                            <p>information</p>
                        </a>
                    </li>
                </ul>
            </div>
            <ol class="list-unstyled">
                <?php if(is_array($informations)): foreach($informations as $k=>$info): ?><!-- <li class="active"> -->
                <li>
                    <div class="wrap">
                        <div class="title">
                            <span class="num"><?php echo ++$k;?></span>
                            <h6><?php echo ($info['title']); ?></h6>
                        </div>
                        <div class="contact">
                            <p> <?php echo ($info['short_desc']); ?></p>
                            <img src="/panxu/Public/Home/index/pic/news_img.jpg">
                        </div>
                    </div>
                </li><?php endforeach; endif; ?>
            </ol>
        </div>
        <!-- 促销活动 -->
        <div class="activity row section">
            <div class="wrap">
                <ul class="tabs">
                    <li class="active">
                        <a href="#">
                            <h4>促销活动</h4>
                            <p>activity</p>
                        </a>
                    </li>
                </ul>
                <ul class="banner list-unstyled">
                    <li class="index_0">
                        <a href="#">
                            <img src="/panxu/Public/Home/index/pic/activity_img.jpg">
                        </a>
                    </li>
                    <li class="index_1">
                        <a href="#">
                            <img src="/panxu/Public/Home/index/pic/activity_img.jpg">
                        </a>
                    </li>
                    <li class="index_2">
                        <a href="#">
                            <img src="/panxu/Public/Home/index/pic/activity_img.jpg">
                        </a>
                    </li>
                </ul>
                <ul class="banner_nav">
                    <li>
                        <a href="#"></a>
                    </li>
                    <li class="active">
                        <a href="#"></a>
                    </li>
                    <li>
                        <a href="#"></a>
                    </li>
                </ul>
                <ul class="banner_info list-unstyled">
                    <li class="active">
                        <h4>跳楼大甩卖</h4>
                        <p>[发掘小麦中的“软黄金”(小麦,糊粉 层,食品,富贵病)] 提起小麦糊粉层，大 多数人可能并不熟悉。它的学名为外胚 乳，是小麦籽粒皮层的最内层，由一层 排列…</p>
                    </li>
                    <li>
                        <h4>甩卖买甩卖</h4>
                        <p>[发掘小麦中的“软黄金”(小麦,糊粉 层,食品,富贵病)] 提起小麦糊粉层，大 多数人可能并不熟悉。它的学名为外胚 乳，是小麦籽粒皮层的最内层，由一层 排列…</p>
                    </li>
                    <li>
                        <h4>没啥不可能</h4>
                        <p>[发掘小麦中的“软黄金”(小麦,糊粉 层,食品,富贵病)] 提起小麦糊粉层，大 多数人可能并不熟悉。它的学名为外胚 乳，是小麦籽粒皮层的最内层，由一层 排列…</p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ==================== -->
        <!-- 以下部分为footer模板 -->
        <!-- ==================== -->
        <!-- 站点信息 -->
        <div class="siteInfo row">
            <div class="wrap">
                <ul class="list-unstyled">
                    <li>
                        <h4>集团介绍</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">企业宗旨</a></li>
                            <li><a href="#">企业文化</a></li>
                            <li><a href="#">企业发展</a></li>
                        </ul>
                    </li>
                    <li>
                        <h4>诚聘信息</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">诚聘精英</a></li>
                            <li><a href="#">投递简历</a></li>
                        </ul>
                    </li>
                    <li>
                        <h4>联系我们</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">合作加盟</a></li>
                            <li><a href="#">详情咨询</a></li>
                        </ul>
                    </li>
                </ul>
                <p class="address">
                    <span class="fa fa-map-marker"></span>
                    <span class="value">辽宁省沈阳市浑南区</span>
                </p>
                <p class="tel">
                    <span class="fa fa-phone"></span>
                    <span class="value">024-8721-4321</span>
                </p>
            </div>
        </div>
        <footer class="footer row">
            <span>佰昊生物科技有限公司</span>
            <span>版权所有</span>
            <span>c2010-2016</span>
            <span>辽ICP备 432454号</span>
        </footer>
    </div>
    <script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/panxu/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/panxu/Public/Home/index/js/index.js"></script>
</body>

</html>