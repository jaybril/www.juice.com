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
use backend\models\SettingForm;
use backend\models\WebSiteConfig;
use yii\web\Controller;
use yii\data\Pagination;
use backend\models\AdminUser;
use common\widgets\Tool;
use common\widgets\JsonParser;
use common\widgets\Variable;
use Yii;
use yii2mod\alert\Alert;

class WebsettingmangerController extends Controller{
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
     *网站参数设置
     */
    public function actionIndex(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $model=new SettingForm();
        $settingModel=WebSiteConfig::find()->one();
        print_r($settingModel);
        return $this->render(Variable::$setting_view,['model'=>$model]);
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
                $this->redirect(Variable::$adminUserManger_url);
                return;
            }
            $form->addError('','添加失败，请检查数据');
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
                $form->addError('','资料更新成功');
            }
            else{
                $form->addError('','资料更新失败');
            }
        }
        $adminUserModel = $adminUserModel->findUserByUserId($id);
        $form->username=$adminUserModel->username;
        $form->password=$adminUserModel->password;
        $form->role=$adminUserModel->role;
        $form->mobile=$adminUserModel->mobile;
        $form->status=$adminUserModel->status;
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
}