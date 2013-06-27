<?if($elements['views_x_topnews-block']):?>
<?=render($elements['views_x_topnews-block']);?>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-middle">
    <div class="row-fluid">
        <div class="span4">
            <a target="_blank" href="http://nordfx-chinese.com/?id=730026"><img src="/sites/all/themes/wallstcn/ads/ad_nordfx.gif" alt=""></a>
        </div>
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
        <?if(0):?>
        <div class="span4">
            <script type="text/javascript">
              var ord = window.ord || Math.floor(Math.random() * 1e16);
              document.write('<script type="text/javascript" src="http://ad.doubleclick.net/N6105/adj/G-wallstreetcn.com/banc;sz=230x60;ord=' + ord + '?"><\/script>');
            </script>
            <noscript>
            <a href="http://ad.doubleclick.net/N6105/jump/G-wallstreetcn.com/banc;sz=230x60;ord=[timestamp]?">
            <img src="http://ad.doubleclick.net/N6105/ad/G-wallstreetcn.com/banc;sz=230x60;ord=[timestamp]?" width="230" height="60" />
            </a>
            </noscript>
            <?if(0):?>
            <a target="_blank" href="/contact"><img src="/sites/all/themes/wallstcn/ads/ad_weixin.gif" alt=""></a>
            <?endif?>
        </div>
        <div class="span4 right-align">
            <script type="text/javascript">
              var ord = window.ord || Math.floor(Math.random() * 1e16);
              document.write('<script type="text/javascript" src="http://ad.doubleclick.net/N6105/adj/G-wallstreetcn.com/hantecfx;sz=230x60;ord=' + ord + '?"><\/script>');
            </script>
            <noscript>
            <a href="http://ad.doubleclick.net/N6105/jump/G-wallstreetcn.com/hantecfx;sz=230x60;ord=[timestamp]?">
            <img src="http://ad.doubleclick.net/N6105/ad/G-wallstreetcn.com/hantecfx;sz=230x60;ord=[timestamp]?" width="230" height="60" />
            </a>
            </noscript>
            <?if(0):?>
            <a target="_blank" href="/contact"><img src="/sites/all/themes/wallstcn/ads/ad_sponsor.gif" alt=""></a>
            <?endif?>
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
