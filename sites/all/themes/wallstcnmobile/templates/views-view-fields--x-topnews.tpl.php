<?
global $wscn;
if($wscn['x_topnews_rendered']) return;

$items = $view->result;
?>

<ul data-role="listview" data-inset="true"  data-theme="c">
    <li data-role="list-divider">头条新闻</li>

    <?foreach($items as $item):?>
    <li><a href="<?=url('node/'. $item->nid);?>">
        <h2 class="full-title"><?=$item->node_title?></h2>
        <?if($item->uri):?>
        <img alt="<?=$item->node_title?>" class="" src="<?=image_style_url('thumbnail', $item->uri);?>">
        <?endif?>
        <?if(0):?>
        <p><?=strip_tags($item->field_body[0]['raw']['summary'])?></p>
        <p class="ui-li-aside"><?=format_date($item->node_created);?></p>
        <?endif?>
    </a></li>
    <?endforeach;?>
</ul>

<?$wscn['x_topnews_rendered'] = true?>
