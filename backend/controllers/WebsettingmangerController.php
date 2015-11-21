<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/18
 * Time: 14:51
 */
namespace backend\controllers;
use backend\models\AdminUserForm;
use backend\models\Area;
use backend\models\Express;
use backend\models\ExpressForm;
use backend\models\Join;
use backend\models\JoinForm;
use backend\models\Material;
use backend\models\SettingForm;
use backend\models\WebSiteConfig;
use yii\bootstrap\Alert;
use yii\web\Controller;
use yii\data\Pagination;
use backend\models\AdminUser;
use common\widgets\Tool;
use common\widgets\JsonParser;
use common\widgets\Variable;
use Yii;


class WebsettingmangerController extends Controller{
    public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/uploads/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ]
        ];
    }
//    public function actions()
//    {
//        return [
//            'upload' => [
//                'class' => 'kucha\ueditor\UEditorAction',
//            ]
//        ];
//    }
    /*
  *网站参数设置
  */
    public function actionIndex(){
//        error_reporting(0);

        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $form=new SettingForm();
        $model=new WebSiteConfig();
        $settingModel=WebSiteConfig::find()->one();

        $req=Yii::$app->request;//创建一个请求对象
        //修改
        if($form->load($req->post()) && $form->validate()){
//            echo '--';
//            print_r($form);
//            echo '--';
//            exit;
            if($model->updateSetting($form->name,$form->registration,$form->website,$form->logo,$form->copyright,$form->email,$form->background,$form->phone,$form->addr)){
                Yii::$app->session->setFlash('success','配置成功');
                $this->redirect(Variable::$setting_url);
                return;

            }
            Yii::$app->session->setFlash('error','配置更新失败，请刷新重试');
        }
        $form->email=$settingModel->email;
        $form->name=$settingModel->name;
        $form->registration=$settingModel->registration;
        $form->website=$settingModel->website;
        $form->logo=$settingModel->logo;
        $form->copyright=$settingModel->copyright;
        $form->background=$settingModel->background;
        $form->phone=$settingModel->phone;
        $form->addr=$settingModel->addr;

//        print_r($settingModel);
        return $this->render(Variable::$setting_view,['model'=>$form]);
    }
    /*
     *系统用户管理
     */
    public function actionAdminusermanger(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = AdminUser::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$adminUserManger_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
    /*
     *系统用户管理
     */
    public function actionJoinlist(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Join::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$joinList_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
    /*
* 修改加盟状态
*/
    public function actionEditjoin(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }

        $req=Yii::$app->request;//创建一个请求对象
        $form = new JoinForm();
        $form->setScenario('update');
        $joinModel=new Join();

        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$joinList_url);
            return;
        }

        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = $joinModel->updateJoinStatus($id,$form->status);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'更新失败，刷新重试');
            }
        }
        $joinModel = Join::findOne($id);
        $form->username=$joinModel->username;
        $form->mobile=$joinModel->mobile;
        $form->company=$joinModel->company;
        $form->industry=$joinModel->industry;
        $form->email=$joinModel->email;
        $form->nature=$joinModel->nature;
        $form->inCity=$joinModel->inCity;
        $form->area=$joinModel->area;
        $form->inMoney=$joinModel->inMoney;
        $form->inCount=$joinModel->inCount;
        $form->inPlace=$joinModel->inPlace;
        $form->inSource=$joinModel->inSource;
        $form->hardwareSource=$joinModel->hardwareSource;
        $form->experience=$joinModel->experience;
        $form->status=$joinModel->status;
        $form->applyTime=$joinModel->applyTime;
        return $this->render(Variable::$editJoin_view,['model'=>$form,'joinModel'=>$joinModel,]);
    }
    /*
    * 添加后台用户
    */
    public function actionAddadminuser(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new AdminUserForm();

        //添加
        $form->setScenario('create');
        if($form->load($req->post()) && $form->validate()){
            if($user->addAdminUser($form->username,$form->password,$form->mobile,$form->role,$form->status)){
                Yii::$app->session->setFlash(Variable::$flash_success,'添加成功');
                $this->redirect(Variable::$adminUserManger_url);
                return;
            }{
                Yii::$app->session->setFlash(Variable::$flash_error,'添加失败，请刷新重试');
            }

        }
        return $this->render(Variable::$addAdminUser_view,['model'=>$form]);
    }
    /*
   * 修改用户信息页面
   */
    public function actionEditadminuser(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }

        $req=Yii::$app->request;//创建一个请求对象
        $form = new AdminUserForm();
        $form->setScenario('update');
        $adminUserModel=new AdminUser();

        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$adminUserManger_url);
            return;
        }

        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = $adminUserModel->updateAdminUser($id,$form->password,$form->mobile,$form->role,$form->status);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_success,'更新失败，');
            }
        }
        $adminUserModel = $adminUserModel->findUserByUserId($id);
        $form->username=$adminUserModel->username;
        $form->password=$adminUserModel->password;
        $form->role=$adminUserModel->role;
        $form->mobile=$adminUserModel->mobile;
        $form->status=$adminUserModel->status;
        $form->role=$adminUserModel->role;
        return $this->render(Variable::$editAdminUser_view,['model'=>$form,'adminUserModel'=>$adminUserModel,]);
    }
    /*
    *删除用户
    */
    public function actionDeleteadminuser(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isDelete=(new AdminUser())->deleteAdminUser($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','删除失败，请刷新重试');
        exit;
    }

    public function actionVideo(){
        $video=Material::findOne(['materialId'=>Variable::$materialId_productVideo]);

        return $this->render(Variable::$video_view,['video'=>$video]);
    }
    public function actionUploadvideo(){
        $targetFolder = 'video/';
        if (!empty($_FILES)) {
            $fileName=$_FILES['file']['name'];
            $arr=explode('.',$fileName);
            $ext='.'.$arr[count($arr)-1];
            $tep=$_FILES['file']['tmp_name'];
            $path=pathinfo($tep);
            $path=$path['basename'].$ext;
                if(move_uploaded_file($tep,$targetFolder.$path)){
                    $model=Material::find()->where(['materialId'=>Variable::$materialId_productVideo])->one();
                    if($model){
                        $model->address='/'.$targetFolder.$path;
                        $model->save();
                    }
                    else{
                        $model=new Material();
                        $model->type=2;
                        $model->materialId=Variable::$materialId_productVideo;
                        $model->address='/'.$targetFolder.$path;
                        $model->save();
                    }
                }
                else{
                    echo 'fail';
                    exit;
                }
        }
    }

    public function actionUploadnetvideo(){
        $videoLink=trim(Yii::$app->request->post('videoLink'));
        if(!isset($videoLink) || empty($videoLink)){
            JsonParser::GenerateJsonResult('_0001','不合法的视频链接');
            exit;
        }
        $ss='video/';
        if(!strpos($videoLink,$ss)){

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $videoLink);
        //不下载
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        //设置超时
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($http_code == 200) {
            $model=Material::find()->where(['materialId'=>Variable::$materialId_productVideo])->one();
            if($model){
                $model->address=$videoLink;
                if($model->save()){
                    JsonParser::GenerateJsonResult('_0000','上传成功');
                    exit;
                };
            }
            else{
                $model=new Material();
                $model->type=2;
                $model->materialId=Variable::$materialId_productVideo;
                $model->address=$videoLink;
                if($model->save()){
                    JsonParser::GenerateJsonResult('_0000','上传成功');
                    exit;
                }
            }

        }
        JsonParser::GenerateJsonResult('_0001','不合法的视频链接');
        exit;
        }
        JsonParser::GenerateJsonResult('_0000','上传成功');
        exit;

    }

}