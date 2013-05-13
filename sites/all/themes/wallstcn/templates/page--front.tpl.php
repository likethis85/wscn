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
                <?if(theme_get_setting('allow_ad')):?>
                <script type="text/javascript" src="http://cbjs.baidu.com/js/m.js"></script>
                <script type="text/javascript">BAIDU_CLB_fillSlot("507800");</script>
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
                <?if($page['live_content']):?>
                <?=render($page['live_content'])?>
                <?endif?>
                <?if($page['index_content']):?>
                <?=render($page['index_content']); ?>
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

<div id="navigation">
    <div class="container">
        <div class="row-fluid">
            <div class="span4">
            </div>
            <div class="span8">
                <?php print render($page['navigation']); ?>
            </div>
        </div>
    </div>
</div>
