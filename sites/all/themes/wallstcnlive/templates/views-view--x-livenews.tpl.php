<?
global $wscn;
if($wscn['x_livenews_rendered']) return;
?>
<?$items = $view->result;
$lastdate = '';
?>

<div class="control-bar">
    <span id="realtime-clock-wrap" class="pull-right"><i class="icon-time"></i> <span id="realtime-clock" class=""></span></span>
    <label class="btn btn-small"> <i class="icon-refresh"></i> 自动刷新 <input id="enable-fresh" class="checkbox" type="checkbox" checked="chekced" /></label>
    <label class="btn btn-small"> <i class="icon-volume-up"></i>  声音提醒 <input id="enable-sound" class="checkbox" type="checkbox" checked="chekced" /></label>
</div>

<div class="alert live-alert" title="最新实时新闻会自动显示">直播中<span class="ani-dot">...</span></div>

<div id="livenews-list" class="livenews-list">
    <script id="livenews-list-js" type="text/x-tmpl">
        <div id="livenews-id-{%=o.nid%}" class="media highlight">
            <div class="media-body {%=o.colorClass%} {%=o.format == '加粗' ? 'media-format-bold' : ''%}">
                <time datetime="">{%=o.time%}</time>
                <span class="icon">
                    <i class="icon-file-alt"></i> 
                </span>

                <h2 class="media-heading">{%#o.body%}</h2>
                <div class="media-meta">
                    <a href="/node/{%=o.nid%}">{%=o.created%}</a>
                    <span class="livenews-comment-trigger">
                        / <a href="/node/{%=o.nid%}" class="livenews-loader"><i class="icon-spinner icon-spin"></i> 正在加载评论...</a>
                    </span>
                    {% if(o.field_field_source) { %}
                    / 消息来源:
                        {% if(o.field_field_sourcelink) { %}
                            <a href="{%=o.field_field_sourcelink[0].raw.value%}">{%=o.field_field_source[0].raw.value%}</a>
                        {% } else { %}
                            {%=o.field_field_source[0].raw.value%}
                        {% } %}
                    {% } %}
                </div>
                <div class="media-comment">
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
        <div class="media-body media-format-<?=isset($item->field_field_format[0]) ? $item->field_field_format[0]['raw']['value'] : '';?> media-color-<?=isset($item->field_field_color[0]) ? $item->field_field_color[0]['raw']['value'] : '';?>">
            <time datetime="<?=format_date($item->node_created);?>"><?=format_date($item->node_created, 'custom', 'H:i');?></time>
            <span class="icon">
                <?$icon = isset($item->field_field_icon[0]) ? $item->field_field_icon[0]['raw']['value'] : '';?>
                <?if($icon == 'chart'):?>
                <i class="icon-external-link"></i>
                <?elseif($icon == 'calendar'):?>
                <i class="icon-calendar"></i>
                <?elseif($icon == 'download'):?>
                <i class="icon-download-alt"></i>
                <?elseif($icon == 'warning'):?>
                <i class="icon-warning-sign"></i>
                <?elseif($icon == 'alert'):?>
                <i class="icon-bullhorn"></i>
                <?elseif($icon == 'chart_pie'):?>
                <i class="icon-signal"></i>
                <?elseif($icon == 'rumor'):?>
                <i class="icon-twitter"></i>
                <?else:?>
                <i class="icon-file-alt"></i> 
                <?endif?>
            </span>

            <h2 class="media-heading <?=$item->field_body[0]['raw']['summary'] ? 'has-more' : ''?>">
                <?if(!$item->field_body[0]['raw']['summary'] && !$item->field_body[0]['raw']['safe_value']):?>
                数据图表
                <?else:?>
                <?=$item->field_body[0]['raw']['summary']  ? $item->field_body[0]['raw']['summary'] : $item->field_body[0]['raw']['safe_value']?>
                <?endif?>
                <?if(0 && $item->field_body[0]['raw']['summary']):?>
                <span class="show-more pull-left">[more]</span>
                <?endif?>
            </h2>
            <div class="media-meta clearfix">
                <a href="/node/<?=$item->nid?>" target="_blank" class="pull-left"><?=format_date($item->node_created);?></a>
                <span class="livenews-comment-trigger">
                　/　<a href="/node/<?=$item->nid?>" class="livenews-loader"><i class="icon-spinner icon-spin"></i> 正在加载评论...</a>
                </span>
                <?if($item->field_field_source):?>
                / 消息来源:
                <?if($item->field_field_sourcelink):?>
                <a href="<?=$item->field_field_sourcelink[0]['raw']['value']?>"><?=$item->field_field_source[0]['raw']['value']?></a>
                <?else:?>
                <?=$item->field_field_source[0]['raw']['value']?>
                <?endif?>
                <?endif?>

                <span class="share-btn pull-left">
                    <span class="pull-left">　/　分享到：</span>
                    <span class="addthis_toolbox addthis_default_style" addthis:url="http://live.<?=variable_get('site_domain')?>/node/<?=$item->nid?>"  addthis:title="<?=$item->node_title?>">
                        <a class="addthis_button_sinaweibo"></a>
                        <a class="addthis_button_twitter"></a>
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_google_plusone_share"></a>
                    </span>
                </span>
            </div>
            <div class="media-comment">
            </div>
        </div>
    </div>
    <?$lastdate = $current_date;?>
    <?endforeach?>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51b970eb71800842"></script>

<div class="view-more">
    <?=$pager?>
</div>
<?$wscn['x_livenews_rendered'] = true;?>
