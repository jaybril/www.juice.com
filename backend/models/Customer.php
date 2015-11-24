<?php
namespace backend\models;
use common\widgets\Variable;
use yii;
use yii\db\ActiveRecord;
class Customer extends  ActiveRecord{

    /*
        * 获得用户的名称
         */
    public function  getAdminUser(){
        return $this->hasOne(AdminUser::className(),['id'=>'addUser']);
    }
    /*
     *获取父级
     */
    public function  getParent(){
        return $this->hasOne(Customer::className(),['id'=>'parentId']);
    }
    /*
     *增加一个cus
     *
     */
    public function addCus($name,$sort,$level,$parentId,$blogo,$clogo,$img1='',$img2='',$img3='',$img4='',$img5=''){
        $model=new Customer();
        $model->name=$name;
        $model->sort=$sort;
        $model->level=$level;
        $model->parentId=$parentId;
        $model->blogo=$blogo;
        $model->clogo=$clogo;
        $model->img1=$img1;
        $model->img2=$img2;
        $model->img3=$img3;
        $model->img4=$img4;
        $model->img5=$img5;
        $model->count=0;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);

        if($model->save()){
            return true;
        }
        return false;
    }
    /*
    *增加一个cus
    *
    */
    public function updateCus($id,$name,$sort,$level,$blogo,$clogo,$img1='',$img2='',$img3='',$img4='',$img5=''){
        $model=Customer::findOne($id);
        if(!$model){
            return false;
        }
        if($name){
            $model->name=$name;
        }
        if($sort){
            $model->sort=$sort;
        }
        if($img1){
            $model->img1=$img1;
        }
        if($img2){
            $model->img2=$img2;
        }
        if($img3){
            $model->img3=$img3;
        }
        if($img4){
            $model->img4=$img4;
        }
        if($img5){
            $model->img5=$img5;
        }

        $model->blogo=$blogo;
        $model->clogo=$clogo;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
        if($model->save()){
            return true;
        }
        return false;
    }
    /*
        * 删除
        */
    public function deleteCus($id){
        $model=Customer::findOne($id);
        if(!$model){
            return false;
        }
        if($model->delete()){
            Customer::deleteAll(['parentId'=>$id]);
            return true;
        }
        return false;
    }

}