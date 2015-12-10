<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\Variable;
use frontend\models\Article;
use frontend\models\Material;
use yii\data\Pagination;
use yii\web\Controller;//集成的Controller必须引入
use Yii;

/**
 * 网站首页 登
 */
class ArticleController extends Controller
{

    public function actionIndex(){
        $query = Article::find()->andWhere(['categoryId'=>Variable::$articleCat_type_news]);
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('isTop DESC,addTime DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render(FVariable::$articleIndex_view,[
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }
    public function actionDetail(){

        $id=Yii::$app->request->get('id');
        if(empty($id)){
            $this->redirect(FVariable::$articleIndex_url);
            return;
        }
        (new Article())->updateArticleLookCount($id);
        $model=Article::findOne($id);
        $formerModel=Article::find()->where(['<','id',$id])->andWhere(['categoryId'=>Variable::$articleCat_type_news])->orderBy('id DESC')->limit(1)->one();
        $laterModel=Article::find()->where(['>','id',$id])->andWhere(['categoryId'=>Variable::$articleCat_type_news])->orderBy('id DESC')->limit(1)->one();

        return $this->render(FVariable::$articleDetail_view,['model'=>$model,'formerModel'=>$formerModel,'laterModel'=>$laterModel]);
    }

}
