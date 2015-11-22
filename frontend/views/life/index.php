<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/life.css');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'life'])?>
<div class="top_banner"></div>

<div class="life_wp">
    <div class="life_bg layout1280">
        <?php


        ?>
        <div class="sidermeun">
            <h2>橙鲜生活</h2>
            <ul>
                <?php
                use common\widgets\FVariable;
                foreach($modelList as $k=>$v){
                    $class='';
                    if($id==$v->categoryId){
                        $class='cur';
                    }
                 echo ' <li><a class="'.$class.'" href="'.Yii::$app->urlManager->createUrl([FVariable::$lifeIndex_url,'id'=>$v->categoryId]).'">'.$v->title.'</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="ly-right">
            <h2 class="fm ft26"><?=$model->title?></h2>
            <p class="ft14"><?=$model->content;?></p>
        </div>
    </div>
</div>