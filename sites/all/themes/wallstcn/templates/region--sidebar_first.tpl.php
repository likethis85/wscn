<?if(0 && variable_get('site_ad')):?>
<div class="ad-box">
    <div class="row-fluid">
        <div class="span6">
            <a target="_blank" href="http://www.wfgold.com/"><img src="http://wallstreetcn.com/ckuploadimg/images/side_ad_wfgold0523.gif" alt=""></a>
        </div><!--span6 end -->
        <div class="span6 right-align">
            <a target="_blank" href="http://www.igoldhk.com/?utm_source=wallstreetcn&utm_medium=banner&utm_term=160x50&utm_content=award_first&utm_campaign=all-index"><img src="http://wallstreetcn.com/ckuploadimg/images/ad_igold_0508.gif" alt=""></a> 
        </div><!--span6 end -->
    </div>
</div>
<?endif?>

<?include 'box-icons.php'?>

<?if(0 && variable_get('site_ad')):?>
<div class="ad-box ad-side">
    <div style="width:336px;margin:0 auto">
        <script type="text/javascript">
            google_ad_client = "ca-pub-0869270234052789";
            google_ad_slot = "2911844489";
            google_ad_width = 336;
            google_ad_height = 280;
            google_ad_client = "ca-pub-0869270234052789";
            google_ad_slot = "2911844489";
            google_ad_width = 336;
            google_ad_height = 280;
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div>
</div>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side">
    <div style="width:336px;margin:0 auto">
        <a href="http://www.sinolending.com/" target="_blank"><img src="/sites/all/themes/wallstcn/ads/ad_sinolending.jpg" alt="" /></a>
    </div>
</div>
<?endif?>

<?if($elements['views_x_click-twodays']):?>
<?=render($elements['views_x_click-twodays'])?>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-side ad-margin-top">
    <div style="width:336px;margin:0 auto">
     <script type="text/javascript">
         google_ad_client = "ca-pub-0869270234052789";
         google_ad_slot = "2352258047";
         google_ad_width = 336;
         google_ad_height = 280;
         google_ad_client = "ca-pub-0869270234052789";
         google_ad_slot = "2352258047";
         google_ad_width = 336;
         google_ad_height = 280;
    </script>
    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

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

<?if($is_front):?>
<div class="page-header">
    <h2>投放广告</h2>
</div>
<div class="side-box">
    <div class="row-fluid">
        <div class="span12">
            <a href="/contact">
                <img class="lazy" src="/sites/all/themes/wallstcn/placeholder.gif" data-original="/sites/all/themes/wallstcn/css/img/advertising.gif" />
                <noscript><img alt="" class="" src="/sites/all/themes/wallstcn/css/img/advertising.gif"></noscript>
            </a>
        </div>
    </div>
</div>
<?endif?>

<?if($elements['views_x_tags-block']):?>
<?=render($elements['views_x_tags-block'])?>
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
