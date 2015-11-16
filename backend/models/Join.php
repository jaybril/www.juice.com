<?php
namespace backend\models;
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
    public  function  addOneJoin($name,$code,$phone,$url,$status,$inPostage,$outPostage){
        $model=new Express();
        $model->name=$name;
        $model->phone=$phone;
        $model->code=$code;
        $model->url=$url;
        $model->status=$status;
        $model->inPostage=$inPostage;
        $model->outPostage=$outPostage;
        $model->applyTime=date('Y-m-d H:i:s',time());;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
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