
(function(){
    //加盟频道
    var busines = CZXS.busines = {};
    busines.banner = function(){
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

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner1_wp');
            });
            el.on("mouseleave", function(){
                el.find(".ext").removeClass("fadeInUp");
                el.find("li").removeClass("fadeInUp");
            });
        }
        function banner2(){
            var el = $(".banner2_wp");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner2_wp');
            });
            el.on("mouseleave", function(){
                el.find(".ext").removeClass("fadeInUp");
                el.find(".bt_txt").removeClass("fadeInUp");
                el.find("li").removeClass("bounceIn");
            });
        }
        function banner3(){
            var el = $(".banner3_wp");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner3_wp');
            });
            el.on("mouseleave", function(){
                el.find(".ext").removeClass("fadeInLeft");
                el.find("li").removeClass("fadeInLeft");
            });
        }
        function banner4(){
            var el = $(".banner4_wp");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner4_wp');
            });
            el.on("mouseleave", function(){
                el.find(".t").removeClass("fadeInRight");
                el.find(".ext").removeClass("fadeInRight");
            });
        }
        function banner5(){
            var el = $(".banner5_wp");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner5_wp');
            });
            el.on("mouseleave", function(){
                el.find(".t-tit").removeClass("fadeInLeft");
                el.find(".t").removeClass("fadeInLeft");
            });
        }
        function banner6(){
            var el = $(".banner6_wp");

            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner6_wp');
            });
            el.on("mouseleave", function(){
                el.find(".t").removeClass("fadeInUp");
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

    busines.form = function(){
        function main(){

        }
        function _event(){
            $("#place_meun a").on("click", function(){
                var ths = $(this);
                ths.addClass("cur").siblings().removeClass("cur");
                $("#place").val( ths.attr("data-type") );
            });
        }
        return {
            init: function(){
                _event();
            }
        }
    }();

    busines.ready = function(){
        $(function(){
            busines.banner.init();
            busines.form.init();
            GLOBAL.Utils.fixMeun();
        });
    }();

})();




