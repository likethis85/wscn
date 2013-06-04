<?
global $wscn;
if($wscn['x_recent_rendered']) return;
?>
<?$items = $view->result;?>
<ul data-role="listview" data-inset="true">
    <li data-role="list-divider">最新文章</li>

    <?foreach($items as $item):?>
    <li><a href="<?=url('node/'. $item->nid);?>">
        <h2 class="full-title"><?=$item->node_title?></h2>
        <?if($item->file_managed_field_data_upload_uri):?>
        <img alt="" class="" src="<?=image_style_url('thumbnail', $item->file_managed_field_data_upload_uri);?>">
        <?endif?>
        <?if(0):?>
        <p><?=strip_tags($item->field_body[0]['raw']['summary'])?></p>
        <p class="ui-li-aside"><?=format_date($item->node_created);?></p>
        <?endif?>
    </a></li>
    <?endforeach;?>
</ul>

<a href="/news?page=1" data-role="button">查看更多 »</a>
<?$wscn['x_recent_rendered'] = true;?>
