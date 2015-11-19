<?php
namespace backend\controllers;
use backend\models\Bar;
use backend\models\BarForm;
use backend\models\Customer;
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
    public function actionEditbarlist(){
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
        $req=Yii::$app->request;//创建一个请求对象
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$barIndex_url);
            return;
        }
        $barModel = Bar::findOne($id);
        $barListModel=Bar::find()->where(['parentBar'=>$id])->all();

        return $this->render(Variable::$editBarList_url,['barModel'=>$barModel,'barListModel'=>$barListModel]);
    }
    /*
* 删除
*/
    public function actionDeletebar(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isDelete=(new Bar())->deleteBar($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','删除失败，请刷新重试');
        exit;
    }

    public function actionAddbar(){
        $parentBar=trim(Yii::$app->request->post('parentId'));
        $name=trim(Yii::$app->request->post('name'));
        $link=trim(Yii::$app->request->post('link'));
        $isTop=0;
        if($parentBar){
            $isTop=1;
        }
        if(!isset($name) || empty($name)){
            JsonParser::GenerateJsonResult('_0001','栏目名称不能为空');
            exit;
        }
        $isSuccess=(new Bar())->addBar($name,$link,$isTop,$parentBar);

        if($isSuccess){
            JsonParser::GenerateJsonResult('_0000','添加成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','添加失败，请刷新重试');
        exit;
    }
    public function actionUpdatebar(){
        $barId=trim(Yii::$app->request->post('barId'));
        $name=trim(Yii::$app->request->post('name'));
        $link=trim(Yii::$app->request->post('link'));
        if(!isset($name) || empty($name)){
            JsonParser::GenerateJsonResult('_0001','栏目名称不能为空');
            exit;
        }
        $isSuccess=(new Bar())->updateBar($barId,$name,$link);
        if($isSuccess){
            JsonParser::GenerateJsonResult('_0000','更新成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','更新失败，请刷新重试');
        exit;
    }
}