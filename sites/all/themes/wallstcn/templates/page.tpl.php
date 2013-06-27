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
                    <?if(0):?>
                    <img alt="华尔街见闻微博官方帐号" src="/sites/all/themes/wallstcn/banner.jpg" />
                    <?endif?>
                <?if(0 && variable_get('site_ad')):?>
<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-0869270234052789"
     data-ad-slot="9607908946"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                <?endif?>
                <?if(variable_get('site_ad')):?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="90" width="728"><param name="quality" value="high" /><param name="movie" value="/sites/all/themes/wallstcn/ads/IronFX.swf" /><embed height="90" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="/sites/all/themes/wallstcn/ads/IronFX.swf" type="application/x-shockwave-flash" width="728"></embed></object>
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
                <?php print $messages; ?>
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
