(function ($) {
    $(document).ready(function(){

	var parseUri = function(url){
		function parseUri (str) {
			var	o   = parseUri.options,
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

        //实时新闻
        var realtimeNews = [];
        var realtimeNewsIndex = 0;
        var scrollingNews = function(direction){
            if(direction < 0) {
                realtimeNewsIndex--;
                realtimeNewsIndex = realtimeNewsIndex < 0 ? realtimeNews.length - 1 : realtimeNewsIndex;
            } else {
                realtimeNewsIndex++;
                realtimeNewsIndex = realtimeNewsIndex >= realtimeNews.length ? 0 : realtimeNewsIndex;
            }
            $("#realtime-news ul").animate({
                "margin-top": - (realtimeNewsIndex * 38) + "px"
            }, 1000, 'linear', function() {
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
           var url = '/apiv1/node.json?parameters[type]=livenews';
           $.ajax({
                url : url,
                dataType : 'json',
                success : function(entries){
                    var domain = $("#livenews-navbar-prev").attr('href');
                    for(var i in entries){
                        var date = new Date(parseInt(entries[i].created) * 1000);
                        var time = ('0' + date.getHours()).slice(-2)  + ':' + ('0' + date.getMinutes()).slice(-2);
                        realtimeNews.push(
                            '<li><span class="time">' + time + '</span> <a href="' + domain + '/node/' + entries[i].nid + '" target="_blank">' + entries[i].title + '</a></li>'
                        );
                    }
                    $("#realtime-news ul").html(realtimeNews.join(""));
                }
            });
        }

        $("#realtime-news").on('click', '.prev', function(){
            scrollingNews(-1);
            return false;
        });
        $("#realtime-news").on('click', '.next', function(){
            scrollingNews(1);
            return false;
        });

        var timerHandler = setInterval(scrollingNews, 5000);
        initRealtimeNews();


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
                        res.push(' <div class="media text-only"><div class="media-body"><h4 class="media-heading"><a href="/node/' + response[i].nid + '">' + response[i].node_title +'</a></h4></div></div>')
                    }
                    //target.html('<ul>' + res.join('') + '</ul>');
                    target.html( res.join('') );
                    target.addClass('inited');
                }
            })
        });
        
        //自定义搜索
        var searchForm = $("#search-form");
        var searchPage = 0;
        var q = '';
        
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
        }
        var searchHideLoading = function(){
            searchForm.find('button').html('<span class="icon-search"></span>').removeAttr('disabled');
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

        //实时新闻刷新
        if($('#livenews-list')[0]){
            var jplayer = $('<div id="jplayer" />').appendTo('body');
            var livenewsTmpl = $("#livenews-list-js");
            var refreshTime = 5000;
            var lowlightTime = 10000;
            var livenewsHandler;
            var allowFresh = function(){
                return $("#enable-fresh").val() ? true : false;
            }
            var allowSound = function(){
                return $("#enable-sound").val() ? true : false;
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
                item.colorClass = colorMapping[item.color];
                return item;
            }
            var appendLivenews = function(items){
                var foundNew = false;
                for(var i in items){
                    var item = $("#livenews-id-" + items[i].nid);
                    if(item[0]){
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
            }
            var loadLivenews = function(){
                var url = '/apiv1/livenews.json';
                var currentPath = parseUri();
                switch(currentPath.path) {
                    case '/live-europe':
                        url = '/apiv1/livenews-europe.json';
                    break;
                    case '/live-china':
                        url = '/apiv1/livenews-china.json';
                    break;
                    case '/live-america':
                        url = '/apiv1/livenews-america.json';
                    break;
                    default:
                    break;
                }
                $.ajax({
                    url : url,
                    dataType : 'json',
                    ifModified:true,
                    error: function(xhr, err){
                        //console.log(err);
                        //console.log(xhr);
                        //console.log("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                        //console.log("responseText: "+xhr.responseText);
                    },
                    success : function(response, textStatus, jqXHR){
                        //console.log(2);
                        appendLivenews(response);
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

            jplayer.jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                        mp3 : "/sites/all/themes/wallstcn/js/notification.mp3"
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
    });
})(jQuery);
