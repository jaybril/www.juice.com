<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\widgets\Variable;

class UserRegisterForm extends Model
{
    public $mobile;
    public $password;
    public $verifyCode;

    public function rules()
    {
        return array(
            [['mobile','password'],'trim'],
            ['mobile','required','message'=>'*手机号码不能为空'],
            ['verifyCode','required','message'=>'*验证码不能为空'],
            ['password','required','message'=>'*密码不能为空'],
            ['mobile','match','pattern'=>'/^1[3-5,7-8]{1}[0-9]{9}$/','message'=>'*手机号码格式不正确'],
            ['mobile','checkUpUser'],
            ['verifyCode','checkUpCode'],
        );
    }

    public function checkUpUser($attribute,$params)
    {

      $user = (new User())->checkUpUser($this->mobile);
        if ($user) {
            $this->addError($attribute, '*用户已存在！');
        }
    }

    public function checkUpCode($attribute,$params)
    {
        $SmsLog = (new SmsLog())->findMoblie($this->mobile,Variable::$smsType_register);
        if ($SmsLog->checkCode != $this->verifyCode) {
            $this->addError($attribute, '*验证码不正确！');
        }

    }
}