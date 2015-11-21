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
                $admin_cur="article";
                $this->title='新增文章';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['文章管理',\common\widgets\Variable::$articleManger_url],[$this->title]]) ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'add-activity-form',
                            'action'=>\common\widgets\Variable::$addArticle_url,
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?=$form->field($model, 'title',['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->textInput()->label('文章名称') ?>
                    <?=$form->field($model, 'isTop',['options' => ['class' => 'form-group col-lg-5  paddingLeft']])->checkbox(['template'=>"<div class=\"test\">{label}{input}{error}</div>"])->label('是否置顶');?>
                    <?= $form->field($model, 'isIndexShow', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->dropDownList(GlobalArray::$articleIsIndexShowArr, ['prompt' => '请选择是否首页展示'])->label('是否首页展示'); ?>
                    <?=$form->field($model, 'description', ['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->textarea()->label('文章描述');?>
                    <?= $form->field($model, 'pic',['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->label('文章主题图')->widget('common\widgets\file_upload\FileUpload',['config'=>[]]) ?>
                    <?= $form->field($model,'content',['options' => ['class' => 'form-group col-lg-12  paddingLeft']])->label('文章内容')->widget(UEditor::className(),[
                        'clientOptions' => [
                            //编辑区域大小
                            'initialFrameHeight' => '250',
                            //设置语言
                            'lang' =>'zh-cn', //中文为 zh-cn
                            //定制菜单
                            'toolbars' => [
                                [
                                    'imagePopup','imageScaleEnabled','source', 'undo', 'redo', '|',
                                    'fontsize',
                                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat','autotypeset','justify','|',
                                    'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                                    'forecolor', 'backcolor', '|',
                                    'lineheight', '|',
                                    'indent', '|'
                                ],
                            ]
                        ]
                    ]);
                    ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false,'class'=>'col-lg-12']);
                    ?>
                    <div class="form-group col-lg-12">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-activity-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$activityList_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
