<?if($view_mode == 'full'):
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-article node-livenews" <?php print $attributes; ?>>

<div class="page-header header-red" id="livenews_page_sign">
    <h3><a class="page-header-link" href="http://live.wallstreetcn.com/">实时新闻</a> &nbsp;&nbsp;&nbsp;&nbsp;<?=format_date($node->created);?></h3>
</div>

<div class="article-meta clearfix">
    <span class="pull-left">
        文 <a href="<?=url('user/'. $node->uid);?>"><?=$node->name?></a>
        <?if($node->field_location):?> /
        <?foreach($node->field_location['und'] as $tag):?>
        <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
        <?endforeach?>
        <?endif?>
        /  分享到：
    </span>
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
    <script type="text/javascript" >
    var jiathis_config={
        data_track_clickback:true,
        url:"http://live.<?=variable_get('site_domain')?>/node/<?=$node->nid?>",
        summary:"<?=$node->title?>",
        title:"<?=$node->title?>",
        ralateuid:{
            "tsina":"1875034341"
        },
        hideMore:false
    }
    </script>
    <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1773865" charset="utf-8"></script>
</div>

<div class="article-content typo">
    <?=$node->body['und']['0']['safe_value']?>

    <?if(!empty($node->upload['und']) && $node->upload['und']):?>
    <img alt="" class="" src="<?=file_create_url($node->upload['und'][0]['uri']);?>">
    <?endif?>
</div>


<div class="article-tags">
    新闻标签 ：
    <?if($node->field_category):?>
    <?foreach($node->field_category['und'] as $tag):?>
    <a href="<?=url('taxonomy/term/' . $tag['tid'])?>" class="tag"><?=$tag['taxonomy_term']->name?></a>
    <?endforeach?>
    <?endif?>
</div>


<div class="article-copyright">
    <p> <b>*欢迎添加见闻微信公众号：wallstreetcn，每天精选最重要的资讯及时送达你手机。</b></p>
    <p> <b>*欢迎加入见闻读者贵金属QQ群（152103904）交流互动，申请时请注明“公司（行业）-城市-姓名”，谢谢配合。</b></p>
    <p>版权采用 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh">知识共享署名-非商业性使用 3.0 未本地化版本许可协议</a> 进行许可 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh"><img alt="知识共享许可协议" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/80x15.png" /></a></p>
</div>

<?if(variable_get('site_ad')):?>
<div class="ad-box">
<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-0869270234052789"
     data-ad-slot="7788817240"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<?endif?>


<?$comments = $content['comments']['comments'];
unset($comments['#sorted']);
unset($comments['pager']);
?>

<?if($node->comment == 2 || $comments):?>
<div class="page-header header-blue">
    <h2>评论</h2>
</div>
<?endif?>



<div id="comment-ajax">

    <?if(!empty($node->upload['und']) || $node->body['und']['0']['summary'] && $node->body['und']['0']['value'] != $node->body['und']['0']['summary']):?>
    <div class="live-news-full hide">
        <?if($node->body['und']['0']['value'] != $node->body['und']['0']['summary']):?>
        <?=$node->body['und']['0']['value']?>
        <?endif?>
        <img alt="" class="" src="<?=file_create_url($node->upload['und'][0]['uri']);?>">
    </div>
    <?endif?>

    <?if($node->comment == 2 || $comments):?>
    <div class="comments-list">

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
                    <div class="media-content-body typo"><?=$comment->comment_body['und'][0]['safe_value']?></div>
                    <p class="media-meta">
                    <a href="<?=url('node/'. $comment->nid);?>#comment-form">回复</a>
                    </p>
                </div>

            </div>
        </div>
        <?endforeach?>
    </div>
    <?endif?>

    <?if(!$comments && $node->comment == 2):?>
    <div class="comment-message">
        还没有评论
    </div>
    <?endif?>

    <?if($node->comment != 2):?>
    <div class="comment-message">
        当前文章不允许评论
    </div>
    <?endif?>

    <?=render($content['comments']['comment_form'])?>


    <?if($node->comment == 2 && !$logged_in):?>
    <div>
        请<a href="/user">登录</a>后发表评论，新用户请<a href="/user/register">点击注册</a>
    </div>
    <?endif?>

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


