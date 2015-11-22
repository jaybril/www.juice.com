<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/14
 * Time: 20:24
 */
    namespace frontend\models;
    use common\widgets\Variable;
    use yii;
    use yii\db\ActiveRecord;
    class Article extends  ActiveRecord{
        /*
        * 获得用户的名称
         */
        public function  getAdminUser(){
            return $this->hasOne(AdminUser::className(),['id'=>'author']);
        }

        /*
         * 更新文章内容
         */
        public function updateArticleContent($id,$content){
            $model=Article::findOne($id);
            if(!$model){
                return false;
            }
            $model->content=$content;
            $model->addTime=date('Y-m-d H:i:s',time());
            $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
            if($model->save()){
                return true;
            }
            return false;
        }
    }