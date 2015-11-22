
(function(){
    //首页
    var index = CZXS.index = {};

    index.banner = function(){
        return {
            init: function(){
            var banner = new Swiper('.banner', {
                    pagination: '.banner-swiper-pagination',
                    paginationClickable: true,
                    noSwiping : true,
                    autoplay: 5000,
                    autoplayDisableOnInteraction : false,
                    speed: 600,
                    loop: true,
                    onInit: function(swiper){
                        swiperAnimateCache(swiper);
                        swiperAnimate(swiper);
                    },
                    onSlideChangeEnd: function(swiper){
                        swiperAnimate(swiper);
                    }
                });
            }
        }
    }();

    index.news = function(){
        return {
            init: function(){
                var news = new Swiper('.news', {
                    pagination: '.news-swiper-pagination',
                    paginationClickable: true,
                    autoplay: 5000,
                    autoplayDisableOnInteraction: false,
                    speed: 600,
                    loop: true,
                    spaceBetween: 10,
                    effect: 'fade'
                });
            }
        }
    }();

    index.ready = function(){
        $(function(){
            index.banner.init();
            index.news.init();
        });
    }();
})();




