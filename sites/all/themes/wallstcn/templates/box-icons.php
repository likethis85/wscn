<div class="social-icons well well-small media-list">
    
    <div class="social-navbar">
        <span class="social-nav social-nav-active" id="social_swith">
            <img class="social-nav-img-normal" src="/sites/all/themes/wallstcn/css/img/social.png" />
            <img class="social-nav-img-active" src="/sites/all/themes/wallstcn/css/img/social-active.png" />
            实时行情
        </span>
        <span class="social-nav" id="livenews_swith" >
            <img class="social-nav-img-normal" src="/sites/all/themes/wallstcn/css/img/livenews.png" />
            <img class="social-nav-img-active" src="/sites/all/themes/wallstcn/css/img/livenews-active.png" />
            <a href="http://live.wallstreetcn.com/" target="_blank">实时新闻</a>
        </span>  
        
    </div>


    <div class="social-content">
        
        <div id="social_block" style="display:block;">
            <div style="margin-left:-20px;margin-top:-20px;">
                <script src="http://markets.static.wallstreetcn.com/widget_side_v1.js?v=1" data-width="360px" data-height="290px"></script>
            </div>
        </div>
        <div class="row-fluid" id="livenews_block" style="display:none;">
        
            <div id="realtime-news" style="">
                <ul>
                    <li>正在载入...</li>
                </ul>               
            </div>
            <a id="realtime-news-more" href="http://live.wallstreetcn.com/" target="_blank">more &gt;&gt;</a>
        </div>
     

        <?if(0):?>
        <div id="social_block" style="display:none;">
            <div class="row-fluid">
                <div class="span6">
                    <div class="media">
                        <a class="pull-left icon-img" href="http://weibo.com/wallstreetcn" target="_blank">
                            <i class="icon-weibo"></i>
                            <?if(0):?>
                            <img alt="华尔街见闻微博官方帐号" src="/sites/all/themes/wallstcn/css/img/weibo.png" />
                            <?endif?>
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
                        <a class="pull-left weixin  icon-img" href="#footer">
                            <?if(0):?>
                            <img alt="" src="/sites/all/themes/wallstcn/css/img/weixin.png" />
                            <?endif?>
                            <i class="icon-qrcode"></i>
                        </a>
                        <div class="media-body">
                            <p class="media-heading weixin"><a href="#footer">微信公众帐号</a></p>
                            <div>
                                wallstreetcn
                            </div>
                        </div>
                    </div>
                </div><!--span6 end -->

            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="media">
                        <a class="pull-left  icon-img" href="http://feedburner.google.com/fb/a/mailverify?uri=wallstreetcn&loc=en_US" target="_blank">
                            <span class="icon-envelope"></span>
                        </a>
                        <div class="media-body">
                            <p class="media-heading"><a href="http://feedburner.google.com/fb/a/mailverify?uri=wallstreetcn&loc=en_US" target="_blank">邮件订阅</a></p>
                            <div>
                                每天免费文章
                            </div>
                        </div>
                    </div>
                </div><!--span6 end -->


                <div class="span6">
                    <div class="media">
                        <a class="pull-left  icon-img" href="/rss.xml">
                            <span class="icon-rss"></span>
                        </a>
                        <div class="media-body">
                            <p class="media-heading"><a href="/rss.xml">RSS</a></p>
                            <div>
                                订阅最新资讯
                            </div>
                        </div>
                    </div>
                </div><!--span6 end -->


            </div><!--row end -->

            <div class="row-fluid">
                <div class="span6">
                    <div class="media">
                        <a class="pull-left icon-img add-tofavor" href="#footer">
                            <span class="icon-star-empty"></span>
                        </a>
                        <div class="media-body add-tofavor">
                            <p class="media-heading"><a href="http://m.<?=variable_get('site_domain')?>/">加入收藏</a></p>
                            <div>
                                方便每日查看
                            </div>
                        </div>
                    </div>
                </div><!--span6 end -->
                <div class="span6">
                    <div class="media">
                        <a class="pull-left  icon-img" href="http://m.<?=variable_get('site_domain')?>/" target="_blank">
                            <span class="icon-mobile-phone"></span>
                        </a>
                        <div class="media-body">
                            <p class="media-heading"><a href="http://m.<?=variable_get('site_domain')?>/">Mobile移动版</a></p>
                            <div>
                                随时随地浏览
                            </div>
                        </div>
                    </div>
                </div><!--span6 end -->
            </div><!--row end -->
        </div><!-- social end-->
        <?endif?>

    </div>

    

</div>
