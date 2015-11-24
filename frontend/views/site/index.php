<?php
use common\widgets\FVariable;
?>
<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/index.css');
AppAsset::addScript($this,'@web/js/index.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'index'])?>
<div class="swiper-container banner">
    <div class="swiper-wrapper">
        <?php
        if($bannerList){
            foreach($bannerList as $k=>$v){
                $address=FVariable::$domainUrl.$v->address;
                $wapUrl=FVariable::$domainUrl.$v->wapUrl;

                echo '<div class="swiper-slide swiper-no-swiping">';
                echo ' <div class="img" style="background: url('.$address.') no-repeat center top;"></div>';
                echo '<div class="wp">';
                echo '<div class="txt1 ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="0.2s">';
                echo '<img src="'.$wapUrl.'">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '';
                echo '';
            }
        }
        ?>
    </div>
    <div class="swiper-pagination banner-swiper-pagination"></div>
</div>

<div class="content_wp">
    <div class="content">
        <div class="ly-lt">
            <div class="swiper-container news">
                <div class="swiper-wrapper">
                    <?php
                    foreach($articleList as $k=>$v){
                        $pic=FVariable::$domainUrl.$v->pic;
                        echo '<div class="swiper-slide">';
                        echo ' <div class="img"><img src="'.$pic.'" /></div>';
                        echo '<div class="box">';
                        echo ' <h2>'.$v->title.'</h2>';
                        echo '<div class="bd">';
                        $dat=date('Y年m月d日',strtotime($v->publishTime));
                        echo '<p> '.$dat.'<br/>'.$v->description.'</p>';
                        echo ' </div>';
                        echo ' <p class="more"><a href="'.Yii::$app->urlManager->createUrl([FVariable::$articleDetail_url,'id'=>$v->id]).'">More>></a></p>';
                        echo '  </div>';
                        echo ' </div>';
                    }
                    ?>

<!--                    <div class="swiper-slide">-->
<!--                        <div class="img"><img src="/images/local/a1.jpg" /></div>-->
<!--                        <div class="box">-->
<!--                            <h2>Juice X Uber in Guangzhou</h2>-->
<!--                            <div class="bd">-->
<!--                                <p> 2225年12月12日<br/> 沪指跌3.52%顽守3000点 两市逾700股跌停 </p>-->
<!--                            </div>-->
<!--                            <p class="more"><a href="#">More>></a></p>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="swiper-pagination news-swiper-pagination"></div>
            <div class="title"></div>
        </div>
        <div class="ly-rt">
            <div class="col1"><img src="/images/local/a2.jpg" /></div>
            <div class="col2">
                <div class="ad3">
                    <script language="JavaScript">
                        var n = '<iframe height=100% width=100% src="http://player.youku.com/embed/XMTM0NjE5NDg3Ng==" frameborder=0 allowfullscreen ></iframe>';
                        var moz = '<embed src="http://player.youku.com/player.php/sid/XMTM0NjE5NDg3Ng==/v.swf" wmode="transparent" allowFullScreen="true" quality="high" width="100%" height="100%" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';

                        if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){
                            document.write(moz)
                        }else{
                            document.write(n)
                        }
                    </script>
                </div>
                <div class="ad4"><img src="/images/local/a4.jpg" /></div>
            </div>
        </div>
    </div>
</div>