
(function(){
    //招贤纳士
    var recruit = CZXS.recruit = {};

    recruit.open = function(){
        var _body = $("body");

        function layerO( html ){
            var _layer = layer.open({
                type: 1,
                title: false,
                closeBtn: false,
                area: '1000px',
                skin: "my_layer",
                content: html,
                success: function(){

                }
            });
        }
        function _event(){
            $(".show").on("click", function(){
                var ths = $(this);
                var id = ths.attr("data-id");
//                整合请求
                GLOBAL.base.mAjax( { url: '/employ/get', type: "post", data: {"id": id} }, function( data ){
                    var html = template( 'layer_open', data );
                    layerO( html );
                });
                //演示模拟
                //var data = {
                //    "title": "资产主管Assets Supervisor",
                //    "id": "04189",
                //    "obj": "全职111",
                //    "add": "天津市",
                //    "order": "1",
                //    "money": "面谈",
                //    "date": "2015-05-05",
                //    "type": "社招",
                //    "item": "支持中心岗位",
                //    "intro": "本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法顺利有效经营本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法顺利有效经营本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法"
                //
                //};
                //var html = template( 'layer_open', data );
                //layerO( html );
                //演示模拟
            });
            _body.on("click", ".close", function(){
                layer.closeAll();
            });
        }
        return {
            init: function(){
                _event();
            }
        }
    }();

    recruit.ready = function(){
        $(function(){
            recruit.open.init();
        });
    }();

})();




