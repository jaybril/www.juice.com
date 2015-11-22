<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/pro.css');
AppAsset::addScript($this,'@web/js/pro.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'pro'])?>
<div class="swiper-container banner_max" id="banner_max">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="banner_1_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="banner_1 layout1062">
                    <div class="h1">- 橙汁先生视频 －</div>
                    <div class="border"></div>
                    <div class="swiper-container gallery">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="tit">橙汁先生全新功能产品首登万达</div>
                                <div class="img">
                                    <img src="/images/local/v.jpg" />
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tit">橙汁先生全新功能产品首登万达222</div>
                                <div class="img">
                                    <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="264"

                                           data-setup="{}">
                                        <?php
                                        $ads=\common\widgets\FVariable::$domainUrl.$model->address;
                                        ?>
                                        <source src="<?=$ads;?>" type='video/swf' />
                                        <source src="<?=$ads?>" type='video/mp4' />
                                        <source src="<?=$ads?>" type='video/mp3' />
                                        <source src="<?=$ads?>" type='video/webm' />
                                        <source src="<?=$ads?>" type='video/ogg' />
                                        <source src="<?=$ads?>" type='video/mov' />
                                        <track kind="captions" src="/video/demo.captions.vtt" srclang="en" label="English"></track>
                                        <track kind="subtitles" src="/video/demo.captions.vtt" srclang="en" label="English"></track>
                                    </video>
<!--                                    <script language="JavaScript">-->
<!--                                        var n = '<iframe height=100% width=100% src="http://player.youku.com/embed/XMTM0NjE5NDg3Ng==" frameborder=0 allowfullscreen ></iframe>';-->
<!--                                        var moz = '<embed src="--><?//=\common\widgets\FVariable::$domainUrl.$model->address?>//" wmode="transparent" allowFullScreen="true" quality="high" width="100%" height="100%" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';
//
<!--//                                        if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){-->
<!--//                                            document.write(moz)-->
<!--//                                        }else{-->
<!--//                                            document.write(n)-->
<!--//                                        }-->
<!--//                                    </script>-->
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tit">橙汁先生全新功能产品首登万达3333</div>
                                <div class="img">
                                    <img src="/images/local/v.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/images/local/v_small.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/local/v_small.jpg" />
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/local/v_small.jpg" />
                            </div>
                        </div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="banner_2_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="layout1190">
                    <img class="img" src="/images/pro/b2-img.png" />
                    <div class="btn_wp">
                        <div class="btn cur" data-src="/images/pro/b2-img.png">
                            <img class="big" src="/images/pro/1.png" />
                            <img class="small" src="/images/pro/1_s.png" />
                        </div>
                        <div class="btn" data-src="/images/pro/b2-1-img.png">
                            <img class="big" src="/images/pro/2.png" />
                            <img class="small" src="/images/pro/2_s.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
            <div class="swiper-container banner_3_wp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <ul>
                            <li class="y1">
                                <div class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0"></div>
                                <p class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.3s"></p>
                            </li>
                            <li class="y2">
                                <div class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0"></div>
                                <p class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.3s"></p>
                            </li>
                            <li class="y3">
                                <div class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0"></div>
                                <p class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.3s"></p>
                            </li>
                            <li class="y4">
                                <div class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0"></div>
                                <p class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.3s"></p>
                            </li>
                            <li class="y5">
                                <div class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0"></div>
                                <p class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.3s"></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="banner_4_wp">
                <ul class="myroundabout">
                    <?php
                    foreach($list as $k=>$v){
                        $pic=\common\widgets\FVariable::$domainUrl.$v->address;
                        echo '   <li class="roundabout-moveable-item">';
                        echo '<a href="" target="_blank"><img src="'.$pic.'" /></a>';
                        echo ' </li>';

                    }
                    ?>
<!--                    <li class="roundabout-moveable-item">-->
<!--                        <a href="" target="_blank"><img src="/images/pro/11.jpg" /></a>-->
<!--                    </li>-->
<!--                    <li class="roundabout-moveable-item">-->
<!--                        <a href="" target="_blank"><img src="/images/pro/22.jpg" /></a>-->
<!--                    </li>-->
<!--                    <li class="roundabout-moveable-item">-->
<!--                        <a href="" target="_blank"><img src="/images/pro/33.jpg" /></a>-->
<!--                    </li>-->
<!--                    <li class="roundabout-moveable-item">-->
<!--                        <a href="" target="_blank"><img src="/images/pro/44.jpg" /></a>-->
<!--                    </li>-->
<!--                    <li class="roundabout-moveable-item">-->
<!--                        <a href="" target="_blank"><img src="/images/pro/55.jpg" /></a>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="swiper-pagination banner_max-pagination"></div>
</div>