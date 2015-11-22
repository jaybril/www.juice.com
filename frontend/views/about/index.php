<?php
//$this->registerCssFile('@web/css/busines.css');
//$this->registerJsFile('@web/js/busines.js');


use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/busines.css');
AppAsset::addScript($this,'@web/js/busines.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'about'])?>
<div class="swiper-container banner_max" id="banner_max">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <!-- banner1 -->
            <div class="banner1_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="h1">公司介绍</div>
                            <div class="ext ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0">
                                <p class="ft16">广东橙鲜智能科技有限公司，简称 <span class="bold cl_c">橙鲜科技</span>。</p>
                                <p class="bold ft18">宣传口号：<span class="cl_c">新鲜健康源自橙鲜</span></p>
                            </div>
                            <ul>
                                <li class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0">
                                    <p class="p1"></p>
                                    <p class="t">成立于2014年8月<br/>坐落在广东广州 !</p>
                                </li>
                                <li class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                    <p class="p2"></p>
                                    <p class="t">公司是建立在物联网科技上的新鲜现制饮料自动售卖机生产商，以关注健康、追求生活品质的顾客为目标，致力于研发生产世界一流品质的高度智能化商用机器。</p>
                                </li>
                                <li class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s">
                                    <p class="p3"></p>
                                    <p class="t">旗下全资拥有广东绿马农业发展有限公司。<br/>
                                        广东绿马农业发展有限公司是绿色健康生活态度的倡导者，力争将橙汁先生自动鲜榨橙汁售卖机全面推向中国市场。<br/>
                                        作为“橙汁先生”中国大陆地区的营运商，绿马农业负责市场营销、设备运营及品牌推广。</p>
                                </li>
                                <li class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.6s">
                                    <p class="p4"></p>
                                    <p class="t">自成立以来，我们始终专注于新鲜现制饮料售卖机的研究，为不断满足市场的需求、传播健康的生活方式不遗余力。</p>
                                </li>
                                <li class="ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.8s">
                                    <p class="p5"></p>
                                    <p class="t">目前，橙汁先生已遍布 北京、上海、广州、深圳、天津、南京、武汉、佛山、揭阳、临沂 等城市。
                                        重点投放在 机场、高铁、商超百货、大型企业、医院、儿童乐园 等场所，因其快速便捷、时尚健康等特点深受顾客好评。</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <!-- banner2 -->
            <div class="banner2_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="h1">企业定位</div>
                            <div class="ext ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0">
                                <p class="tit ft16">社会型企业</p>
                                <p class="b">社会型企业企业经营和社会责任并重，盈利与慈善同行！<br/>心怀梦想，为社会创造新的价值。
                                </p>
                            </div>
                            <ul>
                                <li class="ani p1" swiper-animate-effect="bounceIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"></li>
                                <li class="ani p2" swiper-animate-effect="bounceIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s"></li>
                                <li class="ani p3" swiper-animate-effect="bounceIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.6s"></li>
                                <li class="ani p4" swiper-animate-effect="bounceIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.8s"></li>
                            </ul>
                            <div class="ani bt_txt" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="1s" >橙鲜科技通过“千家万户工程”，帮助果农解决橙子滞销的难题，保证果农生计以及小孩上学问题。</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <!-- banner3 -->
            <div class="banner3_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="h1">文化理念</div>
                            <div class="ext ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0">
                                <p class="b">价值观是企业的灵魂和精神所在，是构建企业竞争优势、稳健发展的支柱，它支撑企业赢得客户和未来。
                                    橙鲜科技力求塑造“知行合一”的价值观，让价值观的内涵通过员工的一言一行体现出来，形成一股精神的力量，
                                    熔铸在企业的凝聚力、竞争力、生命力之中。</p>
                            </div>
                            <ul>
                                <li class="ani p1" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"></li>
                                <li class="ani p2" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s"></li>
                                <li class="ani p3" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0.6s"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <!-- banner4 -->
            <div class="banner4_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="h1">团队</div>
                            <div class="t ani" swiper-animate-effect="fadeInRight" swiper-animate-duration="0.5s" swiper-animate-delay="0"></div>
                            <div class="ext ani" swiper-animate-effect="fadeInRight" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s">
                                广东橙鲜智能科技有限公司由原美的总裁黄健先生创办。<br/><br/>
                                公司现有员工 100余人，平均年龄25岁，汇集各行业精英人员，是一个年轻又充满活力的集体。<br/>
                                我们崇尚自由与创造的生活态度，认同服务与分享的工作理念。<br/>
                                专业尽职，确保每一款产品和每一次服务都做到极致精湛和高效。<br/><br/>
                                改变中国人饮料饮用方式，将绿色、生态、有机、健康的生活理念推向全国是我们的终极目标。<br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <!-- banner5 -->
            <div class="banner5_wp">
                <img src="/images/com/arr.png" class="img_arr pt-page-moveIconUp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="h1">目标</div>
                            <div class="t-tit ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0">致力于研发世界一流品质的新鲜现制饮料自动售卖机</div>
                            <div class="t ani" swiper-animate-effect="fadeInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <!-- banner6 -->
            <div class="banner6_wp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="layout">
                            <div class="h1">市场前景</div>
                            <div class="t t1 ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"></div>
                            <div class="t t2 ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s"></div>
                            <div class="t t3 ani" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.6s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination banner_max-pagination"></div>
</div>