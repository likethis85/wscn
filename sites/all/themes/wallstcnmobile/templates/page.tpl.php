<div data-role="page" data-add-back-btn="true" data-back-btn-text="后退">

    <div data-role="header">
        <a href="/" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
        <h1><a href="/"><img src="/sites/all/themes/wallstcnmobile/logo.png" alt="华尔街见闻 移动版" /></a></h1>
    </div><!-- /header -->

    <div data-role="navbar" data-grid="d">
        <ul>
            <li><a href="/">首页</a></li>
            <li><a href="/taxonomy/term/3119">推荐</a></li>
            <li><a href="/livenews">直播</a></li>
            <li><a href="#market">市场</a></li>
            <li><a href="#schedule">日程</a></li>
        </ul>
    </div><!-- /navbar -->

    <div data-role="content">
        <?if($is_front):?>
        <?if($page['mobile_index']):?>
        <?=render($page['mobile_index']); ?>
        <?endif?>
        <?else:?>
        <?=render($page['content']); ?>
        <?endif?>
    </div><!-- /content -->

<div data-role="footer">
    <div class="copyright">
        &copy; 2010-2013 <a href="http://<?=variable_get('site_domain')?>/">华尔街见闻</a> , All Rights Reserved.
        | <a href="http://<? $url = variable_get('site_domain') . $_SERVER['REQUEST_URI']; $nomobi = strpos($_SERVER['REQUEST_URI'], '?') === false ? '?nomobi=true' : '&nomobi=true'; echo $url . $nomobi ?>">网页版</a>
    </div>
</div>

</div><!-- /page -->


<div id="market" data-role="page" data-add-back-btn="true" data-back-btn-text="后退">
    <div data-role="header">
        <a href="/" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
        <h1><a href="/"><img src="/sites/all/themes/wallstcnmobile/logo.png" alt="华尔街见闻 移动版" /></a></h1>
    </div><!-- /header -->

    <div data-role="navbar" data-grid="d">
        <ul>
            <li><a href="/">首页</a></li>
            <li><a href="/taxonomy/term/3119">推荐</a></li>
            <li><a href="/livenews">直播</a></li>
            <li><a href="#market" class="ui-btn-active">市场</a></li>
            <li><a href="#schedule">日程</a></li>
        </ul>
    </div><!-- /navbar -->

   <iframe frameborder="0" scrolling="no" height="287" width="300" allowtransparency="true" marginwidth="0" marginheight="0" src="http://tools.cn.forexprostools.com/market_quotes.php?tab_1=1,2,3,5,7,9&tab_2=169,166,20,172,27,178&tab_3=8830,8849,8836,8862,8831,8988&tab_4=8880,8907,8900,8899,8886,8895&select_color=000000&default_color=0059B0"> </iframe><br /><div style="width:300"><span style="font-size: 11px;color: #333333;text-decoration: none;">市场行情由 <a href="http://cn.investing.com/" rel="nofollow" target="_blank" style="font-size: 11px;color: #06529D; font-weight: bold;" class="underline_link">Investing.com 中文站</a> 提供。</span></div>

<div data-role="footer">
    <div class="copyright">
        &copy; 2010-2013 <a href="http://<?=variable_get('site_domain')?>/">华尔街见闻</a> , All Rights Reserved.
        | <a href="http://<?=variable_get('site_domain')?>/">网页版</a>
    </div>
</div>
</div>

<div id="schedule" data-role="page" data-add-back-btn="true" data-back-btn-text="后退">
    <div data-role="header">
        <a href="/" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
        <h1><a href="/"><img src="/sites/all/themes/wallstcnmobile/logo.png" alt="华尔街见闻 移动版" /></a></h1>
    </div><!-- /header -->

    <div data-role="navbar" data-grid="d">
        <ul>
            <li><a href="/">首页</a></li>
            <li><a href="/taxonomy/term/3119">推荐</a></li>
            <li><a href="/livenews">直播</a></li>
            <li><a href="#market">市场</a></li>
            <li><a href="#schedule" class="ui-btn-active">日程</a></li>
        </ul>
    </div><!-- /navbar -->

    <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=500&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=edwinlebow%40gmail.com&amp;color=%2329527A&amp;ctz=Asia%2FShanghai"  style=" border-width:0;  margin-bottom:-22px;z-index;-100;margin-top:-5px;" width="100%" height="400" frameborder="0" scrolling="no"  ></iframe>

<div data-role="footer">
    <div class="copyright">
        &copy; 2010-2013 <a href="http://<?=variable_get('site_domain')?>/">华尔街见闻</a> , All Rights Reserved.
        | <a href="http://<?=variable_get('site_domain')?>/">网页版</a>
    </div>
</div>
</div>
