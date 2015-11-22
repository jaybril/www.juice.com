
(function(){
    //加盟频道
    var join = CZXS.join = {};
    join.banner = function(){
        function banner1(){
            var el = $(".banner1_wp");
            var li = el.find("li");
            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner1_wp');
            });
            el.on("mouseleave", function(){
                li.removeClass("flipInY");
            });
        }
        function banner2(){
            var el = $(".banner2_wp");
            var li = el.find(".txt");
            el.on("mouseenter", function(){
                GLOBAL.Utils.bannerInit('.banner2_wp');
            });
            el.on("mouseleave", function(){
                li.removeClass("bounceIn");
            });
        }
        function banner3(){
            var el = $(".qa_wp");
            var li = el.find(".txt");

            var qa = new Swiper( ".qa_wp", {
                pagination: '.qa-swiper-pagination',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                }
            });
        }
        return {
            init: function(){
                banner1();
                banner2();
                banner3();
            }
        }
    }();

    join.form = function(){
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

    join.ready = function(){
        $(function(){
            join.banner.init();
            join.form.init();
            GLOBAL.Utils.fixMeun();
        });
    }();

})();


var apply=function(){
    var  username= $.trim($("#username").val());
    var  mobile=$.trim($("#mobile").val());
    var  company=$.trim($("#company").val());
    var  industry=$.trim($("#industry").val());
    var  email=$.trim($("#email").val());
    var  nature=$.trim($("#nature").val());
    var  inCity=$.trim($("#inCity").val());
    var  area=null;
    var inMoney=$.trim($("#inMoney").val());
    var  inCount=$.trim($("#inCount").val());
    var  inPlace=$.trim($("#inPlace").val());
    var  hardwareSource=$.trim($("#hardwareSource").val());
    var  experience=$.trim($("#experience").val());
    var  inSource=$.trim($("#inSource").val());
    $("#place_meun a").each(function(){
        if($(this).hasClass('cur')){
            area=$(this).text();
            return false;
        }

    });
    if(isNaN(parseInt(inMoney))){
        layer.msg('请输入正确有效的投入资金。。', {icon: 5});
        return;
    }
    if(isNaN(parseInt(inCount))){
        layer.msg('请输入正确有效的投入机器的数量。。', {icon: 5});
        return;
    }
    if(!username){
        layer.msg('请填写您的名字。。', {icon: 5});
        return;
    }
    if(!mobile){
        layer.msg('请填写您的联系电话。。', {icon: 5});
        return;
    }
    if(!area){
        layer.msg('请填写您所代理的区域。。', {icon: 5});
        return;
    }
    layer.msg('信息提交中...', {icon: 16});
    $.post('/about/apply',{'username':username,'mobile':mobile,'company':company,'industry':industry,'email':email,'nature':nature,'inCity':inCity,'area':area,'inMoney':inMoney,'inCount':inCount,'inPlace':inPlace,'hardwareSource':hardwareSource,'experience':experience,'inSource':inSource},function(json){
        layer.closeAll();
        if(json){
            layer.msg(json.message, {icon: 2});
            returnl;
        }
        layer.msg('出错啦，请刷新重试', {icon: 5});
    },'json');

}



