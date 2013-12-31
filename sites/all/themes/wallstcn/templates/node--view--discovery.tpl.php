<?
    $discovery = get_discovery_arr();
    $discovery_1  = array();
    // 这里加外部广告

    $discovery_2 = array();
    // 这里加外部广告

    $discovery_3 = array();
    // 这里加外部广告

    $discovery_4 = array();
    // 这里加外部广告

    $numbers = range(0, 400);
    shuffle($numbers);

    $key_1  = array_slice($numbers, 0, 6);
    $key_2  = array_slice($numbers, 50, 6);
    $key_3  = array_slice($numbers, 100, 6);
    $key_4  = array_slice($numbers, 150, 6);



    for ($i=0; $i<6; $i++) {
        if (isset($discovery_1[$i])) {
            continue;
        }

        $discovery_1[$i] = $discovery[$key_1[$i]];
    }

    for ($i=0; $i<6; $i++) {
        if (isset($discovery_2[$i])) {
            continue;
        }

        $discovery_2[$i] = $discovery[$key_2[$i]];
    }

    for ($i=0; $i<6; $i++) {
        if (isset($discovery_3[$i])) {
            continue;
        }

        $discovery_3[$i] = $discovery[$key_3[$i]];
    }

    for ($i=0; $i<6; $i++) {
        if (isset($discovery_4[$i])) {
            continue;
        }

        $discovery_4[$i] = $discovery[$key_4[$i]];
    }


 ?>

<div class="hot-news">

    <h2 class="hot-news-header">
        新奇视角
    </h2>
    <div class="hot-news-list row-fluid">
    <?foreach($discovery_1 as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=wscn_get_image_thumbnail($e['img'], 210, 130)?>" alt="<?=$e['title']?>" />
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
    <?foreach($discovery_2 as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=wscn_get_image_thumbnail($e['img'], 210, 130)?>" alt="<?=$e['title']?>" />
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
    <?foreach($discovery_3 as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=wscn_get_image_thumbnail($e['img'], 210, 130)?>" alt="<?=$e['title']?>" />
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
    <?foreach($discovery_4 as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=wscn_get_image_thumbnail($e['img'], 210, 130)?>" alt="<?=$e['title']?>" />
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

