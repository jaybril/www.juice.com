<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/17
 * Time: 11:23
 */
    namespace backend\models;
        use common\widgets\GlobalArray;
        use yii\base\Model;
        use yii\captcha\Captcha;
        use yii\captcha\CaptchaValidator;

        class AdminUserLoginForm extends Model
    {
            public $username;
            public $password;
            public $verifyCode;
            public function rules()
            {
                return array(
                    [['username'],'required','message'=>'请输入用户名'],
                    [['username'],'required','message'=>'请输入密码'],
                    [['username'],'checkUserNameAndPassword'],
                    [['password'],'checkUserNameAndPassword'],
                    [['verifyCode'],'captcha', 'skipOnEmpty'=>!Captcha::checkRequirements(),'message'=>'验证码不正确']
                    );
            }
            /*验证用户*/
            public function checkUserNameAndPassword($attribute,$params)
            {
                $model=(new AdminUser())->findUserByUserName($this->username);
                if(!$model){
                    $this->addError('username','用户名不存在');
                }
                if(md5($this->password)!=$model->password){
                    $this->addError('password','密码不正确'.'md5($this->password):'.md5($this->password).';;$model->password:'.$model->password);
                }
                if($model->status==1){
                    $this->addError('username','用户处于冻结状态，请联系系统管理员解锁');
                }
        }
    }