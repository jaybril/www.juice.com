<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use common\widgets\Tool;
                use yii\web;
                use yii\base;
                $admin_cur="express";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='添加快递';
                echo  Tool::setBreadcrumbs([['快递管理',\common\widgets\Variable::$express_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'add-seller-form',
                            'action'=>\common\widgets\Variable::$addExpress_url,
                            'method'=>'post'
                        ]);
                    ?>
                    <?= $form->field($model, 'name')->textInput()->label('快递名称') ?>
                    <?=$form->field($model, 'code')->textInput()->label('快递代码');?>
                    <?=$form->field($model, 'phone')->textInput()->label('快递客服电话');?>
                    <?=$form->field($model, 'url')->textInput()->label('快递官网');?>
                    <?=$form->field($model, 'inPostage')->textInput()->label('省内邮费');?>
                    <?=$form->field($model, 'outPostage')->textInput()->label('省外邮费');?>
                    <?= $form->field($model, 'status', ['options' => ['class' => 'form-group col-lg-12 paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$expressStatusArray, ['prompt' => '请选择状态'])->label('快递状态');
                    ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-seller-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$express_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
