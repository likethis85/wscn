<header id="header">

    <div class="header-bg"></div>

    <?php if (!empty($logo)): ?>

    <div class="container">

        <div class="header-title row-fluid">
            <!-- logo -->
            <div class="span4">
                <h1>
                    <a class="logo" href="<?=$front_page; ?>" title="华尔街见闻">
                        <img src="<?=$logo?>?v=1.0" alt="华尔街见闻" />
                    </a>
                </h1>
            </div>
            <!-- ads start -->
            <div class="span8">
                <div class="pull-right">
                    <?if(0):?>
                        <img alt="华尔街见闻微博官方帐号" src="/sites/all/themes/wallstcn/banner.jpg" />
                    <?endif?>

                <?if(0 && variable_get('site_ad')):?>
<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-0869270234052789"
     data-ad-slot="9607908946"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                <?endif?>
                <?if(variable_get('site_ad')):?>
                <div class="random-ad" style="margin-bottom:0;">
                    <div class="carousel-inner">
                        <!--
                        <div class="active item"  data-probability="25">
                            <div style="margin:0 auto;">
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="90" width="728"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_mt4_1.swf" /><embed height="90" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_mt4_1.swf" type="application/x-shockwave-flash" width="728"></embed></object>
                            </div>
                        </div>
                        -->
                        <div class="active item"  data-probability="50">
                            <div style="margin:0 auto;">
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="90" width="728"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_ibkr_1.swf" /><embed height="90" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_ibkr_1.swf" type="application/x-shockwave-flash" width="728"></embed></object>

                            </div>
                        </div>
                        <div class="item"  data-probability="50">
                            <div style="margin:0 auto;">
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="90" width="728"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_saxomarkets_1.swf" /><embed height="90" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_saxomarkets_1.swf" type="application/x-shockwave-flash" width="728"></embed></object>

                            </div>
                        </div>
                        <!--
                        <div class="item"  data-probability="0">
                            <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:728px;height:90px"
                                 data-ad-client="ca-pub-0869270234052789"
                                 data-ad-slot="7788817240"></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                           </script>
                        </div>
                        -->


                    </div>
                    <?endif?>
                </div>
            </div>
            <!-- ads end -->
        </div>
        <!-- row-fluid end -->
    </div>

    <?php endif; //logo end ?>


    <?=render($page['header']); ?>

</header>


<div id="wrapper">



    <div id="main-content" class="container">

        <div class="row-fluid">

            <div class="span8">
                <!-- 频道页面包屑导航 -->
                <?if($title && wscn_is_channel()):?>
                <ul class="breadcrumb"><li><a href="/" data-thmr="thmr_3">首页</a></li> › <li><a href="<?= $_SERVER['REQUEST_URI'] ?>" data-thmr="thmr_3"><?= $title;  ?> </a></li></ul>
                <?endif?>

                <?=$messages; ?>
                <?if($is_front):?>

                    <?if(isset($page['live_content']) && $page['live_content']):?>
                    <?=render($page['live_content'])?>
                    <?endif?>
                    <?if(isset($page['index_content']) && $page['index_content']):?>
                    <?=render($page['index_content']); ?>
                    <?endif?>

                <?else:?>

                    <? $item = menu_get_item(); if($item['tab_root'] != 'user/%'): ?>
                        <?$local_menu = menu_local_tasks();?>
                        <?if($local_menu['tabs']['count'] > 1):?>
                        <ul class="nav nav-pills">
                            <?=render($local_menu);?>
                        </ul>
                        <?endif?>
                    <?else:?>
                        <? include 'user-menu.php'; ?>
                    <?endif?>
                    <!-- 频道页标题
                    </?if($title && wscn_is_channel()):?>
                    <div class="page-header header-red top-header">
                        <h2></h2>?=$title?></h2>
                    </div>
                    </?endif?>
                    -->

                    <?
                        $type = '';
                        if (isset($_GET['type'])) {
                            $type = trim($_GET['type']);
                        } else {
                            if($item['tab_root'] == 'user/%') {
                                $type = 'focus';
                            }
                        }

                        if ($type == 'focus') {
                            include 'user-focus.php';
                        } elseif ($type == 'comment') {
                            include 'user-comment.php';
                        } elseif ($type == 'favorites') {
                            include 'user-favorites.php';
                        } elseif ($type == 'feedback') {
                            include 'user-feedback.php';
                        } else {
                            echo render($page['content']);
                        }

                    ?>


                <?endif?>
            </div>


            <div class="span4">
                <?if($page['sidebar_first']):?>
                <?=render($page['sidebar_first']); ?>
                <?endif?>
            </div>

        </div>
    </div>



</div>

<div id="mark-download-app">
    <a href="https://itunes.apple.com/cn/app/hua-er-jie-jian-wen/id738227477?mt=8">
        <img src="/sites/all/themes/wallstcn/css/img/mark-download-app.png"></img>
    </a>
    <a href="javascript:;" class="close">关闭</a>
</div>


<footer id="footer" class="footer">
<div class="container">
    <?=render($page['footer']); ?>
</div>
</footer>

<?=render($page['navigation']); ?>
