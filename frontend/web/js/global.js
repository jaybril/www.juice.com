/// <reference path="jquery-1.8.3.js" />

var CZXS = CZXS || {};
var GLOBAL = CZXS.GLOBAL = {};

(function(){
    meunBannerIndex = 0;
    BANNER = null;
    GLOBAL.Utils = {
        fixMeun: function(){
            $(".siderbar_meun a").on("click", function(){
                var ths =  $(this);
                meunBannerIndex = ths.index();
                ani( ths )
            });
            $(document).on("scroll", function(){
                var s_ht = $(document).scrollTop();
                var el = $(".meun_banner").eq( meunBannerIndex );
                var ht = el.offset().top;
                var len = $(".meun_banner").length;

                if( s_ht >= ht ){
                    $(".siderbar_meun a").eq( meunBannerIndex ).addClass("cur").siblings("a").removeClass("cur");
                    meunBannerIndex++;
                    if( meunBannerIndex > $(".meun_banner").length - 1 ){
                        meunBannerIndex = len - 1
                    }
                }else{
                    meunBannerIndex--;
                    if( meunBannerIndex < 0 ){
                        meunBannerIndex = 0
                    }
                }
            });
            function ani( ths ){
                var ht = $(".meun_banner").eq( meunBannerIndex );
                var s = ht.offset().top;

                $('html,body').animate( { 'scrollTop': s }, 500 );
                ths.addClass("cur").siblings("a").removeClass("cur");
            }
        },
        swiperAnimateCacheMy: function(a){
            for (allBoxes = a.slides[a.activeIndex].querySelectorAll(".ani"), i = 0; i < allBoxes.length; i++) allBoxes[i].attributes["style"] ? allBoxes[i].setAttribute("swiper-animate-style-cache", allBoxes[i].attributes["style"].value) : allBoxes[i].setAttribute("swiper-animate-style-cache", " "),
                allBoxes[i].style.visibility = "hidden"
        },
        swiperAnimateMy: function(a){
            GLOBAL.Utils.clearSwiperAnimateMy(a);
            var b = a.slides[a.activeIndex].querySelectorAll(".ani");
            for (i = 0; i < b.length; i++) b[i].style.visibility = "visible",
                effect = b[i].attributes["swiper-animate-effect"] ? b[i].attributes["swiper-animate-effect"].value: "",
                b[i].className = b[i].className + "  " + effect + " " + "animated",
                style = b[i].attributes["style"].value,
                duration = b[i].attributes["swiper-animate-duration"] ? b[i].attributes["swiper-animate-duration"].value: "",
                duration && (style = style + "animation-duration:" + duration + ";-webkit-animation-duration:" + duration + ";"),
                delay = b[i].attributes["swiper-animate-delay"] ? b[i].attributes["swiper-animate-delay"].value: "",
                delay && (style = style + "animation-delay:" + delay + ";-webkit-animation-delay:" + delay + ";"),
                b[i].setAttribute("style", style)
        },
        clearSwiperAnimateMy: function(a){
            for (allBoxes = a.slides[a.activeIndex].querySelectorAll(".ani"), i = 0; i < allBoxes.length; i++) allBoxes[i].attributes["swiper-animate-style-cache"] && allBoxes[i].setAttribute("style", allBoxes[i].attributes["swiper-animate-style-cache"].value),
                allBoxes[i].style.visibility = "hidden",
                allBoxes[i].className = allBoxes[i].className.replace("animated", " "),
                allBoxes[i].attributes["swiper-animate-effect"] && (effect = allBoxes[i].attributes["swiper-animate-effect"].value, allBoxes[i].className = allBoxes[i].className.replace(effect, " "))
        },
        bannerInit: function( cls ){
            BANNER = new Swiper( cls, {
                resistanceRatio: 0,
                onInit: function(swiper){
                    GLOBAL.Utils.swiperAnimateCacheMy(swiper);
                    GLOBAL.Utils.swiperAnimateMy(swiper);
                }
            });
            BANNER.destroy();
        },
        weixinCode: function(){
            $(function(){
                var el = $("#weixin");
                var elTarget = $("#weixin-main");

                el.on("mouseenter", function(){
                    var ths = $(this);
                    var obj = {
                        "left": ths.offset().left - 75,
                        "top": ths.offset().top - 240
                    };
                    elTarget.css( obj).stop(false).fadeIn();
                });
                el.on("mouseout", function(){
                    elTarget.fadeOut();
                })
            })
        }()
    };

    GLOBAL.base = {
        mAjax: function( opts, callback ){
            var def = {
                url: "",
                data: {},
                type: "post",
                dataType: "json",
                async: false
            };

            var setting = $.extend( def, opts );
            var data = setting.data;

            //基于layer
            var load = layer.load(0, {shade: false});

            $.ajax({
                type: setting.type,
                url: setting.url,
                async: setting.async,
                data: data,
                dataType: setting.dataType,
                success: function( data ){
                    if( data ){
                        layer.close( load );
                        callback && callback( data );
                    }
                }
            });
        }
    };

})();
