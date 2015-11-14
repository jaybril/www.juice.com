<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use common\widgets\Tool;
                use yii\web;
                use yii\base;
                use yii\widgets\Breadcrumbs;
                $admin_cur="seller";
                $this->title='编辑订单';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['订单管理',\common\widgets\Variable::$orderManger_url],[$this->title]]) ?>
            <div class="" id="order-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'edit-product-form',
                            'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editOrder_url,'id'=>Tool::echoEncodeString($orderModel->id)]),
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?= $form->field($model, 'orderNo')->textInput(['disabled'=>true])->label('订单编号') ?>
                    <label class="control-label" for="orderform-orderno">订单详情</label>
                    <table class="tb-void tb-none">
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
                    <?= $form->field($model, 'orderMoney')->textInput(['disabled'=>true])->label('订单价格') ?>
                    <?= $form->field($model, 'orderStatus', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$orderStatusArray, ['prompt' => '请选择订单状态','disabled'=>true])->label('订单状态'); ?>
                    <?= $form->field($model, 'orderPayMethod', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$orderPayMethodArray, ['prompt' => '请选择订单支付方式','disabled'=>true])->label('订单支付方式'); ?>
                    <?= $form->field($model, 'refundhandleDescription')->textarea(['placeholder'=>'填写处理结果的内容'])->label('退货处理信息') ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                    <!--<?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'edit-order-button','error'=>'ss']) ?>-->
                        <a class="btn-cancel"   href="<?php echo \common\widgets\Variable::$orderManger_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
