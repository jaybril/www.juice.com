<?php
namespace backend\models;
use yii\db\ActiveRecord;
use common\widgets\Variable;
class WebSiteConfig extends  ActiveRecord{
        /*
         * 更新商家信息
         */
    public function updateSetting($name,$registration,$website,$logo,$copyright,$email,$background,$phone,$addr){

        $model = WebSiteConfig::find()->one();
        if(!$model){
            $model=new WebSiteConfig();
        }
        $model->name=$name;
        $model->registration=$registration;
        $model->website=$website;
        $model->logo=$logo;
        $model->copyright=$copyright;
        $model->email=$email;
        $model->background=$background;
        $model->phone=$phone;
        $model->addr=$addr;
        $model->addTime=date('Y-m-d H:i:s',time());
        $model->addUser=\Yii::$app->session->get(Variable::$session_userId_str);
        if($model->save()){
            return true;
        }
        return false;
    }

 }
?>