<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use common\widgets\GlobalArray;
            use yii\web;
            use yii\base;
            use dosamigos\datetimepicker\DateTimePicker;
            use kucha\ueditor\UEditor;
            use common\widgets\Tool;
            $admin_cur="service";
            $this->title='添加服务项';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['服务项管理',\common\widgets\Variable::$serviceIndex_url],[$this->title]]) ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-activity-form',
                        'action'=>\common\widgets\Variable::$addService_url,
                        'method'=>'post',
                        'options' => [ 'enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <div class="row">
                    <?=$form->field($model, 'title', ['options' => ['class' => 'form-group col-lg-6  paddingLeft']])->textInput()->label('服务项标题');?>
                    <?=$form->field($model, 'description', ['options' => ['class' => 'form-group col-lg-3  paddingLeft']])->textInput()->label('锚点');?>
                    <?=$form->field($model, 'useId', ['options' => ['class' => 'form-group col-lg-3  paddingLeft']])->textInput()->label('显示顺序');?>
                    </div>
                    <div class="row">
                        <?= $form->field($model, 'pic')->label('请选择图片')->widget('common\widgets\file_upload\FileUpload',['config'=>[]]) ?>
                    </div>
                    <div class="row">
                        <?=$form->field($model, 'content', ['options' => ['class' => 'form-group col-lg-12  paddingLeft']])->textarea()->label('文字描述');?>
                    </div>
                    <?php
                    echo   $form->errorSummary($model,['header'=>false,'class' => 'form-group col-lg-7  paddingLeft']);
                    ?>
                    <div class="form-group col-lg-12">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-activity-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$serviceIndex_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
