<?php
    use yii\helpers\Html;
    use frontend\assets\AppAsset;
    use common\widgets\GlobalArray;
    use common\widgets\Tool;
    use common\widgets\FVariable;
    AppAsset::register($this);  // $this 代表视图对象
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php //$this->beginBody() ?>
<div class="header">
    <div class="container">
        <div class="nav-logo">
            <a href="<?php echo \common\widgets\FVariable::$home_url ?>">
                <img src="/img/mplogo2.png" class="img-responsive" />
            </a>
        </div>
        <ul class="nav-menu">
            <li>
                <a href="<?php echo \common\widgets\FVariable::$home_url ?>">
                    茶市
                </a>
            </li>
            <li>
                <a href="<?php echo \common\widgets\FVariable::$productGarden_url ?>" >
                    到茶园逛逛
                </a>
            </li>
            <li>
                <a href="<?php echo \common\widgets\FVariable::$productTechnology_url ?>">
                    好茶是这样炼成的
                </a>
            </li>
            <li>
                <a href="<?php echo \common\widgets\FVariable::$productTeaceremony_url ?>">
                    茶道
                </a>
            </li>
            <li>
                <a href="">
                    满200减50
                </a>
            </li>
        </ul>
<!--        <div class="nav-vip">-->
<!--            <a href="--><?php //echo \common\widgets\FVariable::$userVipcenter_url ?><!--">-->
<!--                进入会员中心-->
<!--            </a>-->
<!--        </div>-->

<!--        <ul class="nav-userinfo">-->
<!--            <li class="mycart"><a href="">购物车(311111)</a>-->
<!--                <div class="mycart-rrow"></div>-->
<!--                <ul class="mycart-ul">-->
<!--                    <li>-->
<!--                        <div class="mycart-img"><img src="/img/index_11.png" /></div>-->
<!--                        <div class="mycart-tex">日照名坡绿茶</div>-->
<!--                        <div class="mycart-tex">3包 ￥298.00</div>-->
<!--                        <div class="mycart-del">×</div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="mycart-img"><img src="/img/index_11.png" /></div>-->
<!--                        <div class="mycart-tex">日照名坡绿茶</div>-->
<!--                        <div class="mycart-tex">3包 ￥298.00</div>-->
<!--                        <div class="mycart-del">×</div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="mycart-img"><img src="/img/index_11.png" /></div>-->
<!--                        <div class="mycart-tex">日照名坡绿茶</div>-->
<!--                        <div class="mycart-tex">3包 ￥298.00</div>-->
<!--                        <div class="mycart-del">×</div>-->
<!--                    </li>-->
<!--                    <li class="mycart-ul-lastli">-->
<!--                        <div class="cart-lastlitit">-->
<!--                            <p>共3件商品</p>-->
<!--                            <p class="money">￥298.00</p>-->
<!--                        </div>-->
<!--                        <div class="cart-lastlia"><a href="">去购物车结算</a></div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li class="mycart-name"><a href="">哈哈哈哈哈哈哈哈</a></li>-->
<!--            <li class="mycart-out"><a href="">退出</a></li>-->
<!--        </ul>-->
        <ul class="nav-userinfo">
            <?php
            $user = new \frontend\models\User();
            $cart = new \frontend\models\Cart();
            $user=$user->checkUserIsLogin();
            if (!$user) {
            ?>
                <li><a href="<?=FVariable::$siteLogin_url?>">登录</a> </li>
               <li><a href="<?=FVariable::$siteRegister_url?>">注册</a> </li>
            <?php
            }else{
                $cartUser = $cart->findById($user->id);
                if($cartUser){
                ?>
                <li class="mycart"><a href="<?=FVariable::$userMyshopping_url?>"><i class="fa fa-cart-arrow-down"></i> 购物车(<?=count($cartUser)?>)</a>

                    <div class="mycart-rrow"></div>
                    <ul class="mycart-ul">
                        <?php
                         foreach($cartUser as $cartuk => $cartuv){
                        ?>
                         <li>
                             <?php
                             $cartlen = mb_strlen($cartuv['productName'],'utf-8');
                             if($cartlen>18){
                                 $cartPname = mb_strimwidth($cartuv['productName'],0,36,'...','utf-8');
                             }else{
                                 $cartPname = $cartuv['productName'];
                             }
                             ?>
                             <p><?=$cartPname?></p>
                            <div class="mycart-img"><img src="<?=GlobalArray::$imgUrlArray['0'].$cartuv['productLogo']?>" /></div>

                            <div class="mycart-count"><?=$cartuv['count']?>包</div>
                            <div class="mycart-tex">￥<?=sprintf("%.2f",$cartuv['money'])?></div>
                            <div class="mycart-del" onclick="shopdele(<?=$cartuv['id']?>)">×</div>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
              <?php }else{?>
                    <li class="mycart"><a href="<?=FVariable::$shoppingempty_url?>">购物车</a></li>
              <?php } ?>
                 <li class="mycart-name"><a href="<?=FVariable::$userVipcenter_url?>"><?=$user->nickName?></a></li>
                 <li class="mycart-out"><a href="/site/logout">退出</a> </li>
             <?php } ?>

        </ul>
    </div>
</div>
<?= $content ?>
<div class="footer cl">
    <div class="container">
        <div class="linksbox cl">
            <ul>
                <li>
                    关于
                </li>
                <li>
                    <a href="">
                        公司简介
                    </a>
                </li>
                <li>
                    <a href="">
                        团队成员
                    </a>
                </li>
                <li>
                    <a href="">
                        会员中心
                    </a>
                </li>
            </ul>
            <ul class="link-two">
                <li>
                    <img src="/img/index_48.png" />
                    <p>
                        微信公众号
                    </p>
                </li>
                <li>
                    <img src="/img/index_48.png" />
                    <p>
                        新浪微博
                    </p>
                </li>
            </ul>
            <ul>
                <li>
                    <img src="/img/index_45.png" />
                </li>
                <li>
                    400-253-4232
                </li>
                <li>
                    周一 ~ 周五 9:00 ~ 21:00
                </li>
            </ul>
        </div>

        <div class="copyright">
            <p class="footExpress"><a href="http://www.aikuaidi.cn/" target="_blank" >快递单号查询</a></p>
            <p>
                Copyright ©<?=date('Y')?> All Rights Reserved 鲁ICP备15032756号
            </p>
            <p>
                广州市天河区黄埔大道西669号马会家居
            </p>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php
    $this->endPage();
?>
