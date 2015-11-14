<?php
namespace common\widgets;
class  FVariable {
    /*
     * 一些session字符串常量
     */
    public  static   $session_userId_str='userId';

    /*
     * 一些路径URL
     */
    public static $home_url='/';
    public static $siteLogin_url='/site/login';
    public static $siteRegister_url='/site/register';
    public static $siteForgetpsw_url='/site/forgetpsw';
    public static $productGarden_url='/product/teagarden';
    public static $productGarintroduce_url='/product/garintroduce';
    public static $productTechnology_url='/product/technology';
    public static $productTeaceremony_url='/product/teaceremony';
    public static $productCeredetails_url='/product/ceredetails';
    public static $productTeadetails_url='/product/teadetails';
    public static $productTeadetailsrate_url='/product/teadetailsrate';
    public static $userVipcenter_url='/user/vipcenter';
    public static $userAddAddress_url='/user/addaddress';
    public static $userEditAddress_url='/user/editaddress';

    public static $userViporder_url='/user/viporder';
    public static $userViporderstay_url='/user/viporderstay';

    public static $userViporderfinish_url='/user/viporderfinish';
    public static $userVipOrderfinishReturn_url='/user/orderreturn';

    public static $userViporderevaluate_url='/user/viporderevaluate';
    public static $userVipordercancel_url='/user/vipordercancel';
    public static $userOrderevaluate_url='/user/orderevaluate';
    public static $userShoworderevaluate_url='/user/showorderevaluate';

    public static $userVipreturn_url='/user/vipreturn';
    public static $userVipreturnfinish_url='/user/vipreturnfinish';
    public static $userVipreturncancel_url='/user/vipreturncancel';

    public static $userVipbarter_url='/user/vipbarter';
    public static $userVipbarterfinish_url='/user/vipbarterfinish';
    public static $userVipbartercancel_url='/user/vipbartercancel';

    public static $userMyshopping_url='/user/myshopping';
    public static $userShoppingcart_url='/user/shoppingcart';
    public static $userOrderpayment_url='/user/orderpayment';
    public static $userPaysuccess_url='/user/paysuccess';
    public static $userPayfail_url='/user/payfail';

    public static $userOrdercancel_url='/user/ordercancel';
    public static $userOrderpay_url='/user/orderpay';
    public static $userOrderwaitdel_url='/user/orderwaitdel';
    public static $userOrderdelivery_url='/user/orderdelivery';
    public static $userOrderfinish_url='/user/orderfinish';
    public static $userOrderfinished_url='/user/orderfinished';

    public static $error404_url='/user/error';
    public static $shoppingempty_url='/user/shoppingempty';
    /*
     * 一些视图文件
     */
    public static $home_view='/';
    public static $siteIndex_view='/site/index';
    public static $siteLogin_view='/site/login';
    public static $siteRegister_view='/site/register';
    public static $siteForgetpsw_view='/site/forgetpsw';
    public static $productGarden_view='/product/teagarden';
    public static $productGarintroduce_view='/product/garintroduce';
    public static $productTechnology_view='/product/technology';
    public static $productTeaceremony_view='/product/teaceremony';
    public static $productCeredetails_view='/product/ceredetails';
    public static $productTeadetails_view='/product/teadetails';
    public static $productTeadetailsrate_view='/product/teadetailsrate';

    public static $layoutVipmenu_view='/layouts/vipmenu';
    public static $layoutVipordermenu_view='/layouts/vipordermenu';
    public static $layoutVipreturnmenu_view='/layouts/vipreturnmenu';
    public static $layoutVipbartermenu_view='/layouts/vipbartermenu';

    public static $userVipcenter_view='/user/vipcenter';
    public static $userAddAddress_view='/user/addaddress';
    public static $userEditAddress_view='/user/editaddress';

    public static $userViporder_view='/user/viporder';
    public static $userViporderstay_view='/user/viporderstay';

    public static $userViporderfinish_view='/user/viporderfinish';
    public static $userVipOrderfinishReturn_view='/user/orderreturn';

    public static $userViporderevaluate_view='/user/viporderevaluate';
    public static $userVipordercancel_view='/user/vipordercancel';
    public static $userOrderevaluate_view='/user/orderevaluate';
    public static $userShoworderevaluate_view='/user/showorderevaluate';

    public static $userVipreturn_view='/user/vipreturn';
    public static $userVipreturnfinish_view='/user/vipreturnfinish';
    public static $userVipreturncancel_view='/user/vipreturncancel';

    public static $userVipbarter_view='/user/vipbarter';
    public static $userVipbarterfinish_view='/user/vipbarterfinish';
    public static $userVipbartercancel_view='/user/vipbartercancel';

    public static $userMyshopping_view='/user/myshopping';
    public static $userShoppingcart_view='/user/shoppingcart';
    public static $userOrderpayment_view='/user/orderpayment';
    public static $userPaysuccess_view='/user/paysuccess';
    public static $userPayfail_view='/user/payfail';

    public static $userOrdercancel_view='/user/ordercancel';
    public static $userOrderpay_view='/user/orderpay';
    public static $userOrderwaitdel_view='/user/orderwaitdel';
    public static $userOrderdelivery_view='/user/orderdelivery';
    public static $userOrderfinish_view='/user/orderfinish';
    public static $userOrderfinished_view='/user/orderfinished';

    public static $error404_view='/user/error';
    public static $shoppingempty_view='/user/shoppingempty';

    public static $paySuccess_view='/user/paysuccess';
    public static $payFail_view='/user/payfail';
    /*
     * 一些数组
     */
    public  static  $userSexArr=[
        '0'=>'男',
        '1'=>'女',
        '2'=>'保密'
    ];

    public  static  $orderStatus=[
        '0'=>'待付款',
        '1'=>'待发货',
        '2'=>'已发货',
        '3'=>'待评论',
        '4'=>'已完成',
        '5'=>'已关闭',
        '6'=>'退款中',
    ];
}