<?php
namespace backend\controllers;
use backend\models\Bar;
use backend\models\BarForm;
use Yii;
use backend\models\AdminUser;
use backend\models\Employ;
use backend\models\EmployForm;
use common\widgets\Variable;
use yii\web\Controller;
use yii\data\Pagination;
use common\widgets\JsonParser;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;

class BarController extends  Controller{
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
        $query = Bar::find()->where(['<>','isTop','1']);
        $pagination = new Pagination([
            'defaultPageSize' => 25,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render(Variable::$barIndex_view,[
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
        $form=new BarForm();
        $req=Yii::$app->request;//创建一个请求对象
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$barIndex_url);
            return;
        }
        $barModel = Bar::findOne($id);

        return $this->render(Variable::$editBarList_url,['model'=>$form,'barModel'=>$barModel]);
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

}