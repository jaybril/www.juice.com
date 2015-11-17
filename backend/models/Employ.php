<?php
namespace backend\models;
use common\widgets\Variable;
use yii;
use yii\db\ActiveRecord;
use backend\models\EmployForm;
class Employ extends  ActiveRecord{

    public function addEmploy($department,$employName,$address,$employCode,$group,$count,$money,$type,$category,$description,$sendEmail,$status){
        $model=new Employ();
        $model->department=$department;
        $model->employName=$employName;
        $model->address=$address;
        $model->employCode=$employCode;
        $model->group=$group;
        $model->count=$count;
        $model->money=$money;
        $model->type=$type;
        $model->category=$category;
        $model->description=$description;
        $model->sendEmail=$sendEmail;
        $model->status=$status;
        $model->publishTime=date('Y-m-d H:i:s',time());
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
        if($model->save()){
            return true;
        }
        return false;
    }
    public function updateEmploy($id,$department,$employName,$address,$employCode,$group,$count,$money,$type,$category,$description,$sendEmail,$status){
        $model=Employ::findOne($id);
        if(!$model){
            return false;
        }
        $model->department=$department;
        $model->employName=$employName;
        $model->address=$address;
        $model->employCode=$employCode;
        $model->group=$group;
        $model->count=$count;
        $model->money=$money;
        $model->type=$type;
        $model->category=$category;
        $model->description=$description;
        $model->sendEmail=$sendEmail;
        $model->status=$status;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
        if($model->save()){
            return true;
        }
        return false;
    }
    /*
        * 删除活动
        */
    public function deleteEmploy($id){
        $model=Employ::findOne($id);
        if(!$model){
            return false;
        }
        if($model->delete()){
            return true;
        }
        return false;
    }
}