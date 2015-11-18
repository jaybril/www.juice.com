<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/14
 * Time: 20:24
 */
    namespace backend\models;
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
       * 获得用户的名称
        */
        public function  getArticleCat(){
            return $this->hasOne(ArticleCategory::className(),['id'=>'categoryId']);
        }
        /*
        * 添加文章
        */
        public  function  addAerticle($title,$keywords,$categoryId,$content,$status,$isTop,$description,$pic,$isIndexShow){
            $model=new Article();
            $model->title=$title;
            $model->keywords=$keywords;
            $model->categoryId=$categoryId;
            $model->content=$content;
            $model->status=$status;
            $model->isTop=$isTop;
            $model->description=$description;
            $model->pic=$pic;
            $model->source='0';
            $model->isIndexShow=$isIndexShow;
            $model->author=Yii::$app->session->get(Variable::$session_userId_str);
            $model->addTime=date('Y-m-d H:i:s',time());
            $model->publishTime=date('Y-m-d H:i:s',time());
            $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);


            if($model->save()){
                return true;
            }
            return false;
        }
        /*
       *删除
       */
        public function deleteArticle($id){
            $model=Article::findOne($id);
            if(!$model){
                return false;
            }
            if($model->delete()){
                return true;
            }
            return false;
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
        /*
         *更新文章一些
         *
         */
        public function updateArticleByService($id,$title,$useId,$keywords,$pic,$content){
            $model=Article::findOne($id);
            if(!$model){
                return false;
            }
            $model->content=$content;
            $model->title=$title;
            $model->useId=$useId;
            $model->keywords=$keywords;
            $model->pic=$pic;
            $model->content=$content;
            $model->addTime=date('Y-m-d H:i:s',time());
            $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
            if($model->save()){
                return true;
            }
            return false;

        }

    }