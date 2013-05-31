<?if(variable_get('site_ad')):?>
<div class="ad-box">
    <script type="text/javascript">
        google_ad_client = "ca-pub-0869270234052789";
        google_ad_slot = "3270919188";
        google_ad_width = 300;
        google_ad_height = 250;
    </script>
    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
<?endif?>

<div class="social-icons well well-small media-list">
    <div class="row-fluid">
        <div class="span6">
            <div class="media">
                <a class="pull-left" href="http://weibo.com/wallstreetcn" target="_blank">
                    <img alt="华尔街见闻微博官方帐号" src="/sites/all/themes/wallstcn/css/img/weibo.png" />
                </a>
                <div class="media-body">
                    <p class="media-heading"><a href="http://weibo.com/wallstreetcn" target="_blank">新浪微博</a></p>
                    <div>
                        @华尔街见闻
                    </div>
                </div>
            </div>

        </div><!--span6 end -->
        <div class="span6">
            <div class="media">
                <a class="pull-left" href="/rss.xml">
                    <span class="icon-rss"></span>
                </a>
                <div class="media-body">
                    <p class="media-heading"><a href="/rss.xml">RSS</a></p>
                    <div>
                        订阅获得最新资讯
                    </div>
                </div>
            </div>

        </div><!--span6 end -->
    </div>
    <div class="row-fluid">
        <div class="span6">
            <div class="media">
                <a class="pull-left" href="http://feedburner.google.com/fb/a/mailverify?uri=wallstreetcn&loc=en_US" target="_blank">
                    <span class="icon-envelope"></span>
                </a>
                <div class="media-body">
                    <p class="media-heading"><a href="">邮件订阅</a></p>
                    <div>
                        每天免费深度文章
                    </div>
                </div>
            </div>
        </div><!--span6 end -->
        <div class="span6">
            <div class="media">
                <a class="pull-left" href="http://m.<?=variable_get('site_domain')?>/" target="_blank">
                    <span class="icon-mobile-phone"></span>
                </a>
                <div class="media-body">
                    <p class="media-heading"><a href="http://m.<?=variable_get('site_domain')?>/">Mobile移动版</a></p>
                    <div>
                        随时随地手机查看
                    </div>
                </div>
            </div>

        </div><!--span6 end -->
    </div><!--row end -->

    <div class="row-fluid">
        <div class="span6">
            <div class="media">
                <a class="pull-left weixin" href="#footer">
                    <img alt="" src="/sites/all/themes/wallstcn/css/img/weixin.png" />
                </a>
                <div class="media-body">
                    <p class="media-heading weixin"><a href="#footer">微信公众帐号</a></p>
                    <div>
                        wallstreetcn
                    </div>
                </div>
            </div>
        </div><!--span6 end -->
        <div class="span6">
            <div class="media">
                <a class="pull-left weixin" href="#footer">
                    <span class="icon-qrcode"></span>
                </a>
                <div class="media-body weixin">
                    <div>
                        <a href="#footer">点击查看二维码</a>
                    </div>
                </div>
            </div>
        </div><!--span6 end -->
    </div><!--row end -->
</div><!-- social end-->

<?if(variable_get('site_ad')):?>
<div class="ad-box">
    <script type="text/javascript">
        google_ad_client = "ca-pub-0869270234052789";
        google_ad_slot = "8382675565";
        google_ad_width = 300;
        google_ad_height = 250;
    </script>
    <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

</div>
<?endif?>

<?if($elements['views_x_click-block']):?>
<?=render($elements['views_x_click-block'])?>
<?endif?>

<div class="page-header">
    <a href="http://weibo.com/wallstreetcn" class="more pull-right" target="_blank">更多</a>
    <h3>最新微博</h3>
</div>
<iframe width="100%" height="800" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=800&fansRow=2&ptype=1&speed=0&skin=1&isTitle=0&noborder=0&isWeibo=1&isFans=0&uid=1875034341&verifier=7ef13898&dpc=1"></iframe>

<div class="page-header header-brown">
    <h3>经济日历</h3>
</div>
<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai"  style=" border-width:0;  margin-bottom:-22px;z-index;-100;margin-top:-5px;" width="100%" height="400" frameborder="0" scrolling="no"  ></iframe>
