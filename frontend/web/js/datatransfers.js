/**
 * Created by Administrator on 2015/10/10.
 */
$(function() {
    AddStyle();
    calculateCount();
    shopping_cart();
    shopcount();
    algorithm();
});

//加入购物车开始
function calculatePrice(){

}

//样式的加载
function AddStyle(){

    $(".teaDet-right-number .teaDet-list-con > span").click(function(){
        $(this).addClass("active").siblings().removeClass("active");
        teaDetStatistics();
    });
}

//把数量赋值到文本框
function Dataloading(val){
    $(".teaDet-list-con .last-span .teaDet-text").val(val);
}

//加入购物车数量的加减
function calculateCount(){
    var spanCut = $(".teaDet-list-con .last-span .last-span-cut");
    var spanPlus = $(".teaDet-list-con .last-span .last-span-plus");
    var spanVal =  parseInt($(".teaDet-list-con .last-span .teaDet-text").val());
    var hiddenSum = parseInt($(".teaDet-list-con .last-span .teaDet-hiddenSum").val());
    if(!isNaN(spanVal) && !isNaN(hiddenSum)){
        spanCut.click(function () {
             if(spanVal<=1){
                 spanVal = 1;
             }else{
                 spanVal--;
             }
            Dataloading(spanVal);
        });

        spanPlus.click(function () {
            if(spanVal>=hiddenSum){
                spanVal = hiddenSum;
                layer.msg('已超出库存！',{icon: 2});
            }else{
                spanVal++;
            }
            Dataloading(spanVal);
        });
    }
}

//统计数量和总价格
function teaDetStatistics(){
    var count;
    var price = $(".last-span .teaDet-hiddenPrice").val();
    if($(".teaDet-right-number .teaDet-list-con > span.active").hasClass("last-span")){
        count = parseInt($(".teaDet-right-number .teaDet-list-con > span.last-span.active > .teaDet-text").val());
    }else{
        count = parseInt($(".teaDet-right-number .teaDet-list-con > span.active > b.teaDet-num").text());
    }
    var SumPrice = (count*price).toFixed(2);
    $(".teaDet-bottom #productCount").text(count);
    $(".teaDet-bottom .teaDet-bottom-span").text(SumPrice);
}

function addCart(){
    var productCount = parseInt($("#productCount").text());
    var cartMoney = $(".teaDet-bottom .teaDet-bottom-span").text();
    if(productCount && cartMoney){
        $.ajax({
            type: "POST",
            url: "/user/addcart",
            dataType: 'json',
            data: {count:productCount,cartMoney:cartMoney},
            success: function(data){
               if(data.status == '_0004'){
                   layer.confirm(data.message, {
                           btn: ['确定','取消'],
                           icon: 2,
                           closeBtn: 0,
                       }, function(){
                           window.location = "/site/login";
                       }
                   );
               }
                if(data.status == '_0003'){
                    layer.msg(data.message,{icon: 2});
                }
            },

        });
    }
}
//加入购物车结束

//购物车结算开始
function shopping_cart(){
    var chkall = $("#checkall");
    var aCh = $(".shop-tr .shop-check");
    chkall.on('click',function(){
        var status = this.checked;
        if(status==true){
            var a = 0;
            aCh.each(function () {
                a += parseInt($(this).closest('.shop-tr').find('.pricehidden').val());
                this.checked = true;
                $(this).closest('.shop-tr').find('.sh-nubtn').removeAttr("disabled");
            });
            $(".myshopping-twq .total b").text("￥"+a.toFixed(2));
            $(".myshopping-twq .sumhidden").val(a.toFixed(2));
        }else{
            var a = 0;
            aCh.each(function () {
                this.checked = false;
                $(this).closest('.shop-tr').find('.sh-nubtn').prop("disabled","disabled");
            });
            $(".myshopping-twq .total b").text("￥"+a.toFixed(2));
            $(".myshopping-twq .sumhidden").val(a.toFixed(2));
        }
    });

    aCh.on("click",function(){
        var shopping = $(this).closest('.shop-tr').find('input[type=checkbox]');
        var status = this.checked;
        var totalMemberPrice = parseFloat($('.myshopping-twq').find('.sumhidden').val());

        if (status == true) {

            var shopMemberPrice = 0;
            shopping.each(function () {

                    var productMemberPrice = parseFloat($(this).closest('.shop-tr').find('.pricehidden').val());
                    if(!isNaN(productMemberPrice)){
                        shopMemberPrice += productMemberPrice;
                    }
                $(this).closest('.shop-tr').find('.sh-nubtn').removeAttr("disabled");
                $(this).checked = true;
            });
            $(".myshopping-twq .total b").text("￥"+(totalMemberPrice+shopMemberPrice).toFixed(2));
            $(".myshopping-twq .sumhidden").val((totalMemberPrice+shopMemberPrice).toFixed(2));
        }else{
            var shopMemberPrice = 0;
            shopping.each(function (index, domEle) {
               if(index>=0) {
                   var productMemberPrice = parseFloat($(domEle).closest('.shop-tr').find('.pricehidden').val());
                   if (!isNaN(productMemberPrice)) {
                       shopMemberPrice -= productMemberPrice;
                   }
               }
                $(this).closest('.shop-tr').find('.sh-nubtn').prop("disabled","disabled");
                $(this).checked = false;
            });
            $(".myshopping-twq .total b").text("￥"+(totalMemberPrice+shopMemberPrice).toFixed(2));
            $(".myshopping-twq .sumhidden").val((totalMemberPrice+shopMemberPrice).toFixed(2));
        }


        var inputLen = 0,
            checkboxLen = 0;
        $(".shop-tr .shop-check").each(function(i){
            inputLen = i+1;
        });
        $(".shop-tr .shop-check:checked").each(function(i){
            checkboxLen = i+1;
        });
        if(inputLen == checkboxLen){
            $("#checkall").each(function(){
                this.checked=true;
            });
        } else{
            $("#checkall").each(function(){
                this.checked=false;
            });
        }

    });
}

function shopcount(){
var shopsum = 0;

$(".shop-tr .pricehidden").each(function(i){
    shopsum +=+ $(this).val();
});
$(".myshopping-twq .total b").text("￥"+shopsum.toFixed(2));
$(".myshopping-twq .sumhidden").val(shopsum.toFixed(2));
}

function algorithm() {
    var cut = $(".shop-number .cut");
    var numText = $(".shop-number .number-text").val();
    var plus = $(".shop-number .plus");

    cut.click(function () {
        var nextCut = parseInt($(this).next(".number-text").val());
        var cartId = parseInt($(this).closest(".shop-tr").find(".cartId").val());
        if (nextCut <= 1) {
            nextCut = 1;
        }

        if(!isNaN(nextCut)){
            $.ajax({
                type: "POST",
                url: "/user/cartcount",
                dataType: 'json',
                data: {id:cartId,count:nextCut,status:0},
                success: function(data){
                    if(data.status == '_0003'){
                        layer.alert(data.message, {
                            icon: 2,
                        });

                    }
                    if(data.status == '_0000'){
                        window.location.reload();
                    }
                },
            });
        }else{
            window.location.reload();
        }
        var price = $(this).parent().prev("#shop-price").val();
        var sumPrice = $(this).parent().next(".shop-total").children("span").text((nextCut*price).toFixed(2));
        $(this).parent().parent().children(".pricehidden").val((nextCut*price).toFixed(2));
        shopcount();
    });
    plus.click(function () {
        var prevPlus = parseInt($(this).prev(".number-text").val());
        var productStock = parseInt($(this).next(".productStock").val());
        var cartId = parseInt($(this).closest(".shop-tr").find(".cartId").val());
        //var money = parseFloat($(this).closest(".shop-tr").find(".pricehidden").val());
        if(prevPlus>=productStock){
            prevPlus = productStock;

        }
        if(!isNaN(prevPlus)){

            $.ajax({
                type: "POST",
                url: "/user/cartcount",
                dataType: 'json',
                data: {id:cartId,count:prevPlus,status:1},
                success: function(data){
                    if(data.status == '_0003'){
                        layer.alert(data.message, {
                            icon: 2,
                        });

                    }
                    if(data.status == '_0000'){
                        window.location.reload();
                    }

                },

            });
        }else{
            window.location.reload();
        }
        $(this).prev(".number-text").val(prevPlus);
        var price = $(this).parent().prev("#shop-price").val();
        var sumPrice =$(this).parent().next(".shop-total").children("span").text((prevPlus*price).toFixed(2));
        $(this).parent().parent().children(".pricehidden").val((prevPlus*price).toFixed(2));
        shopcount();
    });
}

function shopdele(id){
    var cartId = parseInt(id);
    if(cartId){
        layer.confirm('是否删除购物车的商品？', {
                btn: ['确定','取消'],
                icon: 2,
            }, function(){
                $.ajax({
                    type: "POST",
                    url: "/user/delcart",
                    data: {cartId:cartId},
                    success: function(data){
                        window.location.reload();
                    },

                });
            }, function(){}
        );
    }
}

function balancing(){
    var money = parseFloat($(".myshopping-twq .sumhidden").val());
    if(money == 0.00 || money == null) {
        layer.alert('请至少选中一个商品！', {
            icon: 6,
        });
        return;
    }
    $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/user/selectadd",
            success: function(data){
             if(data.status == '_0004'){
                 layer.confirm(data.message, {
                     btn: ['添加','取消'],
                     icon: 2,
                 }, function(){
                    window.location = "/user/addaddress";
                 }, function(){}
                 );
                 return;
             }
                cartToOrder();//结算购物车并跳转订单页面
            }
        });
}
var cartToOrder=function(){
    var id_str='';
    $(".shop-tr .shop-check:checked").each(function(i){
        var id = $(this).parent().prev(".cartId").val();
        id_str +=(id+'-');
    });
    id_str = id_str.substr(0,id_str.length-1);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/user/notselectcart",
        data:{id_str:id_str},
        success: function(data){
          if(data.status == '_0000'){
             window.location = "/user/shoppingcart";
          }
        }
    });
}
//购物车结算结束

//提交订单开始
function submitOrder(){
   var addressId = parseInt($(".shopping-two .shop-two-add.active #shopaddressId").val());
   var TotalPrice = parseFloat($(".shop-three-payment #TotalPrice").val());
    if(!isNaN(addressId) && !isNaN(TotalPrice)){
        $.ajax({
           type: "post",
            url: "/user/insertorderdata",
            dataType: 'json',
            data:{addressId:addressId,TotalPrice:TotalPrice},
            success: function(data){

            }
        });
    }
}
//提交订单结束

//注册账号验证码开始
var getPhoneCode=function(){
    var phoneNumber=$(".login-form .login-text").val();
    var cd=new countDown();
    cd.time=60;
    cd.obj=window.document.getElementById('ReGetphonecode');
    if(!phoneNumber){
       $(".field-userregisterform-mobile .help-block").text("*请填写手机号码");
        return;
    }
    if(!(/^1[3|4|5|7|8][0-9]\d{0,9}$/.test(phoneNumber))){
        $(".field-userregisterform-mobile .help-block").text("*手机号码格式不正确");
        return;
    }
        cd.beginCountDown();
        $.post('/site/registercode', {phoneNumber: phoneNumber}, function (json) {}, 'json');

}
//注册账号验证码结束

//找回密码验证码开始
var getPhoneCodeAgain=function(){
    var ForgetPhoneNumber=$("#userretrievepswform-forgetmobile").val();
    var cd1=new countDown();
    cd1.time=60;
    cd1.obj=window.document.getElementById('ForgetPhoneCode');
    if(!ForgetPhoneNumber){
        $(".field-userretrievepswform-forgetmobile .help-block").text("*请填写手机号码");
        return;
    }
    if(!(/^1[3|4|5|7|8][0-9]\d{0,9}$/.test(ForgetPhoneNumber))){
        $(".field-userretrievepswform-forgetmobile .help-block").text("*手机号码格式不正确");
        return;
    }
    $.ajax({
        type: "post",
        url: "/site/findpswcode",
        dataType: 'json',
        data:{phoneNumber: ForgetPhoneNumber},
        success: function(data){
            if(data.status == '_0004'){
                $(".field-userretrievepswform-forgetmobile .help-block").text(data.message);
            }
            if(data.status == '_0000'){
                cd1.beginCountDown();
            }

        }
    });

}
//找回密码验证码结束

//个人中心订单退货申请开始
function OrderReturnReason(id){
   var orderTextCon = $("#orderTextCon"+id).val();
   if(orderTextCon==null || orderTextCon==""){
       $("#orderBtnSubmit"+id).prev(".help-block").text("*退货原因不能为空！");
       return;
   }
   $("#orderTextCon"+id).focus(function(){
       $(this).next(".help-block").text("");
       return;
   });
    if(orderTextCon.length<5){
        $("#orderBtnSubmit"+id).prev(".help-block").text("*退货原因不能少于5个字！");
        return;
    }
    $.ajax({
        type: "post",
        url: "/site/findpswcode",
        dataType: 'json',
        data:{phoneNumber: ForgetPhoneNumber},
        success: function(data){
            if(data.status == '_0004'){
                $(".field-userretrievepswform-forgetmobile .help-block").text(data.message);
            }
            if(data.status == '_0000'){
                cd1.beginCountDown();
            }

        }
    });
}
//个人中心订单退货申请结束

//个人中心--基本资料---地址删除开始
function UserAddressDel(id){
    layer.confirm('是否要删除？', {
            btn: ['删除','取消'],
            icon: 3,
        }, function(){
            $.ajax({
                type: "post",
                url: "/user/deladdress",
                dataType: 'json',
                data:{id: id},
                success: function(data){
                 if(data.status == '_0000'){
                     layer.msg(data.message, {icon: 1,closeBtn: 0});
                     setTimeout(function(){location.reload()},2000);
                 }

                }
            });
        }, function(){}
    );
}
//个人中心--基本资料---地址删除结束

//个人中心--我的订单--评价表单开始
function PublishRate(id){
    var iNum =$(".idea #score"+id).val();
    var iScore = $(".idea #score"+id).prev().val();
    var productId = $(".idea #score"+id).nextAll("#productId").val();
    var orderId = $(".idea #orderId").val();
    var orderNo = $(".idea #orderNo").val();
    if(iNum==0){
        $(".eva-con #error"+id).html("*请填写评分");
    }
    else if(iScore==null || iScore==""){
        $(".eva-con #ierror"+id).html("*请填写评价");
    }
    else{
        $.ajax({
            type: "POST",
            url: "/user/evaluatesubmit",
            dataType: 'json',
            data: {orderDetailId:id,iNum:iNum,iScore:iScore,orderId:orderId,productId:productId},
            success: function(data){
                if(data.status == '_0000'){
                    layer.msg(data.message, {icon: 1,closeBtn: 0});
                    setTimeout(function(){location.reload()},2000);
                }
                if(data.status == '_0001'){
                    layer.msg(data.message, {icon: 1,closeBtn: 0});
                    setTimeout(function(){window.location = "/user/showorderevaluate/"+orderNo;},2000);
                }

            },
        });
    }

}
$(".publish-eva-show .idea .idea-textarea").focus(function(){
    $(this).parent().children(".help-block").html("");
});
//个人中心--我的订单--评价表单结束

//个人中心--我的订单--确认收货开始
function hasDelivery(id){
  var orderId = id;
  if(!isNaN(orderId)){
      layer.confirm('是否要确认收货？', {
              btn: ['确定','取消'],
              icon: 3,
          }, function(){
              $.ajax({
                  type: "post",
                  url: "/user/hasdelivery",
                  dataType: 'json',
                  data:{orderId: orderId},
                  success: function(data){
                      if(data.status == '_0000'){
                          layer.msg(data.message, {icon: 1,closeBtn: 0});
                          setTimeout(function(){window.location = '/user/viporderevaluate'},2000);
                      }

                  }
              });
          }, function(){}
      );
  }
}
//个人中心--我的订单--确认收货结束

//个人中心--我的订单--取消订单开始
function orderCancel(id) {
    var orderId = id;
    if(!isNaN(orderId)){
        layer.confirm('是否要取消订单？', {
                btn: ['确定','取消'],
                icon: 3,
            }, function(){
                $.ajax({
                    type: "post",
                    url: "/user/cancelorder",
                    dataType: 'json',
                    data:{orderId: orderId},
                    success: function(data){
                        if(data.status == '_0000'){
                            layer.msg(data.message, {icon: 1,closeBtn: 0});
                            setTimeout(function(){window.location = '/user/vipordercancel'},2000);
                        }

                    }
                });
            }, function(){}
        );
    }
}
//个人中心--我的订单--取消订单结束

//文章发表看法开始
function ArticleComment(){
    var ArticleCon = $("#ArticleCon").val();
    var ArticleId = $("#ArticleId").val();
    $.ajax({
        type: "POST",
        url: "/product/publishcoment",
        dataType: 'json',
        data: {ArticleCon: ArticleCon,ArticleId:ArticleId},
        success: function(data){
            if(data.status == '_0004'){
                layer.confirm(data.message, {
                        btn: ['确定','取消'],
                        icon: 2,
                        closeBtn: 0,
                    }, function(){
                        window.location = "/site/login";
                    }
                );
            }
            if(data.status == '_0003'){
                layer.msg(data.message,{icon: 2});
            }
            if(data.status == '_0000'){
                layer.msg(data.message, {icon: 1,closeBtn: 0});
                setTimeout(function(){window.location = '/product/ceredetails/'+ArticleId},1500);
            }
        },
    });
}
//文章发表看法结束