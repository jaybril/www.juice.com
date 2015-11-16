<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/18
 * Time: 14:24
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
class MultimediamangerController extends  Controller{
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

/*
 *banner列表
 */
    public function actionBannerlist(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Material::find()->where(['materialId'=>1000]);
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$bannerList_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
/*
 *添加banner
 *
 */
    public function actionAddbanner(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->materialId=Variable::$materialId_banner;
        $materialModel=new Material();
        //添加
        $form->setScenario('banner');

        if($form->load($req->post()) && $form->validate()){
            if($materialModel->addOneImage(0,$form->materialId,$form->materialId,$form->address,0,$form->isShow,200,200,$form->sort,$form->pcUrl)){
                Yii::$app->session->setFlash(Variable::$flash_success,'banner添加成功');
                $this->redirect(Variable::$bannerList_url);
                return;
            }
        }
        return $this->render(Variable::$addBanner_view,['model'=>$form,'materialModel'=>$materialModel]);
    }
    /*
*删除素材
*/
    public function actionDeletematerial(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isDelete=(new Material())->deleteMateria($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','删除失败，请刷新重试');
        exit;
    }

    /*
     *编辑素材
     */
    public function actionEditmaterial(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$setting_url);
            return;
        }
        $materialModel = Material::findOne($id);
        $form->materialId=$materialModel->materialId;
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Material())->updateMaterial($id,$form->materialId,$form->address,$form->isShow,$form->sort,$form->pcUrl);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'资料更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'资料更新失败，请刷新重试');
            }
        }
        $materialModel = Material::findOne($id);
        $form->materialId=$materialModel->materialId;
        $form->address=$materialModel->address;
        $form->isShow=$materialModel->isShow;
        $form->sort=$materialModel->sort;
        $form->pcUrl=$materialModel->pcUrl;
        return $this->render(Variable::$editMaterial_view,['model'=>$form,'materialModel'=>$materialModel]);

    }

    /*
     *素材管理页面
     */
    public function actionMaterialmanger(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = MaterialCategory::find();
        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$materialManger_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    /*
     *添加素材分类
     */
    public function actionAddmateredcat(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $materedCatName=trim(\Yii::$app->request->post('materedCatName'));
        $description=trim(\Yii::$app->request->post('description'));
        $isOnly=trim(\Yii::$app->request->post('isOnly'));
        if(!$materedCatName){
            JsonParser::GenerateJsonResult('_0001','素材分类名不能为空');
            exit;
        }
        $isAdd=(new MaterialCategory())->addCat($materedCatName,$description,$isOnly);
        if($isAdd){
            JsonParser::GenerateJsonResult('_0000','素材分类添加成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0001','素材分类添加失败，请刷新重试');
        exit;
    }

    /*
     *删除素材分类
     */
    public function actionDeletematerialcat(){
        $catId=trim(Yii::$app->request->post('catId'));
            if(!isset($catId) || empty($catId)){
                JsonParser::GenerateJsonResult('_0001','素材分类ID不能为空');
                exit;
            }
            $isDelete=(new MaterialCategory())->deleteCat($catId);
            if($isDelete){
                JsonParser::GenerateJsonResult('_0000','素材分类删除成功');
                exit;
            }
            JsonParser::GenerateJsonResult('_0002','素材分类删除失败，请刷新重试');
            exit;
    }
    /*
     * 文章分类*/
    public function actionArticlcat(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = ArticleCategory::find();
        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$articleCat_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    /*
    *添加文章分类
    */
    public function actionAddarticlecat(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $articleCatName=trim(\Yii::$app->request->post('articleCatName'));
        $description=trim(\Yii::$app->request->post('description'));
        $isOnly=trim(\Yii::$app->request->post('isOnly'));
        if(!$articleCatName){
            JsonParser::GenerateJsonResult('_0001','分类名不能为空');
            exit;
        }
        $isAdd=(new ArticleCategory())->addCat($articleCatName,$description);
        if($isAdd){
            JsonParser::GenerateJsonResult('_0000','分类添加成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0001','分类添加失败，请刷新重试');
        exit;
    }
    /*
*删除文章分类
*/
    public function actionDeletearticlecat(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','分类ID不能为空');
            exit;
        }
        $isDelete=(new ArticleCategory())->deleteCat($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','分类删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','分类删除失败，请刷新重试');
        exit;
    }

    /*
     *文章管理页面
     */
    public function actionArticlemanger(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Article::find();
        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$articleManger_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }

    /*
    * 添加文章
    */
    public function actionAddarticle(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ArticleForm();
        $articleModel=new Article();
        $form->categoryId=Variable::$articleCat_type_news;
        $form->status=1;
//        $articleCatModel=ArticleCategory::findAll(['categoryId'=>Variable::$articleCat_type_news]);
        //添加
        $form->setScenario('create');
        if($form->load($req->post()) && $form->validate()){
            if($articleModel->addAerticle($form->title,$form->keywords,$form->categoryId,$form->content,$form->status,$form->isTop,$form->description,$form->pic,$form->isIndexShow)){
                $this->redirect(Variable::$articleManger_url);
                return;
            }
        }
        return $this->render(Variable::$addArticle_view,['model'=>$form,'articleModel'=>$articleModel]);
    }
    /*
     *展示文章
     */
    public function actionShowarticle(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$articleManger_url);
            return;
        }
        return $this->render(Variable::$showArticle_view,['model' => (new Article())->findOne($id)]);
    }
    /*
    *删除素材分类
    */
    public function actionDeletearticle(){
        $id=trim(Yii::$app->request->post('id'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','文章ID不能为空');
            exit;
        }
        $isDelete=(new Article())->deleteArticle($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','文章删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','文章删除失败，请刷新重试');
        exit;
    }
}
