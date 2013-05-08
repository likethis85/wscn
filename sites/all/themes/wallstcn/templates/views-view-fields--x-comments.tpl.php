<?
global $wscn;
if($wscn['x_comments_rendered']) return;
?>
<?$items = $view->result;?>

<div class="page-header">
    <h2>最新评论</h2>
</div>
<div class="comments-list">
    <?foreach($items as $item):?>
    <div class="media">
        <div class="media-body">
            <p class="media-heading">
            <?if($item->comment_uid):?>
            <a href="<?=url('user/'. $item->comment_uid);?>" class="user-name"><?=$item->comment_name?></a>
            <?else:?>
            匿名用户
            <?endif?>
            评论了 <a href="<?=url('node/'. $item->comment_nid);?>"><?=$item->node_comment_title?></a>
            </p>
            <div class="media-content">
                <div class="media-content-body"><?=$item->field_comment_body[0]['raw']['safe_value']?></div>
                <p class="media-meta">
                <?=format_date($item->comment_created);?>
                <a href="<?=url('node/'. $item->comment_nid);?>">回复</a>
                </p>
            </div>

        </div>
    </div>
    <?endforeach?>
</div>


<?$wscn['x_comments_rendered'] = true;?>
