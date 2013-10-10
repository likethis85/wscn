<div id="wrapper" class="livenews-channel">
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
                    <?if(0):?>
                    <img alt="华尔街见闻新版上线" src="/sites/all/themes/wallstcn/banner.jpg" />
                    <?endif?>
                    <?if(variable_get('site_ad')):?>
<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-0869270234052789"
     data-ad-slot="0299947861"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

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
                <?php print $messages; ?>

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
                <a target="_blank" href="http://www.sojex.cn"><img src="/sites/all/themes/wallstcn/ads/KD_BANNER.png" alt=""></a>
                </div>


                <div class="ad-box ad-side">
                <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-0869270234052789"
                     data-ad-slot="7550994990"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
<!--
<script type="text/javascript">
/*侧栏*/
var cpro_id = "u1349094";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>-->
                </div>
                <?endif?>

                <?if(0 && variable_get('site_ad')):?>
                <div class="ad-box ad-side">
                <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-0869270234052789"
                     data-ad-slot="7550994990"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                </div>
                <?endif?>

                <div class="page-header header-red">
                    <h3>经济日历</h3>
                </div>

                <div class="iframe-box" data-src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai" data-width="100%" data-height="400" data-frameborder="0" data-scrolling="no">
                <?if(0):?>
                <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai" width="100%" height="400" frameborder="0" scrolling="no"  ></iframe>
                <?endif?>
                </div>

                <?if(variable_get('site_ad')):?>
                <div class="ad-box ad-side">
                <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-0869270234052789"
                     data-ad-slot="9265550449"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                </div>
                <?endif?>

                <?if(0):?>
                <div class="page-header header-red">
                    <h3>最新市场行情</h3>
                </div>
                <iframe frameborder="0" scrolling="no" height="287" width="300" allowtransparency="true" marginwidth="0" marginheight="0" src="http://tools.cn.forexprostools.com/market_quotes.php?tab_1=1,2,3,5,7,9&tab_2=169,166,20,172,27,178&tab_3=8830,8849,8836,8862,8831,8988&tab_4=8880,8907,8900,8899,8886,8895&select_color=000000&default_color=0059B0"> </iframe><br /><div style="width:300"><span style="font-size: 11px;color: #333333;text-decoration: none;">市场行情由 <a href="http://cn.investing.com" target="_blank" style="font-size: 11px;color: #06529D; font-weight: bold;" class="underline_link">cn.investing.com</a> 提供。</span></div>
                </div>
                <?endif?>

                <?if(variable_get('site_ad')):?>
                <div class="ad-box ad-side">
<!-- G-wallstreetcn.com/24option -->
<script type="text/javascript">
  var ord = window.ord || Math.floor(Math.random() * 1e16);
  document.write('<script type="text/javascript" src="http://ad.doubleclick.net/N6105/adj/G-wallstreetcn.com/24option;sz=300x250;ord=' + ord + '?"><\/script>');
</script>
<noscript>
<a href="http://ad.doubleclick.net/N6105/jump/G-wallstreetcn.com/24option;sz=300x250;ord=[timestamp]?">
<img src="http://ad.doubleclick.net/N6105/ad/G-wallstreetcn.com/24option;sz=300x250;ord=[timestamp]?" width="300" height="250" />
</a>
</noscript>

                </div>
                <?endif?>
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
