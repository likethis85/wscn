<?
global $wscn;
if(!empty($wscn['x_comments_rendered'])) return;
?>
<?$items = $view->result;?>

<div class="<?=$classes;?>" <?=$attributes;?>>
<div class="page-header">
    <h2>最新评论</h2>
</div>
<div class="comments-list comment-block">
    <?foreach($items as $item):?>
    <div class="media">
        <a class="pull-left" href="<?=url('node/'. $item->comment_nid);?>" target="_blank">
            <?if($item->users_comment_picture):?>
            <?$pic = file_load($item->users_comment_picture);?>
            <img alt="" class="userface" src="<?=image_style_url('thumbnail', $pic->uri);?>" width="50" height="50">
            <?else:?>
            <img alt="" class="userface" src="/sites/all/themes/wallstcn/css/img/avatar.png" width="50" height="50">
            <?endif?>
        </a>
        <div class="media-body">
            <p class="media-heading">
            <?if($item->comment_uid):?>
            <a href="<?=url('node/'. $item->comment_nid);?>" class="user-name"><?=$item->comment_name?></a>
            <?else:?>
            匿名用户
            <?endif?>
            评论了 <a href="<?=url('node/'. $item->comment_nid);?>" target="_blank"><?=$item->node_comment_title?></a>
            </p>
            <div class="media-content">
                <div class="media-content-body"><?=$item->field_comment_body[0]['raw']['safe_value']?></div>
                <p class="media-meta">
                <?=format_date($item->comment_created);?>
                <a href="<?=url('node/'. $item->comment_nid);?>" target="_blank" rel="nofollow">回复</a>
                </p>
            </div>

        </div>
    </div>
    <?endforeach?>
</div>

</div><!--drupal comment standard div end-->
<?$wscn['x_comments_rendered'] = true;?>
