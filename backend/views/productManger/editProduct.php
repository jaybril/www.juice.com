<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use yii\helpers\ArrayHelper;
                use common\widgets\Tool;
                use yii\web;
                use yii\base;
                $admin_cur="seller";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='编辑产品';
                echo  Tool::setBreadcrumbs([['产品管理',\common\widgets\Variable::$productManger_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'edit-product-form',
                            'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editProduct_url,'id'=>Tool::echoEncodeString($productModel->id)]),
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?= $form->field($model, 'productName')->textInput()->label('产品名称') ?>

                    <?= $form->field($model, 'productStatus', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$productStatusArray, ['prompt' => '请选择产品状态'])->label('产品状态');
                    ?>
                    <?= $form->field($model, 'productStock')->textInput()->label('产品库存') ?>
                    <?= $form->field($model, 'productPrice')->textInput()->label('价格') ?>
                    <?= $form->field($model, 'productBrief')->textarea()->label('简介') ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'edit-product-button','error'=>'ss']) ?>
                        <a class="btn-cancel"   href="<?php echo \common\widgets\Variable::$productManger_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
