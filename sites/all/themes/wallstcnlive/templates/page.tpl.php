<div id="wrapper">

    <header id="header">
    <?php if (!empty($logo)): //logo start?>
    <div class="container">
        <div class="row-fluid">
            <div class="span4"><h1>
                    <a class="logo" href="<?php print $front_page; ?>" title="<?php print $site_name ? $site_name : t('Home'); ?>">
                        <img src="<?=$logo?>" alt="<?php print $site_name ? $site_name : t('Home'); ?>" />
                    </a>
            </h1></div>
            <div class="span8">
                <div class="pull-right">
                    <img alt="华尔街见闻新版上线" src="/sites/all/themes/wallstcn/banner.jpg" />
                    <?if(0 && variable_get('site_ad')):?>
                    <script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
                    <script type="text/javascript">BAIDU_CLB_fillSlot("507799");</script>
                    <?endif?>
                </div>
            </div>
    </div>
    <?php endif; //logo end ?>

    <?=render($page['header']); ?>
    </header>

    <div id="main-content" class="container">

        <div class="row-fluid">

            <div class="span8"> 
                <?if($is_front):?>

                <?if($page['live_content']):?>
                <?=render($page['live_content'])?>
                <?endif?>

                <?else:?>

                <?$local_menu = menu_local_tasks();?>
                <?if($local_menu['tabs']['count'] > 1):?>
                <ul class="nav nav-pills">
                    <?=render($local_menu);?>
                </ul>
                <?endif?>
                <?=render($page['content']); ?>
                <?endif?>
            </div>


            <div class="span4">
                <?if(variable_get('site_ad')):?>
                <div class="ad-box ad-side">
                    <script type="text/javascript">
                        google_ad_client = "ca-pub-0869270234052789";
                        google_ad_slot = "3270919188";
                        google_ad_width = 336;
                        google_ad_height = 280;
                    </script>
                    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                </div>
                <?endif?>

                <div class="page-header header-red">
                    <h3>经济日历</h3>
                </div>

                <div class="iframe-box">
                <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai"  style=" border-width:0;  margin-bottom:-22px;z-index;-100;margin-top:-5px;" width="100%" height="400" frameborder="0" scrolling="no"  ></iframe>
                </div>

                <?if(variable_get('site_ad')):?>
                <div class="ad-box ad-side">
                    <script type="text/javascript">
                        google_ad_client = "ca-pub-0869270234052789";
                        google_ad_slot = "8382675565";
                        google_ad_width = 336;
                        google_ad_height = 280;
                    </script>
                    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                </div>
                <?endif?>

                <div class="page-header header-red">
                    <h3>最新市场行情</h3>
                </div>
                <div class="iframe-box">
                <iframe frameborder="0" scrolling="no" height="310" width="100%" allowtransparency="true" marginwidth="0" marginheight="0" src="http://tools.cn.forexprostools.com/market_quotes.php?tab_1=1,2,3,5,7,9&tab_2=169,166,20,172,27,178&tab_3=8830,8849,8836,8862,8831,8988&tab_4=8880,8907,8900,8899,8886,8895&select_color=000000&default_color=0059B0" style="margin-top:-17px;z-index;-100;"></iframe></div><h6 id="h-menu-products" class="selected">
                </div>

            </div>

        </div>
    </div>



</div>

<footer id="footer" class="footer">
<div class="container">
    <?=render($page['footer']); ?>
</div>
</footer>

<?=render($page['navigation']); ?>
