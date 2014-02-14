(function($){
    $.fn.backToTop = function(options) {

        var defaults = {
                text: '<i class="icon-chevron-up"></i>',
                min: 200,
                inDelay:600,
                outDelay:400,
                containerID: 'to-top',
                containerHoverID: 'to-top-hover',
                scrollSpeed: 1200,
                easingType: 'linear'
            },
            settings = $.extend(defaults, options),
            containerIDhash = '#' + settings.containerID,
            containerHoverIDHash = '#'+settings.containerHoverID;

        $('body').append('<a href="#" id="'+settings.containerID+'">'+settings.text+'</a>');
        $(containerIDhash).hide().on('click.UItoTop',function(){
            $('html, body').animate({scrollTop:0}, settings.scrollSpeed, settings.easingType);
            $('#'+settings.containerHoverID, this).stop().animate({'opacity': 0 }, settings.inDelay, settings.easingType);
            return false;
        })
        .prepend('<span id="'+settings.containerHoverID+'"></span>')
        .hover(function() {
                $(containerHoverIDHash, this).stop().animate({
                    'opacity': 1
                }, 600, 'linear');
            }, function() {
                $(containerHoverIDHash, this).stop().animate({
                    'opacity': 0
                }, 700, 'linear');
            });

        $(window).scroll(function() {
            var sd = $(window).scrollTop();
            if(typeof document.body.style.maxHeight === "undefined") {
                $(containerIDhash).css({
                    'position': 'absolute',
                    'top': sd + $(window).height() - 50
                });
            }
            if ( sd > settings.min )
                $(containerIDhash).fadeIn(settings.inDelay);
            else
                $(containerIDhash).fadeOut(settings.Outdelay);
        });
};
})(jQuery);

(function ($) {

    //Url解析
    var parseUri = function(url){
        function parseUri (str) {
            var o   = parseUri.options,
                m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
                uri = {},
                i   = 14;

            while (i) {
                i--;
                uri[o.key[i]] = m[i] || "";
            }

            uri[o.q.name] = {};
            uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
                if ($1) uri[o.q.name][$1] = $2;
            });

            return uri;
        }

        parseUri.options = {
            strictMode: false,
            key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
            q:   {
                name:   "queryKey",
                parser: /(?:^|&)([^&=]*)=?([^&]*)/g
            },
            parser: {
                strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
                loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
            }
        };

        return url ? parseUri(url) : parseUri(window.location.href);
    };



    $(document).ready(function(){

        //slider
        //$('.carousel').carousel({interval: 7000});

        //Top news ads
        var topCarousel = $('#top-carousel').carousel();
        topCarousel.carousel('pause');
        topCarousel.find('.carousel-control').css('backgroundColor', '#FFF').hide();
        topCarousel.on('mouseenter', function(){
            $(this).find('.carousel-control').show();
        }).on('mouseleave', function(){
            $(this).find('.carousel-control').hide();
        });

        //$('.carousel').carousel();
        $('.random-carousel').carousel();
        $(".random-carousel").each(function(){
            var num = $(this).find('.item').length;
            var random = parseInt(Math.random() * 10 % num);
            $(this).find('.item').each(function(index){
                if(index === random) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
            $(this).carousel();
        });

        $(".random-ad").each(function(){
            var num = $(this).find('.item').length;
            var probability = [];
            var hasAttr = 0;
            var totalProbability = 0;
            $(this).find('.item').each(function(index){
                if($(this).attr('data-probability')) {
                    probability[index] = parseInt($(this).attr('data-probability'));
                    hasAttr++;
                    totalProbability += probability[index];
                } else {
                    probability[index] = 0;
                }
            });
            var leftNum = num - hasAttr;
            var step = leftNum > 0 ?  parseInt((100 - totalProbability) / leftNum) : 0;
            var start = 0;
            var res = [];
            //console.log(probability);
            for(var i in probability){
                res[i] = probability[i] === 0 ? [start, start + step] : [start, start + probability[i]];
                start = probability[i] === 0 ? start + step : start + probability[i];
            }
            //force set to 100
            res[i][1] = 100;

            //console.log(res);
            //var random = parseInt(Math.random() * 10 % num);
            var random = Math.floor(Math.random()*100 + 1);
            for(i in res) {

                //console.log(random);
                //console.log(res[i]);
                if(random >= res[i][0] && random <= res[i][1]) {
                    break;
                }
            }

            /*
            console.log(res);
            console.log(random);
            console.log(i);
            */
            $(this).find('.item').each(function(index){
                if(index == i) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });


        //图片延迟加载
        $("img.lazy").show().lazyload({
            //effect       : "fadeIn",
            threshold : 500,
            load : function() {
                var img = $(this);
                if(img.parent().hasClass('news-img-wrap') && img.height() < img.parent().height()){
                    img.height(img.parent().height());
                }
            }
        });
        //解决加载问题
        window.onload = function() {
            $(window).resize()
        };


        //回到顶部
        $().backToTop({ easingType: 'easeOutQuart' });

        //实时新闻
        var realtimeNews = [];
        var realtimeNewsIndex = 0;
        var scrollingNews = function(direction, speed){
            if(direction < 0) {
                realtimeNewsIndex--;
                realtimeNewsIndex = realtimeNewsIndex < 0 ? realtimeNews.length - 1 : realtimeNewsIndex;
            } else {
                realtimeNewsIndex++;
                realtimeNewsIndex = realtimeNewsIndex >= realtimeNews.length ? 0 : realtimeNewsIndex;
            }

            if(realtimeNewsIndex == 0) {
                $("#realtime-news ul").css("margin-top", '-38px');
            }

            speed = speed > 0 ? speed : 1000;
            $("#realtime-news ul").animate({
                "margin-top": - (realtimeNewsIndex * 38) + "px"
            }, speed, 'linear', function() {
            });
        }
        var initRealtimeNews = function(){
            /*
            //by Google ajax
            $.ajax({
                url : 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=13&output=json-in-script&q=http://wallstreetcn.com/rss.xml',
                dataType : 'jsonp',
                success : function(rss){
                    var entries = rss.responseData.feed.entries;
                    for(var i in entries){
                        var date = new Date(entries[i].publishedDate);
                        var time = ('0' + date.getHours()).slice(-2)  + ':' + ('0' + date.getMinutes()).slice(-2);
                        realtimeNews.push(
                            '<li><span class="time">' + time + '</span> <a href="' + entries[i].link + '" target="_blank">' + entries[i].title + '</a></li>'
                        );
                    }
                    $("#realtime-news ul").html(realtimeNews.join(""));
                }
            });
           */
           if(!$("#realtime-news")[0]){
                return false;
           }
           var url = '/apiv1/live-index.json';
           $.ajax({
                url : url,
                dataType : 'json',
                success : function(entries){
                    var domain = $("#livenews-navbar-prev").attr('href');
                    realtimeNews = [];
                    for(var i in entries){
                        var date = new Date(parseInt(entries[i].node_created) * 1000);
                        var time = ('0' + date.getHours()).slice(-2)  + ':' + ('0' + date.getMinutes()).slice(-2);
                        var icon = '';
                        if (entries[i].icon == '折线') {
                            icon = 'chart';
                        } else if (entries[i].icon == '日程') {
                            icon = 'calendar';
                        } else if (entries[i].icon == '警告') {
                            icon = 'warning';
                        } else if (entries[i].icon == '提醒') {
                            icon = 'alert';
                        } else if (entries[i].icon == '柱状') {
                            icon = 'chart_pie';
                        } else if (entries[i].icon == '传言') {
                            icon = 'rumor';
                        } else {
                            icon = 'common';
                        }

                        var formart = '';
                        if (entries[i].formart == '加粗') {
                            formart = 'font-weight:bold;';
                        }

                        var font_color = '';
                        if (entries[i].font_color == '红色') {
                            font_color = 'color:#D24747;';
                        } else if (entries[i].icon == '蓝色') {
                            font_color = 'color:#D24747;';
                        } else if (entries[i].icon == '黑色') {
                            font_color = 'color:#00000;';
                        }

                        realtimeNews.push(
                            //'<li><span class="time">' + time + '</span> <a href="' + domain + '/node/' + entries[i].nid + '" target="_blank">' + entries[i].node_title + '</a></li>'
                            '<li><img width="18" height="20" src="/sites/all/themes/wallstcn/css/img/icon_' + icon + '.png"/>&emsp;<a href="http://live.wallstreetcn.com/" target="_blank"><span style="' + formart + font_color + '">' + entries[i].node_title + '</span></a></li>'
                        );
                    }
                    $("#realtime-news ul").html("");
                    $("#realtime-news ul").html(realtimeNews.join(""));
                }
            });
        }

        $("#realtime-news").on('click', '.prev', function(){
            scrollingNews(-1, 300);
            return false;
        });
        $("#realtime-news").on('click', '.next', function(){
            scrollingNews(1, 300);
            return false;
        });

        // 右上角实时新闻自动刷新
        //访问量过大，暂时停止
        //setInterval(initRealtimeNews, 10000);
        initRealtimeNews();

        //var timerHandler = setInterval(scrollingNews, 5000);
        //initRealtimeNews();
        $(document).on('mouseover', '#realtime-news', function(){
            //clearInterval(timerHandler);
        });
        $(document).on('mouseout', '#realtime-news', function(){
            //timerHandler = setInterval(scrollingNews, 5000);
        });


        //固定头部
        $(window).scroll(function(){
            var scrollT = $(window).scrollTop();
            if(scrollT > 100){
                $("#nav-area").addClass('nav-area-fixed');
            } else {
                $("#nav-area").removeClass('nav-area-fixed');
            }
        });


        //编辑推荐
        var newsSlider = $("#news-slider");
        var newsSliderIndex = 0;
        var newsSliderMax = newsSlider.find('>div').length;
        var newsSliderShuffle = function(direction){
            if(direction < 0) {
                newsSliderIndex--;
                newsSliderIndex = newsSliderIndex < 0 ? newsSliderMax - 1 : newsSliderIndex;
            } else {
                newsSliderIndex++;
                newsSliderIndex = newsSliderIndex >= newsSliderMax ? 0 : newsSliderIndex;
            }
            newsSlider.find('.row-fluid').hide();
            newsSlider.find('.row-fluid').eq(newsSliderIndex).show();
        }

        $(".news-slider-controls").on('click', '.prev', function(){
            newsSliderShuffle(-1);
            return false;
        });
        $(".news-slider-controls").on('click', '.next', function(){
            newsSliderShuffle(1);
            return false;
        });

        //微信QR码
        var qrcode = $("#weixin-qrcode").clone().hide();
        qrcode.appendTo('body');
        qrcode.on('click', function(){
            $(this).hide();
        });
        $(".weixin").on('mouseover click', function(){
            qrcode.css({
                position : 'absolute',
                boxShadow: '10px 10px 20px #333',
                top: ($(window).height() - qrcode.height()) / 2,
                left: ($(window).width() - qrcode.width()) / 2
            }).show();
            return false;
        }).on('mouseout', function(){
            qrcode.css({
                position : 'static'
            }).hide();
        });


        //添加收藏夹
        $(".add-tofavor").on('click', function(){
              title = document.title;
              url = document.location;
              try {
                // Internet Explorer
                window.external.AddFavorite( url, title );
              }
              catch (e) {
                try {
                  // Mozilla
                  window.sidebar.addPanel( title, url, "" );
                }
                catch (e) {
                  // Opera
                  if( typeof( opera ) == "object" ) {
                    a.rel = "sidebar";
                    a.title = title;
                    a.url = url;
                    return true;
                  }
                  else {
                    // Unknown
                    alert( '请按Ctrl+D键收藏本站' );
                  }
                }
              }
              return false;
        });

        //tab 切换
        $('.side-box a[data-tab-url]').on('show', function (e) {
            var url = $(this).attr('data-tab-url');
            var target = $($(this).attr('href'));
            if(target.hasClass('inited')){
                return;
            }
            target.html('<i class="icon-spinner icon-spin"></i> 正在载入...');
            $.ajax({
                url : url,
                dataType : 'json',
                success : function(response){
                    var res = [];
                    for(var i in response){
                        res.push(' <div class="media text-only"><span class="number">' + (parseInt(i) + 1) +'</span><div class="media-body"><h4 class="media-heading"><a href="/node/' + response[i].nid + '" target="_blank">' + response[i].node_title +'</a></h4></div></div>')
                    }
                    //target.html('<ul>' + res.join('') + '</ul>');
                    target.html( res.join('') );
                    target.addClass('inited');
                }
            })
        });


        //关键字阅读
        $('#related-read a[data-tab-url]').on('show', function (e) {
            var url = $(this).attr('data-tab-url');
            var target = $($(this).attr('href'));
            if(target.hasClass('inited')){
                return;
            }
            target.html('<i class="icon-spinner icon-spin"></i> 正在载入...');
            $.ajax({
                url : url,
                dataType : 'html',
                success : function(response){
                    var relatedReads = {
                        'tid' : target.attr('data-tid'),
                        'results' : []
                    };
                    $(response).find('#block-system-main .media-heading').each(function(){
                        var link = $(this);
                        var relatedRead = {
                            'title' : '',
                            'url' : ''
                        };
                        relatedRead.title = link.text();
                        relatedRead.url = link.find('a').attr('href');
                        relatedReads.results.push(relatedRead);
                        var t = tmpl($("#related-read-js").html(), relatedReads);
                        target.html(t);
                    });
                    target.addClass('inited');
                }
            })
        });
        $('#related-read a:first').tab('show');



        //自定义搜索
        var searchForm = $("#search-form");
        var searchPage = 0;
        var q = '';
        //语音搜索
        searchForm.find('input[name=q]').on("webkitspeechchange", function() {
            searchForm.submit();
        });

        //搜索栏变化
        $("#search-query").on('focus', function(){
            var q = $(this);
            var width = q.width();
            var maxAllowWidth = 230;
            var allowWidth = $("#navbar").width() - $("#navbar .nav").width() - 150;
            allowWidth = allowWidth > maxAllowWidth ? maxAllowWidth : allowWidth;
            if(allowWidth < width) {
                allowWidth = width;
            }

            q.animate({
                width: allowWidth,
                backgroundColor : '#FFF'
            }, 'easeOutQuint');
        });

        $("#search-query").on('blur', function(){
            var q = $(this);
            q.animate({
                width: '110px',
                backgroundColor : '#707070'
            }, 'easeInQuint');
        });

        $("#search-submit-icon").on('click', function(){
            searchForm.submit();
        });


        var showSearchResults = function(results, reset){
            searchHideLoading();
            $("#main-content").hide();
            results.q = q;
            var t = tmpl($("#search-results-js").html(), results);
            if(results.cursor.currentPageIndex == 0){
                $("#search-result").remove();
                $("#search-results-js").after(t);
            } else {
                $("#search-result .news-list").append(t);
            }
        }
        var searchShowLoading = function(){
            searchForm.find('button').html('<span class="icon-spinner icon-spin"></span>').attr('disabled', 'disabled');
            $("#search-submit-icon").html('<span class="icon-spinner icon-spin"></span>');
        }
        var searchHideLoading = function(){
            searchForm.find('button').html('<span class="icon-search"></span>').removeAttr('disabled');
            $("#search-submit-icon").html('<span class="icon-search"></span>');
        }
        var googleCustomSearch = function(newSearch){
            searchShowLoading();
            if(newSearch) {
                searchPage = 0;
            }

            $.ajax({
                url:'http://ajax.googleapis.com/ajax/services/search/web',
                data : {
                    v : '1.0',
                    q : 'site:wallstreetcn.com ' + q,
                    rsz : 8,
                    start : searchPage,
                    hl : 'zh-CN'
                },
                dataType : 'jsonp',
                success: function(json){
                    if(newSearch) {
                        showSearchResults(json.responseData, 1);
                    } else {
                        showSearchResults(json.responseData);
                    }
                }
            });
            searchPage+=8;
        }
        $(document).on('click', '.search-pager a', function(){
            googleCustomSearch();
            return false;
        });

        if($('.livenews-channel')[0]) {
            searchForm.attr('action', '/livesearch');
            searchForm.find('input[name=q]').attr('name', 'title').attr('placeholder', '搜索实时新闻');

            var uri = parseUri();
            var title = uri.queryKey.title || null;
            if(title) {
                title = decodeURIComponent(title);
                $("#livenews-list").highlight(title);
                searchForm.find('input[name=title]').val(title);
                $("#livenews-list").prepend('<div class="page-header header-red"><h3>正在搜索 : ' +  title + '</h3></div>');
            }


        } else {
            searchForm.on('submit', function(){
                var currentQ = $(this).find('input[name=q]').val();
                if(q == currentQ) {
                    q = currentQ;
                    googleCustomSearch(q);
                } else {
                    q = currentQ;
                    googleCustomSearch(q, 1);
                }
                return false;
            });
        }

        $(document).on('click', "#search-results-close", function(){
            $("#main-content").show();
            $("#search-result").hide();
        });



        //实时新闻页最新文章
        $('script[data-url]').each(function(){
            var template = $(this);
            var url = template.attr('data-url');
            $.ajax({
                url : url,
                dataType : 'json',
                success : function(response){
                    var t = tmpl(template.html(), response);
                    template.after(t);
                }
            });
        });

        //实时新闻时钟
        setInterval(function(){
            $("#realtime-clock").html(moment().format('YYYY年MM月DD日 HH:mm:ss'));
        }, 1000);

        //页面自动刷新
        if($('#livenews-list')[0]){
            //每6分钟
            setTimeout('window.location.reload();', 1000 * 60 * 6);
        }




        //添加 自动刷新 和 声音提醒 功能的 禁用 start


        var $ebFresh = $("#enable-fresh");

        var $ebSound = $("#enable-sound");

        if ($ebFresh.length>0 && $ebSound>0) {

            if (store.get("enable-fresh") != undefined) {
                $ebFresh[0].checked =  store.get("enable-fresh");
            }

            if (store.get("enable-sound") != undefined) {
                $ebSound[0].checked =  store.get("enable-sound");
            }
        }

        $("#block-views-x-livenews-block").on("click.check", function(){
            store.set("enable-fresh", $ebFresh[0].checked);
            store.set("enable-sound", $ebSound[0].checked);
        });

        //添加 自动刷新 和 声音提醒 功能的 禁用 end

        //添加 黄金 new 标识 start

        $(".nav .leaf a").each(function(){
            var $this = $(this);
            if ($this.text() == "黄金") {

                $this.addClass('mark-new-target');
                var img = new Image();
                img.alt = "new";
                img.className = "mark-new";
                img.style.right = "5px";
                img.style.top  = "-10px";
                img.src = "/sites/all/themes/wallstcn/css/img/new.gif";

                $this.append(img);

                /*
                //窗口大小改变时 ，初始化位置

                var resizeTemp;

                $(window).on('resize', function(){

                    clearTimeout(resizeTemp);

                    resizeTemp = setTimeout(function(){

                        var img = $('.mark-new');

                        var target = $('.mark-new-target');

                        img.css({
                            left : target.offset().left + target.width()  + "px",
                            top  : target.offset().top  - 10 + "px"
                        });

                        //console.log(target.offset().left + ", " + target.offset().top );

                    }, 500);

                });
                */

            }
        });



        //添加 黄金 new 标识 end



        //实时新闻刷新
        if($('#livenews-list')[0]){
            var jplayer = $('<div id="jplayer" />').appendTo('body');
            var livenewsTmpl = $("#livenews-list-js");
            var refreshTime = 10000;
            var lowlightTime = 60000;
            var livenewsHandler;
            var allowFresh = function(){
                return $("#enable-fresh").attr('checked') ? true : false;
            }
            var allowSound = function(){
                return $("#enable-sound").attr('checked') ? true : false;
            }
            var prepareItem = function(item){
                var timstamp = parseInt(item.node_created);
                var date = new Date(timstamp * 1000);
                var year = date.getFullYear() + '年';
                var month = date.getMonth() + 1 + '月';
                var day = date.getDate() + '日';
                var time = ('0' + date.getHours()).slice(-2)  + ':' + ('0' + date.getMinutes()).slice(-2);
                item.time = time;
                item.created = [year,month,day].join('') + ' ' + time;


                var colorMapping = {
                    '黑色' : '',
                    '红色' : 'media-color-red',
                    '蓝色' : 'media-color-blue'
                }
                item.colorClass = colorMapping[item.颜色] || colorMapping[item.color];
                return item;
            }
            var pageloadTime = Math.round(new Date().getTime()/1000);

            var replaceLivenews = function(item) {
                var $item = $("#livenews-id-" + item.nid);
                if($.trim($item.find('.media-heading').html()) == $.trim(item.body)) {
                    return false;
                }
                $item.find('.media-heading').html(item.body);
            }

            //检测页面最上边部item，如果与items不统一则删除
            var removePageItems = function(items) {
                var pageItems = $("#livenews-list .media:lt(3)");
                var ajaxIds = [];
                for(var i in items) {
                    ajaxIds.push("livenews-id-" + items[i].nid);
                }

                pageItems.each(function(){
                    var id = $(this).attr('id');
                    if(-1 === $.inArray(id, ajaxIds)) {
                        $("#" + id).remove();
                    }
                });
            }
            var appendLivenews = function(items, statusCode){
                if(!items){
                    return false;
                }
                var uri = parseUri();
                var page = uri.queryKey.page || 0;
                //搜索页面强制不检测最新消息
                if(uri.path == '/livesearch'){
                    page = 1;
                }

                //翻页后只加载新闻事件 > 用户本地时间 的最新消息
                if(page > 0 && parseInt(items[0].node_created) < pageloadTime){
                    return false;
                }

                var foundNew = false;
                items.reverse();
                for(var i in items){
                    var item = $("#livenews-id-" + items[i].nid);

                    //ID相同， 还需要检查文本是否被替换
                    if(item[0]){
                        replaceLivenews(items[i]);
                        continue;
                    }
                    item = prepareItem(items[i]);
                    livenewsTmpl.after(tmpl(livenewsTmpl.html(), item));

                    var lowlight = function(nid){
                        setTimeout(function(){
                            $("#livenews-id-" + nid).animate({
                                "background-color": "#FFF"
                            }, 'slow', function() {
                                $(this).removeClass('highlight');
                            });
                        }, lowlightTime);
                    }

                    lowlight(items[i].nid);


                    foundNew = true;
                }
                if(foundNew && allowSound()) {
                    jplayer.jPlayer('play');
                }
                removePageItems(items);
            }

            //载入实时新闻
            var loadLivenews = function(){
                var url = '/apiv1/livenews.json';
                var uri = parseUri();
                var page = uri.queryKey.page || 0;
                var data = {};

                if (uri.path != '/node' && uri.path != '/') {
                    return false;
                }

                /*
                switch(uri.path) {
                    case '/node':
                    case '/':
                    break;
                    default:
                        url = '/apiv1/livesearch.json';
                    break;
                }
                var pathMapping = {
                    '/live-china' : { location : 9479 },
                    '/live-europe' : { location : 9478 },
                    '/live-america' : { location: 9477 },
                    '/live-japan' : { location: 9480 },
                    '/live-economy' : { tid: 9498 },
                    '/live-centralbank' : { tid: 9496},
                    '/live-market' : { tid: 9502},
                }
                if(pathMapping[uri.path]) {
                    data = pathMapping[uri.path];
                }*/
                $.ajax({
                    url : url,
                    dataType : 'json',
                    data : data,
                    ifModified:true,
                    //cache : false,
                    error: function(xhr, err){
                        //console.log(err);
                        //console.log(xhr);
                        //console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                        //console.log("responseText: "+xhr.responseText);
                    },
                    success : function(response, textStatus, jqXHR){
                        appendLivenews(response, jqXHR.status);
                    }
                });
            }

            var loadComment = function(item){
                var url = item.find('.livenews-loader').attr('href');
                if(item.hasClass('comment-loaded')){
                } else {
                    item.find('.media-comment').load(url + ' #comment-ajax', function(){
                        item.find('.livenews-comment-trigger').hide();
                        item.find('form').attr('target', "_blank");
                        item.find('.live-news-full').removeClass('hide');
                    });
                    item.addClass('comment-loaded');
                }
                item.find('.media-comment').show();
            }

            $('#livenews-list').on('click', '.media-heading', function(){
                var item = $(this).parent().parent();
                if(item.hasClass('expend')){
                    item.removeClass('expend');
                    item.find('.media-meta').hide();
                    item.find('.media-comment').hide();
                } else {
                    item.find('.media-meta').show();
                    item.addClass('expend');
                    loadComment(item);
                }
            });

            $('#livenews-list .media-heading.has-more').each(function(){
                $(this).find('p:last').append(' <span class="show-more">[more]</span>');
            })


            jplayer.jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                        mp3 : "http://wallstreetcn.com/sites/all/themes/wallstcn/js/notification.mp3"
                    });
                },
                swfPath: "/sites/all/themes/wallstcn/js/Jplayer.swf",
                supplied: "mp3"
            });

            if(allowFresh()){
                livenewsHandler = setInterval(loadLivenews, refreshTime);
            }

            $("#enable-fresh").on('change', function(){
                if($(this).attr('checked')){
                    livenewsHandler = setInterval(loadLivenews, refreshTime);
                } else {
                    clearInterval(livenewsHandler);
                }
            });
        }


        //iframe延迟加载
        $('.iframe-box').each(function() {
            if(!$(this).attr('data-src')){
                return false;
            }
            var attrs = [];
            $.each(this.attributes, function() {
                if(this.specified) {
                    attrs.push(this.name.replace('data-', '') + '="' + this.value + '"');
                }
            });
            $(this).append('<iframe ' + attrs.join(' ') + '></iframe>');
        });

        //Google 访问滚动事件追踪
        $.scrollDepth();


        // 主站文章显示在live域名下自动跳转
        var live_redirect = function(){
            var livenews_page_sign = $('#livenews_page_sign');
            var not_livenews_page_sign = $('#not_livenews_page_sign');
            var current_url = window.location.href.toLowerCase();

            if (livenews_page_sign.length == 0 && not_livenews_page_sign.length == 1 && current_url.indexOf('live') != -1) {
                window.location.href = current_url.replace('live.', '');
            }
            //alert(window.location.href);
        }
        live_redirect();


        // 主页右边实时新闻板块切换

        (function(){

            var $livenews = $("#livenews-block");
            var $markets   = $("#markets-block");

            $("#livenews-swith").on('click', function(e){

                var $this = $(this);

                if ($this.hasClass('side-nav-active')) {

                } else {

                    $("#markets-swith").removeClass("side-nav-active");
                    $this.addClass("side-nav-active");

                    $markets.hide();
                    $livenews.show();

                    return false;
                }

            });

            $("#markets-swith").on('click', function(e){

                var $this = $(this);

                if ($this.hasClass('side-nav-active')) {

                } else {

                    $("#livenews-swith").removeClass("side-nav-active");
                    $this.addClass("side-nav-active");

                    $livenews.hide();
                    $markets.show();

                    return false;
                }

            });

        })();


        /*
         *
         * 主站微改版  start
         *
         * */
        (function(){


            //设置 侧边拦位置
            function showSlideBar() {

                //var $wrapper = $('#wrapper');

                var $content = $('#main-content');

                var $slideBar = $('.article-slide-bar');

                var left = $content.offset().left - 20 - $slideBar.outerWidth();


                $slideBar.css('left',  left + 'px');

                /*
                if (left >= 0) {



                } else {

                    $slideBar.css('left',  '-100px');

                }
                */
            }

            //设定 侧边拦位置
            showSlideBar();

            //缩放时重新设定位置
            var resizeTemp;

            $(window).on('resize', function(){

                clearTimeout(resizeTemp);

                resizeTemp = setTimeout(function(){

                    showSlideBar();

                }, 100);



            });


            var uri = new URI(window.location);
            var path = uri.path();

            $('#navbar .nav a').each(function(){

                var item = $(this);

                var pattern = item.attr("data-active-url");

                if (pattern) {

                    pattern = pattern.replace(/\//g,"\\/");
                    var reg = new RegExp(pattern);

                    if(reg.test(path)) {
                        item.addClass("active");
                    }

                }

            });


            $('#favorites_login_alert').on('click', function(){

                if (confirm('您还不是本站的注册用户，暂时无法收藏文章，请先登录或注册。')) {
                    window.open('/user', '_blank');
                }

            });


        })();

        /*
         *
         * 主站微改版  end
         *
         * */

    });
})(jQuery);

//to support backgroundcolor animation
(function(d){d.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(f,e){d.fx.step[e]=function(g){if(!g.colorInit){g.start=c(g.elem,e);g.end=b(g.end);g.colorInit=true}g.elem.style[e]="rgb("+[Math.max(Math.min(parseInt((g.pos*(g.end[0]-g.start[0]))+g.start[0]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[1]-g.start[1]))+g.start[1]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[2]-g.start[2]))+g.start[2]),255),0)].join(",")+")"}});function b(f){var e;if(f&&f.constructor==Array&&f.length==3){return f}if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(e[1]),parseInt(e[2]),parseInt(e[3])]}if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(e[1])*2.55,parseFloat(e[2])*2.55,parseFloat(e[3])*2.55]}if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}if(e=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[d.trim(f).toLowerCase()]}function c(g,e){var f;do{f=d.css(g,e);if(f!=""&&f!="transparent"||d.nodeName(g,"body")){break}e="backgroundColor"}while(g=g.parentNode);return b(f)}var a={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]}})(jQuery);
