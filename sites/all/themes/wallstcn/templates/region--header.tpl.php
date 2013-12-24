<div class="container <?=$classes;?>" <?=$attributes;?>>
<div id="nav-area">
    <div class="row"><div class="span12">
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
                    <?=render($elements['system_main-menu']);?>
                    <?endif?>
                    <?if(isset($elements['menu_menu-live-menu']) && $elements['menu_menu-live-menu']):?>
                    <?=render($elements['menu_menu-live-menu']);?>
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
</div></div>


<!--

<?if(!isset($elements['menu_menu-live-menu']) || !$elements['menu_menu-live-menu']):?>
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <?if(0):?>
                <div id="realtime-news">
                    <p class="control-buttons pull-left">
                    <a id="livenews-navbar-prev" href="http://live.<?=variable_get('site_domain')?>" class="btn prev"><span class="icon-angle-up"></span></a>
                    <a id="livenews-navbar-next" href="http://live.<?=variable_get('site_domain')?>" class="btn next"><span class="icon-angle-down"></span></a>
                    </p>
                    <p class="news"> <a href="http://live.<?=variable_get('site_domain')?>" target="_blank"><i class="icon-volume-up"></i> 实时新闻</a>：
                    <ul>
                        <li>正在载入...</li>
                    </ul>
                    </p>
                    <a href="http://live.<?=variable_get('site_domain')?>" class="more" target="_blank">即时刷新»</a>
                </div>
                <?endif?>
            </div>span12 end
        </div>rows end
    </div>container end
<?endif?>

 -->
</div><!--navbar area end-->
</div><!--outer container end-->


<?if(isset($elements['menu_menu-live-menu']) && $elements['menu_menu-live-menu']):?>
<div class="container">
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
    <?if(1):?>
    <div class="live-top-ad row-fluid">
        <div class="span4">
            <i class="icon-gift"></i>
            <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_kuaixun360_1&url=http://www.kuaixun360.com/?jw" target="_blank">炒金/炒银/炒外汇必备软件，下载送“iPhone 5S”</a>
        </div>
        <div class="span4">
            <i class="icon-male"></i>
            <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_hxylpme_1&url=http://www.hxylpme.com/?jw" target="_blank">鸿鑫御隆，新华社平台，广招代理商和经纪类会员</a>
        </div>
        <div class="span4">
            <i class="icon-bullhorn" ></i>
            <a href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_live_hit_fxcm-chinese_1&url=http://www.fxcm-chinese.com/gb/sh/overview/?CMP=SFS-70160000000NjycAAC" target="_blank">福汇上海外汇培训中心现已开幕！</a>
        </div>
        <!-- <div class="span3">
            <a href="https://www.ironfx.cn/zh/wb-register?utm_source=WALLSTREETWN720_90&utm_medium=hp_WN&utm_campaign=wallstreetcn" target="_blank">铁汇在线交易解盘室 一对一名家实战指导</a>
        </div> -->
    </div>
    <?endif?>
</div>
<?endif?>

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
