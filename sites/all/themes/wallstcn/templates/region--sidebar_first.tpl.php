<div class="<?=$classes;?>" <?=$attributes;?>>
<?include 'box-icons.php'?>

<?if(0 && variable_get('site_ad')):?>
<div class="ad-box ad-side">
<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-0869270234052789"
     data-ad-slot="2911844489"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<?endif?>

<?if(0 && variable_get('site_ad')): //slider ads?>
<div class="ad-box ad-side">
<div class="carousel slide" style="margin-bottom:0;">
    <div class="carousel-inner">
        <div class="active item">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/fxcm.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/fxcm.swf" type="application/x-shockwave-flash" width="336"></embed></object>
            </div>
        </div>
        <div class="item">
            <div style="margin:0 auto;">
            <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_top_ad_hit_2&url=http://www.svsfx.com.cn/2013815/"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/svsfx.gif" alt=""></a>
            </div>
        </div>

    </div>
</div>
</div>
<?endif?>

<?if(variable_get('site_ad')): //slider ads?>
<div class="ad-box ad-side">
<div class="random-ad" style="margin-bottom:0;">
    <div class="carousel-inner">

        <?if(0):?>
        <div class="active item"  data-probability="70">
            <div style="margin:0 auto;">
                <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_xinwaihui_1&url=http://www.xinwaihui.com/?utm_source=hej&utm_medium=cpc&utm_term=hej336280&utm_content=logolink&utm_campaign=hegnmj"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_xinwaihui_1.jpg" alt=""></a>
            </div>

        </div>
        <?endif?>

        <?if(0):?>
        <div class="item" data-probability="15">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
            </div>
        </div>
        <?endif?>

        <div class="active item" data-probability="70">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_fxcm_1.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_fxcm_1.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
            </div>
        </div>

        <div class="item" data-probability="30">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_cfbagrey_1.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_cfbagrey_1.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
            </div>
        </div>

        <?if(0):?>
        <div class="item">
            <div style="margin:0 auto;">
            <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_top_ad_hit_2&url=http://www.svsfx.com.cn/2013815/"><img src="/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.gif" alt=""></a>
            </div>
        </div>


        <?endif?>

    </div>
</div>
</div>
<?endif?>

<?if(0 && variable_get('site_ad')):?>
<div class="ad-box ad-side">
    <div style="width:336px;margin:0 auto">
        <a href="http://www.sinolending.com/" target="_blank"><img src="/sites/all/themes/wallstcn/ads/ad_sinolending.gif" alt="" /></a>
    </div>
</div>
<?endif?>

<?if(isset($elements['views_x_click-twodays']) && $elements['views_x_click-twodays']):?>
<?=render($elements['views_x_click-twodays'])?>
<?endif?>

<?if($is_front):?>
<div class="ad-box">
<div class="carousel slide">
    <div class="carousel-inner">
        <!--
        <div class="active item">
            <a target="_blank" href="/sponsor"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/sponsor_ironfx.jpg" alt=""></a>
        </div>
        -->
        <div class="active item">
            <a target="_blank" href="/sponsor"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/sponsor_fxcm.jpg" alt=""></a>
        </div>
        <div class="item">
            <a target="_blank" href="/sponsor"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/sponsor_svsfx.jpg" alt=""></a>
        </div>
    </div>
</div>
</div>
<?endif?>


<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div class="random-ad" style="margin-bottom:0;">
        <div class="carousel-inner">
            <div class="active item"  data-probability="50">
                <div style="width:336px;margin:0 auto">
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_forexct_3&url=http://www.forexct.com/pr/fcity/forexct.htm?SerialId=1066233"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_forexct_3.jpg" alt=""></a>
                </div>
            </div>
            <!--
            <div class="item"  data-probability="30">
                <div style="width:336px;margin:0 auto">
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_ironfx_3&url=https://www.ironfx.cn/zh/register?utm_source=wallstreetcn728_90HPIB&utm_mediumwallstreetcn728_90HPIB&utm_campaign=wallstreetcn"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_ironfx_3.jpg" alt=""></a>
                </div>
            </div>
            -->
            <div class="item"  data-probability="20">
                <div style="width:336px;margin:0 auto">
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_nordfx_2&url=http://nordfx-chinese.com/?id=859276"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_nordfx_2.jpg" alt=""></a>
                </div>
            </div>
            <div class="item"  data-probability="30">
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
<?endif?>


<?if($is_front && $elements['views_x_comments-block']):?>
<?=render($elements['views_x_comments-block'])?>
<?endif?>

<!-- add -->


<div class="page-header">
    <a href="/discovery" class="more pull-right" target="_blank">MORE»</a>
    <h3>热门阅读</h3>
</div>

<div class="hot-news-sidebar">
    <div class="hot-news-sidebar-wrapper">

        <? $discovery_arr=get_discovery_item(); foreach($discovery_arr as $k => $e):?>
        <div class="hot-news-content">
            <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                <img src="<?=wscn_get_image_thumbnail($e['img'], 170, 110)?>" alt="<?=$e['title']?>" />
            </a>
            <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-title"><?=$e['title']?></a>
        </div>
        <?if(++$k%2 == 0):?><br style="clear: both;" /><?endif;?>
        <?endforeach;?>

    </div>
</div>


<!-- add end -->

<?if(0):?>
<div class="page-header">
    <a href="http://weibo.com/wallstreetcn" class="more pull-right" target="_blank">MORE»</a>
    <h3>最新微博</h3>
</div>
<div class="iframe-box" data-width="100%" data-height="800" data-class="share_self"  data-frameborder="0" data-scrolling="no" data-src="http://widget.weibo.com/weiboshow/index.php?language=&amp;width=0&amp;height=800&amp;fansRow=2&amp;ptype=1&amp;speed=0&amp;skin=1&amp;isTitle=0&amp;noborder=0&amp;isWeibo=1&amp;isFans=0&amp;uid=1875034341&amp;verifier=7ef13898&amp;dpc=1">
<?if(0):?>
<iframe width="100%" height="800" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&amp;width=0&amp;height=800&amp;fansRow=2&amp;ptype=1&amp;speed=0&amp;skin=1&amp;isTitle=0&amp;noborder=0&amp;isWeibo=1&amp;isFans=0&amp;uid=1875034341&amp;verifier=7ef13898&amp;dpc=1"></iframe>
<?endif?>
</div>
<?endif?>

<?if(variable_get('site_ad') && 0):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
        <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_middle2_ad_hit_1&url=http://xianguo.com/section/9163D6A8FF6494B79424131CF7BA0D55"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/index_left_middle2_ad_1_xianguo.png" alt=""></a>
    </div>
</div>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div class="random-ad" style="margin-bottom:0;">
        <div class="carousel-inner">
            <div class="active item"  data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>0<?else:?>0<?endif;?>">
                <div style="width:336px;margin:0 auto">
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_forexct_2&url=http://www.forexct.com/pr/fcity/forexct.htm?SerialId=1066233"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_forexct_2.jpg" alt=""></a>
                </div>
            </div>
            <div class="item" data-probability="<?if(time() > strtotime(date('Y-m-d') . ' 09:00:00') && time() < strtotime(date('Y-m-d') . ' 18:00:00')):?>0<?else:?>0<?endif;?>">
                <div style="width:336px;margin:0 auto">
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_xinwaihui_2&url=http://www.xinwaihui.com/?utm_source=hej&utm_medium=cpc&utm_term=hej_home&utm_content=textlink&utm_campaign=hejhonme1"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_xinwaihui_2.jpg" alt=""></a>
                </div>
            </div>
            <?if(time() < strtotime('2014-01-03 03:00:00') || time() > strtotime('2014-01-04 03:00:00')):?>
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
            <?else:?>
            <div class="item"  data-probability="100">
                <IFRAME WIDTH="336" HEIGHT="280" MARGINWIDTH="0" MARGINHEIGHT="0" HSPACE="0" VSPACE="0" FRAMEBORDER="0" SCROLLING="no"
    SRC="http://pbid.fxdepo.com/engine?site=134262;size=336x280;linktarget=_blank;rnd=(randomNumber)"></IFRAME>
            </div>
           <?endif;?>
        </div>
    </div>
</div>
<?endif?>

<?if(isset($elements['views_x_tags-block']) && $elements['views_x_tags-block']):?>
<?=render($elements['views_x_tags-block'])?>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="336" height="406"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_aefc_1.swf" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_aefc_1.swf" type="application/x-shockwave-flash" width="336" height="406"></embed></object>
    </div>
</div>
<?endif?>

<?if($is_front):?>
<div class="page-header">
    <h2>投放广告</h2>
</div>
<div class="side-box">
    <div class="row-fluid">
        <div class="span12">
            <a href="/contact">
                <img class="" src="/sites/all/themes/wallstcn/css/img/advertising.gif" width="360" />
            </a>
        </div>
    </div>
</div>
<?endif?>


<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
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
</div>
<?endif?>


<?if(0 && $is_front):?>
<div class="page-header">
    <h2>加入我们</h2>
</div>
<div class="ad-box">
    <div class="row-fluid">
        <div class="span12">
            <a href="/wanted"><img alt="" src="http://wallstreetcn.com/ckuploadimg/images/joinus.png" class="span12" /></a>
        </div>
    </div>
</div>
<?endif?>

</div><!--drupal standard div end-->
