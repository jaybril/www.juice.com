<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/serve.css');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'service'])?>
<div class="top_banner"></div>

<div class="content_pg layout1190">
    <?php
    use common\widgets\FVariable;
    foreach($list as $k=>$v){
        echo '<a href="'.$v->keywords.'"> <div class="box">';
        $pic=FVariable::$domainUrl.$v->pic;
        echo ' <div class="img"><img src="'.$pic.'"></div>';
        echo ' <div class="ly-rt">';
        echo '<h2 style="color: orange;font-size: 20px">'.$v->title.'</h2>';
        echo '<p style="color: #000000">'.$v->content.'</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
    ?>
</div>