
(function(){
    //在中国
    var at = CZXS.at = {};
    var DATAS = {};
    var curId = null;
    var galleryTop;

    at.logo = function(){
        var _body = $("body");
        function getData(){
//            整合请求
            GLOBAL.base.mAjax( { url: '/at/get?id='+curId,type: "get" }, function( data ){
                DATAS = data;
            });
            //alert(DATAS);
            //演示模拟
            //DATAS = {
            //    "1_1023": {
            //        "item": [
            //            {
            //                "name": "广州番禺万达",
            //                "pic": ["../../assets/images/local/a.jpg","../../assets/images/local/v.jpg"]
            //            },
            //            {
            //                "name": "广州萝岗万达",
            //                "pic": ["../../assets/images/local/a3.jpg","../../assets/images/local/a2.jpg","../../assets/images/local/a4.jpg","../../assets/images/local/a1.jpg"]
            //            },
            //            {
            //                "name": "深圳福田万达",
            //                "pic": ["../../assets/images/local/a4.jpg","../../assets/images/local/a1.jpg"]
            //            }
            //        ]
            //    },
            //    "1_1024": {
            //        "item": [
            //            {
            //                "name": "广州番禺万达",
            //                "pic": ["../../assets/images/local/a.jpg","../../assets/images/local/v.jpg"]
            //            }
            //        ]
            //    }
            //};
            //演示模拟
        }
        function gallery(){
            galleryTop = new Swiper('.gallery', {
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                spaceBetween: 10,
                resistanceRatio: 0
            });

        }
        function tpl(){
            var data = DATAS[curId];
            var html = template( 'layer_open', data );
            return html;
        }
        function initClick( index ){
            var index = index || 0;
            if(!DATAS[curId]){
                layer.closeAll();
                layer.msg('该品牌暂无点位信息', {icon: 5});
                return;
            }
            //alert(DATAS[curId])
            var data =DATAS[curId].item[index];

            var html = template( 'center_bd', data );
            $(".gallery_wp").html(html);
            $(".left_meun a").eq(index).addClass("cur").siblings().removeClass("cur");

            gallery();
        }
        function _event(){
            $(".content_pg dd a").on("click", function(){
                var ths = $(this);
                curId = ths.attr("data-id");
                if( !curId ){
                    return false
                }
                var _layer = layer.open({
                    type: 1,
                    title: false,
                    closeBtn: false,
                    area: ['1190px', '645px'],
                    skin: "my_layer",
                    content: tpl(),
                    success: function(){
                        initClick();

                    }
                });
            });
            _body.on("click", ".close", function(){
                layer.closeAll();
            });
            _body.on("click",".left_meun a", function(){
                var ths = $(this);
                var index = ths.index();
                initClick( index )
            });
        }
        return {
            init: function(){
                getData();
                _event();
            }
        }
    }();

    at.ready = function(){
        $(function(){
            at.logo.init();
        });
    }();

})();




