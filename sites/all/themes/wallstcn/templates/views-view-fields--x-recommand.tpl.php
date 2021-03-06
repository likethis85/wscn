<?
global $wscn;
if(!empty($wscn['x_recommand_rendered'])) return;
$items = $view->result;
$max = count($items);
$rows = ceil($max / 3);
?>
<div class="<?=$classes;?>" <?=$attributes;?>>
<div class="page-header header-brown news-slider-controls">
    <a href="/recommend" class="pull-right more">MORE»</a>
    <a href="javascript:;" class="news-slider-btn btn pull-right next"><span class="icon-angle-right"></span></a>
    <a href="javascript:;" class="news-slider-btn btn pull-right prev"><span class="icon-angle-left"></span></a>
    <h2>编辑推荐</h2>
</div>
<div class="news-list vlist recommend-news">
    <div id="news-slider" class="row-slider">
    <?for($i = 0; $i < $rows; $i++):?>
    <div class="row-fluid">
        <?for($j = 0; $j < 3; $j++):?>
        <?$item = $items[$i * 3 + $j];?>
        <div class="span4">
            <div class="media">
                <a class="media-image news-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
                <?if($item->file_managed_field_data_upload_uri || $item->field_field_image_1):?>
                    <div class="news-img-wrap">
                        <img class="lazy" src="<?=path_to_theme()?>/placeholder.gif" data-original="<?=wscn_get_image_thumbnail(wscn_image_domain(wscn_image_url($item)), 210, 140);?>" alt="<?=$item->node_title?>" />
                        <noscript><img class="" src="<?=wscn_get_image_thumbnail(wscn_image_domain(wscn_image_url($item)), 210, 140);?>" alt="<?=$item->node_title?>"></noscript>
                        <h3 class="media-heading"><?=$item->node_title?></h3>
                    </div>
                <?endif?>
                
                </a>

                <div class="media-body">
                    <p class="media-meta">
                    by <?=$item->users_node_name?>
                    <?=format_date($item->node_created);?>
                    </p>
                    
                </div>
            </div>
        </div>
        <?php endfor;?>
    </div>
    <?php endfor;?>
    </div>
</div><!--new list end-->
</div><!--drupal recommend standard div end-->


<?$wscn['x_recommand_rendered'] = true;?>
