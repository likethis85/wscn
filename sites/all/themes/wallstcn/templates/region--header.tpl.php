<div class="container">
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
                <a href="http://<?=variable_get('site_domain')?>" class="brand <?=$elements['system_main-menu'] ? 'mainsite-brand' : ''?>"><i class="icon-home"></i> 华尔街见闻</a>
                <div class="nav-collapse collapse navbar-responsive-collapse">
                    <?if($elements['system_main-menu']):?>
                    <?=render($elements['system_main-menu']);?>
                    <?endif?>
                    <?if($elements['menu_menu-live-menu']):?>
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

    <?if(!$elements['menu_menu-live-menu']):?>
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
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
            </div><!--span12 end-->
        </div><!--rows end-->
    </div><!--container end-->
<?endif?>

</div><!--navbar area end-->
</div><!--outer container end-->


<?if($elements['menu_menu-live-menu']):?>
<div class="container">
    <div id="live-topnews">
<script type="text/x-tmpl" data-url="/apiv1/node.json?parameters[type]=news">

        <div class="container">
            <div class="row-fluid">
                <div class="span4">
                    <ul>
                        <li class="first">最新文章</li>
                        {% for (var i=0; i < 2; i++) { %}
                            <li><a href="http://<?=variable_get('site_domain')?>/node/{%=o[i].nid%}" target="_blank">{%=o[i].title%}</a></li>
                        {% } %}
                    </ul>
                </div>
                <div class="span4">
                    <ul>
                        {% for (var i=2; i < 5; i++) { %}
                            <li><a href="http://<?=variable_get('site_domain')?>/node/{%=o[i].nid%}" target="_blank">{%=o[i].title%}</a></li>
                        {% } %}
                    </ul>
                </div>
                <div class="span4">
                    <ul>
                        {% for (var i=5; i < 7; i++) { %}
                            <li><a href="http://<?=variable_get('site_domain')?>/node/{%=o[i].nid%}"  target="_blank">{%=o[i].title%}</a></li>
                        {% } %}
                    <li class="last"><a href="http://<?=variable_get('site_domain')?>/news" target="_blank">MORE »</a></li>
                    </ul>
                </div>
            </div><!--rows end-->
        </div><!--container end-->
    </script>
    </div>
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
            <h3 class="media-heading"><a href="{%=item.url%}">{%#item.title%}</a></h3>
            <p class="media-meta">链接：<a href="{%=item.url%}">{%=item.url%}</a></p>
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
