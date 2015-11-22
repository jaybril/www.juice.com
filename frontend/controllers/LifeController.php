<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\Variable;
use frontend\models\Article;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入


class LifeController extends Controller
{
    public function actionIndex(){
        $categoryId=\Yii::$app->request->get('id');
        $list=[Variable::$articleCat_type_good,Variable::$articleCat_type_nutrition,Variable::$articleCat_type_people];
        if(!in_array($categoryId,$list)){
            $categoryId=Variable::$articleCat_type_nutrition;
        }
        $model=Article::findOne(['categoryId'=>$categoryId]);
        $modelList=Article::find()->where(['in','categoryId',$list])->all();

        return $this->render(FVariable::$lifeIndex_view,['model'=>$model,'modelList'=>$modelList,'id'=>$categoryId]);
    }

}
