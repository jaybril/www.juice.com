<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2015/9/17
     * Time: 11:23
     */
    namespace backend\models;
    use yii\base\Model;

    class ArticleForm extends Model
    {
        public $id;
        public $title;
        public $keywords;
        public $author;
        public $categoryId;
        public $useId;
        public $content;
        public $status;
        public $isTop;
        public $description;
        public $pic;
        public $isIndexShow;

        public function rules()
        {
            return array(
                [['title', 'keywords','author','categoryId','useId','content','status','isTop','description','pic','isIndexShow'], 'trim'],
                [
                    ['title'],
                    'required',
                    'message'=>'请输入标题'
                ],
//                [
//                    ['keywords'],
//                    'required',
//                    'message'=>'请输入关键字'
//                ],
//                [
//                    ['categoryId'],
//                    'required',
//                    'message'=>'请输入文章分类'
//                ],
//                [
//                    ['content'],
//                    'required',
//                    'message'=>'请输入文章内容'
//                ],
//                [
//                    ['status'],
//                    'required',
//                    'message'=>'请选择发布状态'
//                ],
                [
                    ['isTop'],
                    'required',
                    'message'=>'请选择是否置顶'
                ],
//                [
//                    ['description'],
//                    'required',
//                    'message'=>'请填写文章简介'
//                ],
                [
                    ['isIndexShow'],
                    'required',
                    'message'=>'请选择是否首页展示'
                ],
            );
        }
        //场景
        public function scenarios()
        {
            return [
                'create' =>['title','author','useId','content','isTop','description','pic','isIndexShow'],
                'update' =>['title','author','useId','content','isTop','description','pic','isIndexShow'],
                'editLiftObject' =>['content'],
                'service' =>['title','keywords','pic','useId','content'],
            ];
        }
    }