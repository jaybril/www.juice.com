<div class="container adminIndex">
    <!--    --><?php //include('adminhead.php'); ?>

    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\widgets\LinkPager;
                use common\widgets\GlobalArray;
                use yii\helpers\Html;
                use common\widgets\Tool;
                use yii\widgets\Breadcrumbs;

                $admin_cur="product";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='产品管理';
                echo  Tool::setBreadcrumbs([[$this->title]]);
            ?>
            <div class="product seller">
                <div class="seller-head">
<!--                    <div class="seller-head-left">-->
<!--                        产品类别：-->
<!--                        <select>-->
<!--                            <option>全部</option>-->
<!--                            <option>茶叶</option>-->
<!--                            <option>数码</option>-->
<!--                            <option>服装</option>-->
<!--                        </select>-->
<!--                    </div>-->
                    <a href="<?php echo \common\widgets\Variable::$addProduct_url?>" class="seller-head-add">+添加产品</a>
                </div>
                <div class="product-con">
                    <?php
                        $defaultLogo="this.src='/img/u1090.png'";
                        foreach($countries as $k=>$v){
                            echo ' <div class="product-list">';
                            echo ' <div class="pro-list-head">'.Tool::echoEncodeString($v->productName).'</div>';
                            echo '<div class="pro-list-con">';
                            echo '<div class="pro-con-depict">';
                            echo '<div class="pro-depict-top">';
                            echo '<div class="pro-top-img"><img src="'.Tool::echoEncodeString($v->productLogo).'" onerror='.$defaultLogo.' /></div>';
                            echo '<div class="pro-top-name">';
                            echo ' <p>商家：'.Tool::echoEncodeString($v->seller->sellerName).'</p>';
                            echo '<p>类别：'.Tool::echoEncodeString($v->category->categoryName).'</p>';
                            echo ' <p>状态：'.GlobalArray::$productStatusArray[$v->productStatus].'</p>';
                            echo '<p>价格：￥'.Tool::echoEncodeString($v->productPrice,'0.00').'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="pro-depict-bottom">';
                            echo '<p>产品描述：</p>';
                            echo '<p>'.Tool::echoEncodeString($v->productBrief,'暂无描述').'</p>';
                            echo ' </div>';
                            echo '</div>';
                            echo '<div class="pro-con-stock">';
                            echo '<div class="pro-stock-list">';
                            echo '<p>库存：'.Tool::echoEncodeString($v->productStock,'0').'</p>';
                            echo ' <p>浏览：'.Tool::echoEncodeString($v->lookCount,'0').'</p>';
                            echo ' <p>评论：'.Tool::echoEncodeString($v->commentCount,'0').'</p>';
                            echo '</div>';
                            echo ' <div class="pro-stock-list">';
                            echo '<p>销量：'.Tool::echoEncodeString($v->productSales,'0') .'</p>';
                            echo ' <p>关注：'.Tool::echoEncodeString($v->collectCount,'0').'</p>';
                            echo '<p>评分：'.Tool::echoEncodeString($v->score,'0').'</p>';
                            echo ' </div>';
                            echo ' </div>';
                            echo '<div class="pro-con-foot">';
//                            echo ' <a  href="'.Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editProduct_url,'id'=>Html::encode($v->id)]).'" class="btn1">详情</a>';
                            echo '<div class="pro-foot-left"><a href="'.Yii::$app->urlManager->createUrl([\common\widgets\Variable::$addProductimages_url,'id'=>Html::encode($v->id)]).'" class="btn1">添加产品展示图</a></div>';
                            echo '<div class="pro-foot-left"><a  onclick="setProductStatus(this,'.Tool::echoEncodeString($v->productStatus,'0').','.Tool::echoEncodeString($v->id).')" class="btn1">'.GlobalArray::$productStatusArray[Tool::echoEncodeString($v->productStatus,'0')].'</a><a href="'.Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editProduct_url,'id'=>Html::encode($v->id)]).'"class="btn1" >编辑</a></div>';
                            echo ' </div>';
                            echo ' </div>';
                            echo ' </div>';
                        }
                    ?>
                </div>
            </div>
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'firstPageLabel'=>'首页',
                'lastPageLabel'=>'末页'
            ]);
            ?>
        </div>
    </div>
</div>