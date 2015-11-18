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
//        $model=Bar::find()->where(['id'=>$id])->andWhere(['<>','isTop','1'])->one();
        $model=Bar::find()->where(['id'=>$id])->one();
        if(!$model){
            return false;
        }
        //子级
        if($model->isTop==1){
            $parent=Bar::findOne(['id'=>$model->parentBar]);
            $parent->count=intval($parent->count)-1;
            $parent->save();
        }
//        $son=Bar::find()->where(['parentBar'=>$id])->all();
//        if($model->delete())
        if($model->delete()){
            return true;
        }
        return false;
    }
    /*
     *增加一个栏目
     *
     */
    public function addBar($name,$link,$isTop,$parentBar){
        $model=new Bar();
        $model->name=$name;
        $model->link=$link;
        $model->isTop=$isTop;
        $model->parentBar=$parentBar;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);

        if($model->save()){
            $parent=Bar::findOne(['id'=>$parentBar]);
            $parent->count=intval($parent->count+1);
            $parent->save();
            return true;
        }
        return false;
    }
    /*
   *增加一个栏目
   *
   */
    public function updateBar($id,$name,$link){
        $model=Bar::findOne($id);
        if(!$model){
            return false;
        }
        $model->name=$name;
        $model->link=$link;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);

        if($model->save()){
            return true;
        }
        return false;
    }

}