<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/new.css');
?>
<?=$this->render('/layouts/tabbar',['cur'=>''])?>
<div class="top_banner"></div>

<div class="content_pg layout1190">
    <div class="breadlink">您当前位置：<a class="cl_b" href="<?=\common\widgets\FVariable::$articleIndex_url?>">新闻列表</a> <span class="cl_c">></span> <span class="cl_c">新闻内页</span></div>
    <div class="bd">
        <div class="main_content">
            <div class="date"><?=$model->publishTime;?> </div>
            <h1><?=$model->title;?></h1>
<!--            <div class="ext">橙汁先生联合uber健康跨界案</div>-->
            <div class="news_bd">
                <?=$model->content;?>
            </div>
        </div>
    </div>
    <div class="bto">
        <div class="links">
            <p>
                <span>上一篇文章：</span>
                <?php
                $former='';
                if($formerModel){
                    $former='<a href="'.Yii::$app->urlManager->createUrl([\common\widgets\FVariable::$articleDetail_url,'id'=>$formerModel->id]).'">'.$formerModel->title.'</a>';
                }
                echo $former;
                ?>
            </p>
            <p>
                <span>下一篇文章：</span>
                <?php
                $later='';
                if($laterModel){
                    $later='<a href="'.Yii::$app->urlManager->createUrl([\common\widgets\FVariable::$articleDetail_url,'id'=>$laterModel->id]).'">'.$laterModel->title.'</a>';
                }
                echo $later;
                ?>
            </p>
        </div>
    </div>
</div>