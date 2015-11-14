<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/22
 * Time: 9:39
 */
namespace backend\models;
use common\widgets\Variable;
use yii;
use yii\db\ActiveRecord;
class Area extends  ActiveRecord{
    /*
     * 获得省份列表
     */
    public function getProvinceList(){
        $provinceList = Area::find()->where(array('parentId' => '0'))->all();
        if ($provinceList) {
            return ($provinceList);
        }
        return null;
    }
    /*
    * 获得上一级列表
    */
    public function getPrev(){
        return $this->hasOne(Area::className(),['id'=>'parentId']) ;
    }
    /*
     * 根据省份id获得城市列表
     */
    public function getCityList($provinceId){
        if(!isset($provinceId) || empty($provinceId)){
            return null;
        }
        $cityList = Area::find()->where(array('parentId' => $provinceId))->asArray()->all();
        if ($cityList) {
            return ($cityList);
        }
        return null;
    }

}