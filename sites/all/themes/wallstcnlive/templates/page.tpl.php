<header id="header">

    <div class="header-bg"></div>

    <?php if (!empty($logo)): //logo start?>
    <div class="container">
        <div class="header-title row-fluid">
            <div class="span4"><h1>
                    <a class="logo" href="<?php print $front_page; ?>" title="<?php print $site_name ? $site_name : t('Home'); ?>">
                        <img src="<?=$logo?>?v=1.0" alt="<?php print $site_name ? $site_name : t('Home'); ?>" />
                    </a>
            </h1></div>
            <div class="span8">
                <div class="pull-right">
                    <?if(0):?>
                    <img alt="华尔街见闻新版上线" src="/sites/all/themes/wallstcn/banner.jpg" />
                    <?endif?>
                    <?if(variable_get('site_ad')):?>
                    <div class="random-ad" style="margin-bottom:0;">
                        <div class="carousel-inner">
                            <div class="active item"  data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>100<?else:?>50<?endif;?>">
                                <div style="height:90px;margin:0 auto;">
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="90" width="728"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_mt4_1.swf" /><embed height="90" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_mt4_1.swf" type="application/x-shockwave-flash" width="728" wmode="transparent"></embed></object>
                                </div>
                            </div>

                            <div class="item"  data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>0<?else:?>50<?endif;?>">
                                <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:inline-block;width:728px;height:90px"
                                     data-ad-client="ca-pub-0869270234052789"
                                     data-ad-slot="7788817240"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                               </script>
                            </div>
                        </div>
                    </div>

                    <?endif?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; //logo end ?>

    <?=render($page['header']); ?>

</header>


<div id="wrapper" class="livenews-channel">

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
                    <!--
                    <div class="ad-box ad-side">
                        <a target="_blank" href="http://www.zsgjs.com/"><img src="/sites/all/themes/wallstcn/ads/__ads_wscn_live_zsgjs_1.jpg" alt=""></a>
                    </div> -->


                    <div class="ad-box ad-side">

                        <div class="random-ad" style="margin-bottom:0;">
                            <div class="carousel-inner">
                                <!--
                                <div class="item" data-probability="30">
                                    <div style="height:280px;margin:0 auto;">
                                        <IFRAME WIDTH="336" HEIGHT="280" MARGINWIDTH="0" MARGINHEIGHT="0" HSPACE="0" VSPACE="0" FRAMEBORDER="0" SCROLLING="no"
    SRC="http://pbid.fxdepo.com/engine?site=134351;size=336x280;linktarget=_blank;rnd=(randomNumber)"></IFRAME>
                                    </div>
                                </div>
                                -->
                                <div class="item"  data-probability="100">
                                    <ins class="adsbygoogle"
                                        style="display:inline-block;width:336px;height:280px"
                                        data-ad-client="ca-pub-0869270234052789"
                                        data-ad-slot="2911844489"></ins>
                                    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                                <!--
                                <div class="item" data-probability="50">
                                    <div style="height:280px;margin:0 auto;">
                                        <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_forexct_1&url=http://www.forexct.com/pr/fcity/forexct.htm?SerialId=1066233"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_forexct_1.jpg" alt="广告"></a>
                                    </div>
                                </div>

                                <div class="item"  data-probability="100">
                                    <IFRAME WIDTH="336" HEIGHT="280" MARGINWIDTH="0" MARGINHEIGHT="0" HSPACE="0" VSPACE="0" FRAMEBORDER="0" SCROLLING="no"
    SRC="http://pbid.fxdepo.com/engine?site=134351;size=336x280;linktarget=_blank;rnd=(randomNumber)"></IFRAME>
                                </div>-->

                            </div>
                        </div>

                        <?if(0):?>

                        <div class="random-ad" style="margin-bottom:0;">
                            <div class="carousel-inner">
                                <div class="item" data-probability="15">
                                    <div style="height:280px;margin:0 auto;">
                                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
                                    </div>
                                </div>

                                <div class="item" data-probability="15">
                                    <div style="height:280px;margin:0 auto;">
                                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_top_ad_3_CFBAGREY.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_top_ad_3_CFBAGREY.swf" type="application/x-shockwave-flash" width="336"></embed></object>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_xinwaihui_1&url=http://www.119gold.com/activity/moni/?referer=7002"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_xinwaihui_1.jpeg" alt=""></a>
                        <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <ins class="adsbygoogle"
                            style="display:inline-block;width:336px;height:280px"
                            data-ad-client="ca-pub-0869270234052789"
                            data-ad-slot="7550994990"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        <?endif?>
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

                    <div class="ad-box ad-side">
                        <a href="http://wallstreetcn.com/redirect.htm?type=index_left_middle1_ad_hit_1&amp;url=http://www.119gold.com/activity/moni/?referer=7002" target="_blank"><img alt="" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_middle1_ad_1_offpic2.jpeg"></a>

                        <a href="http://wallstreetcn.com/redirect.htm?type=live_left_middle2_ad_hit_1&amp;url=http://www.xinwaihui.com/?utm_source=hej&utm_medium=cpc&utm_term=hejnews&utm_content=textlink&utm_campaign=livenews" target="_blank"><img alt="" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/live_left_middle2_ad_1.jpeg"></a>


                    <?endif?>

                    <div class="ad-box ad-side">
                        <script src="http://markets.static.wallstreetcn.com/widget_side_v2.js?v=1" data-width="360" data-height="380"></script>
                    </div>

                    <div class="page-header header-red">
                        <h3>经济日历</h3>
                    </div>

                    <div class="iframe-box" data-src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai" data-width="100%" data-height="400" data-frameborder="0" data-scrolling="no">
                        <?if(0):?>
                        <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai" width="100%" height="400" frameborder="0" scrolling="no"  ></iframe>
                        <?endif?>
                    </div>


                    <?if(variable_get('site_ad')):?>
                    <?if(0):?>
                    <div class="ad-box ad-side">

                        <div class="random-ad" style="margin-bottom:0;">
                            <div class="carousel-inner">

                                <div class="active item" data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>80<?else:?>40<?endif;?>">
                                    <div style="height:280px;margin:0 auto;">
                                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_svsfx_2.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_svsfx_2.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
                                    </div>
                                </div>

                                <div class="item" data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>20<?else:?>10<?endif;?>">
                                    <div style="height:280px;margin:0 auto;">
                                        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_hantec_1.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_hantec_1.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
                                    </div>
                                </div>
                                <div class="item"  data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>0<?else:?>50<?endif;?>">
                                    <ins class="adsbygoogle"
                                        style="display:inline-block;width:336px;height:280px"
                                        data-ad-client="ca-pub-0869270234052789"
                                        data-ad-slot="2911844489"></ins>
                                    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?endif;?>
                    <div class="ad-box ad-side">
                        <div class="random-ad" style="margin-bottom:0;">
                            <div class="carousel-inner">
                                <!--
                                <div class="active item" data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>100<?else:?>50<?endif;?>">
                                    <div style="height:280px;margin:0 auto;">
                                        <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_xinwaihui_2&amp;url=http://www.xinwaihui.com/?utm_source=hej&utm_medium=cpc&utm_term=hejnews&utm_content=textlink&utm_campaign=livenews" target="_blank"><img alt="" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_live_xinwaihui_2.jpeg"></a>
                                    </div>
                                </div>

                                <div class="item"  data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>0<?else:?>50<?endif;?>">
                                    <ins class="adsbygoogle"
                                        style="display:inline-block;width:336px;height:280px"
                                        data-ad-client="ca-pub-0869270234052789"
                                        data-ad-slot="2911844489"></ins>
                                    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                                -->
                                <div class="active item" data-probability="100">
                                    <div style="height:280px;margin:0 auto;">
                                        <ins class="adsbygoogle"
                                            style="display:inline-block;width:336px;height:280px"
                                            data-ad-client="ca-pub-0869270234052789"
                                            data-ad-slot="2911844489"></ins>
                                        <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?endif?>

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
