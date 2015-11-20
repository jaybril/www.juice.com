<?php
namespace backend\controllers;
use backend\models\Bar;
use backend\models\BarForm;
use backend\models\Customer;
use backend\models\CustomerForm;
use Yii;
use backend\models\AdminUser;
use backend\models\Employ;
use backend\models\EmployForm;
use common\widgets\Variable;
use yii\web\Controller;
use yii\data\Pagination;
use common\widgets\JsonParser;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;

class CustomerController extends  Controller{
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

    public function actionIndex(){

        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Customer::find()->where(['=','level',Variable::$customer_type_c]);
        $pagination = new Pagination([
            'defaultPageSize' => 25,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render(Variable::$customerIndex_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionEditcuscat(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
//        $form=new BarForm();
//        $req=Yii::$app->request;//创建一个请求对象
//        $form->setScenario('update');
//        if($form->load($req->post()) && $form->validate()){
//            print_r($form);
//        }
//        $form->setScenario('update');
//        $req=Yii::$app->request;//创建一个请求对象
//        $id=trim($req->get('id'));
//        if (!is_numeric($id) || $id == 0) {
//            $this->redirect(Variable::$barIndex_url);
//            return;
//        }
        $catModel = Customer::find()->where(['level'=>Variable::$customer_type_c])->all();
//        $barListModel=Bar::find()->where(['parentBar'=>$id])->all();

        return $this->render(Variable::$editCusCatList_view,['catModel'=>$catModel]);
    }
    /*
* 删除
*/
    public function actionDeletecus(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isDelete=(new Customer())->deleteCus($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','删除失败，请刷新重试');
        exit;
    }

    public function actionAddcus(){
        $parentId=trim(Yii::$app->request->post('parentId'));
        $name=trim(Yii::$app->request->post('name'));
        $sort=trim(Yii::$app->request->post('sort'));
        $level=trim(Yii::$app->request->post('level'));
        $clogo=null;
        $blogo=null;

        if(!isset($name) || empty($name)){
            JsonParser::GenerateJsonResult('_0001','名称不能为空');
            exit;
        }
        $isSuccess=(new Customer())->addCus($name,$sort,$level,$parentId,$blogo,$clogo);

        if($isSuccess){
            JsonParser::GenerateJsonResult('_0000','添加成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','添加失败，请刷新重试');
        exit;
    }
    public function actionUpdatecus(){
        $id=trim(Yii::$app->request->post('id'));
        $parentId=trim(Yii::$app->request->post('parentId'));
        $name=trim(Yii::$app->request->post('name'));
        $sort=trim(Yii::$app->request->post('sort'));
        $level=trim(Yii::$app->request->post('level'));
        $clogo=null;
        $blogo=null;
        if(!isset($name) || empty($name)){
            JsonParser::GenerateJsonResult('_0001','名称不能为空');
            exit;
        }
        $isSuccess=(new Customer())->updateCus($id,$name,$sort,$level,$blogo,$clogo);
        if($isSuccess){
            JsonParser::GenerateJsonResult('_0000','更新成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','更新失败，请刷新重试');
        exit;
    }
    /*品牌*/
    public function actionBrand(){

        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Customer::find()->where(['level'=>Variable::$customer_type_p]);
        $pagination = new Pagination([
            'defaultPageSize' => 25,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render(Variable::$customerBrand_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionAddbrand(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new CustomerForm();
        $customerModel=new Customer();
        //添加
        $form->setScenario('create');
        $form->level=Variable::$customer_type_p;
        $catModel=Customer::find()->where(['level'=>Variable::$customer_type_c])->all();
//        $form->parentId=$id

        if($form->load($req->post()) && $form->validate()){
            if($customerModel->addCus($form->name,$form->sort,$form->level,$form->parentId,$form->clogo,$form->blogo)){
                Yii::$app->session->setFlash(Variable::$flash_success,'添加成功');
                $this->redirect(Variable::$customerBrand_url);
                return;
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'添加失败，请重试');
            }

        }
        return $this->render(Variable::$addBrand_view,['model'=>$form,'catModel'=>$catModel]);
    }
    /*
* 修改品牌
*/
    public function actionEditbrand(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new CustomerForm();
        $form->level=Variable::$customer_type_p;
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$customerBrand_url);
            return;
        }
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Customer())->updateCus($id,$form->name,$form->sort,$form->level,$form->blogo,$form->clogo);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'修改成功');
            }
            else{
//                $form->addError('','更新失败');
                Yii::$app->session->setFlash(Variable::$flash_error,'修改失败，请重试');
            }
        }
        $customerModel = Customer::findOne($id);
        $form->name=$customerModel->name;
        $form->sort=$customerModel->sort;
        $form->clogo=$customerModel->clogo;
        $form->blogo=$customerModel->blogo;
        $catModel=Customer::find()->where(['id'=>$customerModel->parentId])->one();
        $form->parentId=$catModel->name;
        print_r($form->clogo);
        return $this->render(Variable::$editBrand_view,['model'=>$form,'customerModel'=>$customerModel,'catModel'=>$catModel]);
    }
    public function actionEditpoint(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
//        $form=new CustomerForm();
//        $req=Yii::$app->request;//创建一个请求对象
//        $form->setScenario('update');
//        if($form->load($req->post()) && $form->validate()){
//            print_r($form);
//        }
//        $form->setScenario('update');
        $req=Yii::$app->request;//创建一个请求对象
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$barIndex_url);
            return;
        }
        $brandModel=Customer::findOne($id);
        $catModel = Customer::find()->where(['parentId'=>$id])->all();
//        $barListModel=Bar::find()->where(['parentBar'=>$id])->all();

        return $this->render(Variable::$editPoint_view,['catModel'=>$catModel,'brandModel'=>$brandModel]);
    }

}