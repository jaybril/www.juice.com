<?php
namespace frontend\models;
use common\widgets\Variable;
use yii;
use yii\db\ActiveRecord;
class Join extends  ActiveRecord{
    /*
     * 通过id查找
     */
    public function findById($id){
        $model = Join::find()->where(array('id' => $id))->one();
        if ($model) {
            return new static($model);
        }
        return null;
    }
    /*
  * 添加一个申请
  */
    public  function  addOneJoin($username,$mobile,$company,$industry,$email,$nature,$inCity,$area,$inMoney,$inCount,$inPlace,$hardwareSource,$experience,$inSource){
        $model=new Join();
        $model->username=$username;
        $model->mobile=$mobile;
        $model->company=$company;
        $model->industry=$industry;
        $model->email=$email;
        $model->nature=$nature;
        $model->inCity=$inCity;
        $model->area=$area;
        $model->inMoney=$inMoney;
        $model->inPlace=$inPlace;
        $model->inCount=$inCount;
        $model->hardwareSource=$hardwareSource;
        $model->experience=$experience;
        $model->inSource=$inSource;
        $model->status=0;

        $model->applyTime=date('Y-m-d H:i:s',time());;
        $model->addTime=date('Y-m-d H:i:s',time());
//        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
        if($model->save()){
            return true;
        }
        return false;
    }
    /*
    * 更新申请状态
    */
    public function updateJoinStatus($id,$status){
        $model = Join::findOne($id);
        if(!$model){
            return false;
        }
        $model->status=$status;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
        if($model->save()){
            return true;
        }
        return false;
    }
}