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
            $admin_cur="auth";
            $this->title='添加资质认证';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['资质认证',\common\widgets\Variable::$authList_url],[$this->title]]) ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-activity-form',
                        'action'=>\common\widgets\Variable::$addAuth_url,
                        'method'=>'post',
                        'options' => [ 'enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <?= $form->field($model, 'address')->label('请选择图片')->widget('common\widgets\file_upload\FileUpload',['config'=>[]]) ?>
                    <?= $form->field($model, 'isShow', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->dropDownList(GlobalArray::$materialIsShowArray, ['prompt' => '请选择资质是否启用'])->label('是否启用'); ?>
                    <?=$form->field($model, 'sort', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->textInput()->label('展示顺序');?>

                    <?php
                    echo   $form->errorSummary($model,['header'=>false,'class' => 'form-group col-lg-7  paddingLeft']);
                    ?>
                    <div class="form-group col-lg-12">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-activity-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$authList_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
