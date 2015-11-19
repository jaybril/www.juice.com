<?php
namespace backend\models;
use yii\base\Model;

class CustomerForm extends Model
{
    public $name;
    public $level;
    public $parentId;
    public $blogo;
    public $clogo;
    public $sort;

    public function rules()
    {
        return array(
            [['name', 'level','parentId','blogo','clogo','sort'], 'trim'],
            [
                ['name'],
                'required',
                'message'=>'请输入名称'
            ],
//            [
//                ['blogo'],
//                'required',
//                'message'=>'请'
//            ],
//            [
//                ['clogo'],
//                'required',
//                'message'=>'请选择招聘性质'
//            ],
        );
    }
    //场景
    public function scenarios()
    {
        return [
            'create' =>['name', 'blogo','clogo','sort','parentId'],
            'update' =>['name', 'blogo','clogo','sort','parentId'],

        ];
    }
}