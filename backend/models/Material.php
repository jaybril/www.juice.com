<?php
    namespace backend\models;
    use yii\db\ActiveRecord;
    use Yii;
    use common\widgets\Variable;

    class Material extends  ActiveRecord{
        /*
     * 获得后台用户的名称
     */
        public function  getAdminUser(){
            return $this->hasOne(AdminUser::className(),['id'=>'addUser']);
        }
        /*
         *添加一个产品图片
         */
        public function addOneImage($type=0,$materialId,$useId,$address,$isDefault=0,$isShow=0,$width=200,$height=200,$sort,$pcUrl,$wapUrl){
            $model=new Material();
            $model->type=$type;
            $model->materialId=$materialId;
            $model->useId=$useId;
            $model->address=$address;
            $model->isDefault=$isDefault;
            $model->isShow=$isShow;
            $model->width=$width;
            $model->height=$height;
            $model->height=$height;
            $model->sort=$sort;
            $model->pcUrl=$pcUrl;
            $model->wapUrl=$wapUrl;
            $model->addTime=date('Y-m-d H:i:s',time());
            $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
            if($model->save()>0){
                return true;
            }
            return false;
        }
        /*
        *删除
        */
        public function deleteMateria($id){
            $model=Material::findOne($id);
            if(!$model){
                return false;
            }
            if($model->delete()){
                return true;
            }
            return false;
        }
        /*
         *update 素材
         */
        public function updateMaterial($id,$materialId,$address,$isShow,$sort,$pcUrl,$wapUrl=''){
            $model=Material::findOne($id);
            if(!$model){
                return false;
            }
            $model->materialId=$materialId;
            $model->address=$address;
//            $model->isDefault=$isDefault;
            $model->isShow=$isShow;
            $model->sort=$sort;
            $model->pcUrl = $pcUrl;
            if($wapUrl) {
                $model->wapUrl = $wapUrl;
            }
            $model->addTime=date('Y-m-d H:i:s',time());
            $model->addUser=Yii::$app->session->get(Variable::$session_userId_str);
            if($model->save()){
                return true;
            }
            return false;
        }
    }