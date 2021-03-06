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
use backend\models\Product;
use common\widgets\FVariable;
use common\widgets\GlobalArray;
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
                    "imageUrlPrefix"  =>FVariable::$domainUrl,//图片访问路径前缀
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
        $query = Material::find()->where(['materialId'=>Variable::$materialId_banner]);
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
            if($materialModel->addOneImage(0,$form->materialId,$form->materialId,$form->address,0,$form->isShow,200,200,$form->sort,$form->pcUrl,$form->wapUrl)){
                Yii::$app->session->setFlash(Variable::$flash_success,'banner添加成功');
                $this->redirect(Variable::$bannerList_url);
                return;
            }
        }
        return $this->render(Variable::$addBanner_view,['model'=>$form,'materialModel'=>$materialModel]);
    }
    public function actionEditbanner(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->setScenario('banner');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$setting_url);
            return;
        }
        $materialModel = Material::findOne($id);
        $form->materialId=$materialModel->materialId;
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Material())->updateMaterial($id,$form->materialId,$form->address,$form->isShow,$form->sort,$form->pcUrl,$form->wapUrl);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'资料更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'资料更新失败，请刷新重试');
            }
        }
        $materialModel = Material::findOne($id);
        $form->materialId=$materialModel->materialId;
        $form->id=$materialModel->id;
        $form->address=$materialModel->address;
        $form->isShow=$materialModel->isShow;
        $form->sort=$materialModel->sort;
        $form->pcUrl=$materialModel->pcUrl;
        $form->wapUrl=$materialModel->wapUrl;
        return $this->render(Variable::$editBanner_view,['model'=>$form,'materialModel'=>$materialModel]);

    }
    /*
 *资质认证列表
 */
    public function actionAuthlist(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Material::find()->where(['materialId'=>Variable::$materialId_auth]);
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$authList_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
    /*
 *添加资质认证
 *
 */
    public function actionAddauth(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->materialId=Variable::$materialId_auth;
        $materialModel=new Material();
        //添加
        $form->setScenario('auth');

        if($form->load($req->post()) && $form->validate()){
            if($materialModel->addOneImage(0,$form->materialId,$form->materialId,$form->address,0,$form->isShow,200,200,$form->sort,$form->pcUrl,'0')){
                Yii::$app->session->setFlash(Variable::$flash_success,'资质认证添加成功');
                $this->redirect(Variable::$authList_url);
                return;
            }
        }
        return $this->render(Variable::$addAuth_view,['model'=>$form,'materialModel'=>$materialModel]);
    }

    /*
     *编辑资质
     */
    public function actionEditauth(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->setScenario('auth');
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
                $this->redirect(Variable::$authList_url);
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
        return $this->render(Variable::$editAuth_view,['model'=>$form,'materialModel'=>$materialModel]);

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
        $query = Article::find()->andWhere(['not in','categoryId',[1006,1005,1007,1008]]);

        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count(),
        ]);
//        var_dump($query->count());
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
* 编辑文章
*/
    public function actionEditarticle(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ArticleForm();
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$articleManger_url);
            return;
        }
        $articleModel = Article::findOne($id);
        $form->categoryId=$articleModel->categoryId;
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Article())->updateArticleByNews($id,$form->title,$form->isTop,$form->description,$form->pic,$form->isIndexShow,$form->content);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'文章更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'文章更新失败，请刷新重试');
            }
            $this->redirect(Variable::$articleManger_url);
            return;
        }

        $articleModel = Article::findOne($id);
        $form->content=$articleModel->content;
        $form->isTop=$articleModel->isTop;
        $form->title=$articleModel->title;
        $form->isIndexShow=$articleModel->isIndexShow;
        $form->pic=$articleModel->pic;
        $form->id=$articleModel->id;
        return $this->render(Variable::$editArticle_view,['model'=>$form,'articleModel'=>$articleModel]);
    }
    /*
 *更新文章置顶状态
 */
    public function actionUpdatearticletop(){
        $id=trim(Yii::$app->request->post('id'));
        $status=trim(Yii::$app->request->post('status'));
        if(!isset($id) || empty($id)){
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isUpdate=(new Article())->updateArticleTop($id,$status);
//        if($isUpdate){
            JsonParser::GenerateJsonResult('_0000',$isUpdate.'-'.GlobalArray::$isTopArray[$isUpdate]);
            exit;
//        }
//        JsonParser::GenerateJsonResult('_0002','产品状态更新失败，请刷新重试');
//        exit;
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
            JsonParser::GenerateJsonResult('_0001','ID不能为空');
            exit;
        }
        $isDelete=(new Article())->deleteArticle($id);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','删除失败，请刷新重试');
        exit;
    }
    /*鲜橙生活*/
    public function actionLiftobject(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $countries = Article::find()->where(['in','categoryId',[Variable::$articleCat_type_good,Variable::$articleCat_type_nutrition,Variable::$articleCat_type_people]])->all();
        return $this->render(Variable::$liftObject_view,[
            'countries' => $countries,
        ]);
    }
    /*
    *编辑鲜橙生活
    */
    public function actionEditliftobject(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ArticleForm();
        $form->setScenario('editLiftObject');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$liftObject_url);
            return;
        }
        $articleModel = Article::findOne($id);
        $form->categoryId=$articleModel->categoryId;
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Article())->updateArticleContent($id,$form->content);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'资料更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'资料更新失败，请刷新重试');
            }
//            $this->redirect(Yii::$app->urlManager->createUrl([Variable::$showLiftObject_url,'id'=>$id]));
        }

        $articleModel = Article::findOne($id);
        $form->content=$articleModel->content;
        $form->title=$articleModel->articleCat->name;
        return $this->render(Variable::$editLiftObject_view,['model'=>$form,'articleModel'=>$articleModel]);
    }
    /*
 *展示生活方式
 */
    public function actionShowliftobject(){
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
        return $this->render(Variable::$showLiftObject_view,['model' => (new Article())->findOne($id)]);
    }
    /*
 *产品轮播图列表
 */
    public function actionProbanner(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = Material::find()->where(['materialId'=>Variable::$materialId_proBanner]);
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$proBanner_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
    /*
     *添加产品轮播图
     *
     */
    public function actionAddprobanner(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->materialId=Variable::$materialId_proBanner;
        $materialModel=new Material();
        //添加
        $form->setScenario('probanner');

        if($form->load($req->post()) && $form->validate()){
            if($materialModel->addOneImage(0,$form->materialId,$form->materialId,$form->address,0,$form->isShow,200,200,$form->sort,$form->pcUrl,$form->wapUrl)){
                Yii::$app->session->setFlash(Variable::$flash_success,'添加成功');
                $this->redirect(Variable::$proBanner_url);
                return;
            }
        }
        return $this->render(Variable::$addProBanner_view,['model'=>$form,'materialModel'=>$materialModel]);
    }
    public function actionEditprobanner(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new MaterialForm();
        $form->setScenario('probanner');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$setting_url);
            return;
        }
        $materialModel = Material::findOne($id);
        $form->materialId=$materialModel->materialId;
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Material())->updateMaterial($id,$form->materialId,$form->address,$form->isShow,$form->sort,$form->pcUrl,$form->wapUrl);
            if($isSuccess){
                Yii::$app->session->setFlash(Variable::$flash_success,'资料更新成功');
            }
            else{
                Yii::$app->session->setFlash(Variable::$flash_error,'资料更新失败，请刷新重试');
            }
            $this->redirect(Variable::$proBanner_url);
            return;
        }
        $materialModel = Material::findOne($id);
        $form->materialId=$materialModel->materialId;
        $form->id=$materialModel->id;
        $form->address=$materialModel->address;
        $form->isShow=$materialModel->isShow;
        $form->sort=$materialModel->sort;
        $form->pcUrl=$materialModel->pcUrl;
        $form->wapUrl=$materialModel->wapUrl;
        return $this->render(Variable::$editProBanner_view,['model'=>$form,'materialModel'=>$materialModel]);

    }

}
