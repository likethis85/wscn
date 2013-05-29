<div data-role="page" data-add-back-btn="true" data-back-btn-text="后退">

    <div data-role="header">
        <h1><img src="/sites/all/themes/wallstcn/wallstcnmobile/logo.png" alt="华尔街见闻 移动版" /></h1>
        <a href="index.html" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right jqm-home">Home</a>
    </div><!-- /header -->

    <div data-role="navbar" data-grid="d">
        <ul>
            <li><a href="#" class="ui-btn-active">首页</a></li>
            <li><a href="#">推荐</a></li>
            <li><a href="#">直播</a></li>
            <li><a href="#">市场</a></li>
            <li><a href="#">日程</a></li>
        </ul>
    </div><!-- /navbar -->

    <div data-role="content">
        <?if($page['mobile_index']):?>
        <?=render($page['mobile_index']); ?>
        <?endif?>
    </div><!-- /content -->

</div><!-- /page -->

