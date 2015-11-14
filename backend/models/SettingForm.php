<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/06
 * Time: 20:38
 */
namespace backend\models;
use yii\base\Model;


class SettingForm extends Model
{
    public $name;
    public $registration;
    public $website;
    public $logo;
    public $copyright;
    public $email;
    public $background;
    public $phone;
    public $addr;

    public function rules()
    {
        return array(
            //去掉收尾空格
            [['name', 'registration','website','copyright','email','phone','addr'], 'trim'],
            [
                ['name'],
                'required',
                'message'=>'请输入网站名称'
            ],
            [
                ['registration'],
                'required',
                'message'=>'请输入备案号'
            ],
            [
                ['website'],
                'required',
                'message'=>'请填写公司网址'
            ],
            [
                ['copyright'],
                'required',
                'message'=>'请填写网站版权'
            ],
            [
                ['addr'],
                'required',
                'message'=>'请填写公司地址'
            ],
        );
    }
    //场景
//    public function scenarios()
//    {
//        return [
//            'create' =>['name', 'code','phone','url','inPostage','outPostage','status'],
//            'update' =>['name', 'code','phone','url','inPostage','outPostage','status'],
//        ];
//    }
}