<?php
namespace frontend\models;
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

}