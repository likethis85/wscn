<?if($view_mode == 'full'):?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-article node-single" <?php print $attributes; ?>>

<header class="article-header">
<h1><a href="<?=url('node/' . $node->nid)?>"><?=$node->title?></a></h1>
</header>

<?if(!$node->status):?>
<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>本文尚未发布</strong> <a href="/node/<?=$node->nid?>/edit" class="btn">编辑</a>
</div>
<?endif?>

<?php if ($display_submitted): ?>
<div class="article-meta clearfix">
    <span class="pull-left">
        <?if($node->taxonomy_vocabulary_2):?>
        <span class="meta-item">
            <i class="icon-tags"></i> 
        <?foreach($node->taxonomy_vocabulary_2['und'] as $tag):?>
        <a href="<?=wscn_tagmapping($tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
        <?endforeach?> 
        </span>
        <?endif?>
        <span class="meta-item">
            <i class="icon-pencil"></i>  文 / <a href="<?=url('columns/'. $node->uid);?>" target="blank"><?=$node->name?></a>
        </span>
        <span class="meta-item">
            <i class="icon-time"></i> <?=format_date($node->created);?>
        </span>
        <span class="meta-item">
        <?if($logged_in && $content['links']['statistics']):?>
        <i class="icon-desktop"></i> <?=$content['links']['statistics']['#links']['statistics_counter']['title']?>
        <?endif?>
        </span>
    </span>
    <span class="pull-right"><span class="googleplus-author">来源：<a href="https://plus.google.com/110470401701117498132?rel=author">华尔街见闻</a></span></span>
</div>
<?php endif; ?>

<div class="article-content typo">
    <?=$node->body['und']['0']['value']?>
</div>

<?if($node->field_related):?>
<div class="article-related">
    <h2>相关文章：</h2>
    <ul>
        <?foreach($node->field_related['und'] as $related):?>
        <li><h3><a href="<?=url('node/'. $related['entity']->nid);?>"><?=$related['entity']->title?></a></h3></li>
        <?endforeach?>
    </ul>
</div>
<?endif?>

<?if(0):?>
<script type="text/javascript" id="wumiiRelatedItems"></script>
<script type="text/javascript">
    var wumiiPermaLink = "123"; //请用代码生成文章永久的链接
    var wumiiTitle = "123"; //请用代码生成文章标题
    var wumiiTags = "美国"; //请用代码生成文章标签，以英文逗号分隔，如："标签1,标签2"
    var wumiiCategories = []; //请用代码生成文章分类，分类名放在 JSONArray 中，如: ["分类1", "分类2"]
    var wumiiSitePrefix = "http://wallstreetcn.com/";
    var wumiiParams = "&num=5&mode=1&pf=JAVASCRIPT";
</script>
<script type="text/javascript" src="http://widget.wumii.cn/ext/relatedItemsWidget"></script>
<?endif?>



<div class="article-copyright">
    <p>本文内容仅供读者参考，并非投资建议。 转载请注明来源并加上本站链接，华尔街见闻将保留所有法律权益。</p>
    <p>版权采用 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh">知识共享署名-非商业性使用 3.0 未本地化版本许可协议</a> 进行许可 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh"><img alt="知识共享许可协议" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/80x15.png" /></a></p>
    <p></p>
</div>




<div class="article-share">
    <!-- JiaThis Button BEGIN -->
    <div class="jiathis_style_32x32">
        <a class="jiathis_button_tsina"></a>
        <a class="jiathis_button_tqq"></a>
        <a class="jiathis_button_weixin"></a>
        <a class="jiathis_button_twitter"></a>
        <a class="jiathis_button_googleplus"></a>
        <a class="jiathis_button_fb"></a>
        <a class="jiathis_button_email"></a>
        <a class="jiathis_button_copy"></a>
        <a class="jiathis_button_fav"></a>
        <a class="jiathis_button_print"></a>
        <a class="jiathis_counter_style"></a>
    </div>
    <script type="text/javascript" >
        var jiathis_config={
                data_track_clickback:true,
                summary:"",
                hideMore:true
            }
        </script>
        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1673372" charset="utf-8"></script>
        <!-- JiaThis Button END -->
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

<?if($node->taxonomy_vocabulary_3):?>
<div id="related-read" class="">
    <h5>关键字阅读：</h5>
    <ul class="nav nav-tabs">
        <?foreach($node->taxonomy_vocabulary_3['und'] as $key => $tag):?>
        <li><a data-toggle="tab" href="#related-read-<?=$key?>" data-tab-url="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a></li>
        <?endforeach?>
    </ul>
    <div class="tab-content">
        <?foreach($node->taxonomy_vocabulary_3['und'] as $key => $tag):?>
        <div id="related-read-<?=$key?>" class="tab-pane fade" data-tid="<?=$tag['tid']?>"><a href="<?=url('taxonomy/term/' . $tag['tid'])?>" class="tag"><?=$tag['taxonomy_term']->name?></a></div>
        <?endforeach?>
    </div>

<script id="related-read-js" type="text/x-tmpl">
    <ul>
        {% var max = o.results.length > 10 ? 10 : o.results.length; %}
        {% for (var i=0; i < max; i++) { %}
        {% var item = o.results[i]; %}
        <li><a href="{%=item.url%}" target="_blank">{%=item.title%}</a></li>
        {% } %}
        {% if(o.results.length >= 10) { %}
            <li class="last"><a href="/taxonomy/term/{%=o.tid%}" target="_blank" class="pull-right">MORE»</a></li>
        {% } %}
    </ul>
</script>

</div>
<?endif?>



<?if(0 && $node->taxonomy_vocabulary_3):?>
<div class="article-tags">
    文章标签：
    <?foreach($node->taxonomy_vocabulary_3['und'] as $tag):?>
    <a href="<?=url('taxonomy/term/' . $tag['tid'])?>" class="tag"><?=$tag['taxonomy_term']->name?></a>
    <?endforeach?>
</div>
<?endif?>



<?$comments = $content['comments']['comments'];
unset($comments['#sorted']);
unset($comments['pager']);
//var_dump($comments);
?>
<?if($node->comment == 2 || $comments):?>
<div class="page-header header-blue">
    <h2>评论</h2>
</div>

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
                <a href="<?=url('node/'. $comment->nid);?>#comment-form"><i class="icon-comment"></i> 回复</a>
                </p>
            </div>

        </div>
    </div>
    <?endforeach?>
</div>

<?endif?>

<?if($node->comment == 2 && !$logged_in):?>
<div>
    请<a href="/user">登录</a>后发表评论，新用户请<a href="/user/register">点击注册</a>
</div>
<?endif?>

<?=render($content['comments']['comment_form'])?>

</article>


<?elseif($view_mode == 'teaser'):?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-article media" <?php print $attributes; ?>>

    <?if($node->upload['und']):?>
    <a class="pull-left news-img" href="<?=url('node/'. $item->nid);?>" target="_blank">
        <div class="news-img-wrap">
            <img class="lazy" src="/sites/all/themes/wallstcn/placeholder.gif" data-original="<?=wscn_image_domain(file_create_url($node->upload['und'][0]['uri']));?>" />
            <noscript><img alt="" class="" src="<?=wscn_image_domain(file_create_url($node->upload['und'][0]['uri']));?>"></noscript>
        </div>
    </a>
    <?endif?>

    <div class="media-body">
        <header class="media-heading">
        <h2><a href="<?=url('node/' . $node->nid)?>" target="_blank"><?=$node->title?></a></h2>
        </header>

        <?php if ($display_submitted): ?>
        <div class="media-meta clearfix">
            <span class="pull-left">
                <span class="meta-item">
                    文 / <a href="<?=url('columns/'. $node->uid);?>" target="blank"><?=$node->name?></a>
                </span>
                <span class="meta-item">
                    <?=format_date($node->created);?>
                </span>
                <?if($node->taxonomy_vocabulary_2):?> 
                <span class="meta-item">
                <?foreach($node->taxonomy_vocabulary_2['und'] as $tag):?>
                <a href="<?=wscn_tagmapping($tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
                <?endforeach?>
                </span>
                <?endif?>
            </span>
        </div>
        <?php endif; ?>

        <div class="media-content">
            <?=$node->body['und']['0']['summary']?>
        </div>

    </div><!-- media body end-->
</div><!-- node teaser end-->

<?else:?>

<?=render($content);?>

<?endif?>
