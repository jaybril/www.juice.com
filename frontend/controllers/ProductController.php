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
        $bannerList=Material::find()->where(['materialId'=>Variable::$materialId_banner])->orderBy('sort ASC')->all();
        $model=Material::findOne(['materialId'=>Variable::$materialId_productVideo]);
        $list=Material::findAll(['materialId'=>Variable::$materialId_auth]);

        return $this->render(FVariable::$productIndex_view,['model'=>$model,'list'=>$list,'bannerList'=>$bannerList]);
    }
    public function actionOrchard(){
        return $this->render(FVariable::$productOrchard_view);

    }

}
