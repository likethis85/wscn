<?$title_prefix = '期货外汇黄金全球市场投资资讯平台';?>
<?if($view_mode == 'full'):?>
<?$page_title = $node->title;
if(!empty($node->taxonomy_vocabulary_2)){
    $tags = array();
    foreach($node->taxonomy_vocabulary_2['und'] as $tag) {
        $tags[] = $tag['taxonomy_term']->name;
    }
    $page_title .= '_' . implode('_', $tags);
}
$page_title .= '_' . $title_prefix;
drupal_set_title($page_title, PASS_THROUGH);?>

<!-- 内容页面包屑导航 -->
<ul class="breadcrumb">
    <li><a href="/" data-thmr="thmr_3">首页</a></li> ›
    <?if($node->taxonomy_vocabulary_2):?>
    <li>
    <?foreach($node->taxonomy_vocabulary_2['und'] as $key => $tag):?><?if($key != 0) print '/'?><a href="<?=wscn_tagmapping($tag['tid'])?>"><?=$tag['taxonomy_term']->name?></a><?endforeach?>
    </li>
    <?endif?>
    ›
</ul>

<article id="node-<?=$node->nid; ?>" class="<?=$classes; ?> clearfix node-article node-single" <?=$attributes; ?>>

<header class="article-header" id="not_livenews_page_sign">
<h1><?=$node->title?></h1>
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
        <?foreach($node->taxonomy_vocabulary_3['und'] as $key => $tag):?><?if($key != 0) print '<font color="black">/</font>'?><a href="<?=url('taxonomy/term/' . $tag['tid'])?>" target="_blank"><?=$tag['taxonomy_term']->name?></a><?endforeach?>
        <!-- old tags
        <//?foreach($node->taxonomy_vocabulary_2['und'] as $tag):?>
        <a href="</?=wscn_tagmapping($tag['tid'])?>"></?=$tag['taxonomy_term']->name?></a>
        </?endforeach?>
        -->
        </span>
        <?endif?>
        <span class="meta-item" >
            <i class="icon-pencil"></i>  文 / <a href="<?=url('columns/'. $node->uid);?>" target="blank"><?=$node->name?></a>
        </span>
        <span class="meta-item">
            <i class="icon-time"></i> <?=format_date($node->created);?>
        </span>
        <span class="meta-item read-count">
        <?if($logged_in && $content['links']['statistics']):?>
        <?=get_counter_totalcount($content['links']['statistics']['#links']['statistics_counter']['title'])?>
        <?endif?>
        </span>
    </span>
    <span class="pull-right"><span class="googleplus-author">来源：<a href="https://plus.google.com/110470401701117498132?rel=author">华尔街见闻</a></span></span>
</div>
<?php endif; ?>

<div class="article-content typo">
    <?=$node->body['und']['0']['safe_value']?>
</div>

<?if(!empty($node->field_related)):?>
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
    <p> <b>*在各大APP商店搜索“华尔街见闻”，可下载我们的移动客户端。同时欢迎关注见闻微信号：wallstreetcn。</b></p>
    <!--<p> <b>*欢迎添加见闻微信公众号：wallstreetcn，每天精选最重要的资讯及时送达你手机。</b></p>
    <p> <b>*欢迎加入华尔街见闻读者QQ群（196387008）交流互动，申请请注明公司与姓名。</b></p> -->
    <p>本文内容仅供读者参考，并非投资建议。 转载请注明来源并加上本站链接，华尔街见闻将保留所有法律权益。</p>
    <p>版权采用 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh">知识共享署名-非商业性使用 3.0 未本地化版本许可协议</a> 进行许可 <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/deed.zh"><img alt="知识共享许可协议" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/80x15.png" /></a></p>
    <p></p>
</div>

<div class="article-slide-bar">

    <div class="article-favorites">
        <div class="slide-bar-text">收藏</div>
        <!--
        <form >
            <input class="action-favorites" type="submit" title="收藏文章" value=" "/>
        </form>
        -->
        <span id="article-favorites-node">
        <?if($logged_in):?>
            <?$fav = get_favorites($user->uid, 'node/' . $node->nid); if(empty($fav)):?>
                <?$add_fav = favorites_block_view(0, 'add', 'node/' . $node->nid); if(!empty($add_fav)):?>
                    <? echo $add_fav['content'] ?>
                <?endif?>
            <?else:?>
                <? echo $fav ?>
            <?endif?>
        <?else:?>
            <input type="submit" name="op" class="action-favorites" value=" " id="favorites_login_alert"/>
        <?endif?>
        </span>
        <div class="article-favorites-tip">
            <span id="favorites_alert"></span>
        </div>
<script>

function favorites_cancel() {
    var $ = window.jQuery;
    var fid = $("#favorites_cancel_fid").val();
    var token = $("#favorites_cancel_token").val();
    $('#favorites_alert').html('取消收藏成功');
    $.get("/favorites/remove/" + fid + "?js=2&token=" + token, function(data){
        $('#article-favorites-node').html(data);

        $('.article-favorites .article-favorites-tip')
            .stop()
            .animate({
                width: '120px'
            }, 1000)
            .delay(1000)
            .animate({
                width: '0'
            }, 1000);

    });
}
</script>

    </div>

    <div class="article-share">

        <div class="slide-bar-text">分享</div>
        <div class="jiathis_style_32x32">
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_twitter"></a>
            <a class="jiathis_counter_style"></a>
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
        </div>
        <script type="text/javascript" >
            <?
                $summary = rtrim(addslashes(html_entity_decode(strip_tags($node->body['und']['0']['summary']))), "\n\r");
                $summary = mb_strlen($summary) > 100 ? mb_substr($summary, 0, 100, 'utf-8') . '...'  : $summary;
                $summary = str_ireplace(array('&ldquo;', '&rdquo;'), array('“', '“'), $summary);
            ?>
            var jiathis_config={

                data_track_clickback:true,
                title : "好文分享：【<?=$summary?>】。本文来自华尔街见闻网站：",
                summary : " ",
                pic : "<?=wscn_image_domain(file_create_url($node->upload['und'][0]['uri']));?>"
            }
        </script>
        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1673372" charset="utf-8"></script>
    </div>


</div>



<?if(0 && variable_get('site_ad')):?>
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

<?if(variable_get('site_ad')):?>
<div class="random-ad" style="margin-bottom:0;">
    <div class="carousel-inner">
        <!--
        <div class="item"   data-probability="80">
            <div style="margin:0 auto;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="90" width="728"><param name="quality" value="high" /><param name="movie" value="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_gb513_1.swf" /><embed height="90" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_gb513_1.swf" type="application/x-shockwave-flash" width="728"></embed></object>
            </div>
        </div>

        <div class="item" data-probability="25">
            <div style="margin:0 auto;">
                <a target="_blank" href="http://wallstreetcn.com/redirect.htm?type=__ads_wscn_index_hit_ironfx_2&url=https://www.ironfx.cn/zh/register?utm_source=wallstreetcn728_90HPIB&utm_mediumwallstreetcn728_90HPIB&utm_campaign=wallstreetcn"><img src="http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_ironfx_2.jpg" alt=""></a>
            </div>
        </div>
        -->
        <div class="item"  data-probability="100">
            <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-0869270234052789"
                 data-ad-slot="7788817240"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
</script>
        </div>
    </div>
</div>
<?endif?>

<div class="hot-news">

    <h2 class="hot-news-header">
        更多热点
        <a href="/discovery" target="_blank" class="hot-news-more">MORE»</a>
    </h2>
    <div class="hot-news-list row-fluid">
    <? $discovery_arr=get_discovery_item();
       /*
       $item = menu_get_item();
       if ($item['href'] == 'node/70962' || $item['href'] == 'node/70836' || $item['href'] == 'node/71029') {
           $discovery_arr[0] = array('title' => '华尔街“男神”2014着装行头',
                               'url'   => 't.55bbs.com/pin/891460/?tuiguangid=huaerjie',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_55bbs_1.jpg',
                         );
       }
    */
    foreach($discovery_arr as $k => $e):?>
        <div class="span4">
            <div class="hot-news-content">
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-img">
                    <img src="<?=wscn_get_image_thumbnail($e['img'], 210, 130)?>" alt="<?=$e['title']?>" />
                </a>
                <a href="http://<?=$e['url']?>" target="_blank" class="hot-news-title"><?=$e['title']?></a>
            </div>
        </div>
    <?if($k == 2):?>
    </div>
    <div class="hot-news-list row-fluid">
    <?endif;?>
    <?endforeach;?>
    </div>
</div>

<?if(!empty($node->taxonomy_vocabulary_3)):?>
<div id="related-read" class="">
    <h5>关键字阅读：</h5>
    <ul class="nav nav-tabs">
        <? foreach($node->taxonomy_vocabulary_3['und'] as $key => $tag):?>
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



<?
$comments = array();
if(!empty($content['comments']['comments'])) {
    $comments = $content['comments']['comments'];
    unset($comments['#sorted']);
    unset($comments['pager']);
}
?>
<?if($node->comment == 2 || $comments):?>
<div class="page-header header-blue">
    <h2>评论</h2>
</div>

<div class="comments-list">

    <?foreach($comments as $item):?>
    <?$comment = $item['#comment'];?>
    <div id="comment-<?=$comment->cid?>" class="media">


        <!--<div class="media-avatar">
            <img src="" alt=""/>
        </div>-->

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

<?if(isset($node->field_from) && isset($node->field_from['und'][0]['value']) && $node->field_from['und'][0]['value'] == 2):?>
<div id="node-<?=$node->nid; ?>" class="<?=$classes;?> clearfix node-article media textonly" <?=$attributes;?>>
<?else:?>
<div id="node-<?=$node->nid; ?>" class="<?=$classes;?> clearfix node-article media <?=$view->name=='gold'?'gold':''?>" <?=$attributes;?>>
<?endif?>

    <?if(isset($node->field_upload) && $node->field_upload['und']):?>
    <a class="pull-left news-img" href="<?=url('node/'. $node->nid);?>" target="_blank">
        <div class="news-img-wrap">
            <img class="lazy" src="/sites/all/themes/wallstcn/placeholder.gif" data-original="<?=wscn_get_image_thumbnail(wscn_image_domain(file_create_url($node->field_upload['und'][0]['uri'])), 200, 140);?>" <?=$node->title?> />
            <noscript><img class="" src="<?=wscn_get_image_thumbnail(wscn_image_domain(file_create_url($node->field_upload['und'][0]['uri'])), 200, 140);?>"  alt="<?=$node->title?>"></noscript>
        </div>
    </a>
    <?endif?>

    <?if(isset($node->upload['und']) && $node->upload['und']):?>
    <a class="pull-left news-img" href="<?=url('node/'. $node->nid);?>" target="_blank">
        <div class="news-img-wrap">
            <img class="lazy" src="/sites/all/themes/wallstcn/placeholder.gif" data-original="<?=wscn_get_image_thumbnail(wscn_image_domain(file_create_url($node->upload['und'][0]['uri'])), 200, 140)?>"  alt="<?=$node->title?>" />
            <noscript><img class="" src="<?=wscn_get_image_thumbnail(wscn_image_domain(file_create_url($node->upload['und'][0]['uri'])), 200, 140)?>"  alt="<?=$node->title?>"></noscript>
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
                <span class="meta-item read-count" title="阅读次数">
                    <?=wscn_get_node_totalcount($node->nid)?>
                </span>
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
