<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\Variable;
use frontend\models\Article;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入


class ProductController extends Controller
{
    public function actionIndex()
    {
        $model=Material::findOne(['materialId'=>Variable::$materialId_productVideo]);
        $list=Material::findAll(['materialId'=>Variable::$materialId_auth]);

        return $this->render(FVariable::$productIndex_view,['model'=>$model,'list'=>$list]);
    }
    public function actionOrchard(){
        return $this->render(FVariable::$productOrchard_view);

    }

}
