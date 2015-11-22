<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\Variable;
use frontend\models\Customer;
use frontend\models\Article;
use frontend\models\Bar;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入


class AtController extends Controller
{
    public function actionIndex()
    {

        $modelList=Customer::find()->all();
        $list=[];
        foreach($modelList as $k=>$v) {
            $name = null;
            if ($v->parent) {
                $name = $v->parent->name;
            }
            $data = [
                'id' => $v->id,
                'name' => $v->name,
                'clogo' => $v->clogo,
                'blogo' => $v->blogo,
            ];
            if ($name) {
                $list[$name][] = $data;
            }
        }
        return $this->render(FVariable::$atIndex_view,['list'=>$list]);
    }
    public function actionGet(){
        $modelList=Customer::find()->where(['level'=>Variable::$customer_type_w])->all();
        $jsonList=[];
        foreach($modelList as $k=>$v){
            if($v->level!=Variable::$customer_type_w){
                continue;
            }
            if(empty($v->parentId)){
                continue;
            }
            if(!isset($v->parent) || empty($v->parent)){
                continue;
            }
            $id='1_'.$v->parent->id;
            $item=[];
            $tmp=[];
            $pic=[];
            if($v->img1){
                array_push($pic,FVariable::$domainUrl.$v->img1);
            }
            if($v->img2){
                array_push($pic,FVariable::$domainUrl.$v->img2);
            }
            if($v->img3){
                array_push($pic,FVariable::$domainUrl.$v->img3);
            }
            if($v->img4){
                array_push($pic,FVariable::$domainUrl.$v->img4);
            }
            if($v->img5){
                array_push($pic,FVariable::$domainUrl.$v->img5);
            }
            $tmp=[
                'name'=>$v->name,
                'pic'=>$pic,
            ];
            $jsonList[$id]['item'][]=$tmp;
        }
        echo(json_encode($jsonList));
    }

}
