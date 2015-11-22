<?php
namespace frontend\models;
use common\widgets\Variable;
use yii;
use yii\db\ActiveRecord;
class Bar extends  ActiveRecord{
    /*
        *获取父级
        */
    public function  getParent(){
        return $this->hasOne(Bar::className(),['id'=>'parentBar']);
    }
}