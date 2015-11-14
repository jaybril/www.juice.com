<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/18
 * Time: 11:07
 */
    namespace backend\controllers;
    use backend\models\Express;
    use backend\models\OrderExpressInfo;
    use backend\models\OrderForm;
    use backend\models\UserAddress;
    use Yii;
    use backend\models\Order;
    use backend\models\OrderDeliverForm;
    use yii\web\Controller;
    use common\widgets\Tool;
    use common\Widgets\Variable;
    use backend\models\AdminUser;
    use yii\data\Pagination;
class OrdermangerController extends Controller{
    /*
     * 订单管理页面
     */
    public function actionIndex()
    {
        $user = new AdminUser();
        if (!$user->checkUserIsLogin()) {
            $this->redirect(Variable::$home_url);
            return;
        }

        $query = Order::find();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('orderTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$orderManger_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    /*
     * 编辑订单页面
     */
    public function actionEditorder(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new OrderForm();
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$orderManger_url);
            return;
        }
        $orderModel = Order::findOne($id);

        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Product())->updateProduct($id,$form->productName,$form->productBrief,$form->productStatus,$form->productPrice);
            if($isSuccess){
                $form->addError('','资料更新成功');
            }
            else{
                $form->addError('','资料更新失败');
            }
        }
        $form->orderNo=$orderModel->orderNo;
        $form->orderMoney=$orderModel->orderMoney;
        $form->orderStatus=$orderModel->orderStatus;
        $form->orderPayMethod=$orderModel->orderPayMethod;
        $form->refundhandleDescription=$orderModel->refundhandleDescription;
        return $this->render(Variable::$editOrder_view,['model'=>$form,'orderModel'=>$orderModel]);
    }
    /*
     * 订单发货页面
     */
    public function actionDeliverorder(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new OrderDeliverForm();
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$orderManger_url);
            return;
        }
        $orderModel = Order::findOne($id);
        $orderExpressInfoModel=(new OrderExpressInfo())->findOne(['orderId'=>$id]);
        $userAddressModel=(new UserAddress())->findOne(['id'=>$orderModel->addressId]);
        $orderStyleModel=(new Express())->find()->all();

        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new OrderExpressInfo())->deliver($id,$form->expressNo,$form->expressStyle,$form->expressChart);
            if($isSuccess){
                $form->addError('','订单发货成功');
            }
            else{
                $form->addError('','订单发货失败');
            }
        }
        $form->orderNo=$orderModel->orderNo;
        $form->orderMoney=$orderModel->orderMoney;
        $form->orderStatus=$orderModel->orderStatus;
        $form->orderPayMethod=$orderModel->orderPayMethod;
        $form->orderStatus=$orderModel->orderStatus;
        if($orderExpressInfoModel) {
            $form->expressNo = $orderExpressInfoModel->expressNo;
            $form->expressStyle=$orderExpressInfoModel->expressStyle;
        }


        return $this->render(Variable::$deliverOrder_view,['model'=>$form,'orderModel'=>$orderModel,'orderExpressInfoModel'=>$orderExpressInfoModel,'orderStyleModel'=>$orderStyleModel,'userAddressModel'=>$userAddressModel]);
    }
    /*
         *七天自动收货
         * 每天对订单状态为：2-已发货 并且  的订单进行查询
         * 如果快递进度表对应订单status=4 说明已经到货
         * 如果到货时间超过7天，则自动确认订单已经收货
         */
    public function actionF(){
        set_time_limit(0);
        $model=new Order();
        $list=$model->find()->where(['orderStatus'=>2])->all();//查出所有已发货的订单
        $res=[];
        foreach($list as $k=>$v){
            $status=$v->orderExpressInfo->status;
            $updateTime=null;
            if(isset($v->orderExpressInfo->updateTime) && !empty($v->orderExpressInfo->updateTime)){
                $updateTime=$v->orderExpressInfo->updateTime;
            }
            $updateTime=strtotime($updateTime);
            if($updateTime){
                $interval=strtotime(date('Y-m-d H:i:s',time()))-$updateTime;
                $day=(($interval)/86400); //60s*60min*24h
                if($day>7){
                    array_push($res,[
                        'id'=>$v->id,
                        'orderStatus'=>3
                    ]);
                }
            }
        }
        $model->updateOrderStatusByBatch($res);//系统自动确认收货（批量）
    }
}