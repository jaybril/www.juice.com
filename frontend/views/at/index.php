<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/at.css');
AppAsset::addScript($this,'@web/js/at.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'at'])?>
<div class="top_banner"></div>

<div class="content_pg layout1190">
    <div class="tit"><img src="/images/at/s.png"></div>
    <?php
    use common\widgets\FVariable;
    foreach($list as $k=>$v){
        if(!$k){
            continue;
        }
        echo '<dl class="dl">';
        echo '<dt>'.$k.'：</dt>';
        echo '<dd>';
        foreach($v as $kk=>$vv){
            $model=$v[$kk];
            $clogo=FVariable::$domainUrl.$model['clogo'];
            $blogo=FVariable::$domainUrl.$model['blogo'];
            ?>
            <style>
                .d_1_<?=$vv['id']?>{ background: url("<?=$blogo?>") no-repeat;}
                .d_1_<?=$vv['id']?>:hover{ background: url("<?=$clogo?>") no-repeat;}
            </style>
    <?php
            echo '<a onclik="initClick()" class="d_a d_1_'.$vv['id'].'" data-id="1_'.$vv['id'].'" href="javascript:void(0)"></a>';
        }
        echo'</dd>';
        echo '</dl>';

    }
    ?>
</div>
<script id="center_bd" type="text/html">
    <div class="center_bd">
        <div class="swiper-container gallery">
            <div class="swiper-wrapper">
                <% for(i = 0; i < pic.length; i ++) {%>
                <div class="swiper-slide">
                    <img src="<%= pic[i] %>" />
                </div>
                <% } %>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="close"></div>
    </div>
</script>
<script id="layer_open" type="text/html">
    <div class="layer_open">
        <div class="logo_main">
            <div class="left_meun">
                <% for(i = 0; i < item.length; i ++) {%>
                <a href="javascript:void(0)"><%= item[i].name %></a>
                <% } %>
            </div>
            <!-- 画册位置 -->
            <div class="gallery_wp">

            </div>
        </div>
    </div>
</script>