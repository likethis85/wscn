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
    $(document).ready(function(){

    //Fix news image height
    $(".news-img-wrap img").each(function(){
        if($(this).height() < $(this).parent().height()){
            $(this).height($(this).parent().height());
        }
    });

	$().backToTop({ easingType: 'easeOutQuart' });

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
           var url = '/apiv1/live-index.json';
           $.ajax({
                url : url,
                dataType : 'json',
                success : function(entries){
                    var domain = $("#livenews-navbar-prev").attr('href');
                    //console.log(entries);
                    for(var i in entries){
                        var date = new Date(parseInt(entries[i].node_created) * 1000);
                        var time = ('0' + date.getHours()).slice(-2)  + ':' + ('0' + date.getMinutes()).slice(-2);
                        realtimeNews.push(
                            //'<li><span class="time">' + time + '</span> <a href="' + domain + '/node/' + entries[i].nid + '" target="_blank">' + entries[i].node_title + '</a></li>'
                            '<li><span class="time">' + time + '</span> <a href="' + domain + '/" target="_blank">' + entries[i].node_title + '</a></li>'
                        );
                    }
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



        var timerHandler = setInterval(scrollingNews, 5000);
        initRealtimeNews();
        $(document).on('mouseover', '#realtime-news', function(){
            clearInterval(timerHandler);
        });
        $(document).on('mouseout', '#realtime-news', function(){
            timerHandler = setInterval(scrollingNews, 5000);
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
            var allowWidth = 230;
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

        //实时新闻时钟
        setInterval(function(){
            $("#realtime-clock").html(moment().format('YYYY年MM月DD日 HH:mm:ss'));
        }, 1000);

        //实时新闻刷新
        if($('#livenews-list')[0]){
            var jplayer = $('<div id="jplayer" />').appendTo('body');
            var livenewsTmpl = $("#livenews-list-js");
            var refreshTime = 5000;
            var lowlightTime = 10000;
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

//to support backgroundcolor animation
(function(d){d.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(f,e){d.fx.step[e]=function(g){if(!g.colorInit){g.start=c(g.elem,e);g.end=b(g.end);g.colorInit=true}g.elem.style[e]="rgb("+[Math.max(Math.min(parseInt((g.pos*(g.end[0]-g.start[0]))+g.start[0]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[1]-g.start[1]))+g.start[1]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[2]-g.start[2]))+g.start[2]),255),0)].join(",")+")"}});function b(f){var e;if(f&&f.constructor==Array&&f.length==3){return f}if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(e[1]),parseInt(e[2]),parseInt(e[3])]}if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(e[1])*2.55,parseFloat(e[2])*2.55,parseFloat(e[3])*2.55]}if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}if(e=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[d.trim(f).toLowerCase()]}function c(g,e){var f;do{f=d.css(g,e);if(f!=""&&f!="transparent"||d.nodeName(g,"body")){break}e="backgroundColor"}while(g=g.parentNode);return b(f)}var a={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]}})(jQuery);
