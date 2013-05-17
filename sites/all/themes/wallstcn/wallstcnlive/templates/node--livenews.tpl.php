<?if($view_mode == 'full'):?>
<?//p($node, 1)?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-article node-livenews" <?php print $attributes; ?>>

<div class="page-header header-red">
    <h3>实时新闻 <?=format_date($node->created);?></h3>
</div>

<div class="article-meta clearfix">
    <span class="pull-left">
        文 <a href="<?=url('user/'. $comment->uid);?>"><?=$node->name?></a>
        <?if($node->field_location):?> / 
        <?foreach($node->field_location['und'] as $tag):?>
        <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
        <?endforeach?>
        <?endif?>
        /  分享到：
    </span>
    <!-- JiaThis Button BEGIN -->
    <div class="jiathis_style">
        <a class="jiathis_button_tsina"></a>
        <a class="jiathis_button_tqq"></a>
        <a class="jiathis_button_weixin"></a>
        <a class="jiathis_button_douban"></a>
        <a class="jiathis_button_fb"></a>
        <a class="jiathis_button_twitter"></a>
        <a class="jiathis_button_copy"></a>
        <a class="jiathis_button_fav"></a>
    </div>
    <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1773865" charset="utf-8"></script>
    <!-- JiaThis Button END -->


</div>

<div class="article-content typo">
    <?=$node->body['und']['0']['value']?>

    <?if($node->upload):?>
    <img alt="" class="" src="<?=file_create_url($node->upload['und'][0]['uri']);?>">
    <?endif?>
</div>


<div class="article-tags">
    新闻标签：
    <?if($node->field_category):?>
    <?foreach($node->field_category['und'] as $tag):?>
    <a href="<?=url('taxonomy/term/' . $tag['tid'])?>" class="tag"><?=$tag['taxonomy_term']->name?></a>
    <?endforeach?>
    <?endif?>
</div>


<div class="article-copyright">
    <p>本文内容仅供读者参考，并非投资建议。 转载请注明来源并加上本站链接，华尔街见闻将保留所有法律权益。</p>
    <p>版权采用 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh">知识共享署名-非商业性使用 3.0 未本地化版本许可协议</a> 进行许可 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh"><img alt="知识共享许可协议" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/80x15.png" /></a></p>
    <p></p>
</div>




<div class="page-header header-blue">
    <h2>评论</h2>
</div>

<div id="comment-ajax">

<div class="comments-list">
    <?$comments = $content['comments']['comments'];
    unset($comments['#sorted']);
    unset($comments['pager']);
?>
<?foreach($comments as $item):?>
<?$comment = $item['#comment'];?>
<div id="comment-<?=$comment->cid?>" class="media">
    <div class="media-body">
        <p class="media-heading">
        <?if($comment->uid):?>
        <a href="<?=url('user/'. $comment->uid);?>" class="user-name"><?=$comment->name?></a>
        <?else:?>
        匿名用户
        <?endif?>
        于 <?=format_date($comment->created);?>
        </p>
        <div class="media-content">
            <div class="media-content-body typo"><?=$comment->subject?></div>
            <p class="media-meta">
            <a href="<?=url('node/'. $comment->nid);?>#comment-form">回复</a>
            </p>
        </div>

    </div>
</div>
<?endforeach?>
</div>

<?=render($content['comments']['comment_form'])?>

</div><!--comment ajax end-->
</article>


<?elseif($view_mode == 'teaser'):?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-article" <?php print $attributes; ?>>

<header class="article-header">
<h2><a href="<?=url('node/' . $node->nid)?>"><?=$node->title?></a></h2>
</header>

<?php if ($display_submitted): ?>
<div class="article-meta clearfix">
    <span class="pull-left">
        文 <a href="<?=url('user/'. $node->uid);?>"><?=$node->name?></a> / <?=format_date($node->created);?>
        <?if($node->taxonomy_vocabulary_2):?> / 
        <?foreach($node->taxonomy_vocabulary_2['und'] as $tag):?>
        <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
        <?endforeach?>
        <?endif?>
    </span>
</div>
<?php endif; ?>

<div class="article-summary typo">
    <?=$node->body['und']['0']['summary']?>
</div>

</article>


<?else:?>

<?=render($content);?>

<?endif?>
