<?if($elements['views_x_topnews-block']):?>
<?=render($elements['views_x_topnews-block']);?>
<?endif?>

<div class="<?=$classes;?>" <?=$attributes;?>>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-middle">
    <div class="row-fluid">

        <div class="span4">
            <div class="item">
                <a target="_blank" href="http://nordfx-chinese.com/?id=730026"><img src="/sites/all/themes/wallstcn/ads/ad_nordfx.gif" alt=""></a>
            </div>

        </div>
        <?if(0): //google ad?>
        <div class="span4">
            <div class="item">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="234" height="60"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/ad_forexct0822.swf" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/ad_forexct0822.swf" type="application/x-shockwave-flash" width="234" height="60"></embed></object>
            </div>
        </div>

        <div class="span4">
<div class="random-ad">
    <div class="carousel-inner">
        <div class="active item">
            <a target="_blank" href="http://www.svsfx.com.cn/2013815/"><img src="/sites/all/themes/wallstcn/ads/ad_svsfx_new_0923.gif" alt=""></a>
        </div>
        <div class="item">
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="234" height="60"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/ad_toty_new_1008.swf" /><embed pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/ad_toty_new_1008.swf" type="application/x-shockwave-flash" width="234" height="60"></embed></object>
        </div>
    </div>
</div>
        </div>
    <?endif?>

        <div class="span8 right-align">

            <div class="random-carousel">
                <div class="carousel-inner">
                    <div class="active item  right-align">
                        <a target="_blank" href="http://open.yuedu.163.com/?act=rdwst_20130916_01" style="float:right;"><img src="/sites/all/themes/wallstcn/ads/ad_163yun.jpg" alt=""></a>
                    </div>
                    <?if(0): //google ad?>
                    <div class="item right-align">
                        <a target="_blank" href="http://www.myzaker.com/" style="float:right;"><img src="/sites/all/themes/wallstcn/ads/ad_zaker.jpg" alt=""></a>
                    </div>
                    <?endif?>
                </div>
            </div>
        </div>

        <?if(0): ?>
        <div class="span8">
            <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:468px;height:60px"
                 data-ad-client="ca-pub-0869270234052789"
                 data-ad-slot="5114810965"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <?endif?>

    </div>
</div>
<?endif?>

<?if(0 && variable_get('site_ad')):?>
<div class="ad-box">
<script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
<script type="text/javascript">BAIDU_CLB_fillSlot("507800");</script>
</div>
<?endif?>


<?if($elements['views_x_recommand-block']):?>
<?=render($elements['views_x_recommand-block']);?>
<?endif?>


<?if($elements['views_x_recent-block']):?>
<?=render($elements['views_x_recent-block']);?>
<?endif?>

</div><!--drupal index content standard div end-->
