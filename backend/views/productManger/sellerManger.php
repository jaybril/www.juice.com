<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\widgets\LinkPager;
                use yii\helpers\Html;
                use common\widgets\Variable;
                use common\widgets\Tool;
                use yii\widgets\Breadcrumbs;
                $admin_cur="seller";
                $this->title='商家管理';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='商家管理';
                echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="seller">
                <div class="seller-head">
                    <a href="<?php echo \common\widgets\Variable::$addSeller_url ?>" class="seller-head-add">+添加商家</a>
                </div>
                <ul class="seller-ul cl" id="sellerList">
                    <?php
                        $defaultSellerLogo="this.src='/img/u1090.png'";
                        foreach($countries as $k=>$v){
                            echo '<li>';
                            echo '<p class="sellerName"><b>'.Tool::echoEncodeString($v->sellerName,'暂无商家名').'</b></p>';
                            echo '<div>';
                            echo '<img src="'.Tool::echoEncodeString($v->sellerLogo).'" onerror="'.$defaultSellerLogo.'"   class="sell-li-img" />';
                            echo '<div class="sell-li-info">';
                            echo '<p><span>联</span><span>系</span>人：'.Tool::echoEncodeString($v->contacts).'</p>';
                            echo ' <p>联系电话：'.Tool::echoEncodeString($v->phone).'</p>';
                            echo ' <p>所在省市：'.Tool::echoEncodeString($v->province->name).'-'.Tool::echoEncodeString($v->city->name).'</p>';
                            echo '</div>';
                            echo ' </div>';
                            echo '<div class="introduce">简要：'.Tool::replaceStringWithStar(Tool::echoEncodeString($v->sellerBrief,'暂无摘要'),50,strlen($v->sellerBrief)-50,'...').'</div>';
                            echo '<div class="seller-shade"></div>';
                            echo '<div class="seller-shade-a"><a href="'.Yii::$app->urlManager->createUrl([Variable::$editSeller_url,'id'=>Tool::echoEncodeString($v->id)]).'"  class="seller-a-edit">编辑</a><a <a onclick="deleteSeller(this,'.Html::encode($v->id).')" >删除</a></div>';
                        }
                    ?>
                </ul>
            </div>
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'firstPageLabel'=>'首页',
                'lastPageLabel'=>'末页'
            ]); ?>
        </div>
    </div>
</div>

<div class="discount-fixed seller-fixed" id="sellered-fixed1">
    <div class="dis-close">×</div>
    <div class="dis-head">编辑商家资料</div>
    <div class="dis-con">
        <form>
            <input type="text" value="苏宁预购" />
            <input type="text" value="http://www.baidu.com" />
            <input type="text" value="黄哈哈" />
            <input type="text" value="154414421" />
            <input type="text" value="江苏南京" />
            <textarea>苏宁易购，是苏宁电器旗下新一代B2C网上购物平台，现已覆盖传统家电、3C电器、日用百货等品类。2011年，苏宁易购将强化虚拟网络与实体店面的同步发展，不断提升网络市场份额。</textarea>
            <input type="submit" value="提交保存" class="dis-btn" />
        </form>
    </div>
</div>