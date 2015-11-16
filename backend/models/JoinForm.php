<?php
namespace backend\models;
use yii\base\Model;


class JoinForm extends Model
{
    public $username;
    public $mobile;
    public $company;
    public $industry;
    public $email;
    public $nature;
    public $inCity;
    public $area;
    public $inMoney;
    public $inCount;
    public $inPlace;
    public $inSource;
    public $hardwareSource;
    public $experience;
    public $status;
    public $applyTime;

    public function rules()
    {
        return array(
            //去掉收尾空格
            [['status'], 'trim'],
            [
                ['status'],
                'required',
                'message'=>'请选择状态'
            ],
        );
    }
    //场景
    public function scenarios()
    {
        return [
            'update' => ['status'],
        ];
    }
}