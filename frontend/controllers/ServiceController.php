<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\Variable;
use frontend\models\Article;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入


class ServiceController extends Controller
{
    public function actionIndex(){
        $list=Article::findAll(['categoryId'=>Variable::$articleCat_type_service]);


        return $this->render(FVariable::$serviceIndex_view,['list'=>$list]);
    }

}
