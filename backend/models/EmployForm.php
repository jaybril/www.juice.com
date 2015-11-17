<?php
namespace backend\models;
use yii\base\Model;

class EmployForm extends Model
{
    public $department;
    public $employName;
    public $address;
    public $employCode;
    public $group;
    public $count;
    public $money;
    public $type;
    public $category;
    public $description;
    public $sendEmail;
    public $status;

    public function rules()
    {
        return array(
            [['department', 'employName','address','employCode','group','count','money','type','category','description','sendEmail','status'], 'trim'],
            [
                ['employName'],
                'required',
                'message'=>'请输入职位名称'
            ],
            [
                ['address'],
                'required',
                'message'=>'请输入招聘城市'
            ],
            [
                ['group'],
                'required',
                'message'=>'请选择招聘性质'
            ],
            [
                ['count'],
                'required',
                'message'=>'请输入招聘人数'
            ],
            [
                ['sendEmail'],
                'required',
                'message'=>'请设置接收简历的邮箱'
            ]
        );
    }
    //场景
    public function scenarios()
    {
        return [
            'create' =>['department', 'employName','address','employCode','group','count','money','type','category','description','sendEmail','status'],
            'update' =>['department', 'employName','address','employCode','group','count','money','type','category','description','sendEmail','status'],

        ];
    }
}