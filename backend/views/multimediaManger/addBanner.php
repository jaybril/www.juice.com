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
            $admin_cur="banner";
            $this->title='添加banner';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['banner管理',\common\widgets\Variable::$bannerList_url],[$this->title]]) ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-activity-form',
                        'action'=>\common\widgets\Variable::$addBanner_url,
                        'method'=>'post',
                        'options' => [ 'enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <?= $form->field($model, 'address')->label('请选择大图')->widget('common\widgets\file_upload\FileUpload',['config'=>[]]) ?>
                    <?= $form->field($model, 'wapUrl')->label('请选择小图')->widget('common\widgets\file_upload\FileUpload',['config'=>[]]) ?>
                    <?=$form->field($model, 'pcUrl', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->textInput()->label('跳转链接地址') ?>
                    <?=$form->field($model, 'sort', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->textInput()->label('显示顺序') ?>
                    <?= $form->field($model, 'isShow', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->dropDownList(GlobalArray::$materialIsShowArray, ['prompt' => '请选择图片是否启用'])->label('请选择是否启用'); ?>

                    <?php
                    echo   $form->errorSummary($model,['header'=>false,'class' => 'form-group col-lg-7  paddingLeft']);
                    ?>
                    <div class="form-group col-lg-12">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-activity-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$bannerList_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
