<?
global $wscn;
if($wscn['x_topnews_rendered']) return;

$items = $view->result;
$item = $items[0];
unset($items[0]);
if(!$item->field_field_related){
    unset($items[count($items) - 1]);
}
?>

<div id="top-news" class="<?if(!$item->field_field_related):?>no-related<?endif?>">
    <div class="row-fluid">
        <div class="span7">
            <div class="top-news-entry">
                <div class="row-fluid">
                    <div class="span12">
                        <a class="entry-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
                            <div class="entry-img-wrap">
                                <img alt="" class="span12" src="<?=wscn_image_domain(file_create_url($item->uri));?>" />
                            </div>
                        </a>
                    </div>
                    <?if(0):?>
                    <div class="entry-meta">
                        <?=format_date($item->node_created);?>
                    </div>                    
                    <?endif?>
                    <h2 class="entry-title"><a href="<?=url('node/'. $item->nid);?>"  target="_blank"><?=$item->node_title?></a></h2>
                    <div class="top-new-extra">
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
                </div>
            </div>
        </div><!--span6 end -->
        <div class="span5">
            <div class="page-header header-blue">
                <a href="/topnews" class="more pull-right"  target="_blank">MORE»</a>
                <h3>头条新闻</h3>
            </div>
            <?foreach($items as $item):?>
            <div class="media text-only">
                <div class="media-body">
                    <h2 class="media-heading"><a href="<?=url('node/'. $item->nid);?>"  target="_blank"><?=$item->node_title?></a></h2>
                </div>
            </div>
            <?endforeach;?>
        </div><!--span6 end -->
    </div><!--row end -->

</div><!-- top news end-->

<?$wscn['x_topnews_rendered'] = true?>
