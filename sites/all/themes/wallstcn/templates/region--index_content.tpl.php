<?if($elements['views_x_topnews-block']):?>
<?=render($elements['views_x_topnews-block']);?>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box ad-middle">
    <div class="row-fluid">
        <div class="span4">
            <a target="_blank" href="http://nordfx-chinese.com/promo/bonus_deposit.html?id=730026"><img src="http://wallstreetcn.com/ckuploadimg/images/nordfx.gif" alt=""></a>
        </div>
        <div class="span4">
            <!-- G-wallstreetcn.com/ufxmarkets -->
            <script type="text/javascript">
                var ord = window.ord || Math.floor(Math.random() * 1e16);
                document.write('<script type="text/javascript" src="http://ad.doubleclick.net/N6105/adj/G-wallstreetcn.com/ufxmarkets;sz=230x60;ord=' + ord + '?"><\/script>');
            </script>
            <noscript>
                <a href="http://ad.doubleclick.net/N6105/jump/G-wallstreetcn.com/ufxmarkets;sz=230x60;ord=[timestamp]?">
                    <img src="http://ad.doubleclick.net/N6105/ad/G-wallstreetcn.com/ufxmarkets;sz=230x60;ord=[timestamp]?" width="230" height="60" />
                </a>
            </noscript>
        </div>
        <div class="span4 right-align">
            <a target="_blank" href="http://t.wallstreetcn.com/weixin"><img src="http://wallstreetcn.com/ckuploadimg/images/follow_us_onweixin.gif" alt=""></a>
            <?if(0):?>
            <a target="_blank" href="http://www.maslink.com/sh/lunbotu/bk/index.html"><img src="http://pic.yupoo.com/panzhiyao/CPw2EA0t/RKhAe.gif" alt=""></a>
            <?endif?>
        </div>
    </div>
</div>
<?endif?>

<?if($elements['views_x_recommand-block']):?>
<?=render($elements['views_x_recommand-block']);?>
<?endif?>


<?if($elements['views_x_recent-block']):?>
<?=render($elements['views_x_recent-block']);?>
<?endif?>
