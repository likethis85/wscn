<?
global $wscn;
if($wscn['x_recommand_rendered']) return;
$items = $view->result;
$max = count($items);
$rows = ceil($max / 3);
?>
<div class="page-header header-brown news-slider-controls">
    <a href="/taxonomy/term/3119" class="pull-right more">更多</a>
    <a href="javascript:;" class="news-slider-btn btn pull-right next"><span class="icon-angle-right"></span></a>
    <a href="javascript:;" class="news-slider-btn btn pull-right prev"><span class="icon-angle-left"></span></a>
    <h2>编辑推荐</h2>
</div>
<div class="news-list vlist">
    <div id="news-slider" class="row-slider">
    <?for($i = 0; $i < $rows; $i++):?>
    <div class="row-fluid">
        <?for($j = 0; $j < 3; $j++):?>
        <?$item = $items[$i * 3 + $j];?>
        <div class="span4">
            <div class="media">
                <?if($item->file_managed_field_data_upload_uri || $item->field_field_image_1):?>
                <a class="media-image" href="<?=url('node/'. $item->nid);?>">
                    <img alt="" src="<?=wscn_image_url($item);?>">
                </a>
                <?endif?>
                <div class="media-body">
                    <p class="media-meta">
                    by <a href="/user/<?=$item->users_node_uid?>"><?=$item->users_node_name?></a>
                    <?=format_date($item->node_created);?>
                    </p>
                    <h3 class="media-heading"><a href="<?=url('node/'. $item->nid);?>"><?=$item->node_title?></a></h3>
                    <div>
                        <p><?=$item->_field_data['nid']['entity']->body['und'][0]['summary']?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor;?>
    </div>
    <?php endfor;?>
    </div>
</div><!--new list end-->


<?$wscn['x_recommand_rendered'] = true;?>
