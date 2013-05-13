<div id="nav-area">
    <div id="navbar" class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="nav-collapse collapse navbar-responsive-collapse">
                    <?if($elements['system_main-menu']):?>
                    <?=render($elements['system_main-menu']);?>
                    <?endif?>
                    <?if($elements['menu_menu-live-menu']):?>
                    <?=render($elements['menu_menu-live-menu']);?>
                    <ul class="nav pull-right">
                        <li><a href="http://<?=theme_get_setting('domain')?>">华尔街见闻</a></li>
                    </ul>
                    <?endif?>

                    <form id="search-form" class="navbar-search pull-right" action="/search/node/">
                        <div class="input-append">
                            <input name="q" type="text" class="input-medium" placeholder="搜索华尔街见闻">
                            <button class="btn" type="submit"><span class="icon-search"></span></button>
                        </div>
                    </form>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div>

    <?if(!$elements['menu_menu-live-menu']):?>
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div id="realtime-news">
                    <p class="control-buttons pull-left">
                    <a href="http://live.wallstreetcn.com/" class="btn prev"><span class="icon-angle-up"></span></a>
                    <a href="http://live.wallstreetcn.com/" class="btn next"><span class="icon-angle-down"></span></a>
                    </p>
                    <p class="news"> 实时新闻：
                    <ul>
                        <li>正在载入...</li>
                    </ul>
                    </p>
                    <a href="http://live.wallstreetcn.com/" class="more" target="_blank">即时刷新»</a>
                </div>
            </div><!--span12 end-->
        </div><!--rows end-->
    </div><!--container end-->
<?endif?>

</div>

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
        <a href="/search/node/">查看更多 »</a>
    </div>
    </div>
    {% } %}
</script>
