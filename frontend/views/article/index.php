<?php
use yii\data\Pagination;
use yii\widgets\LinkPager;
use common\widgets\FVariable;
?>
<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/new.css');
?>
<?=$this->render('/layouts/tabbar',['cur'=>''])?>
<div class="top_banner"></div>
<div class="content_pg layout1190">
    <div class="breadlink">您当前位置：<span class="cl_c">新闻列表</span></div>
    <div class="bd">
        <?php
        foreach($countries as $k=>$v){
            echo ' <div class="box">';
            $pic=FVariable::$domainUrl.$v->pic;
            $url=Yii::$app->urlManager->createUrl([FVariable::$articleDetail_url,'id'=>$v->id]);
            echo ' <div class="img"><a href="'.$url.'"><img src="'.$pic.'"></a></div>';
            echo ' <div class="tit"><a href="'.$url.'">'.$v->title.'</a></div>';
            echo ' <div class="date">'.date('Y-m-d',strtotime($v->publishTime)).'</div>';
            echo '<div class="intro">'.$v->description.'</div>';
            echo ' <div class="more"><a href="'.$url.'">More>></a></div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="bto">
<!--        <div class="links">-->
<!--            <p><span>上一篇文章：</span><a href="#">橙汁先生再获b轮注资</a></p>-->
<!--            <p><span>下一篇文章：</span><a href="#">橙汁先生入驻萝岗万达广场</a></p>-->
<!--        </div>-->
        <style>
            .page ul li{
                float: left;
                width: 30px;
                height: 30px;
                margin-right: 5px;
                line-height: 30px;
                border-radius: 50%;
                text-align: center;
                text-align: center;
                font-size: 20px;
                font-family: "arial";

            }
            /*.page   a:link{*/
                /*color: #f7f5f3;*/
            /*}*/
            /*.page   a:visited{*/
                /*color: #FFFFFF;*/
            /*}*/
            /*.page   a:hover{*/
                /*color: #FFFFFF;*/
            /*}*/
            /*.page   a:active{*/
                /*color: #FFFFFF;*/
            /*}*/

            .cur {
                background: #f76540;
                color: #fff;
            }
            .cur a{
                color: #FFFFFF;
            }
        </style>
        <div class="page">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel'=>'>',
                'activePageCssClass'=>'cur ',
                'options'=>['class'=>"",],
                'prevPageLabel'=>false,
//                'firstPageLabel'=>'1',
//                'lastPageLabel'=>'末页'
            ]); ?>
        </div>
    </div>
</div>