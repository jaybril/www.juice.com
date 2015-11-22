<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\widgets\FVariable;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="gol_header layout1190">
    <div class="bd"><a class="logo" href="<?=FVariable::$home_url?>"></a></div>
</div>
<!--<div class="wrap">-->
<!--    <div class="container">-->
        <?= $content ?>
<!--    </div>-->
<!--</div>-->

<footer class="footer">
    <div class="gol_contact_wp">
        <div class="gol_contact">
            <div class="ly-lt">
                <?php
                use frontend\models\Bar;

//                $modelList=Bar::find()->all();
//                $list=[];
//                foreach($modelList as $k=>$v) {
//                    $name = null;
//                    if ($v->parent) {
//                        $name = $v->parent->name;
//                    }
//                    $data = [
//                        'id' => $v->id,
//                        'link' => $v->link,
//                        'name' => $v->name,
//                    ];
//                    if ($name) {
//                        $list[$name][] = $data;
//                    }
//                }
//                print_r($list);
//                foreach($list as $k=>$v){
//                    if(!$k){
//                        continue;
//                    }
//                    echo '<dl>';
//                    echo '<dt>'.$k.'</dt>';
//                foreach($v as $kk=>$vv){
//                        echo '<dd><a href="'.$vv['link'].'">'.$vv['name'].'</a></dd>';
//                    }
//                    echo '</dl>';
//
//                }


                $parent=Bar::findAll(['isTop'=>0]);
                $list=[];
                foreach($parent as $k=>$v){
                    $m=Bar::findAll(['parentBar'=>$v->id]);
                    echo '<dl>';
                    echo '<dt>'.$v->name.'</dt>';
                    foreach($m as $kk=>$vv){
                        echo '<dd><a href="'.$vv->link.'">'.$vv['name'].'</a></dd>';
                    }
                    echo '</dl>';
                }
                ?>
            </div>
            <div class="ly-rt">
                <div class="search_wp">
                    <form action="#" method="post">
                        <input class="transition" type="text" value="" />
                        <button class="btn" type="submit"></button>
                        <div class="iconfont">&#xe602;</div>
                    </form>
                </div>
                <div class="ext">
                    <h3>联系我们</h3>
                    <ul>
                        <li id="weixin" class="wx">
                            <div class="ico"></div>
                            <p>点击<br/>扫码关注</p>
                        </li>
                        <li class="weibo">
                            <div class="ico"><a href="#"></a></div>
                            <p>点击<br/>进入微博</p>
                        </li>
                        <li class="tel">
                            <div class="ico"></div>
                            <p>客服热线<span><br/>400-6166400</span></p>
                        </li>
                        <li class="add">
                            <div class="ico"><a href="http://map.baidu.com/?newmap=1&ie=utf-8&s=s%26wd%3D橙鲜科技"></a></div>
                            <p>公司地址<br/><span>广州番禺</span></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="weixin-main" class="weixin-main"></div>
        </div>
    </div>

    <div class="gol_footer_wp">
        <div class="gol_footer">
            <div class="ly_lt"><a href="<?=FVariable::$employIndex_url?>">招贤纳士</a><a href="<?=FVariable::$articleIndex_url?>">新闻中心</a></div>
            <div class="ly_rt">
                <p>广东橙鲜智能科技有限公司&nbsp;&nbsp;粤ICP备12040230号<br/>COPYRIGHT@2014 JUICE,ALLRIGHTRESERV</p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
