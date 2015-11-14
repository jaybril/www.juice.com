//导航链接高亮开始
var nava = $(".nav-menu > li");
var myURL = document.location.href;
var myHost = document.location.host.length+7;
var myURL = myURL.substring(myHost);

for(var i = 0;i<nava.length;i++){
	var links = nava.eq(i).children("a").attr("href");
    if(myURL==links){
    	nava.children("a").removeClass("active");
    	nava.eq(i).children("a").addClass("active");
   }
}
//导航链接高亮结束

//以茶会友回复弹窗开始
$(".cere-three-con .cere-three-span").click(function(){
	$(".cere-three-reply").fadeIn();
});
$(".cere-three-reply .reply-close").click(function(){
	$(".cere-three-reply").fadeOut();
});
//以茶会友回复弹窗结束

//我的购物车开始


$(".shopping-two .shop-two-add").click(function() {
	$(".shopping-two .shop-two-add").removeClass("active");
	$(this).addClass("active");
});

$(".shopping-two .address-p-show span").click(function(){
	var shopTwoAdd = $(".shopping-two .shopping-two-more");
	$(this).html(shopTwoAdd.is(":hidden") ? "收起更多<i class='fa fa-angle-double-up'></i>" : "显示更多<i class='fa fa-angle-double-down'></i>");
	shopTwoAdd.slideToggle();
})

var mycartw = $(".nav-userinfo .mycart-name").outerWidth() + $(".nav-userinfo .mycart-out").outerWidth();
$(".nav-userinfo .mycart-ul").css("right",-mycartw);
$(".nav-userinfo .mycart").mouseenter(function(){
	$(".nav-userinfo .mycart-ul").stop();
	$(".nav-userinfo .mycart-rrow").stop();
	$(".nav-userinfo .mycart-rrow").slideDown();
	$(".nav-userinfo .mycart-ul").slideDown();
});
$(".nav-userinfo .mycart").mouseleave(function(){
	$(".nav-userinfo .mycart-ul").stop();
	$(".nav-userinfo .mycart-rrow").stop();
	$(".nav-userinfo .mycart-rrow").slideUp();
	$(".nav-userinfo .mycart-ul").slideUp();
});
//我的购物车结束

//所有茶园更多加载开始
$(".garden-more > a").click(function() {
	$(this).text($(".garden-hide").is(":hidden") ? "收起更多" : "加载更多");
	$(".garden-hide").slideToggle(800);
});
//所有茶园更多加载结束

//茶叶详情导航滑动开始
var teadetaA = $(".teadetails-conHead a");
var teadetaLine = $(".teadetails-conHead .teadeta-line");
var teadetaNum = $(".teadetails-conHead a.active").index();

teadetaA.mouseenter(function() {
	var teaAx = $(this).index();
	teadetaLine.stop();
	teadetaLine.animate({
		"left": teaAx * 160
	}, 300);
	$(this).css("color", "#cc0000").siblings().css("color", "#a1a1a1");
});
teadetaA.mouseleave(function() {
	teadetaLine.stop();
	for (var i = 0; i < teadetaA.length; i++) {
		if (teadetaA.eq(i).hasClass("active")) {
			teadetaLine.animate({
				"left": teadetaA.eq(i).index() * 160
			}, 300);
			teadetaA.eq(i).css("color", "#cc0000").siblings().css("color", "#a1a1a1");
		}
	}
});
//茶叶详情导航滑动结束


//会员中心基本信息开始
var vipHeight = $(document.body).height()-($(".vipheader").height()+35)-430;
$(".vipcon").css("min-height",vipHeight);
$(".datum-head .vipedit").click(function() {
	$(".datum-edit").fadeOut();
	$("#datum-edit1").fadeIn();
});
$(".datum-address .datum-add-gba a:first-child").click(function() {
	$(".datum-edit").fadeOut();
	$("#datum-edit2").fadeIn();
});
$(".datum-address .datum-li-last").click(function() {
	$(".datum-edit").fadeOut();
	$("#datum-edit3").fadeIn();
});
$(".datum-edit .datum-edit-close").click(function() {
	$(".datum-edit").fadeOut();
});
//会员中心基本信息结束

//会员中心我的订单开始
var orderA = $(".order .order-head a");
var orderLine = $(".order-head .order-line");
var orderNum = $(".order .order-head a.active").index();

//orderA.mouseenter(function() {
//	var oindex = $(this).index();
//	orderLine.stop();
//	orderLine.animate({
//		"left": oindex * 160
//	}, 300);
//	$(this).css("color", "#cc0000").siblings().css("color", "#868686");
//});
//orderA.mouseleave(function() {
//	orderLine.stop();
//	for (var i = 0; i < orderA.length; i++) {
//		if (orderA.eq(i).hasClass("active")) {
//			orderLine.animate({
//				"left": orderA.eq(i).index() * 160
//			}, 300);
//			orderA.eq(i).css("color", "#cc0000").siblings().css("color", "#868686");
//		}
//	}
//});
orderA.click(function() {
	$(this).addClass("active").siblings().removeClass("active");
});

$(".order-sub-con .return").click(function(){
	$(".orderfin").fadeOut();
	$("#orderfin1").fadeIn();
});
$(".order-sub-con .barter").click(function(){
	$(".orderfin").fadeOut();
	$("#orderfin2").fadeIn();
});
$(".orderfin .orderfin-close").click(function(){
	$(".orderfin").fadeOut();
});
$(".orderfin .sub-con > div").not(".sub-last").click(function(){
	$(this).addClass("active").siblings().removeClass("active");
})

$(function() {
	orderLine.css("left", orderNum * 160);
	teadetaLine.css("left", teadetaNum * 160);
	var orderHeight = $(".order").outerHeight() + 35;
	var vipconHeight = $(window).outerHeight();
	if (orderHeight > vipconHeight) {
		$(".vipcon").css("min-height",orderHeight);
		$(".vipcon-right").css("height", orderHeight);
		$(".vipcon-left").css("height", orderHeight);
	}
	var evaH = $(".header").height();
	var evaF = $(".footer").outerHeight()+180;
	var myeva = vipconHeight - (evaH + evaF)+50;
	$(".evaluate").css("min-height",myeva);


	$(".teaDet-bottom .teaDet-bottom-b").html($(".teaDet-right-number .teaDet-list-con span.active").children(".teaDet-num").html());
	$(".teaDet-bottom .teaDet-bottom-span").html("￥"+$(".teaDet-right-number .teaDet-list-con span.active").children(".teaDet-price").html());

})
//会员中心我的订单结束

//评价晒单开始
$(".evaluate-con .publish").click(function(){
	var pubEva = $(this).next();
	pubEva.is(":hidden") ? pubEva.slideDown():pubEva.slideUp();
});
$(".evaluate-con .see").click(function(){
	var pubEva = $(this).next();
	pubEva.is(":hidden") ? pubEva.slideDown():pubEva.slideUp();
});

$(".publishScore .score-i i").click(function(){

	if($(this).hasClass("fa fa-star-o")){
		$(this).removeClass("fa fa-star-o").addClass("fa fa-star");
	}
	else{
		$(this).removeClass("fa fa-star").addClass("fa fa-star-o");
	}
	var num = $(this).parent().children("i.fa-star").length;
	$(this).parent().children(".score-span").html(num+"分");
	score = $(this).parent().parent().parent().children(".idea").find(".idea-hidden").val(num);
	$(this).parent().parent().next().html("");
});
//评价晒单结束



//好茶是这样炼成的开始

//好茶是这样炼成的结束

//个人中心--基本资料--删除地址开始
//function userDelete() {
//	var Dcid= arguments[0];
//	msg='是否删除？';
//	if(window.confirm(msg)) {
//		url="/user/deladdress?id="+Dcid;
//		window.location = url;
//	}
//}
//个人中心--基本资料--删除地址结束

//个人中心--我的订单--待支付--取消订单开始
//function orderCancel() {
//	var Dcid= arguments[0];
//	msg='是否取消订单？';
//	if(window.confirm(msg)) {
//		url="/user/cancelorder?id="+Dcid;
//		window.location = url;
//	}
//}
//个人中心--我的订单--待支付--取消订单结束

//个人中心--我的订单--待收货--确认收货开始
//function orderConfirm() {
//	var Dcid= arguments[0];
//	msg='是否确认收货？';
//	if(window.confirm(msg)) {
//		url="/user/confirmorder?id="+Dcid;
//		window.location = url;
//	}
//}
//个人中心--我的订单--待收货--确认收货结束

//个人中心--我的订单--已完成--申请退货开始
//function orderReturn(id) {
//	var ReturnId= id;
//	$.ajax({
//		type: "GET",
//		url: "/user/viporderfinish",
//		data: {returnid:ReturnId},
//		success: function(data){},
//	});
//	returnShow(ReturnId);
//}
//function returnShow(id){
//    $("#return"+id).fadeIn();
//}
//个人中心--我的订单--已完成--申请退货结束


//购物teadetails结算开始
//$(".teaDet-list .teaDet-right-number .teaDet-list-con span").click(function(){
//	$(this).addClass("active").siblings().removeClass("active");
//	if($(this).hasClass("last-span")){
//		$(".teaDet-bottom .teaDet-bottom-b").html($(this).children(".teaDet-text").val());
//		$(".teaDet-bottom .teaDet-bottom-span").html("￥"+$(this).children(".teaDet-price").html());
//	}else{
//		$(".teaDet-bottom .teaDet-bottom-b").html($(this).children(".teaDet-num").html());
//		$(".teaDet-bottom .teaDet-bottom-span").html("￥"+$(this).children(".teaDet-price").html());
//	}
//
//});
//
//var teacut = $(".teaDet-right-number .last-span .last-span-cut");
//var teanumHidden = $(".teaDet-right-number .last-span .teaDet-hidden").val();
//var teaDettext = $(".teaDet-right-number .last-span .teaDet-text");
//var teaprice = $(".teaDet-right-number .last-span .teaDet-price");
//var teaplus = $(".teaDet-right-number .last-span .last-span-plus");
//
//teacut.click(function() {
//	var nextCut = $(this).next(".teaDet-text").val();
//	if (nextCut <= 1) {
//		nextCut = 1;
//	} else {
//		nextCut--;
//		$(this).next(".teaDet-text").val(nextCut);
//	}
//	teaprice.html((teanumHidden*nextCut).toFixed(2));
//});
//teaplus.click(function() {
//	var prevPlus = $(this).prev(".teaDet-text").val();
//	prevPlus++;
//	$(this).prev(".teaDet-text").val(prevPlus);
//	teaprice.html((teanumHidden*prevPlus).toFixed(2));
//});
//teaDettext.keyup(function(){
//	teaprice.html((teanumHidden*$(this).val()).toFixed(2));
//	$(".teaDet-bottom .teaDet-bottom-b").html($(this).val());
//	$(".teaDet-bottom .teaDet-bottom-span").html("￥"+(teanumHidden*$(this).val()).toFixed(2));
//});
//购物teadetails结算结束

//购物teadetails图片滚动开始
var smallimgLiWidth = $(".smallimg .smallimg-div .smallimg-ul li").outerWidth()+20;
var smallimgLiNum = $(".smallimg .smallimg-div .smallimg-ul li").length;
var smallCursor  = smallimgLiNum-1;
$(".smallimg .smallimg-div .smallimg-ul").css("width",smallimgLiNum*smallimgLiWidth);

var smallIndex = 0;
var active = 3;
var samllShow = 4;
var residue = smallimgLiNum - samllShow;
var smallPrev = $(".smallimg ol .prev");
var smallNext = $(".smallimg ol .next");
var smallUl = $(".smallimg .smallimg-div .smallimg-ul");
var smallLi = $(".smallimg .smallimg-div .smallimg-ul li");

function SmallAnimate(smallIndex){
	smallUl.stop();
	smallUl.animate({"margin-left":smallIndex*smallimgLiWidth});
}

smallNext.click(function(){

	if(smallIndex == residue){
		smallIndex = 0;
	}else{
		smallIndex++;
	}
	SmallAnimate(-smallIndex);
});

smallPrev.click(function(){


	if(smallIndex==0){
		smallIndex=residue;
	}else{
		smallIndex--;
	}
	SmallAnimate(-smallIndex);
});


smallLi.mouseenter(function(){
	$(this).addClass("active").siblings().removeClass("active");
	$(".bigimg-jqzoom").attr('src',$(this).children("img").attr("mid"));
	$(".bigimg-jqzoom").attr('rel',$(this).children("img").attr("big"));
});
var smallActive = $(".smallimg .smallimg-div .smallimg-ul li.active img").attr("src");
$(".teaDet-con-left .bigimg img").attr("src",smallActive);
//购物teadetails图片滚动结束

