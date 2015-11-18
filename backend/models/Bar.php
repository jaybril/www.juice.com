<?php
namespace backend\models;
use common\widgets\Variable;
use yii;
use yii\db\ActiveRecord;
class Bar extends  ActiveRecord{
    /*
       * 获得后台用户的名称
       */
    public function  getAdminUser(){
        return $this->hasOne(AdminUser::className(),['id'=>'addUser']);
    }
    /*
        *删除
        */
    public function deleteBar($id){
        $model=Bar::find()->where(['id'=>$id])->andWhere(['<>','isTop','1'])->one();
        if(!$model){
            return false;
        }
        $son=Bar::find()->where(['parentBar'=>$id])->all();
//        if($model->delete())
        if($model->delete()){
            return true;
        }
        return false;
    }

}