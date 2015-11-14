<?php
namespace frontend\models;
use \yii\db\ActiveRecord;
use common\widgets;

class User extends  ActiveRecord{
    /*
     * 通过username查找用户
     */
    public function findUserByUserName($mobile){
        $user = User::find()->where(array('mobile'=>$mobile))->one();
        if ($user) {
            return new static($user);
        }
        return null;
    }

    public function findUserByUserPassword($password){
        $password = User::find()->where(array('password' => $password))->one();
        if ($password) {
            return new static($password);
        }
        return null;
    }
    /*
     * 通过id查找用户
     */
    public function findUserByUserId($id){
        $user = User::find()->where(array('id' => $id))->one();
        if ($user) {
            return new  static($user);
        }
        return null;
    }

    /*
    * 通过id修改用户资料
    */
    public function updateUserByUserId($userId,$email,$realName,$sex,$birthday){
        $result = User::findOne($userId);
        if($result){
            $result->email=$email;
            $result->realName=$realName;
            $result->sex=$sex;
            $result->birthday=$birthday;
            $result->update();
        }

    }

    /*
     * 检查用户是否登录
     * @return false -用户尚未登录
     * @return user -返回用户对象
     * */
    public function checkUserIsLogin(){

        $userId=\Yii::$app->session->get(widgets\FVariable::$session_userId_str);
        $user=$this->findUserByUserId($userId);
//            print_r($user);
        if(!$user){
            return false;
        }
        return $user;
    }

    /*
* 检查是否存在这个用户
* */
    public function checkUpUser($mobile){
        $result = User::find()->where(['or','nickName='."'".$mobile."'",'mobile='."'".$mobile."'"])->one();
        if(!$result){
            return false;
        }
        return $result;
    }

    /*
 * 注册新用户
 * */
    public function RegisterNewUser($mobile,$password,$salt){
        date_default_timezone_set('Asia/Shanghai');
        $registerTime = date('Y-m-d H:i:s',time());
        $user = new User();
        $user->nickName = $mobile;
        $user->password = $password;
        $user->mobile = $mobile;
        $user->registerTime = $registerTime;
        $user->lastLoginTime = $registerTime;
        $user->salt = $salt;
        $user->insert();
    }

    /*
* 通过i手机号码修改密码
*/
    public function updateUserByPsw($moblie,$newPsw){
        $result=User::find()->where(array('mobile' => $moblie))->one();
        $result->password = $newPsw;
        $result->update();
        if(!$result){
            return false;
        }
        return $result;
    }

    /*
     * 退出登录 清除session数据
     */
    public function logOut(){
        \Yii::$app->session->set(widgets\FVariable::$session_userId_str,'');
        \Yii::$app->session->destroy();
    }

    public function getOrder(){
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(Order::className(), ['userId' => 'id']);
    }

    public function getUserAddress(){
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的customer_id，关联主表的id字段
        return $this->hasMany(UserAddress::className(), ['userId' => 'id']);
    }

}