<?php

namespace frontend\controllers;
use common\widgets\FVariable;

use common\widgets\JsonParser;
use common\widgets\Variable;
use frontend\models\Article;
use frontend\models\Join;
use frontend\models\Material;
use yii\web\Controller;//集成的Controller必须引入


class AboutController extends Controller
{
    public function actionIndex()
    {

        return $this->render(FVariable::$aboutIndex_view);
    }
    public function actionJoin()
    {

        return $this->render(FVariable::$aboutJoin_view);
    }
    public function actionApply(){

        $req=\Yii::$app->request;
        $username=trim($req->post('username'));

        $mobile=trim($req->post('mobile'));

        $company=trim($req->post('company'));
        $industry=trim($req->post('industry'));
        $email=trim($req->post('email'));
        $nature=trim($req->post('nature'));
        $inCity=trim($req->post('inCity'));
        $area=trim($req->post('area'));
        $inMoney=trim($req->post('inMoney'));
        $inCount=trim($req->post('inCount'));
        $inPlace=trim($req->post('inPlace'));
        $hardwareSource=trim($req->post('hardwareSource'));
        $experience=trim($req->post('experience'));
        $inSource=trim($req->post('inSource'));

        if((new Join())->addOneJoin($username,$mobile,$company,$industry,$email,$nature,$inCity,$area,$inMoney,$inCount,$inPlace,$hardwareSource,$experience,$inSource)){
            JsonParser::GenerateJsonResult('_0000','感谢您的申请，我们会尽快联系您的');
            exit;
        }
        JsonParser::GenerateJsonResult('_0001','申请提交失败，请刷新重试');
        exit;
    }
}
