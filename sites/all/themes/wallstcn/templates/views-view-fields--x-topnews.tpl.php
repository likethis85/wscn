<?
global $wscn;
if(!empty($wscn['x_topnews_rendered'])) return;

$items = $view->result;
$item = $items[0];
unset($items[0]);
if(!$item->field_field_related){
    unset($items[count($items) - 1]);
}
$picNews = array();
foreach($items as $key => $news) {
    if(isset($news->field_data_field_weight_field_weight_value) && $news->field_data_field_weight_field_weight_value == 123 ) {
        $picNews[] = $news;
        unset($items[$key]);
    }
}
?>

<div id="top-news" class="align-bottom <?if(!$item->field_field_related):?>no-related<?endif?> <?=$classes;?>" <?=$attributes;?>>
    <div class="row-fluid">
        <div class="span7">
            <div class="top-news-entry">
                <div class="row-fluid">
                    <div class="span12">

                        <?if(0):?>
                        <a class="entry-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
                            <div class="entry-img-wrap">
                                <img class="span12" src="<?=wscn_image_domain(file_create_url($item->uri));?>"  alt="<?=$item->node_title?>" />
                            </div>
                        </a>
                        <?endif?>


                        <div id="top-carousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#top-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#top-carousel" data-slide-to="1"></li>
                                <li data-target="#top-carousel" data-slide-to="2"></li>
                                <!--<li data-target="#top-carousel" data-slide-to="3"></li>-->
                            </ol>
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="active item">
                                    <a class="entry-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
                                        <div class="entry-img-wrap">
                                            <img alt="" class="span12" src="<?=wscn_get_image_thumbnail(wscn_image_domain(file_create_url($item->uri)), 406, 271);?>" />
                                        </div>
                                    </a>
                                </div>
                                <?if($picNews):?>
                                <?foreach($picNews as $picitem):?>
                                <div class="item">
                                    <a class="entry-img" href="<?=url('node/'. $picitem->nid);?>" target="_blank">
                                        <div class="entry-img-wrap">
                                            <img alt="" class="span12" src="<?=wscn_get_image_thumbnail(wscn_image_domain(file_create_url($picitem->uri)), 406, 271);?>" />
                                        </div>
                                        <div class="carousel-caption">
                                            <h2><?=$picitem->node_title?></h2>
                                        </div>

                                    </a>
                                </div>
                                <?endforeach?>
                                <?endif?>
                                <!--
                                <div class="item">
                                    <a class="entry-img" href="redirect.htm?type=__ads_wscn_index_hit_zsgjs_1&url=http://www.zsgjs.com/ws/" target="_blank">
                                        <div class="entry-img-wrap">
                                            <img alt="广告" class="" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_zsgjs_1.jpg" width="406" height="240" />
                                        </div>
                                    </a>
                                </div>
                                -->
                            </div>
                            <!-- Carousel nav -->
                            <a class="carousel-control left" href="#top-carousel" data-slide="prev">&lsaquo;</a>
                            <a class="carousel-control right" href="#top-carousel" data-slide="next">&rsaquo;</a>
                        </div>

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
