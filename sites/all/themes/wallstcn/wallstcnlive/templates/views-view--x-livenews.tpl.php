<?
global $wscn;
if($wscn['x_livenews_rendered']) return;
?>
<?$items = $view->result;?>

<div class="control-bar">
    <label class="btn btn-small"> <i class="icon-refresh"></i> 自动刷新 <input id="enable-fresh" class="checkbox" type="checkbox" checked="chekced" /></label>
    <label class="btn btn-small"> <i class="icon-volume-up"></i>  声音提醒 <input id="enable-sound" class="checkbox" type="checkbox" checked="chekced" /></label>
</div>


<div class="livenews-list">
    <?foreach($items as $item):?>
    <div class="media">
        <div class="media-body">
            <time datetime="2012-07-11T12:54:55+00:00">12:30</time>
            <h2 class="media-heading"><?=$item->field_body[0]['raw']['value']?></h2>
            <p class="media-meta">
            <a href="/node/<?=$item->nid?>"><?=format_date($item->node_created);?></a>
            / <a href="/node/<?=$item->nid?>">评论</a>
            </p>
            <div class="media-content">
            </div>
        </div>
    </div>
    <?endforeach?>
</div>

<div class="view-more">
    <a href="/live?page=2">查看更多 »</a>
</div>
<?$wscn['x_livenews_rendered'] = true;?>
