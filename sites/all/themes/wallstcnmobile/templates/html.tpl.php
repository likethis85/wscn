<?//print_r(menu_get_item());die;?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?if ($node = menu_get_object()):?>
        <title><?=$head_title; ?></title>
        <?if (isset($node->taxonomy_vocabulary_3['und'])):?>
        <meta name="keywords" content="<?foreach($node->taxonomy_vocabulary_3['und'] as $tag):?><?=$tag['taxonomy_term']->name?>,<?endforeach?>" />
        <?endif?>
        <meta name="description" content="<?= rtrim(addslashes(html_entity_decode(strip_tags($node->body['und']['0']['summary']))), "\n\r"); ?>">
    <?else:?>
        <?if($item = menu_get_item()):?>
            <?if($item['href'] == 'taxonomy/term/3119'):?>
            <title>华尔街见闻_移动版_编辑推荐_外汇_期货_大宗商品_贵金属_黄金_股市_行情</title>
            <meta name="keywords" content="编辑推荐,外汇,期货,金融,黄金,白银,债券,股市,投资,财经日历,银行,新闻,美元,欧元,日元,人民币," />
            <meta name="description" content="华尔街见闻移动版——中国最专业的移动金融资讯平台；为您推荐外汇、期货、黄金、债券、证券等金融领域的实时新闻。投资者可以在这里得到精选的金融资讯。" />
            <?elseif($item['href'] == 'livenews'):?>
            <title>华尔街见闻_移动版_实时新闻_直播_外汇_期货_大宗商品_贵金属_黄金_股市_行情</title>
            <meta name="keywords" content="实时新闻,直播,外汇,期货,金融,黄金,白银,债券,股市,投资,财经日历,银行,新闻,美元,欧元,日元,人民币," />
            <meta name="description" content="华尔街见闻移动版——中国最专业的移动金融资讯平台；为您推荐外汇、期货、黄金、债券、证券等金融领域的实时新闻。直播最新,最快速,最准确的全球金融资讯。" />
            <?else:?>
            <title>华尔街见闻_移动版_中国最专业金融资讯平台_外汇_期货_大宗商品_贵金属_黄金_股市_行情</title>
            <meta name="keywords" content="移动直播,外汇,期货,金融,黄金,白银,债券,股市,投资,财经日历,银行,新闻,美元,欧元,日元,人民币," />
            <meta name="description" content="华尔街见闻移动版——中国最专业的移动金融资讯平台；直播外汇、期货、黄金、债券、证券等金融领域的实时新闻。华人投资者可以在这里获得最快速、最精准、最深入的全球财经资讯和市场行情。" />
            <?endif?>
        <?endif?>
    <?endif?>

    <style>

        .ui-header .ui-title {
            margin-left: auto !important;
            margin-right: auto !important;
        }

    </style>



    <?if(0):?>
        <title><?=$head_title; ?></title>
        <?if($is_front):?>
        <meta name="description" content="华尔街见闻隶属上海阿牛信息科技有限公司，是一个专业的的全球金融资讯中文平台 商，为全球金融市场投资者和从业者提供经济和金融市场信息">
        <?endif?>
    <?endif?>

    <meta name="viewport" content="width=device-width">
    <?=$head?>
    <?=$styles; ?>
    <!--[if IE 6]>
    <script src="/sites/all/themes/wallstcn/js/killie6.js"></script>
    <![endif]-->
    <?=$scripts; ?>
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <link href="/sites/all/themes/wallstcn/css/fontawesome/css/font-awesome-ie7.min.css" media="all" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if lt IE 7]>
    <link href="/sites/all/themes/wallstcn/css/bootstrap/ie6.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/sites/all/themes/wallstcn/js/ie6.js"></script>
    <![endif]-->
    <link rel="alternate" type="application/rss+xml" title="华尔街见闻" href="http://wallstreetcn.com/rss.xml" />
    <script>var _hmt = _hmt || []; (function() {  var hm = document.createElement("script");  hm.src = "//hm.baidu.com/hm.js?c9477ef9d8ebaa27c94f86cc3f505fa5";  var s = document.getElementsByTagName("script")[0];   s.parentNode.insertBefore(hm, s); })(); </script>
</head>
<body class="<?=$classes; ?>" <?=$attributes;?> >
    <?=$page_top; ?>
    <?=$page; ?>
    <?=$page_bottom; ?>
</body>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19303398-2']);
  _gaq.push(['_setDomainName', '.wallstreetcn.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</html>
