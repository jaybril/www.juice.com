<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use common\widgets\Tool;
                use common\widgets\GlobalArray;
                use yii\web;
                use yii\base;
                use yii\helpers\ArrayHelper;
                use yii\widgets\Breadcrumbs;
                $admin_cur="order";
                $this->title='订单发货';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?=Tool::setBreadcrumbs([['订单管理',\common\widgets\Variable::$orderManger_url],[$this->title]]) ?>
            <div class="" id="order-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'edit-product-form',
                            'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$deliverOrder_url,'id'=>Tool::echoEncodeString($orderModel->id)]),
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?= $form->field($model, 'orderNo',['options' => ['class' => 'col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('订单编号') ?>
                    <?= $form->field($model, 'orderMoney',['options' => ['class' => 'col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('订单价格') ?>
                    <?= $form->field($model, 'orderStatus',['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->dropDownList(GlobalArray::$orderStatusArray, ['prompt' => '请选择订单状态','disabled'=>true])->label('订单状态'); ?>
                    <?= $form->field($model, 'orderPayMethod',['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->dropDownList(GlobalArray::$orderPayMethodArray, ['prompt' => '请选择订单支付方式','disabled'=>true])->label('订单支付方式');?>
                    <label class="control-label" for="orderform-orderno">订单详情</label>
                    <table class="tb-void tb-none form-group">
                        <thead>
                        <tr>
                            <th>商品编号</th>
                            <th>商品名称</th>
                            <th>商品数量</th>
                            <th>商品单价</th>
                            <th>商品总价</th>
                            <th>折扣价格</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($orderModel->orderdetail as $k=>$v){
                                echo '<tr>';
                                echo ' <td>'.Tool::echoEncodeString($v->product->productNo).'</td>';
                                echo '<td class="align_Left"><a>'.Tool::echoEncodeString($v->product->productName).'</a></td>';
                                echo '<td>'.Tool::echoEncodeString($v->productCount,'1').'</td>';
                                echo '<td><strong class="ftx-01">¥'.Tool::echoEncodeString($v->product->productPrice).'</strong></td>';
                                echo '<td>¥'.Tool::echoEncodeString($v->productPrice).'</td>';
                                echo '<td>¥'.Tool::echoEncodeString($v->discountPrice,'0.00').'</td>';
                                echo '</tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                    <label class="control-label">收货地址</label>
                    <table class="tb-void tb-none order-user-address form-group">
                        <tbody>
                        <tr>
                            <td>收&nbsp; 货 &nbsp;人:</td>
                            <td><?=$userAddressModel->userName?></td>
                        </tr>
                        <tr>
                            <td>地 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:</td>
                            <td><?=$userAddressModel->detailAddress?></td>
                        </tr>
                        <tr>
                            <td>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编:</td>
                            <td><?=$userAddressModel->postNumber?></td>
                        </tr>
                        <tr>
                            <td>手机号码:</td>
                            <td><?=$userAddressModel->userMobile?></td>
                        </tr>
                        </tbody>
                    </table>


                    <?php
                        $isSubmit=Html::submitButton('确认发货', ['class' => 'btn btn-primary', 'name' => 'edit-order-button','error'=>'ss']);


                        if($orderExpressInfoModel || $orderModel->orderStatus!=1 ){
                            $isSubmit='';
                            echo $form->field($model, 'expressStyle',['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->dropDownList(ArrayHelper::map($orderStyleModel, 'id', 'name'), ['prompt' => '请选择发货快递','disabled'=>true])->label('发货快递');
                            echo $form->field($model, 'expressNo',['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput(['disabled'=>true])->label('快递单号') ;
//                            echo $form->field($model, 'expressChart')->fileInput(['disabled'=>true])->label('快递截图');
                        }
                        else{
                            echo $form->field($model, 'expressStyle',['options' => ['class' => 'form-group paddingLeft']])->dropDownList(ArrayHelper::map($orderStyleModel, 'id', 'name'), ['prompt' => '请选择发货快递'])->label('发货快递');
                            echo $form->field($model, 'expressNo')->textInput()->label('快递单号') ;
                            echo $form->field($model, 'expressChart')->fileInput()->label('快递截图');
                        }
                    ?>
                    <?= $form->errorSummary($model,['header'=>false]); ?>
                    <div class="form-group">
                        <?= $isSubmit; ?>
                        <a class="btn-cancel"   href="<?php echo \common\widgets\Variable::$orderManger_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end();?>
                </div>
            </div>
        </div>
    </div>
</div>
