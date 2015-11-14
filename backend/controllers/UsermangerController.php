<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/17
 * Time: 18:40
 */
    namespace backend\controllers;//控制器必须有命名空间
    use backend\models\OrderExpressInfo;
    use backend\models\UserAddress;
    use backend\models\UserForm;
    use common\widgets\Tool;
    use Yii;
    use backend\models\AdminUser;
    use backend\models\User;
    use common\widgets\JsonParser;
    use common\widgets\Variable;
    use yii\data\Pagination;
    use yii\filters\AccessControl;
    use \yii\web\Controller;
    use yii2mod\alert\Alert;


 class UsermangerController extends  BaseController{
     /*
      *用户管理
      */
     public $isNeedLogin=true;//需要登录才能访问
     public function actionIndex()
     {
         $query = User::find();
         $pagination = new Pagination([
             'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('registerTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
         return $this->render(Variable::$userMange_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
     }
     /*
      * 添加用户
      */
     public function actionAddcustomer(){
         //请求处理
         $req=Yii::$app->request;
         $realName=trim($req->post('realName'));
         $nickName=trim($req->post('nickName'));
         $password=trim($req->post('password'));
         $mobile=trim($req->post('mobile'));
         $user=new User();
         $isSave=  $user->addCustomer($nickName,$password,$mobile,$realName);
         if($isSave){
             JsonParser::GenerateJsonResult('_0000','添加成功');
             exit;
         }
         JsonParser::GenerateJsonResult('_0001','添加失败');
         exit;
     }
     /*
   * 修改产品页面
   */
     public function actionEdituser(){
         $req=Yii::$app->request;//创建一个请求对象
         $form = new UserForm();
         $form->setScenario('update');
         $id=trim($req->get('id'));
         if (!is_numeric($id) || $id == 0) {
             $this->redirect(Variable::$userMange_url);
             return;
         }
         //修改
         if($form->load($req->post()) && $form->validate()){

             $isSuccess = (new User())->updateCusetomer($id,$form->realName,$form->nickName,$form->password,$form->email,$form->mobile,$form->userType,$form->userStatus,$form->frozenReason,$form->comeFrom);
             if($isSuccess){
                 $form->addError('','资料更新成功');
             }
             else{
                 $form->addError('','资料更新失败');
             }
         }
         $userModel = User::findOne($id);
         $form->realName=$userModel->realName;
         $form->nickName=$userModel->nickName;
         $form->password=$userModel->password;
         $form->email=$userModel->email;
         $form->mobile=$userModel->mobile;
         $form->userType=$userModel->userType;
         $form->userStatus=$userModel->userStatus;
         $form->frozenReason=$userModel->frozenReason;
         $form->comeFrom=$userModel->comeFrom;

         return $this->render(Variable::$editUser_view,['model'=>$form,'userModel'=>$userModel]);
     }
    /*
    * 删除商家
    */
     public function actionDeleteuser(){
         $userId=trim(Yii::$app->request->post('userId'));
         if(!isset($userId) || empty($userId)){
             JsonParser::GenerateJsonResult('_0001','用户ID不能为空');
             exit;
         }
         $isDelete=(new User())->deleteUser($userId);
         if($isDelete){
             JsonParser::GenerateJsonResult('_0000','用户删除成功');
             exit;
         }
         JsonParser::GenerateJsonResult('_0002','用户删除失败，请刷新重试');
         exit;
     }
     /*
      *用户地址列表
      */
     public function actionUseraddresslist(){
         $userId=trim(Yii::$app->request->get('id'));
         if(!isset($userId) || empty($userId)){
             $this->redirect(Variable::$home_url);
             exit;
         }
         $userAddress=new UserAddress();
         $list=$userAddress->findAll(['userId'=>$userId]);
        return $this->render(Variable::$userAddress_view,['model'=>$list]);
     }
}