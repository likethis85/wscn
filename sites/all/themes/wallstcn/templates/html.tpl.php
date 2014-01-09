<!DOCTYPE html>
<?
$styles = str_ireplace('http://wallstreetcn.com', 'http://img.wallstreetcn.com', $styles);
$scripts = str_ireplace('http://wallstreetcn.com', 'http://img.wallstreetcn.com', $scripts);
?>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="alexaVerifyID" content="86076a42-3d59-4329-b13f-0b55cd1606f2" />
    <meta name="baidu-site-verification" content="U0xyHxD1O6" />

    <?if ($node = menu_get_object()):?>
        <title><?=$head_title; ?></title>
        <?if (isset($node->taxonomy_vocabulary_3['und'])):?>
        <meta name="keywords" content="<?foreach($node->taxonomy_vocabulary_3['und'] as $tag):?><?=$tag['taxonomy_term']->name?>,<?endforeach?>" />
        <?endif?>
        <meta name="description" content="<?= rtrim(addslashes(html_entity_decode(strip_tags($node->body['und']['0']['summary']))), "\n\r"); ?>">
    <?else:?>
        <title>华尔街见闻_中国最专业金融资讯平台_外汇_期货_大宗商品_贵金属_黄金_股市_行情</title>
        <?if($item = menu_get_item()):?>
            <?if($item['path'] == 'breakfast'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_见闻早餐_华尔街见闻早餐_华尔街早餐_早餐见闻_华尔街早餐见闻" />
            <?elseif($item['path'] == 'europe'):?>
            <meta name="keywords" content="欧洲外汇,欧洲期货,欧洲金融,欧洲黄金,欧洲白银,欧洲债券,欧洲股市,欧洲投资,欧洲财经日历,欧洲银行,欧洲新闻,欧元,欧洲直播,英镑,瑞郎,欧元区,欧洲央行,ECB,欧盟,欧盟委员会,德国,英国" />
            <?elseif($item['path'] == 'america'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_美联储_美元_美国股市_美国投资_美国债券_美国股市_美国股指" />
            <?elseif($item['path'] == 'china'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_中国直播_中国外汇_中国期货_中国金融_中国黄金_中国财经日历_中国银行_人民币" />
            <?elseif($item['path'] == 'economy'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_经济直播_欧洲经济_美国经济_中国经济_经济新闻_经济行情_经济日历" />
            <?elseif($item['path'] == 'centralbank'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_央行_央行逆回购_央行基准利率_央行利率_央行票据_央行汇率_欧洲央行_日本央行_美联储_中国央行_中国人民银行" />
            <?elseif($item['path'] == 'market'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_市场_金融市场_黄金市场_外汇市场_白银市场_现货市场_期货市场_现货黄金市场_期货黄金市场_一级市场_二级市场_股票市场_债券市场" />
            <?elseif($item['path'] == 'company'):?>
            <meta name="keywords" content="公司,欧洲公司,中国公司,美国公司,外汇公司,黄金公司,期货公司,白银公司,债券公司,投资公司,公司新闻" />
            <?elseif($item['path'] == 'gold'):?>
            <meta name="keywords" content="华尔街见闻_中国最专业金融资讯平台_黄金价格_今日黄金价格_黄金_纸黄金_黄金t+d_中国黄金_中国黄金今日价格_现货黄金_黄金多少钱一克" />
            <?else:?>
            <meta name="keywords" content="直播,外汇,期货,金融,黄金,白银,债券,股市,投资,财经日历,银行,新闻,美元,欧元,日元,人民币," />
            <?endif?>
        <?endif?>
        <meta name="description" content="华尔街见闻——中国最专业的金融资讯平台；直播外汇、期货、黄金、债券、证券等金融领域的实时新闻。华人投资者可以在这里获得最快速、最精准、最深入的全球财经资讯和市场行情。" />
    <?endif?>

    <?if (0):?>
    <title><?=$head_title; ?></title>
    <meta name="baidu-site-verification" content="U0xyHxD1O6"/>
    <?if($is_front):?>
    <meta name="description" content="华尔街见闻是一个专业的的全球金融资讯中文平台提供商，为全球金融市场投资者和从业者提供经济和金融市场信息">
    <?else:?>
      <?if ($node = menu_get_object()):?>
      <meta name="description" content="<?= rtrim(addslashes(html_entity_decode(strip_tags($node->body['und']['0']['summary']))), "\n\r"); ?>">
      <?endif?>
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
<body class="<?=$classes; ?>" <?=$attributes;?>>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"+YhCf1a8Md00aX", domain:"wallstreetcn.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=+YhCf1a8Md00aX" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

    <?=$page_top; ?>
    <?=$page; ?>
    <?=$page_bottom; ?>

<?if(0):?>
<script type="text/javascript">//<![CDATA[
ac_as_id = 2107398;
ac_click_track_url = "";ac_format = 0;ac_mode = 1;
ac_width = 280;ac_height = 210;
//]]></script>
<script type="text/javascript" src="http://static.acs86.com/g.js"></script>
<?endif?>

</body>
</html>
