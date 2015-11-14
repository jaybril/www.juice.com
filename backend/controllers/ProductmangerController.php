<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/18
 * Time: 11:23
 */
namespace backend\controllers;
use backend\models\AddProductImagesForm;
use backend\models\Material;
use backend\models\MaterialCategory;
use backend\models\Product;
use backend\models\ProductForm;
use common\widgets\GlobalArray;
use Yii;
use backend\models\Area;
use backend\models\ProductCategory;
use backend\models\Seller;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Session;
use backend\models\AdminUser;
use common\widgets\Variable;
use backend\models\SellerForm;
use common\widgets\JsonParser;
use yii\web\UploadedFile;

class ProductmangerController extends  Controller{
    public $layout='main';
    /*
     * 产品管理页面
     */
    public function actionIndex()
    {
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => Product::find()->count(),
        ]);
        $countries=Product::find()->orderBy('AddTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$productManger_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    /*
     * 添加产品页面
     */
    public function actionAddproduct(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ProductForm();//产品表单
        $sellerModel=new Seller();//商家
        $productCatModel=new ProductCategory();//产品分类
        $productMode=new Product();

        //添加
        $form->setScenario('create');

        if($form->load($req->post()) && $form->validate()){
            $productLogoPath='uploads/';
            if (!file_exists($productLogoPath)) {
                mkdir($productLogoPath,true);
            }
            $image=UploadedFile::getInstance($form,'productLogo');
            if(!($image instanceof UploadedFile && $image->error != UPLOAD_ERR_NO_FILE)){
                $form->addError('sellerLogo','请输入符合格式要求的图片');
                return $this->render(Variable::$addProduct_view,['model'=>$form,'sellerModel'=>Seller::find()->all(),'productCatModel'=>ProductCategory::find()->all()]);
            }
            $ext=$image->getExtension();
            $imageName=time().rand(100,999).'.'.$ext;
            $isUpLoad=$image->saveAs($productLogoPath.$imageName);
            if(!$isUpLoad){
                return $this->render(Variable::$addProduct_view,['model'=>$form,'sellerModel'=>Seller::find()->all(),'productCatModel'=>ProductCategory::find()->all(),'error'=>'图片上传失败']);
            }
            $form->productLogo='/'.$productLogoPath.$imageName;
            if($productMode->addProduct($form->productName,$form->productBrief,$form->productLogo,$form->sellerId,$form->categoryId,$form->productStock,$form->productPrice,$form->productStatus)){
                $this->redirect(Variable::$productManger_url);
                return;
            }
        }
        return $this->render(Variable::$addProduct_view,['model'=>$form,'sellerModel'=>Seller::find()->all(),'productCatModel'=>ProductCategory::find()->all()]);
    }
    /*
     *更新产品的上下架状态
     */
    public function actionUpdateproductstatus(){
        $productId=trim(Yii::$app->request->post('productId'));
        $status=trim(Yii::$app->request->post('status'));
        if(!isset($productId) || empty($productId)){
            JsonParser::GenerateJsonResult('_0001','产品ID不能为空');
            exit;
        }
        $isUpdate=(new Product())->updateProductStatus($productId,$status);
        if($isUpdate){
            JsonParser::GenerateJsonResult('_0000',$isUpdate.'-'.GlobalArray::$productStatusArray[$isUpdate]);
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','产品状态更新失败，请刷新重试');
        exit;
    }
    /*
    * 修改产品页面
    */
    public function actionEditproduct(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new ProductForm();
        $form->setScenario('update');
        $id=trim($req->get('id'));
        if (!is_numeric($id) || $id == 0) {
            $this->redirect(Variable::$productManger_url);
            return;
        }
        $productModel = Product::findOne($id);

        $form->productName=$productModel->productName;
        $form->productBrief=$productModel->productBrief;
        $form->productStock=$productModel->productStock;
        $form->productPrice=$productModel->productPrice;
        $form->productStatus=$productModel->productStatus;
        $form->productStock=$productModel->productStock;
        //修改
        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Product())->updateProduct($id,$form->productName,$form->productBrief,$form->productStatus,$form->productPrice,$form->productStock);
            if($isSuccess){
                $form->addError('','资料更新成功');
            }
            else{
                $form->addError('','资料更新失败');
            }
        }
        return $this->render(Variable::$editProduct_view,['model'=>$form,'productModel'=>$productModel]);
    }
    /*
     * 商家管理页面
     */
    public function actionSeller(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query=Seller::findBySql('select se.id,se.sellerName,se.sellerBrief,se.sellerLogo,se.sellerProvince,se.sellerCity,se.contacts,se.phone,ar1.name  "prvince",ar2.name "city" from mp_seller se LEFT JOIN mp_area ar1 ON se.sellerProvince=ar1.id LEFT JOIN mp_area ar2 ON se.sellerCity=ar2.id   ')->all();
        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => Seller::find()->count(),
        ]);
        $countries=Seller::find()->orderBy('registerTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(Variable::$sellerManger_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    /*
     * 添加商家页面
     */
    public function actionAddseller(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new SellerForm();
        $areaModel=new Area();
        $sellerModel=new Seller();
        //添加
        $form->setScenario('create');
        if($form->load($req->post()) && $form->validate()){
            $sellerLogoPath='uploads/';
            if (!file_exists($sellerLogoPath)) {
                mkdir($sellerLogoPath,true);
            }
            $image=UploadedFile::getInstance($form,'sellerLogo');
            if(!($image instanceof UploadedFile && $image->error != UPLOAD_ERR_NO_FILE)){
                $form->addError('sellerLogo','请输入符合格式要求的图片');
                return $this->render(Variable::$addSeller_view,['model'=>$form,'provinceMode'=>$areaModel->getProvinceList()]);
            }
            $ext=$image->getExtension();
            $imageName=time().rand(100,999).'.'.$ext;
            $isUpLoad=$image->saveAs($sellerLogoPath.$imageName);
            if(!$isUpLoad){
                return $this->render(Variable::$addSeller_view,['model'=>$form,'provinceMode'=>$areaModel->getProvinceList(),'error'=>'图片上传失败']);
            }
            $form->sellerLogo='/'.$sellerLogoPath.$imageName;
            if($sellerModel->addSeller($form->sellerName,$form->sellerBrief,$form->sellerLogo,$form->sellerProvince,$form->sellerCity,$form->contacts,$form->phone)){
               $this->redirect(Variable::$sellerManger_url);
                return;
            }
        }
        return $this->render(Variable::$addSeller_view,['model'=>$form,'provinceMode'=>$areaModel->getProvinceList()]);
    }
    /*
     * 修改商家页面
     */
    public function actionEidtseller(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;//创建一个请求对象
        $form = new SellerForm();
        $form->setScenario('update');
        $areaModel=new Area();
        $sellerId=trim($req->get('id'));
        if (!is_numeric($sellerId) || $sellerId == 0) {
            $this->redirect(Variable::$sellerManger_url);
            return;
        }
        //修改

        if($form->load($req->post()) && $form->validate()){
            $isSuccess = (new Seller())->updateSeller($sellerId, $form->sellerProvince, $form->sellerCity, $form->contacts, $form->phone,$form->sellerBrief);

            if($isSuccess){
                $form->addError('','资料更新成功');
            }
            else{
                $form->addError('','资料更新失败');
            }
        }
        $sellerModel = (new Seller())->findSellerById($sellerId);
        $form->sellerName=$sellerModel->sellerName;
        $form->sellerProvince=$sellerModel->sellerProvince;
        $form->sellerCity=$sellerModel->sellerCity;
        $form->contacts=$sellerModel->contacts;
        $form->phone=$sellerModel->phone;
        $form->sellerBrief=$sellerModel->sellerBrief;
        return $this->render(Variable::$editSeller_view,['model'=>$form,'sellerModel'=>$sellerModel,'provinceMode'=>$areaModel->getProvinceList()]);
    }
    /*
     *省市联动 活动市区
     */
    public function actionGetcitylist(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $provinceId=trim(Yii::$app->request->post('provinceId'));
        if(!isset($provinceId) || empty($provinceId)){
            JsonParser::GenerateJsonResult('_0001','省份ID不能为空');
            exit;
        }
        $cityList=(new Area())->getCityList($provinceId);
        JsonParser::GenerateJsonResult('_0000',$cityList);
        exit;
    }
    /*
     * 删除商家
     */
    public function actionDeleteseller(){
        $sellerId=trim(Yii::$app->request->post('sellerId'));
        if(!isset($sellerId) || empty($sellerId)){
            JsonParser::GenerateJsonResult('_0001','商家ID不能为空');
            exit;
        }
        $isDelete=(new Seller())->deleteSeller($sellerId);
        if($isDelete){
            JsonParser::GenerateJsonResult('_0000','商家删除成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0002','商家删除失败，请刷新重试');
        exit;
    }
    /*
     * 产品分类管理页面
     */
    public function actionProductcat(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $query = ProductCategory::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render(Variable::$productCat_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    /*
     *添加产品展示图像
     */
    public function actionAddproductimages(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        $req=Yii::$app->request;
        $useId=trim($req->get('id'));
        $materialModel=Material::find()->where(['useId'=>$useId,'type'=>0,'materialId'=>5])->orderBy('addTime DESC')->all();
        $materialCatModel=MaterialCategory::find()->all();
        $addForm=new AddProductImagesForm();
        $addForm->materialId=5;//产品轮播图片
        if($addForm->load($req->post()) && $addForm->validate()){
            $logoPath='uploads/';
            if (!file_exists($logoPath)) {
                mkdir($logoPath,true);
            }
            $image=UploadedFile::getInstance($addForm,'productImage');
            if(!($image instanceof UploadedFile && $image->error != UPLOAD_ERR_NO_FILE)){
                $addForm->addError('productImage','请输入符合格式要求的图片');
                return $this->render(Variable::$addProductImages_view,['materialModel' => $materialModel, 'model'=>$addForm,'useId'=>$useId,'materialCatModel'=>$materialCatModel]);
            }
            $ext=$image->getExtension();
            $imageName='productImage_'.$useId.'_'.time().rand(100,999).'.'.$ext;
            $isUpLoad=$image->saveAs($logoPath.$imageName);
            if(!$isUpLoad){
                return $this->render(Variable::$addProductImages_view,['materialModel' => $materialModel, 'model'=>$addForm,'error'=>'图片上传失败','useId'=>$useId,'materialCatModel'=>$materialCatModel]);
            }
            $addForm->productImage='/'.$logoPath.$imageName;
            if(!(new Material())->addOneImage(0,$addForm->materialId,$useId,$addForm->productImage)){
                $this->redirect(Variable::$productManger_url);
                return;
            }
            $this->refresh();
        }
        return $this->render(Variable::$addProductImages_view,['materialModel' => $materialModel, 'model'=>$addForm,'useId'=>$useId,'materialCatModel'=>$materialCatModel]);
    }
    /*
     * 添加用户
     */
    public function actionAddproductcat(){
        $user=new AdminUser();
        if(!$user->checkUserIsLogin()){
            $this->redirect(Variable::$home_url);
            return;
        }
        //请求处理
        $req=Yii::$app->request;
        $name=trim($req->post('name'));
        $sort=trim($req->post('sort'));
        $desc=trim($req->post('desc'));
        if((new ProductCategory())->addCat($name,$sort,$desc)){
            JsonParser::GenerateJsonResult('_0000','添加成功');
            exit;
        }
        JsonParser::GenerateJsonResult('_0001','添加失败');
        exit;
    }
}