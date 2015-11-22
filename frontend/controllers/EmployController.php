<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\GlobalArray;
use common\widgets\JsonParser;
use common\widgets\Variable;
use frontend\models\Customer;
use frontend\models\Article;
use frontend\models\Bar;
use frontend\models\Employ;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入
use yii\data\Pagination;


class EmployController extends Controller
{
    public function actionIndex()
    {

        $query = Employ::find();
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('publishTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(FVariable::$employIndex_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionGet(){

//        var data = {
//            "title": "资产主管Assets Supervisor",
//                    "id": "04189",
//                    "obj": "全职111",
//                    "add": "天津市",
//                    "order": "1",
//                    "money": "面谈",
//                    "date": "2015-05-05",
//                    "type": "社招",
//                    "item": "支持中心岗位",
//                    "intro": "本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法顺利有效经营本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法顺利有效经营本职位对橙汁先生的贡献在于：代表公司与业主进行沟通和对合同及业主关系进行管理确保我们的资产合法"
//
//                };
        $id=\Yii::$app->request->post('id');
        if(!$id){
            JsonParser::GenerateJsonResult('_0001','无数据');
            exit;
        }
        $model=Employ::findOne($id);
        $g=$model->group?$model->group:2;
        $g=GlobalArray::$employGroupArr[$g];
        $t=$model->type?$model->type:2;
        $t=GlobalArray::$employTypeArr[$t];
        $s=$model->status?$model->status:0;
        $s=GlobalArray::$employStatusArr[$s];
        $data=[];
        $data= [
            "title"=>$model->employName,
            "id"=>$model->id,
            "obj"=> $g,
            "add"=>$model->address,
            "order"=> $model->count,
            "money"=> $model->money,
            "date"=>date('Y-m-d',strtotime($model->publishTime)),
            "type"=> $t,
            "item"=>$model->category,
            "intro"=> $model->description,
            "email"=> $model->sendEmail
        ];
        echo json_encode($data);
        exit;


    }

}
