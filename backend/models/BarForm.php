<?php
namespace backend\models;
use yii\base\Model;

class BarForm extends Model
{
    public $id;
    public $name;
    public $isTop;
    public $link;
    public $parentBar;
    public $count;
    public $sort;

    public function rules()
    {
        return array(
            [['name', 'isTop','link','parentBar','sort'], 'trim'],
            [
                ['name'],
                'required',
                'message'=>'请输入导航栏的名称'
            ],
//            [
//                ['address'],
//                'required',
//                'message'=>'请输入招聘城市'
//            ],
//            [
//                ['group'],
//                'required',
//                'message'=>'请选择招聘性质'
//            ],
//            [
//                ['count'],
//                'required',
//                'message'=>'请输入招聘人数'
//            ],
//            [
//                ['sendEmail'],
//                'required',
//                'message'=>'请设置接收简历的邮箱'
//            ]
        );
    }
    //场景
    public function scenarios()
    {
        return [
            'create' =>['name','link','sort'],
            'update' =>['name','link','sort']

        ];
    }
}