<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/17
 * Time: 11:23
 */
namespace backend\models;
use yii\base\Model;

class MaterialForm extends Model
{
    public $pcUrl;
    public $id;
    public $sort;
    public $address;
    public $isShow;
    public $materialId;
    public $wapUrl;

    public function rules()
    {
        return array(
            [['pcUrl', 'sort','address','isShow','materialId','wapUrl'], 'trim'],
//            [
//                ['pcUrl'],
//                'required',
//                'message'=>'请输入图片跳转链接'
//            ],
            [
                ['address'],
                'required',
                'message'=>''
            ],
            [
                ['sort'],
                'required',
                'message'=>'请输入显示顺序'
            ],
            [
                ['isShow'],
                'required',
                'message'=>'请选择是否展示'
            ]
        );
    }
    //场景
    public function scenarios()
    {
        return [
            'banner' =>['pcUrl', 'sort','address','isShow','materialId','wapUrl'],
            'auth' =>['address','isShow','sort','pcUrl'],
            'update' =>['pcUrl', 'sort','address','isShow','materialId'],
            'probanner' =>[ 'sort','address','isShow','materialId'],
        ];
    }
}