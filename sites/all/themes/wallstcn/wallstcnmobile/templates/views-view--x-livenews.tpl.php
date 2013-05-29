<?
global $wscn;
if($wscn['x_livenews_rendered']) return;
$items = $view->result;
$lastdate = '';
?>

<div class="view-more">
    <a href="/live" data-role="button" data-icon="refresh" data-theme="c">立即刷新</a>
</div>


<ul data-role="listview"  data-content-theme="d" data-inset="true">
    <li data-role="list-divider">
    实时新闻
    </li>
    <?foreach($items as $item):?>
    <?$current_date = format_date($item->node_created, 'custom', 'Y年m月d日');?>
    <?if($lastdate && $lastdate !== $current_date):?>
    <li data-role="list-divider">
    <?=$current_date?>
    </li>
    <?endif?>
    <li class="media-format-<?=$item->field_field_format[0]['raw']['value']?> media-color-<?=$item->field_field_color[0]['raw']['value']?>">
    <p><strong><?=$item->field_body[0]['raw']['value']?></strong></p>
    <?if($item->field_field_source):?>
    <p>
    消息来源:
    <?if($item->field_field_sourcelink):?>
    <a href="<?=$item->field_field_sourcelink[0]['raw']['value']?>"><?=$item->field_field_source[0]['raw']['value']?></a>
    <?else:?>
    <?=$item->field_field_source[0]['raw']['value']?>
    <?endif?>
    </p>
    <?endif?>
    <p class="ui-li-aside"><strong><?=format_date($item->node_created, 'custom', 'H:i');?></strong></p>
    </li>

    <?$lastdate = $current_date;?>
    <?endforeach?>

</ul>

<?$wscn['x_livenews_rendered'] = true;?>
