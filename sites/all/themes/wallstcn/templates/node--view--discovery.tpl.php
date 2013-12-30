<? //include_once 'discovery.php'; ?>

<div class="hot-news">

    <h2 class="hot-news-header">
        新奇视角
    </h2>
    <div class="hot-news-list row-fluid">
    <?foreach($GLOBALS['discovery_3'] as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=$e['img']?>" alt="<?=$e['title']?>" />
                </a>
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-title"><?=$e['title']?></a>
            </div>
        </div>
    <?if($k == 2):?>
    </div>
    <div class="hot-news-list row-fluid">
    <?endif;?>
    <?endforeach;?>
    </div>
</div>
<br /><br />
<div class="hot-news">

    <h2 class="hot-news-header">
        独特发现
    </h2>
    <div class="hot-news-list row-fluid">
    <?foreach($GLOBALS['discovery_4'] as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=$e['img']?>" alt="<?=$e['title']?>" />
                </a>
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-title"><?=$e['title']?></a>
            </div>
        </div>
    <?if($k == 2):?>
    </div>
    <div class="hot-news-list row-fluid">
    <?endif;?>
    <?endforeach;?>
    </div>
</div>
<br /><br />
<div class="hot-news">

    <h2 class="hot-news-header">
        热点指南
    </h2>
    <div class="hot-news-list row-fluid">
    <?foreach($GLOBALS['discovery_5'] as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=$e['img']?>" alt="<?=$e['title']?>" />
                </a>
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-title"><?=$e['title']?></a>
            </div>
        </div>
    <?if($k == 2):?>
    </div>
    <div class="hot-news-list row-fluid">
    <?endif;?>
    <?endforeach;?>
    </div>
</div>
<br /><br />
<div class="hot-news">

    <h2 class="hot-news-header">
        轻松阅读
    </h2>
    <div class="hot-news-list row-fluid">
    <?foreach($GLOBALS['discovery_6'] as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=$e['img']?>" alt="<?=$e['title']?>" />
                </a>
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-title"><?=$e['title']?></a>
            </div>
        </div>
    <?if($k == 2):?>
    </div>
    <div class="hot-news-list row-fluid">
    <?endif;?>
    <?endforeach;?>
    </div>
</div>

