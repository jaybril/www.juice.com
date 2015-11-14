<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/18
 * Time: 17:53
 */

namespace frontend\controllers;
use common\widgets\JsonParser;
use common\widgets\Tool;
use frontend\models\Cart;
use frontend\models\Comment;
use frontend\models\Express;
use frontend\models\OrderDetail;
use frontend\models\OrderExpressInfo;
use frontend\models\Product;
use frontend\models\UserUpdateForm;
use Yii;
use yii\db\Exception;
use yii\db\Query;
use yii\web\Controller;
use common\widgets\FVariable;
use frontend\models\User;
use frontend\models\UserAddress;
use frontend\models\AddAddressForm;
use frontend\models\Area;
use frontend\models\Order;
use frontend\models\OrderReturnForm;
use yii\data\Pagination;
use common\widgets\GlobalArray;
use yii\filters\AccessControl;

class UserController extends Controller
{
    public  $layout='mingpoMain';//整个controller的布局文件

    //过滤器
//    public function behaviors()
//    {
//
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
////                'only' => ['login', 'logout', 'signup'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login'],
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['vipcenter'],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    //用户个人中心---基本信息
    public function actionVipcenter()
    {
        $model = new User();
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $selectModel= $model->findUserByUserId($userId);

        $updateReq = Yii::$app->request;//创建一个请求对象
        $updateModel = new UserUpdateForm();//创建一个编辑的表单对象
        if($updateModel->load($updateReq->post())){
            if($updateModel->validate()){
                $email=$updateModel->email;
                $realName=$updateModel->realName;
                $sex=$updateModel->sex;
                $birthday=$updateModel->birthday;
                $modelUpdate = $model->updateUserByUserId($userId,$email,$realName,$sex,$birthday);
                return $this->redirect(FVariable::$userVipcenter_view);
            }

        }

        //地址列表
        $address = new UserAddress();
       $addressModel = $address->findByUserIdAll($userId);
        $isDefault = "";
        foreach($addressModel as $isEk=>$isEv){
            if($isEv['isDefault']==1){
                $isDefault = $address->findByIdOne($userId,1);
                break;
            }else{
                $isDefault = $address->findByIdOne($userId,0);
            }
        }
        $addressModel = $address->findByUserIdAllAgain($userId,$isDefault['id']);
        return $this->render(FVariable::$userVipcenter_view,['model'=>$selectModel,'updateModel'=>$updateModel,'addressModel'=>$addressModel,'isDefault'=>$isDefault]);
    }

    //用户个人中心---添加地址
    public function actionAddaddress(){
        $AddressForm = new AddAddressForm();
        $AreaProvince = new Area();
        $UserAddress = new UserAddress();
        $AreaProvince = $AreaProvince->findAllProvince(0);
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $countNum = count($UserAddress->findByUserIdAll($userId));

        $addAddressReq = Yii::$app->request;//创建一个请求对象
        $prompt = '';
        if($AddressForm->load($addAddressReq->post())){
            if($AddressForm->validate()){

                if($countNum<11){
                    if(!$AddressForm->isDefault){
                        $AddressForm->isDefault=0;
                    }else{
                        $UserAddress->findByUserIdUpdate($userId);
                    }
                    $UserAddress->insertAddress($userId,$AddressForm);
                    return $this->redirect(FVariable::$userVipcenter_view);
               }else{
                    $prompt = '*所添加的地址不能超过11个';
                }
            }

        }
        return $this->render(FVariable::$userAddAddress_view,['AddressForm'=>$AddressForm,'AreaProvince'=>$AreaProvince,'prompt'=>$prompt]);
    }

    //用户个人中心---编辑地址
    public function actionEditaddress(){
        $Area = new Area();
        $UserAddress = new UserAddress();
        $AreaProvince = $Area->findAllProvince(0);
        $AddressForm = new AddAddressForm();
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $userAddressId = Yii::$app->request->get('id');
        $EditUserAddress = $UserAddress->findByUserIdEvaluate($userId,$userAddressId);
        $AddressForm->userName=$EditUserAddress->userName;
        $AddressForm->provinceId=$EditUserAddress->provinceId;
        $AddressForm->cityId=$EditUserAddress->cityId;
        $AddressForm->areaId=$EditUserAddress->areaId;

        $AreaCity = $Area->findAllCity($AddressForm->provinceId);
        $AreaArea = $Area->findAllCity($AddressForm->cityId);

        $AddressForm->detailAddress=$EditUserAddress->detailAddress;
        $AddressForm->userMobile=$EditUserAddress->userMobile;
        $AddressForm->userPhone=$EditUserAddress->userPhone;
        $AddressForm->postNumber=$EditUserAddress->postNumber;
        $AddressForm->isDefault=$EditUserAddress->isDefault;

        $editAddressReq = Yii::$app->request;//创建一个请求对象
        if($AddressForm->load($editAddressReq->post())){
            if($AddressForm->validate()){
                    if(!$AddressForm->isDefault){
                        $AddressForm->isDefault=0;
                    }else{
                        $UserAddress->findByUserIdUpdate($userId);
                    }
                    $UserAddress->findByIdEdit($userAddressId,$AddressForm);
                    return $this->redirect(FVariable::$userVipcenter_view);
            }

        }

        return $this->render(FVariable::$userEditAddress_view,['AddressForm'=>$AddressForm,'AreaProvince'=>$AreaProvince,'AreaCity'=>$AreaCity,'AreaArea'=>$AreaArea]);
    }

    //用户个人中心---删除地址
    public function actionDeladdress(){
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $userAddressId = Yii::$app->request->post('id');
        $UserAddress = new UserAddress();
        $UserAddress->findByIdDelete($userAddressId);
        JsonParser::GenerateJsonResult('_0000','地址删除成功！');
        exit;
    }

    //用户个人中心---城市联动
    public function actionCity(){
        $AreaCity = new Area();
        $cityid = Yii::$app->request->post('cityid');
        $AreaCity = $AreaCity->findAllCity($cityid);
        JsonParser::GenerateJsonResult('_0000',$AreaCity);
        exit;
    }

    //用户个人中心---市区联动
    public function actionArea(){
        $AreaArea = new Area();
        $aeraid = Yii::$app->request->post('areaid');
        $AreaArea = $AreaArea->findAllArea($aeraid);
        JsonParser::GenerateJsonResult('_0000',$AreaArea);
        exit;
    }

    //用户个人中心---我的订单--全部订单
    public function actionViporder()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => Order::find()->where(array('userID'=>$userId))->count(),
        ]);
        $orderPay = Order::find()->where(array('userID'=>$userId))->
        offset($pagination->offset)->limit($pagination->limit)->orderBy(['orderTime'=>SORT_DESC])->all();
        return $this->render(FVariable::$userViporder_view,['orderPay'=>$orderPay, 'pagination' => $pagination]);
    }

    //用户个人中心---我的订单--待支付--取消订单
//    public function actionCancelorder(){
//        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
//        $orderId = Yii::$app->request->get('id');
//        $order = new Order();
//        $order->findByCancel($orderId,$userId);
//        return $this->redirect(FVariable::$userViporder_view);
//    }

//    public function actionViporder()
//    {
//        $order = new Order();
//        $orderDetail = new OrderDetail();
//        $product = new Product();
//        $AddressUsername = new UserAddress();
//        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
//        $orderPay = $order->findByStatus(0,$userId);
//
//
//        $AddressUsername = $AddressUsername->findByUserIdEvaluate($userId,9);
//        $orderDetail = $orderDetail->findByOrderDetail($orderPay[0]['id']);
//
//        $product = $product->findByProductId($orderDetail[0]['productId']);
//        if(!$orderPay){
//            return;
//        }
//        return $this->render(FVariable::$userViporder_view,['orderPay'=>$orderPay,'orderDetail'=>$orderDetail,'product'=>$product,'AddressUsername'=>$AddressUsername]);
//    }

    //用户个人中心---我的订单--待支付
    public function actionViporderstay()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['waitPay']))->count(),
        ]);
        $orderStayed = Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['waitPay']))->
        offset($pagination->offset)->limit($pagination->limit)->orderBy(['orderTime'=>SORT_DESC])->all();
        return $this->render(FVariable::$userViporderstay_view,['orderStayed'=>$orderStayed,'pagination'=>$pagination]);
    }

    //用户个人中心---我的订单--待支付--取消订单
    public function actionCancelorder(){
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderId = Yii::$app->request->post('orderId');
        $order = new Order();
        $orderUpdate = $order->findByCancel($orderId,$userId);
        JsonParser::GenerateJsonResult('_0000','订单取消成功！');
        exit;
    }

    //用户个人中心---我的订单--待收货--确认收货
//    public function actionConfirmorder(){
//        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
//        $orderId = Yii::$app->request->get('id');
//        $order = new Order();
//        $order->findByConfirm($orderId,$userId);
//        return $this->redirect(FVariable::$userViporderstay_view);
//    }

    //用户个人中心---我的订单--已完成
    public function actionViporderfinish()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['completed']))->count(),
        ]);
        $orderFinished = Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['completed']))->offset($pagination->offset)->limit($pagination->limit)->
        orderBy(['orderTime'=>SORT_DESC])->all();


        return $this->render(FVariable::$userViporderfinish_view,['orderFinished'=>$orderFinished,'pagination'=>$pagination]);
    }

    //用户个人中心---我的订单--待评价
    public function actionViporderevaluate()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['waitEvaluate']))->count(),
        ]);
        $orderEvaluateed = Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['waitEvaluate']))->offset($pagination->offset)->limit($pagination->limit)->
        orderBy(['orderTime'=>SORT_DESC])->all();
        return $this->render(FVariable::$userViporderevaluate_view,['orderEvaluateed'=>$orderEvaluateed,'pagination'=>$pagination]);
    }

    //用户个人中心---我的订单--申请退货视图
    public function actionOrderreturn()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $returnId = Yii::$app->request->get('id');
        $returnStatus = Yii::$app->request->get('status');
        $order = new Order();
        $orderDetail = new OrderDetail();
        $return = $order->findByOrderReturn($returnId,$userId,$returnStatus);
        if(!$return || $return->isRefund==GlobalArray::$orderIsRefundArray['Application']){
            return $this->redirect(FVariable::$error404_view);
        }
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($returnId);
        return $this->render(FVariable::$userVipOrderfinishReturn_view,['return'=>$return,'orderDetailList'=>$orderDetailList]);
    }
   //用户个人中心---我的订单--申请退货原因
    public function actionOrderreturnreason()
    {

    }

//    public function actionOrderreturn()
//    {
//        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
//        if(!$userId){
//            return $this->redirect(FVariable::$siteLogin_view);
//        }
//        $returnId = Yii::$app->request->get('id');
//        $returnStatus = Yii::$app->request->get('status');
//        $order = new Order();
//        $return = $order->findByOrderReturn($returnId,$userId,$returnStatus);
//        if(!$return || $return->isRefund==GlobalArray::$orderIsRefundArray['Application']){
//            return $this->redirect(FVariable::$error404_view);
//        }
//        $returnReq = Yii::$app->request;//创建一个请求对象
//        $returnModel = new OrderReturnForm();//创建一个编辑的表单对象
//        if($returnModel->load($returnReq->post())){
//            if($returnModel->validate()){
//                $returnEdit = $order->findByOrderReturnEdit($returnId,$userId,$returnStatus,$returnModel);
//                echo "<script>alert('提交成功');window.location='/user/viporder'</script>";
//            }
//        }
//        return $this->render(FVariable::$userVipOrderfinishReturn_view,['return'=>$return,'returnId'=>$returnId,'returnModel'=>$returnModel,'returnStatus'=>$returnStatus]);
//    }

    //用户个人中心---我的订单--申请退货原因表单
//    public function actionOrderreturnform()
//    {
//        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
//        $returnId = Yii::$app->request->get('id');
//        $returnStatus = Yii::$app->request->get('status');
//        $order = new Order();
//
//    }

    //用户个人中心---我的订单--评价订单
    public function actionOrderevaluate()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $returnId = Yii::$app->request->get('id');
//        $returnStatus = Yii::$app->request->get('status');
        $order = new Order();
        $details = $order->findByOrderReturn($returnId);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $orderDetail = new OrderDetail();;
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);
        return $this->render(FVariable::$userOrderevaluate_view,['details'=>$details,'orderDetailList'=>$orderDetailList,'userId'=>$userId]);
    }

    //用户个人中心---我的订单--评价订单提交
    public function actionEvaluatesubmit()
    {

        $userId = Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $iNum = Yii::$app->request->post('iNum');
        $iScore = Yii::$app->request->post('iScore');
        $orderDetailId = Yii::$app->request->post('orderDetailId');
        $orderId = Yii::$app->request->post('orderId');
        $pId = Yii::$app->request->post('productId');
        $commnet = new Comment();
        $orderDetail = new OrderDetail();
        $order = new Order();
        $orderDetailUpdate = $orderDetail->UpdateOrderDetail($orderDetailId);
        $productId = $orderDetail->findIdOrderDetail($orderDetailId);
        $commnet->findByIdInsert($userId,GlobalArray::$commentTypeConstantArray['product'],$orderDetailId,$iNum,$iScore);
        $isEvaluate = $orderDetail->findByIsEvaluate($orderId);
        $product = new Product();
        $commentList =$commnet->SelectAllProductCom();
        $count = 0;
        $num = 0;
        if($commentList) {
            foreach ($commentList as $k => $v) {
                $orderDetailProductId = $orderDetail->findIdOrderDetailIsEvaluate($v['typeId']);
                if ($orderDetailProductId->productId == $pId) {
                    $count++;
                    $num += $commnet->findByIdCom($orderDetailProductId->id)->score;
                }
            }
            $score = sprintf("%.1f", $num / $count);
            $product->UpdateByCommentCount($productId->productId, $score);
        }
        $isOk=true;
        foreach($isEvaluate as $isEk=>$isEv){
            if($isEv['isEvaluate']==0){
                JsonParser::GenerateJsonResult('_0000','评价成功！');
                $isOk=false;
                break;
            }
        }
        if($isOk){
            $order->findByConfirm($orderId,$userId);
            JsonParser::GenerateJsonResult('_0001','评价成功！');
            exit;
        }
    }

    public function actionTest()
    {
      $comment = new Comment();
        $orderDetail = new OrderDetail();
      $commentList =$comment->SelectAllProductCom();
        $count = 0;
        $num = 0;
        foreach($commentList as $k=>$v){
            $orderDetailProductId = $orderDetail->findIdOrderDetailIsEvaluate($v['typeId']);
            if($orderDetailProductId->productId == GlobalArray::$productIdArray['0']){
                $count++;
                $num += $comment->findByIdCom($orderDetailProductId->id)->score;
            }

        }
         echo $num/$count;
    }

    //用户个人中心---我的订单--查看评价
    public function actionShoworderevaluate()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $returnId = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($returnId);
        if($details->orderStatus != GlobalArray::$orderStateConstantArray['completed']){
            return $this->redirect(FVariable::$error404_view);
        }
        $orderDetail = new OrderDetail();
        $orderDetailList = $orderDetail->findByOrderDetail($details->id);

        if(!$details || !$orderDetailList){
            return $this->redirect(FVariable::$error404_view);
        }
        return $this->render(FVariable::$userShoworderevaluate_view,['details'=>$details,'orderDetailList'=>$orderDetailList]);
    }

    //用户个人中心---我的订单--已取消
    public function actionVipordercancel()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['hasCancel']))->count(),
        ]);
        $orderCanceled = Order::find()->where(array('userID'=>$userId,'orderStatus'=>GlobalArray::$orderStateConstantArray['hasCancel']))->offset($pagination->offset)->limit($pagination->limit)->
        orderBy(['orderTime'=>SORT_DESC])->all();
        return $this->render(FVariable::$userVipordercancel_view,['orderCanceled'=>$orderCanceled,'pagination'=>$pagination]);
    }

    //用户个人中心---退货申请--退货中
    public function actionVipreturn()
    {
        return $this->render(FVariable::$userVipreturn_view);
    }

    //用户个人中心---退货申请--已完成
    public function actionVipreturnfinish()
    {
        return $this->render(FVariable::$userVipreturnfinish_view);
    }

    //用户个人中心---退货申请--已取消
    public function actionVipreturncancel()
    {
        return $this->render(FVariable::$userVipreturncancel_view);
    }

    //用户个人中心---换货申请--换货中
    public function actionVipbarter()
    {
        return $this->render(FVariable::$userVipbarter_view);
    }

    //用户个人中心---换货申请--已完成
    public function actionVipbarterfinish()
    {
        return $this->render(FVariable::$userVipbarterfinish_view);
    }

    //用户个人中心---换货申请--已取消
    public function actionVipbartercancel()
    {
        return $this->render(FVariable::$userVipbartercancel_view);
    }

    //我的购物车
    public function actionMyshopping()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }else{
            $cart = new Cart();
            $cartList = $cart->findById($userId);
            if(!$cartList){
                return $this->redirect(FVariable::$home_view);
            }
            return $this->render(FVariable::$userMyshopping_view,['cartList'=>$cartList]);
        }

    }

    //加入购物车
    public function actionAddcart()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            JsonParser::GenerateJsonResult('_0004','您还没有登录，请先登录');
            exit;
        }
            $cart = new Cart();
            $product = new Product();
            $productPrice = $product->findByProductId(GlobalArray::$productIdArray['0']);
            $count  = intval(Yii::$app->request->post("count"));
            $cartMoney  = Yii::$app->request->post("cartMoney");
            $cartCount = $cart->findByIdCartCount($userId,GlobalArray::$productIdArray['0']);

        if($cartCount){
            $cartCount = intval($cartCount->count);
            $count = $cartCount + $count;
        }

        if($count > $productPrice->productStock){
            JsonParser::GenerateJsonResult('_0003','购物车这个商品的数量已超过库存！');
            exit;
        }
        if($count && $cartMoney) {
                $productPrice = sprintf("%.2f", ($productPrice->productPrice) * $count);
                if ($cartMoney != $productPrice) {
                    $cartMoney = $productPrice;
                }
                if ($count && $cartMoney) {
                    $cart->findByIdInsert($userId, GlobalArray::$productIdArray['0'], $count, $cartMoney);
                    return $this->redirect(FVariable::$userMyshopping_view);
                }
            }
        JsonParser::GenerateJsonResult('_0004','添加购物车失败，请刷新重试！');
        exit;


    }

    //删除购物车
    public function actionDelcart()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);

        if(!$userId){
            return $this->redirect(FVariable::$home_view);
        }else{
            $cartDel = new Cart();
            $cartId  = intval(Yii::$app->request->post("cartId"));
            if($cartId){
                $cartFind = $cartDel->findByIdDetails($cartId);
                if($cartFind){
                    $cartDel->findByIdDelCart($userId,$cartId);
                    $cartList = $cartDel->findByIdIs($userId);
                    if(!$cartList){
                        return $this->redirect(FVariable::$shoppingempty_view);
                    }
                }
            }
        }
    }

    //购物车产品数量加减
    public function actionCartcount()
    {
           $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
           $cart = new Cart();
           $product = new Product();
           $cartId  = intval(Yii::$app->request->post("id"));
           $cartCount  = intval(Yii::$app->request->post("count"));
           $status  = intval(Yii::$app->request->post("status"));

           $cartDetails = $cart->findByIdDetails($cartId);
        if($cartDetails) {
            $product = $product->findByProductId($cartDetails->productId);

            if ($status == 0) {

                if ($cartCount <= 1) {
                    $cartCount = 1;
                    JsonParser::GenerateJsonResult('_0003', '商品数量不能再减了！');
                    exit;
                } else {
                    $cartCount = $cartCount - 1;
                    JsonParser::GenerateJsonResult('_0000', '');
                }

            }

            if ($status == 1) {
                if ($cartCount >= intval($product->productStock)) {
                    $cartCount = intval($product->productStock);
                    JsonParser::GenerateJsonResult('_0003', '商品数量已超过库存！');
                    exit;
                } else {
                    $cartCount = $cartCount + 1;
                    JsonParser::GenerateJsonResult('_0000', '');
                }

            }
            $money = $product->productPrice*$cartCount;
            $cartUpdate = $cart->findByIdUpdateCount($cartId,$userId,$cartCount,$money);
        }else{
            return $this->redirect(FVariable::$error404_view);
        }

    }

    //查询用户有没有地址
    public function actionSelectadd()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $userAddress = new UserAddress();
        $userAddress = $userAddress->findByUserIdAll($userId);
        if(!$userAddress){
            JsonParser::GenerateJsonResult('_0004','您还没有添加收货地址，是否要添加？');
            exit;
        }
        JsonParser::GenerateJsonResult('_0000','');
        exit;
    }

    //用户没选中购物车的商品就把删除，然后跳转
    public function actionNotselectcart()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
            $cart = new Cart();
            $id_str  = Yii::$app->request->post('id_str');
            $arr = explode('-',$id_str);
            $cart->findByIdDelCartAgain($arr,$userId);
            JsonParser::GenerateJsonResult('_0000','');
            exit;
    }

    //我的购物车--结算
    public function actionShoppingcart()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }else{
            $cart = new Cart();
            $cartList = $cart->findById($userId);
            if(!$cartList){
                return $this->redirect(FVariable::$home_view);
            }
            $address = new UserAddress();
            $addressIs = $address->findByUserIdAll($userId);
            if(!$addressIs){
                return $this->redirect(FVariable::$home_view);
            }
            $isDefault = "";
            foreach($addressIs as $isEk=>$isEv){
                if($isEv['isDefault']==1){
                    $isDefault = $address->findByIdOne($userId,1);
                    break;
                }else{
                    $isDefault = $address->findByIdOne($userId,0);
                }
            }
            $addressModel = $address->findByUserIdAllAgain($userId,$isDefault['id']);
            return $this->render(FVariable::$userShoppingcart_view,['cartList'=>$cartList,'addressModel'=>$addressModel,'isDefault'=>$isDefault]);
        }
    }

    //插入订单数据
    public function actionInsertorderdata()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $addressId  = intval(Yii::$app->request->post("addressId"));
        $TotalPrice  = floatval(Yii::$app->request->post("TotalPrice"));
        $order = new Order();
        $cart = new Cart();
        $cartList = $cart->findById($userId);
        if(!$cartList){
            return $this->redirect(FVariable::$home_view);
        }
        $allMoney = "";
        foreach($cartList as $mk=>$mv)
        {
            $allMoney += $mv['count']*$mv['productPrice'];
        }
        if($TotalPrice!=$allMoney){
            $TotalPrice = $allMoney;
        }
        $orderNo = Tool::getOrderNumber();
        $connection=Yii::$app->getDb();
        $transaction=$connection->beginTransaction();
        try {
            $orderDetail = new OrderDetail();
            $orderData = $order->insertOrder($orderNo, $TotalPrice, GlobalArray::$orderStateConstantArray['waitPay'], GlobalArray::$orderPayMethodConstantArray['alipay'], GlobalArray::$orderComeFromConstantArray['WEB'], $userId, $addressId);
            $orderId = Yii::$app->db->getLastInsertID();
            $cartDetail = $cart->findByIdIs($userId);
            if (!$cartDetail) {
                return $this->redirect(FVariable::$home_view);
            }
            $detailArr = [];
            foreach ($cartDetail as $k => $v) {
                $new = [];
                $new[0] = $orderId;
                $new[1] = $v['productId'];
                $new[2] = $v['count'];
                $new[3] = $v['money'];
                $detailArr[$k] = $new;
            }
            $orderDetail->insertOrderDetail($detailArr);
            $product = new Product();
            $orderDetailFind = $orderDetail->findByOrderIdProduct($orderId);
            foreach ($orderDetailFind as $k => $v) {
                $productSelect = $product->findByProductId($v['productId']);
                $productStock = $productSelect->productStock;
                $productSales = $productSelect->productSales;
                $detailArrCount = $productStock - $v['productCount'];
                $productSales = $productSales + $v['productCount'];
                $product->UpdateByStock($v['productId'], $detailArrCount,$productSales);
            }
            $cart->findByIdDelCartAll($userId);
            $transaction->commit();
        }
        catch(Exception $e){
            $transaction->rollBack();
            throw $e;
        }
        $this->redirect(Yii::$app->urlManager->createUrl([FVariable::$userOrderpayment_view,'id'=>$orderId]));
    }

//    public function actionTest(){
//        $orderDetail = new OrderDetail();
//        $product  = new Product();
//        $orderDetail = $orderDetail->findByOrderIdProduct(24);
//        $detailArrId=[];
//        $detailArrCount=[];
//        foreach($orderDetail as $k=>$v){
//            $detailArrId[$k]=$v['productId'];
//            $productSelect = $product->findByProductId($v['productId']);
//            $productStock = $productSelect->productStock;
//            $detailArrCount = $productStock-$v['productCount'];
//            $product->UpdateByStock($v['productId'],$detailArrCount);
//            $detailArrCount[$k]=$v['productCount'];
//        }
//
//        foreach($orderDetail as $k=>$v){
//            $detailArrId[$k]=$v['productId'];
//            $detailArrCount[$k]=$v['productCount'];
//        }
//        $productSelect = $product->findIdSelectStock($detailArrId);
//        $productStock =[];
//        foreach($productSelect as $k=>$v){
//            $productStock[$k] = $v['productStock']-$detailArrCount[$k];
//        }
//        print_r($detailArrId);
//        print_r($detailArrCount);
//        print_r($productStock);

//        $detailArrId = (implode(',',$detailArrId));
//        $productStock = (implode(',',$productStock));
//        $productUpdate = $product->findByIdUpdateStock($detailArrId,$productStock);

//    }

    //生成订单页面
    public function actionOrderpayment()
    {
        $orderId  = Yii::$app->request->get("id");
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        if(!$orderId){
            return $this->redirect(FVariable::$home_view);
        }
        $order = new Order();
        $orderNo = $order->findOrderId($orderId,$userId,GlobalArray::$orderStateConstantArray['waitPay']);
        if($orderNo){
            return $this->render(FVariable::$userOrderpayment_view,['orderNo'=>$orderNo]);
        }else{
            return $this->redirect(FVariable::$home_view);
        }

    }

    //我的购物车--支付成功
//    public function actionPaysuccess()
//    {
//        return $this->render(FVariable::$userPaysuccess_view);
//    }

    //我的购物车--支付失败
//    public function actionPayfail()
//    {
//        return $this->render(FVariable::$userPayfail_view);
//    }

    //我的订单详情--待支付
    public function actionOrderpay()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderNo = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($orderNo);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $address = new UserAddress();
        $orderDetail = new OrderDetail();
        $addressList = $address->findByAddressIdAll($details->addressId);
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);
        return $this->render(FVariable::$userOrderpay_view,['details'=>$details,'addressList'=>$addressList,'orderDetailList'=>$orderDetailList]);
    }

    //我的订单详情--待发货
    public function actionOrderwaitdel()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderNo = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($orderNo);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $address = new UserAddress();
        $orderDetail = new OrderDetail();
        $addressList = $address->findByAddressIdAll($details->addressId);
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);
        return $this->render(FVariable::$userOrderwaitdel_view,['details'=>$details,'addressList'=>$addressList,'orderDetailList'=>$orderDetailList]);
    }

    //我的订单详情--待收货
    public function actionOrderdelivery()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderNo = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($orderNo);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $address = new UserAddress();
        $orderDetail = new OrderDetail();
        $addressList = $address->findByAddressIdAll($details->addressId);
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);

        $OrderExpressInfo = new OrderExpressInfo();
        $OrderExpressInfo = $OrderExpressInfo->findOrderExpress($details->id);
        if(!$OrderExpressInfo){
            return $this->redirect(FVariable::$error404_view);
        }
        return $this->render(FVariable::$userOrderdelivery_view,['details'=>$details,'addressList'=>$addressList,'orderDetailList'=>$orderDetailList,'OrderExpressInfo'=>$OrderExpressInfo]);
    }

    //我的订单--确认收货
    public function actionHasdelivery()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderId = Yii::$app->request->post('orderId');
        $order = new Order();
        $orderUpdate = $order->findByHasDelivery($orderId,$userId);
        JsonParser::GenerateJsonResult('_0000','确认收货成功！');
        exit;
    }

    //我的订单详情--待评价
    public function actionOrderfinish()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderNo = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($orderNo);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $address = new UserAddress();
        $orderDetail = new OrderDetail();
        $addressList = $address->findByAddressIdAll($details->addressId);
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);

        $OrderExpressInfo = new OrderExpressInfo();
        $OrderExpressInfo = $OrderExpressInfo->findOrderExpress($details->id);
        if(!$OrderExpressInfo){
            return $this->redirect(FVariable::$error404_view);
        }
        return $this->render(FVariable::$userOrderfinish_view,['details'=>$details,'addressList'=>$addressList,'orderDetailList'=>$orderDetailList,'OrderExpressInfo'=>$OrderExpressInfo]);
    }

    //我的订单详情--已完成
    public function actionOrderfinished()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderNo = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($orderNo);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $address = new UserAddress();
        $orderDetail = new OrderDetail();
        $addressList = $address->findByAddressIdAll($details->addressId);
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);

        $OrderExpressInfo = new OrderExpressInfo();
        $OrderExpressInfo = $OrderExpressInfo->findOrderExpress($details->id);
        if(!$OrderExpressInfo){
            return $this->redirect(FVariable::$error404_view);
        }
        return $this->render(FVariable::$userOrderfinished_view,['details'=>$details,'addressList'=>$addressList,'orderDetailList'=>$orderDetailList,'OrderExpressInfo'=>$OrderExpressInfo]);
    }

    //我的订单详情--已取消
    public function actionOrdercancel()
    {
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        $orderNo = Yii::$app->request->get('id');
        $order = new Order();
        $details = $order->findByOrderReturn($orderNo);
        if(!$details){
            return $this->redirect(FVariable::$error404_view);
        }
        $address = new UserAddress();
        $orderDetail = new OrderDetail();
        $addressList = $address->findByAddressIdAll($details->addressId);
        $orderDetailList = $orderDetail->findByIdOrderReturnDetail($details->id);

        return $this->render(FVariable::$userOrdercancel_view,['details'=>$details,'addressList'=>$addressList,'orderDetailList'=>$orderDetailList]);
    }

    //错误页面
    public function actionError()
    {
        return $this->render(FVariable::$error404_view);
    }

    //购物车返回页面
    public function actionShoppingempty()
    {
        return $this->render(FVariable::$shoppingempty_view);
    }

    //个人中心之订单支付
    public function actionUserpayment()
    {
        $orderId  = Yii::$app->request->get("id");
        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
        if(!$userId){
            return $this->redirect(FVariable::$siteLogin_view);
        }
        if(!$orderId){
            return $this->redirect(FVariable::$home_view);
        }
        $order = new Order();
        $orderNo = $order->findOrderId($orderId,$userId,GlobalArray::$orderStateConstantArray['waitPay']);
        if($orderNo){
            return $this->render(FVariable::$userOrderpayment_view,['orderNo'=>$orderNo]);
        }else{
            return $this->redirect(FVariable::$home_view);
        }

    }

    //测试yii2多表关联
//    public function actionTestyii()
//    {
//用户表user id
//订单表order id userId
//订单产品详情表orderdetail id orderId productId
//产品信息表product id
//
//用户表 和 订单表是 一对多的关系  一个用户有很多订单
//订单表 和 订单产品详情表是 一对多的关系 一个订单有很多产品（商品）
//订单产品详情表 和 产品信息表是 一对一关系 一个产品详情对应一个产品信息
//
//请问用yii2多表关联，怎样把这些表关联起来
//        $userId =  Yii::$app->session->get(FVariable::$session_userId_str);
//        if(!$userId){
//            return $this->redirect(FVariable::$siteLogin_view);
//        }
//      $user = new User();
//      $user = $user::findOne($userId);
//      $orders = $user->orders;
//        foreach($orders as $o){
//            $orderId[] = $o->id;
//        };
//        print_r($orderId);
//        exit;
//
//      print_r($orders);
//        exit;
//
//         $data = (new Query())
//             ->select('a.nickName,b.orderNo')
//             ->from('mp_user a')
//             ->leftJoin('mp_order b','a.id=b.userId')
//             ->where(array('a.id'=>36))
//             ->all();
//        print_r($data);
//        exit;.
//    }

}

