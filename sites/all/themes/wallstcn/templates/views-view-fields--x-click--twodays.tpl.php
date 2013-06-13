<?
global $wscn;
if($wscn['x_click_rendered']) return;
?>
<?$items = $view->result;?>
<div class="side-box ranking">
    <ul class="nav nav-tabs">
        <li><a data-toggle="tab" href="#side-tab-fourth" data-tab-url="/apiv1/click_all.json">点击排行</a></li>
        <li class="active first">
        <a data-toggle="tab" href="#side-tab-first">48小时</a>
        </li>
        <li><a data-toggle="tab" href="#side-tab-second" data-tab-url="/apiv1/click_week.json">一周排行</a></li>
        <li class=""><a data-toggle="tab" href="#side-tab-third" data-tab-url="/apiv1/click_month.json">一月</a></li>
    </ul>
    <div class="tab-content">
        <div id="side-tab-first" class="tab-pane fade in active side-list">
            <?foreach($items as $key => $item):?>
            <div class="media">
                <span class="number"><?=$key + 1?></span>
                <?if($item->file_managed_field_data_upload_uri || $item->field_field_image_1):?>
                <a class="pull-right news-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
                    <div class="news-img-wrap">
                        <img alt="" class="" src="<?=image_style_url('thumbnail', $item->file_managed_field_data_upload_uri);?>">
                    </div>
                </a>
                <?endif?>
                <div class="media-body">
                    <h4 class="media-heading"><a href="<?=url('node/'. $item->nid);?>" target="_blank"><?=$item->node_title?></a></h4>
                </div>
            </div>
            <?endforeach?>
        </div>
        <div id="side-tab-second" class="tab-pane fade">
        </div>
        <div id="side-tab-third" class="tab-pane fade">
        </div>
        <div id="side-tab-fourth" class="tab-pane fade">
        </div>
    </div>
</div>


<?$wscn['x_click_rendered'] = true;?>
