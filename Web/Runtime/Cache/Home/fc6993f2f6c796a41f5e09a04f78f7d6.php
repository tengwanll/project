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
    <link rel="stylesheet" type="text/css" href="/panxu/Public/Home/about/css/about.css">
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
                <header class="title">
                    <h3>公司介绍</h3>
                    <h4>Company introduction</h4>
                    <div class="pr"></div>
                </header>
                <div class="section wrap">
                    <div class="photo">
                        <img src="/panxu/Public/Home/about/pic/comp_img.jpg">
                        <p>公司外景图</p>
                    </div>
                    <article>
                        <p>辽宁佰昊生物科技有限公司是东北最大的第三方生物医学研发及转化平台，与辽宁省科技厅共建了辽宁省免疫生物公共技术服务 平台，同时与厦门大学药学院合作，建立了生物研发人才培训中心。佰昊一家致力于将生物技术在健康产业应用和转化的高科技企业 公司拥有生物信息学、基因组学、蛋白质组学和细胞学四大技术团队，公司以数位国家 “千人计划” 归国教授团队为核心组建，与国 内各大科研机构、医院、政府检测部门、生物企业合作。并得到了厦门大学、美国加州大学圣地亚哥医学院、美国圣地亚哥 艾凯奇细 胞生物技术股份有限公司、广州华南生物芯片研究中心等国内一流科研机构的鼎力支持和加盟。</p>
                        <p> 公司成立于2015年，总部位于辽宁省中国药都创新产业园，一期占地面积3000多平方米。建设了1200多平米符合国际，国内标 准的基因组学实验室,蛋白组学实验室，标准万级无菌细胞实验室，实验室可同时容纳100人共同进行操作实验。招募了一批有活力的 生物高层次科研人才，硕士及以上学历人员占50％以上，本科及以上学历人员占95％。公司依托沈阳汇佰生物科技有限公司，精锐的 产品销售，共同搭建技术推广平台。
                        </p>
                    </article>
                </div>
            </div>
            <div class="row">
                <header class="title">
                    <h3>核心技术团队顾问</h3>
                    <h4>Core technical team Consultant</h4>
                    <div class="pr"></div>
                </header>
                <div class="section wrap team">
                    <ul class="list-unstyled">
                    <?php if(is_array($employees)): foreach($employees as $key=>$employee): ?><li>
                            <a href="<?php echo U('Home/people/index',array('id'=>$employee['id']));?>">
                                <img src="/panxu/Public/Home/about/pic/avatar_01_img.jpg">
                                <h3 class="name"><?php echo ($employee['name']); ?></h3>
                                <p><?php echo ($employee['description']); ?></p>
                            </a>
                        </li><?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <header class="title spa">
                    <h3>生物研发人才培训中心</h3>
                    <h4>Biological R & D personnel training center</h4>
                    <div class="pr"></div>
                </header>
                <div class="section wrap biological">
                    <ul class="list-unstyled">
                        <?php if(is_array($training)): foreach($training as $key=>$vo): ?><li>
                            <img src="/panxu/Public/Home/about/pic/Biological_01_img.jpg">
                            <section>
                                <h4><?php echo ($vo['title']); ?></h4>
                                <p><?php echo ($vo['content']); ?>
                                </p>
                            </section>
                        </li><?php endforeach; endif; ?>
                    </ul>
                </div>
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
    <script type="text/javascript" src="/panxu/Public/Home/about/js/about.js"></script>
</body>

</html>