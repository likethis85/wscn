(function ($) {
    $(document).ready(function(){

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
                "margin-top": - (realtimeNewsIndex * 39) + "px"
            }, 500, 'linear', function() {
            });
        }
        var initRealtimeNews = function(){
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
    });
})(jQuery);