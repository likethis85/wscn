<?
global $wscn;
if($wscn['x_recent_rendered']) return;
?>
<?$items = $view->result;?>
<div class="page-header header-red">
    <a href="/news?page=1" class="more pull-right">更多</a>
    <h2>最新文章</h2>
</div>
<div class="news-list">
    <?foreach($items as $item):?>
    <div class="media">
        <?if($item->file_managed_field_data_upload_uri || $item->field_field_image_1):?>
        <a class="pull-left news-img" href="<?=url('node/'. $item->nid);?>">
            <img alt="" class="" src="<?=wscn_image_url($item);?>">
        </a>
        <?endif?>
        <div class="media-body">
            <h3 class="media-heading"><a href="<?=url('node/'. $item->nid);?>"><?=$item->node_title?></a></h3>
            <p class="media-meta">
           文 <a href="/user/<?=$item->users_node_uid?>"><?=$item->users_node_name?></a>
           / <?=format_date($item->node_created);?>
           <!--
           <?if($item->_field_data['nid']['entity']->taxonomy_vocabulary_2):?> / 
           <?foreach($item->_field_data['nid']['entity']->taxonomy_vocabulary_2['und'] as $tag):?>
           <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
           <?endforeach?>
           <?endif?>
           -->
           </p>
           <div class="media-content">
               <div><?=$item->_field_data['nid']['entity']->body['und'][0]['summary']?></div>
           </div>
            <a class="btn btn-readmore" href="<?=url('node/'. $item->nid);?>">阅读全文</a>
        </div>
    </div>
    <?endforeach?>
</div>

<div class="view-more">
    <a href="/news?page=1">查看更多 »</a>
</div>
<?$wscn['x_recent_rendered'] = true;?>
