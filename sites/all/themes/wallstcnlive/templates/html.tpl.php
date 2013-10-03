<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?=$head_title; ?></title>
    <?if($is_front):?>
    <meta name="description" content="华尔街见闻隶属上海阿牛信息科技有限公司，是一个专业的的全球金融资讯中文平台 商，为全球金融市场投资者和从业者提供经济和金融市场信息">
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
    <?=$page_top; ?>
    <?=$page; ?>
    <?=$page_bottom; ?>
</body>
</html>