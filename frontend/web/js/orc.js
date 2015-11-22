
(function(){
    //果园频道
    var orc = CZXS.orc = {};
    orc.banner = function(){
        function bannerMax(){
            var swiper = new Swiper('.banner_max', {
                pagination: '.banner_max-pagination',
                direction: 'vertical',
                slidesPerView: 1,
                paginationClickable: true,
                mousewheelControl: true,
                mousewheelReleaseOnEdges : true,
                resistanceRatio: 0,
                onSlideChangeStart: function(swiper){
                    $(window).scrollTop("160");
                    if(swiper.isEnd){
                        $(".banner_max").css("zIndex",2)
                    }else{
                        $(".banner_max").css("zIndex",99999)
                    }
                }
            });
        }
        function banner1(){
            var el = $(".banner1_wp");
            var txt = el.find(".tit_txt");
            var li = el.find("li");
            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner1_wp');
            });
            el.on("mouseleave", function(){
                txt.removeClass("fadeInLeft");
                li.removeClass("fadeInUp");
            });

        }
        function banner2(){
            var el = $(".banner2_wp");
            var txt = el.find(".tit_txt");
            var li = el.find("li");
            var _q = el.find("q");
            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner2_wp');
            });
            el.on("mouseleave", function(){
                txt.removeClass("fadeInLeft");
            });
            el.find(".q").on("mouseenter", function(){
                li.fadeOut();
            });

            el.find(".q1").on("mouseenter", function(){
                el.find(".p1").fadeIn();
            });
            el.find(".q1").on("mouseleave", function(){
                el.find(".p1").fadeOut();
            });
            el.find(".q2").on("mouseenter", function(){
                el.find(".p2").fadeIn();
            });
            el.find(".q2").on("mouseleave", function(){
                el.find(".p2").fadeOut();
            });
            el.find(".q3").on("mouseenter", function(){
                el.find(".p3").fadeIn();
            });
            el.find(".q3").on("mouseleave", function(){
                el.find(".p3").fadeOut();
            });
            el.find(".q4").on("mouseenter", function(){
                el.find(".p4").fadeIn();
            });
            el.find(".q4").on("mouseleave", function(){
                el.find(".p4").fadeOut();
            });
        }
        function banner3(){
            var el = $(".banner3_wp");
            var txt = el.find(".tit_txt");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner3_wp');
            });
            el.on("mouseleave", function(){
                txt.removeClass("fadeInRight");
            });
        }
        function banner4(){
            var el = $(".banner4_wp");
            var txt = el.find(".tit_txt");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner4_wp');
            });
            el.on("mouseleave", function(){
                txt.removeClass("fadeInLeft");
            });
        }
        function banner5(){
            var el = $(".banner5_wp");
            var txt = el.find(".tit_txt");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner5_wp');
            });
            el.on("mouseleave", function(){
                txt.removeClass("fadeInRight");
            });
        }
        function banner6(){
            var el = $(".banner6_wp");
            var txt = el.find(".tit_txt");

            el.on("mouseenter", function(){
                el.find(".txt").show().addClass("bounceIn");
                GLOBAL.Utils.bannerInit('.banner6_wp');
            });
            el.on("mouseleave", function(){
                txt.removeClass("fadeInLeft");
                el.find(".txt").hide().removeClass("bounceIn");
            });
        }
        return {
            init: function(){
                bannerMax();
                banner1();
                banner2();
                banner3();
                banner4();
                banner5();
                banner6();
            }
        }
    }();

    orc.ready = function(){
        $(function(){
            orc.banner.init();
        });
    }();

})();




