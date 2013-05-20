<?
global $wscn;
if($wscn['x_topnews_rendered']) return;

$items = $view->result;
$item = $items[0];
unset($items[0]);
?>

<div id="top-news">
    <div class="row-fluid">
        <div class="span7">
            <div class="top-news-entry">
                <div class="row-fluid">
                    <div class="span12">
                        <a href="<?=url('node/'. $item->nid);?>">
                            <!--<img alt="" class="span12" src="<?=file_create_url($item->field_field_image_1[0]['raw']['uri']);?>">-->
                            <img alt="" class="span12" src="<?=file_create_url($item->uri);?>">
                        </a>
                    </div>
                    <div class="entry-meta">
                        <?=format_date($item->node_created);?>
                    </div>                    
                    <h2 class="entry-title"><a href="<?=url('node/'. $item->nid);?>"><?=$item->node_title?></a></h2>

                    <?if($item->field_field_related):?>
                    <ul class="top-new-extra">
                        <?foreach($item->field_field_related as $related_item):?>
                        <li><a href="<?=url('node/'. $related_item['raw']['entity']->nid);?>"><?=$related_item['raw']['entity']->title?></a></li>
                        <?endforeach?>
                    </ul>
                    <?elseif($item->field_body):?>
                    <div class="top-new-extra">
                        <?=$item->field_body[0]['raw']['summary']?>
                    </div>
                    <?endif?>
                </div>
            </div>
        </div><!--span6 end -->
        <div class="span5">
            <div class="page-header header-blue">
                <a href="/taxonomy/term/3118" class="more pull-right">更多</a>
                <h3>头条新闻</h3>
            </div>
            <?foreach($items as $item):?>
            <div class="media text-only">
                <div class="media-body">
                    <h2 class="media-heading"><a href="<?=url('node/'. $item->nid);?>"><?=$item->node_title?></a></h2>
                </div>
            </div>
            <?endforeach;?>
        </div><!--span6 end -->
    </div><!--row end -->

</div><!-- top news end-->

<?$wscn['x_topnews_rendered'] = true?>
