<?php
use common\widgets\FVariable;
?>
<div class="gol_nav_wp">
    <div class="gol_nav layout1190">
        <ul>
            <li <?php echo $cur=="index" ? "class='cur'" : "" ?>><a href="<?=FVariable::$home_url?>">首页</a></li>
            <li <?php echo $cur=="pro" ? "class='cur'" : "" ?>><a href="<?=FVariable::$productIndex_url?>">产品</a></li>
            <li <?php echo $cur=="orc" ? "class='cur'" : "" ?> ><a href="<?=FVariable::$productOrchard_url?>">果园</a></li>
            <li <?php echo $cur=="at" ? "class='cur'" : "" ?>><a href="<?=FVariable::$atIndex_url?>">在中国</a></li>
            <li <?php echo $cur=="service" ? "class='cur'" : "" ?>><a href="<?=FVariable::$serviceIndex_url?>">服务</a></li>
            <li <?php echo $cur=="life" ? "class='cur'" : "" ?>><a href="<?=FVariable::$lifeIndex_url?>">橙鲜生活</a></li>
            <li <?php echo $cur=="about" ? "class='cur'" : "" ?>><a href="<?=FVariable::$aboutIndex_url?>">关于我们</a></li>
            <li class="search"><a class="iconfont" href="#">&#xe603;</a></li>
        </ul>
        <div class="fast">
            <a class="bg" href="<?=FVariable::$aboutJoin_url?>"></a>
            <div class="hum"></div>
        </div>
    </div>
</div>