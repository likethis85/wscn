<?if($view_mode == 'full'):?>

<div class="page-header">
    <h1><a href="<?=url('node/' . $node->nid)?>"><?=$node->title?></a></h1>
</div>

<?php if ($display_submitted): ?>
<div class="article-meta clearfix">
    <span class="pull-left">
        <?if($node->taxonomy_vocabulary_2):?>
        <?foreach($node->taxonomy_vocabulary_2['und'] as $tag):?>
        <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
         / <?endforeach?> 
        文 <?=$node->name?> / <?=format_date($node->created);?>
        <?endif?>
    </span>
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

<div class="article-copyright">
    <p>本文内容仅供读者参考，并非投资建议。 转载请注明来源并加上本站链接，华尔街见闻将保留所有法律权益。</p>
    <p>版权采用 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh">知识共享署名-非商业性使用 3.0 未本地化版本许可协议</a> 进行许可 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh"><img alt="知识共享许可协议" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/80x15.png" /></a></p>
    <p></p>
</div>

<?if($node->taxonomy_vocabulary_3):?>
<div class="article-tags">
    文章标签：
    <?foreach($node->taxonomy_vocabulary_3['und'] as $tag):?>
    <a href="<?=url('taxonomy/term/' . $tag['tid'])?>" class="tag"><?=$tag['taxonomy_term']->name?></a>
    <?endforeach?>
</div>
<?endif?>

<?if(variable_get('site_ad')):?>
<div class="ad-box">
<script type="text/javascript">
	google_ad_client = "ca-pub-0869270234052789";
	google_ad_slot = "2492112899";
	google_ad_width = 320;
	google_ad_height = 50;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
<?endif?>

<a href="http://<?=variable_get('site_domain')?>/<?=url('node/' . $node->nid)?>" data-role="button" data-icon="arrow-r" data-theme="b">去网页版参与评论</a>

</article>


<?elseif($view_mode == 'teaser'):?>

<div id="node-<?=$node->nid; ?>" data-role="collapsible" data-theme="d" data-content-theme="d">
    <h2><?=$node->title?></h2>
    <p>
        <h3><?=$node->title?></h3>
        <p>
            文 <?=$node->name?> / <?=format_date($node->created);?>
            <?if($node->taxonomy_vocabulary_2):?> / 
            <?foreach($node->taxonomy_vocabulary_2['und'] as $tag):?>
            <a href="<?=url('taxonomy/term/' . $tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a>
            <?endforeach?>
            <?endif?>
        </p>
        <?=$node->body['und']['0']['summary']?>
        <a href="<?=url('node/' . $node->nid)?>" data-role="button" data-mini="true" data-inline="true" data-icon="arrow-r" data-theme="b">查看全文</a>
    </p>
</div>

<?else:?>

<?=render($content);?>

<?endif?>
