<?
global $wscn;
if($wscn['x_livenews_rendered']) return;
?>
<?$items = $view->result;
$lastdate = '';
?>

<div class="control-bar">
    <label class="btn btn-small"> <i class="icon-refresh"></i> 自动刷新 <input id="enable-fresh" class="checkbox" type="checkbox" checked="chekced" /></label>
    <label class="btn btn-small"> <i class="icon-volume-up"></i>  声音提醒 <input id="enable-sound" class="checkbox" type="checkbox" checked="chekced" /></label>
</div>


<div id="livenews-list" class="livenews-list">
    <script id="livenews-list-js" type="text/x-tmpl">
        <div id="livenews-id-{%=o.nid%}" class="media new">
            <div class="media-body">
                <time datetime=""></time>
                <span class="icon">
                    <i class="icon-file-alt"></i> 
                </span>

                <h2 class="media-heading">{%#o.body%}</h2>
                <div class="media-meta">
                </div>
            </div>
        </div>
    </script>

    <?foreach($items as $item):?>
    <?$current_date = format_date($item->node_created, 'custom', 'Y年m月d日');?>
    <?if($lastdate && $lastdate !== $current_date):?>
    <div class="datebar">
        <?=$current_date?>
    </div>
    <?endif?>
    <div id="livenews-id-<?=$item->nid?>" class="media">
        <div class="media-body media-format-<?=$item->field_field_format[0]['raw']['value']?> media-color-<?=$item->field_field_color[0]['raw']['value']?>">
            <time datetime="<?=format_date($item->node_created);?>"><?=format_date($item->node_created, 'custom', 'H:i');?></time>
            <span class="icon">
                <?$icon = $item->field_field_icon[0]['raw']['value'];?>
                <?if($icon == 'chart'):?>
                <i class="icon-bar-chart"></i>
                <?elseif('calendar'):?>
                <i class="icon-calendar"></i>
                <?elseif('download'):?>
                <i class="icon-download-alt"></i>
                <?elseif('warning'):?>
                <i class="icon-warning-sign"></i>
                <?else:?>
                <i class="icon-file-alt"></i> 
                <?endif?>
            </span>

            <h2 class="media-heading"><?=$item->field_body[0]['raw']['value']?></h2>
            <div class="media-meta">
                <a href="/node/<?=$item->nid?>"><?=format_date($item->node_created);?></a>
                <span class="livenews-comment-trigger">
                    / <a href="/node/<?=$item->nid?>" class="livenews-loader"><i class="icon-spinner icon-spin"></i> 正在加载评论...</a>
                    <!--/ <a href="/node/<?=$item->nid?>">评论</a>-->
                </span>
                <?if($item->field_field_source):?>
                / 消息来源:
                <?if($item->field_field_sourcelink):?>
                <a href="<?=$item->field_field_sourcelink[0]['raw']['value']?>"><?=$item->field_field_source[0]['raw']['value']?></a>
                <?else:?>
                <?=$item->field_field_source[0]['raw']['value']?>
                <?endif?>
                <?endif?>
            </div>
            <div class="media-comment">
            </div>
        </div>
    </div>
    <?$lastdate = $current_date;?>
    <?endforeach?>
</div>

<div class="view-more">
    <a href="/live?page=2">查看更多 »</a>
</div>
<?$wscn['x_livenews_rendered'] = true;?>
