
(function(){
    //产品频道
    var pro = CZXS.pro = {};

    pro.banner = function(){
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
            var galleryTop = new Swiper('.gallery', {
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                spaceBetween: 10,
                initialSlide: 1,
                resistanceRatio: 0
            });
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 10,
                slidesPerView: 'auto',
                loopedSlides :3,
                centeredSlides: true,
                slideToClickedSlide: true,
                initialSlide: 1,
                resistanceRatio: 0
            });
            galleryTop.params.control = galleryThumbs;
            galleryThumbs.params.control = galleryTop;
        }
        function banner2(){
            var par = $(".banner_2_wp .img");
            var el = $(".banner_2_wp .btn");

            el.on("click", function(){
                var ths = $(this);
                var src = ths.attr("data-src");

                par.attr("src", src );
                ths.addClass("cur flipInX animated").siblings(".btn").removeClass("cur flipInX animated");
            });
        }
        function banner3(){
            var el = $(".banner_3_wp li");

            var adv = new Swiper('.banner_3_wp', {
                resistanceRatio: 0,
                onInit: function(swiper){
                    swiperAnimate(swiper);
                }
            });
            el.on("mouseover", function(){
                $(this).find("div").addClass("flipInX animated").addClass("cur");
                $(this).find("p").addClass("flipInX animated").addClass("cur").show();
            });
            el.on("mouseleave", function(){
                $(this).find("div").removeClass("flipInX animated cur");
                $(this).find("p").removeClass("flipInX animated cur").hide();
            });
        }
        function banner4(){
            $('.myroundabout').roundabout({
                autoplay: true,
                autoplayDuration: 3000,
                autoplayPauseOnHover: true,
                shape: 'figure8',
                minOpacity: 1
            });
        }
        return {
            init: function(){
                bannerMax();
                banner1();
                banner2();
                banner3();
                banner4();
            }
        }
    }();

    pro.ready = function(){
        $(function(){
            pro.banner.init();
            //GLOBAL.Utils.fixMeun()
        });
    }();

})();