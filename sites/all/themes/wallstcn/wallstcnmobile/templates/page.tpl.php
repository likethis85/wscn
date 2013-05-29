<div data-role="page" data-add-back-btn="true" data-back-btn-text="后退">

    <div data-role="header">
        <a href="/" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
        <h1><a href="/"><img src="/sites/all/themes/wallstcn/wallstcnmobile/logo.png" alt="华尔街见闻 移动版" /></a></h1>
    </div><!-- /header -->

    <div data-role="navbar" data-grid="d">
        <ul>
            <li><a href="/" class="ui-btn-active">首页</a></li>
            <li><a href="/taxonomy/term/3119">推荐</a></li>
            <li><a href="/live">直播</a></li>
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
        &copy; 2010-2013 <a href="http://<?=variable_get('site_domain')?>/">华尔街见闻 wallstcn.com</a> , All Rights Reserved. 
        | <a href="http://<?=variable_get('site_domain')?>/">网页版</a> 
    </div>
</div>

</div><!-- /page -->
