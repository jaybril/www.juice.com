<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/29
 * Time: 14:22
 */

namespace frontend\models;
use \yii\db\ActiveRecord;
use common\widgets;
use common\widgets\GlobalArray;
use common\widgets\Variable;

class Order extends  ActiveRecord
{
    /*
 * 根据订单状态---待支付
 */
    public function findByStatus($orderId,$userId){
        $OrderStaus = Order::find()->where(array('orderStatus' => $orderId,'userId'=>$userId))->orderBy(['orderTime'=>SORT_DESC])->all();
        if (!$OrderStaus) {
            return false;
        }
        return $OrderStaus;
    }

    /*
* 根据订单id---取消订单
*/
    public function findByCancel($orderId,$userId){
        $OrderCancel = Order::find()->where(array('id' => $orderId,'userId'=>$userId))->one();
       if($OrderCancel){
           $OrderCancel->orderStatus=widgets\GlobalArray::$orderStateConstantArray['hasCancel'];
           $OrderCancel->update();
       }

    }

    /*
* 根据订单id---确认收货
*/
    public function findByHasDelivery($orderId,$userId){
        $OrderHasDelivery = Order::find()->where(array('id' => $orderId,'userId'=>$userId))->one();
        date_default_timezone_set('Asia/Shanghai');
        $confirmTime = date('Y-m-d H:i:s',time());
        if($OrderHasDelivery){
            $OrderHasDelivery->orderStatus=widgets\GlobalArray::$orderStateConstantArray['waitEvaluate'];
            $OrderHasDelivery->isConfirm= 1;
            $OrderHasDelivery->confirmTime= $confirmTime;
            $OrderHasDelivery->update();
        }

    }

    /*
* 根据订单id---待评价
*/
    public function findByConfirm($orderId,$userId){
        $OrderConfirm = Order::find()->where(array('id' => $orderId,'userId'=>$userId))->one();
        $OrderConfirm->orderStatus=widgets\GlobalArray::$orderStateConstantArray['completed'];
        $OrderConfirm->update();
    }

    /*
* 根据订单id申请退货订单列表
*/
    public function findByOrderReturn($orderNo){
        $OrderReturn = Order::find()->where(array('orderNo' => $orderNo))->one();
        if (!$OrderReturn) {
           return false;
        }
        return $OrderReturn;
    }

    /*
* 根据订单id申请退货填写原因
*/
    public function findByOrderReturnEdit($returnId,$userId,$returnStatus,$returnModel){
        date_default_timezone_set('Asia/Shanghai');
        $refundApplyTime = date('Y-m-d H:i:s',time());
        $ReturnEdit = Order::find()->where(array('id' => $returnId,'userId'=>$userId,'orderStatus'=>$returnStatus))->one();
        $ReturnEdit->isRefund = widgets\GlobalArray::$orderIsRefundArray['Application'];
        $ReturnEdit->refundStatus = widgets\GlobalArray::$orderRefundStatusArray['0'];
        $ReturnEdit->refundReason = $returnModel->refundReason;
        $ReturnEdit->refundApplyTime = $refundApplyTime;
        $ReturnEdit->update();
    }

    //生成订单
    public function insertOrder($orderNo,$orderMoney,$orderStatus,$orderPayMethod,$comeFrom,$userId,$addressId)
    {
        date_default_timezone_set('Asia/Shanghai');
        $orderTime = date('Y-m-d H:i:s',time());
        $order = new Order();
        $order->orderNo = $orderNo;
        $order->orderMoney = $orderMoney;
        $order->orderStatus = $orderStatus;
        $order->orderTime = $orderTime;
        $order->orderPayMethod = $orderPayMethod;
        $order->comeFrom = $comeFrom;
        $order->userId = $userId;
        $order->addressId = $addressId;
        $order->insert();
    }

    /*
     *根据订单号和订单状态更新订单信息
     * @pram $orderNo  订单号
     * @pram $orderStatus 订单状态（不是订单当前状态  是要更新到的状态）
     *
     * return
     * -true 更细成功
     * -false 更新失败
     *
     * 订单状态的其它细节  -TODO
     */
    public function updateOrderByOrderNoAndStatus($orderNo,$orderStatus)
    {
        date_default_timezone_set('Asia/Shanghai');
        $orderPayTime = date('Y-m-d H:i:s',time());
        $model = Order::findOne(['orderNo'=>$orderNo]);
        if(!$model){
            return false;
        }
        if(!intval($orderStatus)){
            return false;
        }
        switch($orderStatus){
            case GlobalArray::$orderStateConstantArray['waitDelivery']://支付完成 等待发货
                $model->orderStatus = $orderStatus;
                $model->orderPayTime = $orderPayTime;
                break;
            case GlobalArray::$orderStateConstantArray['hasDelivery']://已经发货 等待收货
                $model->orderStatus = $orderStatus;
                $model->isConfirm = 1;
                $model->confirmTime = $orderPayTime;
                break;
            case GlobalArray::$orderStateConstantArray['waitEvaluate']://等待评价
                $model->orderStatus = $orderStatus;
                break;
            case GlobalArray::$orderStateConstantArray['completed']://订单完成
                $model->orderStatus = $orderStatus;
                break;
            case GlobalArray::$orderStateConstantArray['hasCancel']://交易关闭
                $model->orderStatus = $orderStatus;
                break;
        }
        if($model->update()){
            return true;
        };
        return false;
    }

    // 获取订单所属用户
    public function getUser()
    {
        //同样第一个参数指定关联的子表模型类名
        //
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    // 获取订单中所有产品详情
    public function getProductdetail()
    {
        //同样第一个参数指定关联的子表模型类名
        //
        return $this->hasMany(OrderDetail::className(), ['orderId' => 'id']);
    }

    // 根据订单id和用户id查询信息
    public function findOrderId($id,$userId,$orderStatus)
    {
        $OrderAll = Order::find()->where(array('id' => $id,'userId'=>$userId,'orderStatus'=>$orderStatus))->one();
        if (!$OrderAll) {
            return false;
        }
        return $OrderAll;
    }
}
?>