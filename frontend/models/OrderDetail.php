<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/29
 * Time: 15:07
 */
namespace frontend\models;
use \yii\db\ActiveRecord;
use common\widgets;
use yii\db\Query;

class OrderDetail extends  ActiveRecord
{
    // 获取详情中的评论
    public function getOrderDetailComment()
    {
        return $this->hasOne(Comment::className(), ['typeId' => 'id']);
    }

    /*
 * 根据订单状态---待支付
 */
    public function findByOrderDetail($orderId){
        $OrderDetail = OrderDetail::find()->where(array('orderId' => $orderId))->asArray()->all();
        if (!$OrderDetail) {
            return false;
        }
        return $OrderDetail;
    }

    /*
* 根据订单id查询产品详情
*/
    public function findByOrderIdProduct($orderId){
        $OrderDetail = OrderDetail::find()->where(array('orderId' => $orderId))->asArray()->orderBy(['productId'=>SORT_ASC])->all();
        if (!$OrderDetail) {
            return false;
        }
        return $OrderDetail;
    }

    /*
* 根据订单状态---待支付
*/
    public function findByIsEvaluate($orderId){
        $IsEvaluateArray = OrderDetail::find()->select(['isEvaluate'])->where(array('orderId' => $orderId))->asArray()->all();
        if (!$IsEvaluateArray) {
            return false;
        }
        return $IsEvaluateArray;
    }

    // 获取产品属性
    public function getProduct()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }
    // 获取订单
    public function getOrder()
    {
        //同样第一个参数指定关联的子表模型类名
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }

    // 根据产品id和产品是否已评价查询所有评价
    public function findProductId($productId,$isEvaluate)
    {
        $productId =  OrderDetail::find()->where(array('productId' => $productId,'isEvaluate'=>$isEvaluate))->all();
        if (!$productId) {
            return false;
        }
        return $productId;
    }

    // 更新订单详情评价状态
    public function UpdateOrderDetail($Id)
    {
        $OrderDetail = OrderDetail::findOne($Id);
        $OrderDetail->isEvaluate = 1;
        $OrderDetail->update();
    }

    // 根据评价typeid查询订单详情
    public function findIdOrderDetail($id)
    {
        $OrderDetailLook =  OrderDetail::find()->where(array('id' => $id))->one();
        if (!$OrderDetailLook) {
            return false;
        }
        return $OrderDetailLook;
    }

    // 根据评价typeid查询订单详情是否已经评价
    public function findIdOrderDetailIsEvaluate($id)
    {
        $OrderDetailLook =  OrderDetail::find()->where(array('id' => $id,'isEvaluate'=>1))->one();
        if (!$OrderDetailLook) {
            return false;
        }
        return $OrderDetailLook;
    }

    // 订单详情插进数据
    public function insertOrderDetail($detailArr)
    {
        $OrderDetail = \Yii::$app->db;
        $OrderDetail = $OrderDetail->createCommand()->batchInsert('mp_order_detail',['orderId','productId','productCount','productPrice'],$detailArr)->execute();
    }

    //根据订单id查询订单产品详情和产品的信息
    public function findByIdOrderReturnDetail($orderId)
    {
//        $OrderReturnDetail = Order::findBySql("select od.id,od.productId,od.productCount,od.productPrice,od.isEvaluate,op.productName,op.productLogo,op.productPrice 'price' from mp_order_detail od LEFT JOIN mp_product op ON od.productId = op.id where od.orderId =".$orderId)->asArray()->all();
        $OrderReturnDetail = (new Query())
            ->select("od.id,od.productId,od.productCount,od.productPrice,od.isEvaluate,op.productName,op.productLogo,op.productPrice price,op.origin,op.artsId")
            ->from("mp_order_detail od")
            ->leftJoin("mp_product op","od.productId = op.id")
            ->where(array('od.orderId'=>$orderId))
            ->all();
        if (!$OrderReturnDetail) {
            return false;
        }
        return $OrderReturnDetail;
    }
}
?>