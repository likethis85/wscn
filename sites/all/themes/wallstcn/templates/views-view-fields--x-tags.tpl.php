<?
global $wscn;
if($wscn['x_tags_rendered']) return;
?>
<?$items = $view->result;
$max = $items[0]->taxonomy_term_data_tid;
$min = $items[count($items) - 1]->taxonomy_term_data_tid;
shuffle($items);
//taxonomy_term_data_tid
//p($items, 1);exit;
?>

<div class="page-header">
    <h2>热门标签</h2>
</div>
<div class="tag-cloud">
    <?foreach($items as $item):?>
    <a href="<?=url('taxonomy/term/'. $item->tid);?>" style="font-size:<?=ceil(log($item->taxonomy_term_data_tid, 20) * 5)?>pt"><?=$item->taxonomy_term_data_name?></a>
    <?endforeach?>
</div>


<?$wscn['x_tags_rendered'] = true;?>
