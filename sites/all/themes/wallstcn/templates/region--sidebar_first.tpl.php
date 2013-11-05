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
            <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_top_ad_hit_2&url=http://www.svsfx.com.cn/2013815/"><img src="/sites/all/themes/wallstcn/ads/svsfx.gif" alt=""></a>
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
        <div class="active item"  data-probability="50">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/index_left_top_ad_1_fxcm.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/index_left_top_ad_1_fxcm.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
            </div>
        </div>
        <div class="active item">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.swf" type="application/x-shockwave-flash" width="336" wmode="transparent"></embed></object>
            </div>
        </div>
        <?if(0):?>
        <div class="item">
            <div style="margin:0 auto;">
            <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_top_ad_hit_2&url=http://www.svsfx.com.cn/2013815/"><img src="/sites/all/themes/wallstcn/ads/index_left_top_ad_2_svsfx.gif" alt=""></a>
            </div>
        </div>
        <div class="item">
            <div style="height:280px;margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="280" width="336"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/CFBAGREY_336x280px_chin_UA0d8.swf" /><embed height="280" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/CFBAGREY_336x280px_chin_UA0d8.swf" type="application/x-shockwave-flash" width="336"></embed></object>
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
        <div class="active item">
            <a target="_blank" href="/sponsor"><img src="/sites/all/themes/wallstcn/ads/sponsor_fxcm.jpg" alt=""></a>
        </div>
        <div class="item">
            <a target="_blank" href="/sponsor"><img src="/sites/all/themes/wallstcn/ads/sponsor_ironfx.jpg" alt=""></a>
        </div>
        <div class="item">
            <a target="_blank" href="/sponsor"><img src="/sites/all/themes/wallstcn/ads/sponsor_svsfx.jpg" alt=""></a>
        </div>
    </div>
</div>
</div>
<?endif?>


<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div class="random-ad" style="margin-bottom:0;">
        <div class="carousel-inner">
            <div class="active item"  data-probability="30">
                <div style="width:336px;margin:0 auto">
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_middle1_ad_hit_1&url=http://www.119gold.com/activity/moni/?referer=7003"><img src="/sites/all/themes/wallstcn/ads/index_left_middle1_ad_1_offpic2.jpeg" alt=""></a>
                    <?if(0):?>
                    <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_middle1_ad_hit_1&url=http://www.forexct.com/pr/fcity/forexct.htm?SerialId=1066233"><img src="/sites/all/themes/wallstcn/ads/index_left_middle1_ad_1_offpic2.jpeg" alt=""></a>
                    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <?endif?>
                </div>
            </div>
            <?if(0):?>
            <div class="item">
                <ins class="adsbygoogle"
                    style="display:inline-block;width:336px;height:280px"
                    data-ad-client="ca-pub-0869270234052789"
                    data-ad-slot="2911844489"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <?endif?>
        </div>
    </div>
</div>
<?endif?>

<?if($is_front && $elements['views_x_comments-block']):?>
<?=render($elements['views_x_comments-block'])?>
<?endif?>

<div class="page-header">
    <a href="http://weibo.com/wallstreetcn" class="more pull-right" target="_blank">MORE»</a>
    <h3>最新微博</h3>
</div>
<div class="iframe-box" data-width="100%" data-height="800" data-class="share_self"  data-frameborder="0" data-scrolling="no" data-src="http://widget.weibo.com/weiboshow/index.php?language=&amp;width=0&amp;height=800&amp;fansRow=2&amp;ptype=1&amp;speed=0&amp;skin=1&amp;isTitle=0&amp;noborder=0&amp;isWeibo=1&amp;isFans=0&amp;uid=1875034341&amp;verifier=7ef13898&amp;dpc=1">
<?if(0):?>
<iframe width="100%" height="800" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&amp;width=0&amp;height=800&amp;fansRow=2&amp;ptype=1&amp;speed=0&amp;skin=1&amp;isTitle=0&amp;noborder=0&amp;isWeibo=1&amp;isFans=0&amp;uid=1875034341&amp;verifier=7ef13898&amp;dpc=1"></iframe>
<?endif?>
</div>


<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
        <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_middle2_ad_hit_1&url=http://xianguo.com/section/9163D6A8FF6494B79424131CF7BA0D55"><img src="/sites/all/themes/wallstcn/ads/index_left_middle2_ad_1_xianguo.png" alt=""></a>
    </div>
</div>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
        <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=index_left_middle3_ad_hit_1&url=http://www.forexct.com/pr/fcity/forexct.htm?SerialId=1066233"><img src="/sites/all/themes/wallstcn/ads/index_left_middle3_ad_1_forexct.jpg" alt=""></a>
    </div>
</div>
<?endif?>

<?if(isset($elements['views_x_tags-block']) && $elements['views_x_tags-block']):?>
<?=render($elements['views_x_tags-block'])?>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="336" height="406"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/index_left_bottom_ad_1_aefc.swf" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/index_left_bottom_ad_1_aefc.swf" type="application/x-shockwave-flash" width="336" height="406"></embed></object>
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
