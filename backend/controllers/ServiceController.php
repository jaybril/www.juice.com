<?php
/**
 * Created by PhpStorm.
 * User: jaybril
 * Date: 15/11/19
 * Time: 上午12:25
 */
namespace backend\controllers;
use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleForm;
use backend\models\Material;
use backend\models\MaterialForm;
use Yii;
use backend\models\MaterialCategory;
use yii\web\Controller;
use backend\models\AdminUser;
use yii\data\Pagination;
use common\widgets\JsonParser;
use common\Widgets\Variable;
class ServiceController extends  Controller{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  =>'',//图片访问路径前缀
                    "imagePathFormat" => "/uploads/{yyyy}{mm}{dd}/{time}{rand:6}" //上传保存路径
                ],
            ]
        ];
    }
    public function actionIndex(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Article::find()->where(['categoryId'=>Variable::$articleCat_type_service]);
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$serviceIndex_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
    /*
*添加服务项
*
*/
    public function actionAddservice(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ArticleForm();
        $form->categoryId=Variable::$articleCat_type_service;
        $form->status=1;
        $articleModel=new Article();
        //添加
        $form->setScenario('service');

        if($form->load($req->post()) && $form->validate()){
            if($articleModel->addAerticle($form->title,$form->keywords,$form->categoryId,$form->content,$form->status,$form->isTop,$form->description,$form->pic,$form->isIndexShow)){
                Yii::$app->session->setFlash(Variable::$flash_success,'服务项添加成功');
                $this->redirect(Variable::$serviceIndex_url);
                return;
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'服务项添加失败，请重试');
            }
        }
        return $this->render(Variable::$addService_view,['model'=>$form,'articleModel'=>$articleModel]);
    }
    /*
* 修改服务项页面
*/
    public function actionEditservice(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ArticleForm();
        $form->setScenario('service');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$employIndex_url);
            return;
        }
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess=(new Article())->updateArticleByService($id,$form->title,$form->useId,$form->keywords,$form->pic,$form->content);
//            $isSuccess = (new Employ())->updateEmploy($id,$form->department,$form->employName,$form->address,$form->employCode,$form->group,$form->count,$form->money,$form->type,$form->category,$form->description,$form->sendEmail,$form->status);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'服务项修改成功');
                $this->redirect(Variable::$serviceIndex_url);
                return;
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'服务项修改失败，请重试');
                return;
            }
        }
        $articleModel = Article::findOne($id);
        $form->title=$articleModel->title;
        $form->keywords=$articleModel->keywords;
        $form->pic=$articleModel->pic;
        $form->useId=$articleModel->useId;
        $form->content=$articleModel->content;

        return $this->render(Variable::$editService_view,['model'=>$form,'articleModel'=>$articleModel]);
    }
}