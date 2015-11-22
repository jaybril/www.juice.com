<?php
use frontend\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'@web/css/join.css');
AppAsset::addScript($this,'@web/js/join.js');
?>
<?=$this->render('/layouts/tabbar',['cur'=>'about'])?>
<!-- banner1 -->
<div class="swiper-container meun_banner banner1_wp">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="layout1190">
                <div class="h1">- 加盟条件 －</div>
                <ul>
                    <li class="ani p1" swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0"></li>
                    <li class="ani p2" swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"></li>
                    <li class="ani p3" swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0.4s"></li>
                    <li class="ani p4" swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0.6s"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- banner2 -->
<div class="swiper-container meun_banner banner2_wp">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="layout1190">
                <div class="h1">- 加盟流程 －</div>
                <div class="ani txt" swiper-animate-effect="bounceIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s"></div>
            </div>
        </div>
    </div>
</div>
<!-- banner3 -->
<div class="meun_banner banner3_wp">
    <div class="h1">- 常见问题 －</div>
    <div class="swiper-container qa_wp layout1190">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <dl>
                    <dt>Q:  每台橙汁先生满载可以完成榨汁多少杯？</dt>
                    <dd>A:  满载的情况下，每台设备可榨汁100杯左右。</dd>
                </dl>
                <dl>
                    <dt>Q:  橙汁先生可以摆放在哪些场所？</dt>
                    <dd>A:  橙汁先生适用投放的渠道非常多元化，包括机场、高铁站、地铁站、购物、中心医院、儿童乐园、电影院等。</dd>
                </dl>
                <dl>
                    <dt>Q:  一个城市是否只授权一个加盟商？授权期限是多久？</dt>
                    <dd>A:  一个城市原则上只授权一个加盟商，大型城市按渠道、区域授予多家加盟商。授权期限一般为3至5年。</dd>
                </dl>
                <dl>
                    <dt>Q:  是否可以购买橙汁先生设备？</dt>
                    <dd>A:  我们的设备不出售。在设备租赁期间，您拥有设备的使用权，但不拥有产权。</dd>
                </dl>
                <dl>
                    <dt>Q:  申请人没有自动售卖机运营经验可以申请为加盟商吗？</dt>
                    <dd>A:  可以，申请人不一定必需具备自动售卖机运营经验。在其他条件相同的情况下，优先考虑具有自动售卖机、零售或者连锁加盟经验的申请者。</dd>
                </dl>
            </div>
            <div class="swiper-slide">
                <dl>
                    <dt>Q:  每台橙汁先生满载可以完成榨汁多少杯？</dt>
                    <dd>A:  满载的情况下，每台设备可榨汁100杯左右。</dd>
                </dl>
                <dl>
                    <dt>Q:  橙汁先生可以摆放在哪些场所？</dt>
                    <dd>A:  橙汁先生适用投放的渠道非常多元化，包括机场、高铁站、地铁站、购物、中心医院、儿童乐园、电影院等。</dd>
                </dl>
                <dl>
                    <dt>Q:  一个城市是否只授权一个加盟商？授权期限是多久？</dt>
                    <dd>A:  一个城市原则上只授权一个加盟商，大型城市按渠道、区域授予多家加盟商。授权期限一般为3至5年。</dd>
                </dl>
                <dl>
                    <dt>Q:  是否可以购买橙汁先生设备？</dt>
                    <dd>A:  我们的设备不出售。在设备租赁期间，您拥有设备的使用权，但不拥有产权。</dd>
                </dl>
                <dl>
                    <dt>Q:  申请人没有自动售卖机运营经验可以申请为加盟商吗？</dt>
                    <dd>A:  可以，申请人不一定必需具备自动售卖机运营经验。在其他条件相同的情况下，优先考虑具有自动售卖机、零售或者连锁加盟经验的申请者。</dd>
                </dl>
            </div>
        </div>
        <div class="swiper-pagination qa-swiper-pagination"></div>
    </div>
</div>
<!-- banner4 -->
<div class="meun_banner banner4_wp">
    <div class="h1">- 在线申请 －</div>
    <div class="sub">
            <table>
                <tr>
                    <td><div class="cl_wp c1_1"><input id="username" class="ipt" type="text" value="" placeholder="您的姓名" /></div></td>
                    <td><div class="cl_wp c1_2"><input id="mobile" class="ipt" type="text" value="" placeholder="手机号码" /></div></td>
                    <td><div class="cl_wp c1_3"><input id="email" class="ipt" type="text" value="" placeholder="你的电子邮箱" /></div></td>
                </tr>
                <tr>
                    <td><div class="cl_wp c2_1"><input id="company"class="ipt" type="text" value="" placeholder="您所在公司名称（可选）" /></div></td>
                    <td>
                        <div class="cl_wp c2_2">
                            <select id="industry">
                                <option value="请选择" >请选择</option>
                                <option value="农、林、牧、渔业" >农、林、牧、渔业</option>
                                <option value="采矿业" >采矿业</option>
                                <option value="制造业" >制造业</option>
                                <option value="电力、热力、燃气及水生产和供应业" >电力、热力、燃气及水生产和供应业</option>
                                <option value="建筑业" >建筑业</option>
                                <option value="批发和零售业" >批发和零售业 </option>
                                <option value="交通运输、仓储和邮政业" >交通运输、仓储和邮政业</option>
                                <option value="住宿和餐饮业" >住宿和餐饮业</option>
                                <option value="信息传输、软件和信息技术服务业" >信息传输、软件和信息技术服务业</option>
                                <option value="金融业" >金融业</option>
                                <option value="房地产业" >房地产业</option>
                                <option value="租赁和商务服务业" >租赁和商务服务业</option>
                                <option value="科学研究和技术服务业" >科学研究和技术服务业</option>
                                <option value="水利、环境和公共设施管理业" >水利、环境和公共设施管理业</option>
                                <option value="居民服务、修理和其他服务业" >居民服务、修理和其他服务业</option>
                                <option value="教育" >教育</option>
                                <option value="卫生和社会工作" >卫生和社会工作</option>
                                <option value="文化、体育和娱乐业" >文化、体育和娱乐业</option>
                                <option value="公共管理、社会保障和社会组织" >公共管理、社会保障和社会组织</option>
                                <option value="国际组织" >国际组织</option>
                            </select>
                        </div>
                    </td>
                    <td><div class="cl_wp c2_3">
                            <select id="nature">
                                <option>请选择</option>
                                <option>国有企业</option>
                                <option>集体所有制企业</option>
                                <option>联营企业</option>
                                <option>三资企业</option>
                                <option>私营企业及其他企业</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><div class="cl_wp c3_1"><input id="inCity" class="ipt" type="text" value="" placeholder="您常住城市" /></div></td>
                    <td><div class="cl_wp c3_2"><input id="area" class="ipt" type="text" value="" placeholder="您想要代理的城市" /></div></td>
                    <td><div class="cl_wp c3_3"><input id="inMoney" class="ipt" type="text" value="" placeholder="您将预计投入的资金" /></div></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="place_meun" class="cl_wp c4_1">
                            <a class="cur" href="javascript:void(0)" data-type="airport">机场</a>
                            <a href="javascript:void(0)" data-type="rail">高铁</a>
                            <a href="javascript:void(0)" data-type="subway">地铁</a>
                            <a href="javascript:void(0)" data-type="market">商场</a>
                            <a href="javascript:void(0)" data-type="hospital">医院</a>
                            <a href="javascript:void(0)" data-type="school">学校</a>
                            <a href="javascript:void(0)" data-type="cinema">影院</a>
                            <a class="last" href="javascript:void(0)" data-type="other">其它</a>
                            <input id="place" type="hidden" name="place" value="airport" />
                        </div>
                    </td>
                    <td><div class="cl_wp c4_2"><input id="inCount" class="ipt" type="text" value="" placeholder="您将预放的机器台数" /></div></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="cl_wp c5_1">
                            <input id="inSource" class="ipt"  type="text" name="" value="" placeholder="请填写您计划投放的场所名称及数量，如：万达广场3台，高铁站3台" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="cl_wp c6_1">
                            <input id="experience" class="ipt"  type="text" name="" value="" placeholder="请描述零售从业经验或相关管理经验，如：3年从事果吧经营经验" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="cl_wp c7_1">
                            <input id="hardwareSource" class="ipt"  type="text" name="" value="" placeholder="请描述是否具有配送车辆、配送人员及冷库，如：配送车2部，配送人员2人，冷库已自有或可租赁
" />
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn" type="button" onclick="apply()"></button>
    </div>
</div>