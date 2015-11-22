<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\Variable;
use frontend\models\Article;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入


/**
 * 网站首页 登
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        $bannerList=Material::find()->where(['materialId'=>Variable::$materialId_banner])->orderBy('sort ASC')->all();
        $articleList=Article::find()->where(['categoryId'=>Variable::$articleCat_type_news]);
        $articleList->orderBy('isIndexShow DESC');
        $articleList=$articleList->limit(4)->all();
//        print_r($bannerList);

        return $this->render(FVariable::$home_view,['bannerList'=>$bannerList,'articleList'=>$articleList]);
    }

}
