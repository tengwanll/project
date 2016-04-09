<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>about</title>
    <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../public/libs/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="/panxu/Public/Home/css/public.css">
    <link rel="stylesheet" type="text/css" href="/panxu/Public/Home/people/css/about_people.css">
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
                        <button>搜索</button>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="#">首页</a></li>
                        <li><a href="#">关于佰昊</a></li>
                        <li><a href="#">服务项目</a></li>
                        <li><a href="#">特色项目</a></li>
                        <li><a href="#">企业资讯</a></li>
                        <li><a href="#">联系我们</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- ==================== -->
        <!-- 以上部分为header模板 -->
        <!-- ==================== -->
        <div class="main">
            <div class="row">
                <header>
                    <div class="wrap">
                        <img src="/panxu/Public/Home/people/pic/avatar_02_img.jpg">
                        <div>
                            <h3><?php echo ($people['name']); ?></h3>
                            <p class="info"><?php echo ($people['position']); ?></p>
                            <p class="tel"><span>电话：</span><span class="value"><?php echo ($people['telephone']); ?></span></p>
                            <p class="email"><span>Email：</span><span class="value"><?php echo ($people['email']); ?></span></p>
                        </div>
                    </div>
                </header>
                <article class="wrap">
                    <h3>个人简历</h3>
                    <p> <?php echo ($people['description']); ?>
                    </p>
                </article>
                <article class="wrap">
                    <h3>研究方向</h3>
                    <p> <?php echo ($people['study']); ?>
                    </p>
                </article>
                <article class="wrap">
                    <h3>近期主要代表论著</h3>
                    <ol>
                        <?php if(is_array($thesis)): foreach($thesis as $key=>$vo): ?><li><?php echo ($vo['content']); ?></li><?php endforeach; endif; ?>
                    </ol>
                </article>
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
        <script type="text/javascript" src="/panxu/Public/Home/people/js/about_people.js"></script>
</body>

</html>