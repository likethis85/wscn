<?
global $wscn;
if(!empty($wscn['x_recent_rendered'])) return;
$items = $view->result;
?>
<div class="page-header header-red">
    <a href="/news?page=1" class="more pull-right">MORE»</a>
    <h2>最新文章</h2>
</div>
<div class="news-list <?=$classes;?>" <?=$attributes;?>>
    <?foreach($items as $item):?>
    <?if($item->_field_data['nid']['entity']->promote == 1):?>
    <?if($item->field_field_from && $item->field_field_from[0]['raw']['value'] == 2):?>
    <div class="media textonly">
    <?else:?>
    <div class="media">
    <?endif?>
        <?if($item->file_managed_field_data_upload_uri || $item->field_field_image_1):?>
        <a class="pull-left news-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
            <div class="news-img-wrap">
                <img class="lazy" src="<?=path_to_theme()?>/placeholder.gif" data-original="<?=wscn_get_image_thumbnail(wscn_image_domain(wscn_image_url($item)), 200, 130);?>" alt="<?=$item->node_title?>" />
                <noscript><img class="" src="<?=wscn_get_image_thumbnail(wscn_image_domain(wscn_image_url($item)), 200, 130);?>"  alt="<?=$item->node_title?>"></noscript>
            </div>
        </a>
        <?endif?>

        <div class="media-body">
            <h3 class="media-heading"><a href="<?=url('node/'. $item->nid);?>" target="_blank"><?=$item->node_title?></a></h3>
            <p class="media-meta">

            <span class="meta-item">
                文 / <a href="<?=url('columns/'. $item->node_uid);?>" target="blank"><?=$item->users_node_name?></a>
            </span>

            <span class="meta-item">
                <?=format_date($item->node_created);?>
            </span>
           <?if(0 && $item->_field_data['nid']['entity']->taxonomy_vocabulary_2):?> /
           /
           <?foreach($item->_field_data['nid']['entity']->taxonomy_vocabulary_2['und'] as $tag):?>
           <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
           <?endforeach?>
           <?endif?>
           </p>
           <div class="media-content">
               <?=$item->_field_data['nid']['entity']->body['und'][0]['summary']?>
               <?if(0):?>
               <a class="pull-left" href="<?=url('node/'. $item->nid);?>" target="_blank">[阅读全文]</a>
               <?endif?>
           </div>
        </div>
    </div>
    <?endif?>
    <?endforeach?>
</div>

<div class="view-more">
    <a href="/news?page=1">MORE »</a>
</div>
<?$wscn['x_recent_rendered'] = true;?>
