<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/orc.css');
AppAsset::addScript($this,'@web/js/orc.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'orc'])?>
<div class="swiper-container banner_max" id="banner_max">
    <div class="swiper-wrapper">
        <!-- banner1 -->
        <div class="swiper-slide">
            <div class="banner1_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="tit_txt ani" swiper-animate-effect="fadeInLeft"  swiper-animate-duration="1s" swiper-animate-delay="0"></div>
                            <ul>
                                <li class="ani p1" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0"></li>
                                <li class="ani p2" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.1s"></li>
                                <li class="ani p3" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"></li>
                                <li class="ani p4" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.3s"></li>
                                <li class="ani p5" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s"></li>
                                <li class="ani p6" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.5s"></li>
                                <li class="ani p7" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.6s"></li>
                                <li class="ani p8" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.7s"></li>
                            </ul>
                            <div class="banner1_img"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner2 -->
        <div class="swiper-slide">
            <div class="banner2_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="tit_txt ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="0"></div>
                            <ul>
                                <li class="p1"></li>
                                <li class="p2"></li>
                                <li class="p3"></li>
                                <li class="p4"></li>
                            </ul>
                            <div class="q q1 pulse animated infinite"></div>
                            <div class="q q2 flash animated infinite"></div>
                            <div class="q q3 flash animated infinite"></div>
                            <div class="q q4 flash animated infinite"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner3 -->
        <div class="swiper-slide">
            <div class="banner3_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="tit_txt ani" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner4 -->
        <div class="swiper-slide">
            <div class="banner4_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="tit_txt ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner5 -->
        <div class="swiper-slide">
            <div class="banner5_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="tit_txt ani" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner6 -->
        <div class="swiper-slide">
            <div class="banner6_wp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="tit_txt ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="0"></div>
                            <div class="txt animated"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination banner_max-pagination"></div>
</div>