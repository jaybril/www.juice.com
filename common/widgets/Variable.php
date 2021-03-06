<?php
    namespace common\widgets;
 class  Variable {
     /*
      * 一些session字符串常量
      */
     public  static   $session_userId_str='userId';

     /*
      * 一些路径URL
      */
     public static $home_url='/';
     public static $siteLogin_url='/site/login';
     public static $userMange_url='/usermanger';
     public static $editUser_url='/usermanger/edituser';
     public static $userAddress_url='/usermanger/useraddresslist';
     public static $orderManger_url='/ordermanger';
     public static $editOrder_url='/ordermanger/editorder';
     public static $deliverOrder_url='/ordermanger/deliverorder';
     public static $productManger_url='/productmanger';
     public static $sellerManger_url='/productmanger/seller';
     public static $productCat_url='/productmanger/productcat';
     public static $activityList_url='/activitymanger/activitylist';
     public static $addActivity_url='/activitymanger/addactivity';
     public static $editActivity_url='/activitymanger/editactivity';
     public static $activityWater_url='/activitymanger/activitywater';
     public static $articleManger_url='/multimediamanger/articlemanger';
     public static $articleCat_url='/multimediamanger/articlcat';
     public static $addArticle_url='/multimediamanger/addarticle';
     public static $editArticle_url='/multimediamanger/editarticle';
     public static $showArticle_url='/multimediamanger/showarticle';
     public static $liftObject_url='/multimediamanger/liftobject';
     public static $editLiftObject_url='/multimediamanger/editliftobject';
     public static $showLiftObject_url='/multimediamanger/showliftobject';
     public static $materialManger_url='/multimediamanger/materialmanger';
     public static $bannerList_url='/multimediamanger/bannerlist';
     public static $addBanner_url='/multimediamanger/addbanner';
     public static $editBanner_url='/multimediamanger/editbanner';
     public static $authList_url='/multimediamanger/authlist';
     public static $editAuth_url='/multimediamanger/editauth';
     public static $addAuth_url='/multimediamanger/addauth';
     public static $editMaterial_url='/multimediamanger/editmaterial';
     public static $commentManger_url='/comment/index';
     public static $adminUserManger_url='/websettingmanger/adminusermanger';
     public static $addAdminUser_url='/websettingmanger/addadminuser';
     public static $editAdminUser_url='/websettingmanger/editadminuser';
     public static $setting_url='/websettingmanger/index';
     public static $area_url='/websettingmanger/area';
     public static $video_url='/websettingmanger/video';
     public static $proBanner_url='/multimediamanger/probanner';
     public static $addProBanner_url='/multimediamanger/addprobanner';
     public static $editProBanner_url='/multimediamanger/editprobanner';
     public static $joinList_url='/websettingmanger/joinlist';
     public static $editJoin_url='/websettingmanger/editjoin';
     public static $addCustomer_url='/usermanger/addcustomer';
     public static $addSeller_url='/productmanger/addseller';
     public static $editSeller_url='/productmanger/eidtseller';
     public static $adddUsller_getCityList_url='/productmanger/getcitylist';
     public static $addProduct_url='/productmanger/addproduct';
     public static $editProduct_url='/productmanger/editproduct';
     public static $addProductimages_url='/productmanger/addproductimages';
     public static $employIndex_url='/employ/index';
     public static $addEmploy_url='/employ/addemploy';
     public static $editEmploy_url='/employ/editemploy';
     public static $barIndex_url='/bar/index';
     public static $addBarCat_url='/bar/addbarcat';
     public static $editBarCat_url='/bar/editbarcat';
     public static $editBarList_url='/bar/editbarlist';
     public static $serviceIndex_url='/service/index';
     public static $addService_url='/service/addservice';
     public static $editService_url='/service/editservice';
     public static $customerIndex_url='/customer/index';
     public static $editCusCatList_url='/customer/editcuscat';
     public static $customerBrand_url='/customer/brand';
     public static $editBrand_url='/customer/editbrand';
     public static $addBrand_url='/customer/addbrand';
     public static $editPoint_url='/customer/editpoint';
     public static $editPointImg_url='/customer/editpointimg';


     /*
      * 一些视图文件
      */
     public static $userMange_view='/userManger/userManger';
     public static $editUser_view='/userManger/editUser';
     public static $userAddress_view='/userManger/userAddressList';
     public static $siteIndex_view='/site/index';
     public static $siteLogin_view='/site/index';
     public static $layoutAdminLeftMenu_view='/layouts/adminLeftMenu';
     public static $userManger_view='/userManger/userManger';
     public static $orderManger_view='/orderManger/orderManger';
     public static $editOrder_view='/orderManger/editOrder';
     public static $deliverOrder_view='/orderManger/deliverOrder';
     public static $productManger_view='/productManger/productManger';
     public static $sellerManger_view='/productManger/sellerManger';
     public static $productCat_view='/productManger/productCat';
     public static $activityList_view='/activityManger/activityList';
     public static $addActivity_view='/activityManger/addActivity';
     public static $editActivity_view='/activityManger/editActivity';
     public static $activityWater_view='/activityManger/activityWater';
     public static $articleManger_view='/multimediaManger/articleManger';
     public static $articleCat_view='/multimediaManger/articleCat';
     public static $addArticle_view='/multimediaManger/addArticle';
     public static $editArticle_view='/multimediaManger/editArticle';
     public static $showArticle_view='/multimediaManger/showArticle';
     public static $liftObject_view='/multimediaManger/liftObject';
     public static $editLiftObject_view='/multimediaManger/editLiftObject';
     public static $showLiftObject_view='/multimediaManger/showLiftObject';
     public static $materialManger_view='/multimediaManger/materialManger';
     public static $bannerList_view='/multimediaManger/bannerList';
     public static $addBanner_view='/multimediaManger/addBanner';
     public static $editBanner_view='/multimediaManger/editBanner';
     public static $authList_view='/multimediaManger/authList';
     public static $editAuth_view='/multimediaManger/editAuth';
     public static $addAuth_view='/multimediaManger/addAuth';
     public static $editMaterial_view='/multimediaManger/editMaterial';
     public static $layoutMaterialMenu_view='/layouts/materialMenu';
     public static $adminUserManger_view='/webSettingManger/adminUserManger';
     public static $addAdminUser_view='/webSettingManger/addAdminUser';
     public static $editAdminUser_view='/webSettingManger/editAdminUser';
     public static $setting_view='/webSettingManger/setting';
     public static $area_view='/webSettingManger/area';
     public static $video_view='/webSettingManger/video';
     public static $proBanner_view='/multimediaManger/proBanner';
     public static $addProBanner_view='/multimediaManger/addProBanner';
     public static $editProBanner_view='/multimediaManger/editProBanner';
     public static $joinList_view='/webSettingManger/joinList';
     public static $editJoin_view='/webSettingManger/editJoin';
     public static $addSeller_view='/productManger/addSeller';
     public static $editSeller_view='/productManger/eidtSeller';
     public static $addProduct_view='/productManger/addProduct';
     public static $editProduct_view='/productManger/editProduct';
     public static $addProductImages_view='/productManger/addProductImages';
     public static $employIndex_view='/employ/index';
     public static $addEmploy_view='/employ/addEmploy';
     public static $editEmploy_view='/employ/editEmploy';
     public static $barIndex_view='/bar/index';
     public static $addBarCat_view='/bar/addBarCat';
     public static $editBarCat_view='/bar/editBarCat';
     public static $editBarList_view='/bar/editBarList';
     public static $serviceIndex_view='/service/index';
     public static $addService_view='/service/addService';
     public static $editService_view='/service/editService';
     public static $customerIndex_view='/customer/index';
     public static $editCusCatList_view='/customer/editCusCat';
     public static $customerBrand_view='/customer/brand';
     public static $editBrand_view='/customer/editBrand';
     public static $addBrand_view='/customer/addBrand';
     public static $editPoint_view='/customer/editPoint';
     public static $editPointImg_view='/customer/editpointImg';


     /*
      * 一些字符串常量
      */
     public static $imageType='';
     //短信类型
     public static $smsType_register=0;//注册短信
     public static $smsType_findPassword=1;//找回密码短信
     public static $smsType_paySuccess=2;//支付成功
     public static $smsType_appDownLoad=3;//app下载短信

     //支付方式类型
     public static $orderPayMethod_alipay = 0;//支付宝
     public static $orderPayMethod_wechat = 1;//微信
     public static $orderPayMethod_balance = 2;//余额


     //session flash
     public static $flash_success='success';
     public static $flash_error='error';
     //素材类型
     public static $materialId_banner=1000;//首页banner
     public static $materialId_auth=1002;//资质认证
     public static $materialId_productVideo=1003;//产品视频
     public static $materialId_placeImg=1004;//点位图片
     public static $materialId_proBanner=1005;//产品轮播图
     //文章类型
     public static $articleCat_type_news=1004;//新闻
     public static $articleCat_type_nutrition=1005;//橙子营养
     public static $articleCat_type_good=1006;//橙子好处
     public static $articleCat_type_people=1007;//适用人群
     public static $articleCat_type_service=1008;//服务项
     //客户分类
     public static $customer_type_c=0;//客户分类
     public static $customer_type_p=1;//品牌
     public static $customer_type_w=2;//点位

}