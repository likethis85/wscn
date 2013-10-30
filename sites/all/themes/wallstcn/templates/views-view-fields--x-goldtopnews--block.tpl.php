<?
$items = $view->result;
$item = $items[0];
unset($items[0]);
if(!$item->field_field_related){
    unset($items[count($items) - 1]);
}

?>

<div id="top-news" class="<?if(!$item->field_field_related):?>no-related<?endif?> <?=$classes;?>" <?=$attributes;?>>
    <div class="row-fluid">
        <div class="span12">
            <div class="top-news-entry" style="height:auto;">
                <div class="row-fluid">
                    <div class="span6">
                        <h2 class="entry-title" style="margin-top;0;"><a href="<?=url('node/'. $item->nid);?>"  target="_blank"><?=$item->node_title?></a></h2>
                        <?if($item->field_body):?>
                        <?=$item->field_body[0]['raw']['summary']?>
                        <?endif?>
                        <?if($item->field_field_related):?>
                        <ul class="">
                            <?foreach($item->field_field_related as $related_item):?>
                            <li><a href="<?=url('node/'. $related_item['raw']['entity']->nid);?>"  target="_blank"><?=$related_item['raw']['entity']->title?></a></li>
                            <?endforeach?>
                        </ul>
                        <?endif?>
                    </div>
                    <div class="span6">
                        <a class="entry-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
                            <div class="entry-img-wrap">
                                <img class="span12" src="<?=wscn_image_domain(file_create_url($item->file_managed_file_usage_uri));?>"  alt="<?=$item->node_title?>" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!--row end -->

</div><!-- top news end-->

<div class="page-header header-red">
    <!--<a href="/news?page=1" class="more pull-right">MORE»</a>-->
    <h2>最新文章</h2>
</div>

