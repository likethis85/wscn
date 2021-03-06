<div class="container <?=$classes;?>" <?=$attributes;?>>
    <div id="nav-area">
        <div class="row">
        <div class="span12">
            <div id="navbar" class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a href="http://<?=variable_get('site_domain')?>" class="brand <?=!empty($elements['system_main-menu']) ? 'mainsite-brand' : ''?>"><i class="icon-home"></i> 华尔街见闻</a>

                    <div class="nav-collapse collapse navbar-responsive-collapse">

                        <?if(isset($elements['system_main-menu']) && $elements['system_main-menu']):?>

                        <ul class="nav">
                            <li class="leaf first"><a class="bg-0" data-active-url="^/$" href="/" title="">首页</a></li>
                            <li class="leaf"><a class="bg-1" data-active-url="" href="http://live.wallstreetcn.com" title="市场直播系统" target="_blank">实时新闻</a></li>
                            <li class="leaf"><a class="bg-2" data-active-url="" href="http://markets.wallstreetcn.com" title="" target="_blank">实时行情</a></li>
                            <li class="leaf"><a class="bg-3" data-active-url="^/breakfast.*$" href="/breakfast" title="">见闻早餐</a></li>
                            <li class="leaf"><a class="bg-4" data-active-url="^/europe.*$" href="/europe" title="">欧洲</a></li>
                            <li class="leaf"><a class="bg-5" data-active-url="^/america.*$" href="/america" title="">美国</a></li>
                            <li class="leaf"><a class="bg-6" data-active-url="^/china.*$" href="/china" title="">中国</a></li>
                            <li class="leaf"><a class="bg-7" data-active-url="^/economy.*$" href="/economy" title="">经济</a></li>
                            <li class="leaf"><a class="bg-8" data-active-url="^/centralbank.*$" href="/centralbank" title="">央行</a></li>
                            <li class="leaf"><a class="bg-9" data-active-url="^/market.*$" href="/market" title="">市场</a></li>
                            <li class="leaf"><a class="bg-10" data-active-url="^/company.*$" href="/company" title="">公司</a></li>
                            <li class="leaf"><a class="bg-11" data-active-url="^/gold.*$" href="/gold" title="">黄金</a></li>
                            <li class="leaf"><a class="bg-12" data-active-url="^/discovery.*$" href="/discovery" title="">发现</a></li>
                            <!--
                            <li class="leaf last"><a class="bg-13" data-active-url="^/wanted.*$" href="/wanted">招聘</a></li>
                            -->
                        </ul>

                        <?endif?>

                        <?if(isset($elements['menu_menu-live-menu']) && $elements['menu_menu-live-menu']):?>

                        <ul class="nav">
                            <li class="first leaf"><a class="bg-1" data-active-url="^/$" href="/" title="">实时新闻</a></li>
                            <li class="leaf"><a class="bg-2" data-active-url="^/live-china.*$" href="/live-breaking" title="">要闻</a></li>

                            <li class="leaf has-sub-nav">
                                <a class="bg-3"  href="/live-areas" title="地区分类">地区<b class="caret"></b></a>
                                <ul class="sub-nav">
                                    <li><a href="/live-area?tid_1[]=9479">中国</a></li>
                                    <li><a href="/live-area?tid_1[]=9477">美国</a></li>
                                    <li><a href="/live-area?tid_1[]=9478">欧元区</a></li>
                                    <li><a href="/live-area?tid_1[]=9483">英国</a></li>
                                    <li><a href="/live-area?tid_1[]=9480">日本</a></li>
                                    <li><a href="/live-area?tid_1[]=9482">加拿大</a></li>
                                    <li><a href="/live-area?tid_1[]=9492">澳洲</a></li>
                                    <li><a href="/live-area?tid_1[]=9488&tid_1[]=9490&tid_1[]=9484&tid_1[]=9486&tid_1[]=9485&tid_1[]=9491&tid_1[]=9489">新兴市场</a></li>
                                </ul>
                            </li>

                            <li class="leaf has-sub-nav">
                                <a class="bg-4"  href="/live-bank" title="全球央行">全球央行<b class="caret"></b></a>
                                <ul class="sub-nav">
                                    <li><a href="/live-bank?tid_1[]=9479">中国央行</a></li>
                                    <li><a href="/live-bank?tid_1[]=9477">美联储</a></li>
                                    <li><a href="/live-bank?tid_1[]=9478">欧洲央行</a></li>
                                    <li><a href="/live-bank?tid_1[]=9483">英国央行</a></li>
                                    <li><a href="/live-bank?tid_1[]=9480">日本央行</a></li>
                                    <li><a href="/live-bank?tid_1[]=9482">加拿大央行</a></li>
                                    <li><a href="/live-bank?tid_1[]=9492">澳洲联储</a></li>
                                </ul>
                            </li>

                            <li class="leaf has-sub-nav">
                                <a class="bg-5"  href="/live-economy" title="经济数据">经济数据<b class="caret"></b></a>
                                <ul class="sub-nav">
                                    <li><a href="/live-economy?tid_1[]=9479">中国数据</a></li>
                                    <li><a href="/live-economy?tid_1[]=9477">美国数据</a></li>
                                    <li><a href="/live-economy?tid_1[]=9478">欧元区数据</a></li>
                                    <li><a href="/live-economy?tid_1[]=9483">英国数据</a></li>
                                    <li><a href="/live-economy?tid_1[]=9480">日本数据</a></li>
                                    <li><a href="/live-economy?tid_1[]=9482">加拿大数据</a></li>
                                    <li><a href="/live-economy?tid_1[]=9492">澳洲数据</a></li>
                                </ul>
                            </li>


                            <li class="leaf"><a class="bg-6" data-active-url="^/live-commodity.*$" href="/live-commodity" title="">商品期货</a></li>
                            <li class="leaf"><a class="bg-7" data-active-url="^/live-forex.*$" href="/live-forex" title="">外汇</a></li>
                            <li class="leaf"><a class="bg-8" data-active-url="^/live-stock.*$" href="/live-stock" title="">股市</a></li>
                            <li class="leaf"><a class="bg-9" data-active-url="^/live-bond.*$" href="/live-bond" title="">债券</a></li>
                            <!--
                            <li class="leaf"><a class="bg-11" data-active-url="" href="http://wallstreetcn.com/gold" title="" target="_blank">黄金</a></li>
                            <li class="last leaf"><a class="bg-12" data-active-url="^/discovery.*$" href="/discovery" title="">发现</a></li>
                            -->
                        </ul>

                        <?endif?>

                        <form id="search-form" class="navbar-search pull-right form-search" action="/search/node/">
                            <div class="">
                                <input id="search-query" name="q" type="text" class="search-query" placeholder="搜索华尔街见闻"  x-webkit-speech x-webkit-grammar="builtin:translate" lang="zh-CN" />
                                <button id="search-submit" class="btn hide" type="submit"><span class="icon-search"></span></button>
                            </div>
                            <span id="search-submit-icon"><span class="icon-search"></span></span>
                        </form>
                    </div><!-- /.nav-collapse -->

                </div><!-- container end -->
            </div><!-- /navbar-inner -->
            </div><!-- #navbar end -->
        </div>
        </div>
    </div><!--navbar area end-->
</div><!--outer container end-->


<?if(isset($elements['menu_menu-live-menu']) && $elements['menu_menu-live-menu']):?>
<div class="container">

    <?if(0):?>
    <div id="live-topnews">
    <script type="text/x-tmpl" data-url="/apiv1/news.json">

        <div class="container">
            <div class="row-fluid">
                <div class="span4">
                    <ul>
                        <li class="first">最新文章</li>
                        {% for (var i=0; i < 2; i++) { %}
                            <li><a href="http://<?=variable_get('site_domain')?>/node/{%=o[i].nid%}" target="_blank">{%=o[i].node_title%}</a></li>
                        {% } %}
                    </ul>
                </div>
                <div class="span4">
                    <ul>
                        {% for (var i=2; i < 5; i++) { %}
                            <li><a href="http://<?=variable_get('site_domain')?>/node/{%=o[i].nid%}" target="_blank">{%=o[i].node_title%}</a></li>
                        {% } %}
                    </ul>
                </div>
                <div class="span4">
                    <ul>
                        {% for (var i=5; i < 7; i++) { %}
                            <li><a href="http://<?=variable_get('site_domain')?>/node/{%=o[i].nid%}"  target="_blank">{%=o[i].node_title%}</a></li>
                        {% } %}
                    <li class="last"><a href="http://<?=variable_get('site_domain')?>/news" target="_blank">MORE »</a></li>
                    </ul>
                </div>
            </div><!--rows end-->
        </div><!--container end-->
    </script>
    </div>

    <?endif?>


    <div class="row-fluid">

        <div class="span12">

            <div id="realtime-news">

                <div class="control-buttons">
                    <span class="text">最新文章</span>

                        <a id="livenews-navbar-prev" href="http://live.<?=variable_get('site_domain')?>" class="button prev"><span class="icon-caret-left"></span></a>
                        <a id="livenews-navbar-next" href="http://live.<?=variable_get('site_domain')?>" class="button next"><span class="icon-caret-right"></span></a>

                </div>

                <ul></ul>
                <a href="http://wallstreetcn.com/news" class="more" target="_blank">more &gt;&gt;</a>
            </div>
        </div><!--span12 end-->

    </div><!--rows end-->


    <?if(0):?>
    <div class="live-top-ad row-fluid">
        <div class="span4">
            <i class="icon-gift"></i>
            <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_kuaixun360_1&url=http://www.kuaixun360.com/?jw" target="_blank">炒金/炒银/炒外汇必备软件，下载送“iPhone 5S”</a>
        </div>
        <div class="span4">
            <i class="icon-male"></i>
            <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_hxylpme_1&url=http://www.hxylpme.com/?jw" target="_blank">《限招战略合作伙伴，省级运营中心》</a>
        </div>
        <div class="span4">
            <i class="icon-bullhorn" ></i>
            <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_fxcm-chinese_1&url=http://www.fxcm-chinese.com/gb/sh/free-seminars/?CMP=SFS-70160000000NjycAAC" target="_blank">福汇上海外汇培训中心现已开幕！</a>
        </div>
        <!-- <div class="span3">
            <a href="https://www.ironfx.cn/zh/wb-register?utm_source=WALLSTREETWN720_90&utm_medium=hp_WN&utm_campaign=wallstreetcn" target="_blank">铁汇在线交易解盘室 一对一名家实战指导</a>
        </div> -->
    </div>
    <?endif?>
</div>
<?endif?>

<div class="container">

    <script id="search-results-js" type="text/x-tmpl">
        {% if(o.cursor.currentPageIndex == 0) { %}
        <div id="search-result">
            <span id="search-results-close"><span class="icon-remove-sign"></span></span>
            <div class="page-header header-red">
                <span class="pull-right result-count">找到约 {%=o.cursor.estimatedResultCount%} 个结果</span>
                <h2>正在搜索：<strong>{%=o.q%}</strong></h2>
            </div>
        <div class="news-list">
        {% } %}

        {% for (var i=0; i < o.results.length; i++) { %}
        {% var item = o.results[i]; %}
        <div class="media">
            <div class="media-body">
                <h3 class="media-heading"><a href="{%=item.url%}" target="_blank">{%#item.title%}</a></h3>
                <p class="media-meta">链接：<a href="{%=item.url%}" target="_blank">{%=item.url%}</a></p>
               <div class="media-content">
                   {%#item.content%}
               </div>
            </div>
        </div>
        {% } %}

        {% if(o.cursor.currentPageIndex == 0) { %}
        </div>
        <div class="search-pager view-more">
            <a href="/search/node/">MORE »</a>
        </div>
        </div>
        {% } %}
    </script>

</div>






