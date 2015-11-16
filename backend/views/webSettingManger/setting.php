<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use common\widgets\Tool;
            use yii\web;
            use yii\base;
            use kucha\ueditor\UEditor;
            $admin_cur="setting";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='网站配置';
            echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-seller-form',
                        'action'=>\common\widgets\Variable::$setting_url,
                        'method'=>'post',
//                        'options' => [ 'enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <?= $form->field($model, 'name')->textInput()->label('网站名称') ?>
                    <?=$form->field($model, 'registration', ['options' => ['class' => 'form-group col-lg-6  paddingLeft']])->textInput()->label('备案号');?>
                    <?=$form->field($model, 'website', ['options' => ['class' => 'form-group col-lg-6  paddingLeft']])->textInput()->label('网站地址');?>
<!--                    --><?//=$form->field($model, 'logo')->textInput()->label('网站logo');?>
                    <?=$form->field($model, 'copyright', ['options' => ['class' => 'form-group col-lg-6  paddingLeft']])->textInput()->label('网站版权');?>
<!--                    --><?//=$form->field($model, 'background')->textInput()->label('网站背景');?>
                    <?=$form->field($model, 'phone', ['options' => ['class' => 'form-group col-lg-6  paddingLeft']])->textInput()->label('客服电话');?>
                    <?=$form->field($model, 'addr')->textInput()->label('公司地址');?>
<!--                    --><?php //echo \common\widgets\file_upload\FileUpload::widget();?>
                    <?= $form->field($model, 'background')->label('网站背景图片')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[
//                            'imageActionName'=>'background_upload',
//                            'fileFieldName'=>'background_upload',
//                            'imageFieldName'=>'background_upload',
//                            'fileName'=>'background_upload'
                        ]
                    ]) ?>
<!--                    --><?//= $form->field($model,'logo')->label('网站logo')->widget(UEditor::className(),[
//                        'clientOptions' => [
//                            //编辑区域大小
//                            'initialFrameHeight' => '250',
//                            //设置语言
//                            'lang' =>'zh-cn', //中文为 zh-cn
//                            //定制菜单
//                            'toolbars' => [
//                                [
//                                    'simpleupload', 'undo', 'redo', '|',
//                                ],
//                            ]
//                        ]
//                    ]);
//                    ?>
                    <?php
                    echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary col-lg-3', 'name' => 'add-seller-button','error'=>'ss']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
