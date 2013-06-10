<div id="wrapper">

    <header id="header">
    <?php if (!empty($logo)): //logo start?>
    <div class="container">
        <div class="row-fluid">
            <div class="span4"><h1>
                    <a class="logo" href="<?php print $front_page; ?>" title="<?php print $site_name ? $site_name : t('Home'); ?>">
                        <img src="<?=$logo?>" alt="<?php print $site_name ? $site_name : t('Home'); ?>" />
                    </a>
            </h1></div>
            <div class="span8">
                <div class="pull-right">
                <?if(variable_get('site_ad')):?>
                <?if($page['live_content']):?>
                <script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
                <script type="text/javascript">BAIDU_CLB_fillSlot("507799");</script>
                <?else:?>
                <script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
                <script type="text/javascript">BAIDU_CLB_fillSlot("507800");</script>
                <?endif?>
                <?endif?>
            </div>
        </div>
    </div>
    <?php endif; //logo end ?>

    <?=render($page['header']); ?>

    </header>

    <div id="main-content" class="container">

        <div class="row-fluid">

            <div class="span8"> 
                <?if($is_front):?>

                    <?if($page['live_content']):?>
                    <?=render($page['live_content'])?>
                    <?endif?>
                    <?if($page['index_content']):?>
                    <?=render($page['index_content']); ?>
                    <?endif?>

                <?else:?>

                    <?$local_menu = menu_local_tasks();?>
                    <?if($local_menu['tabs']['count'] > 1):?>
                    <ul class="nav nav-pills">
                        <?=render($local_menu);?>
                    </ul>
                    <?endif?>
                    <?=render($page['content']); ?>
                <?endif?>
            </div>


            <div class="span4">
                <?if($page['sidebar_first']):?>
                <?=render($page['sidebar_first']); ?>
                <?endif?>
                <?if($page['sidebar_live']):?>
                <?=render($page['sidebar_live']); ?>
                <?endif?>
            </div>

        </div>
    </div>



</div>

<footer id="footer" class="footer">
<div class="container">
    <?=render($page['footer']); ?>
</div>
</footer>

<?=render($page['navigation']); ?>
