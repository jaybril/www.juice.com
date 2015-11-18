<?php
namespace backend\controllers;
use Yii;
use backend\models\AdminUser;
use backend\models\Employ;
use backend\models\EmployForm;
use common\widgets\Variable;
use yii\web\Controller;
use yii\data\Pagination;
use common\widgets\JsonParser;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;

class EmployController extends  Controller{
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '/path/to/temp/files'
            ]
        ];
    }

    public function actionIndex(){

        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Employ::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render(Variable::$employIndex_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionAddemploy(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new EmployForm();
        $employModel=new Employ();
        //添加
        $form->setScenario('create');

        if($form->load($req->post()) && $form->validate()){
            if($employModel->addEmploy($form->department,$form->employName,$form->address,$form->employCode,$form->group,$form->count,$form->money,$form->type,$form->category,$form->description,$form->sendEmail,$form->status)){
                Yii::$app->session->setFlash(Variable::$flash_success,'招聘信息添加成功');
                $this->redirect(Variable::$employIndex_url);
                return;
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'招聘信息添加失败，请重试');
            }

        }
        return $this->render(Variable::$addEmploy_view,['model'=>$form]);
    }
    /*
* 修改招聘页面
*/
    public function actionEditemploy(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new EmployForm();
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$employIndex_url);
            return;
        }
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Employ())->updateEmploy($id,$form->department,$form->employName,$form->address,$form->employCode,$form->group,$form->count,$form->money,$form->type,$form->category,$form->description,$form->sendEmail,$form->status);
            if($isSuccess){
//                $form->addError('','更新成功');
//                echo Alert::widget([
//                    'type' => Alert::TYPE_SUCCESS,
//                    'options' => [
//                        'title' => '',
//                        'text' => "资料更新成功",
//                        'confirmButtonText'  => "确定",
//                        'cancelButtonText' =>  "取消"
//                    ]
//                ]);
                Yii::$app->session->setFlash(Variable::$flash_success,'招聘信息修改成功');
            }
            else{
//                $form->addError('','更新失败');
                Yii::$app->session->setFlash(Variable::$flash_error,'招聘信息修改失败，请重试');
            }
        }
        $employModel = Employ::findOne($id);
        $form->department=$employModel->department;
        $form->employName=$employModel->employName;
        $form->employCode=$employModel->employCode;
        $form->sendEmail=$employModel->sendEmail;
        $form->count=$employModel->count;
        $form->money=$employModel->money;
        $form->category=$employModel->category;
        $form->type=$employModel->type;
        $form->group=$employModel->group;
        $form->address=$employModel->address;
        $form->status=$employModel->status;
        $form->description=$employModel->description;
        return $this->render(Variable::$editEmploy_view,['model'=>$form,'employModel'=>$employModel]);
    }
    /*
* 删除
*/
    public function actionDeleteemploy(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isDelete=(new Employ())->deleteEmploy($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','删除失败，请刷新重试');
        exit;
    }

}