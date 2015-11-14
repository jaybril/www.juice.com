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
                use yii\widgets\Breadcrumbs;
                $admin_cur="activity";
                $this->title='编辑活动';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['活动管理',\common\widgets\Variable::$articleManger_url],[$this->title.'-'.$activityModel->name]]) ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'add-activity-form',
                            'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editActivity_url,'id'=>Tool::echoEncodeString($activityModel->id)]),
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?=$form->field($model, 'name')->textInput()->label('活动名称') ?>
                    <?=$form->field($model, 'description')->textarea()->label('活动简介');?>

                    <?= $form->field($model, 'startTime',['options'=>['class'=>'col-lg-6 paddingLeft']])->label('开始时间')->widget(DateTimePicker::className(), [
                        'language' => 'zh-CN',
                        'size' => 'ms',//输入框的长度
                        'template' => '{input}{reset}{button}',
                        'pickButtonIcon' => 'glyphicon glyphicon-time',
                        'inline' => false,
                        'clientOptions' => [
                            'startView' => 4,
                            'minView' => 1,
                            'maxView' => 4,
                            'autoclose' => true,
                            'linkFormat' => 'yyyy-mm-dd H:ii:ss', // if inline = true
                            'format' => 'yyyy-mm-dd H:ii:ss', // if inline = false
                            'todayBtn' => true
                        ]
                    ]);?>
                    <?= $form->field($model, 'endTime',['options'=>['class'=>'col-lg-6 paddingLeft']])->label('结束时间')->widget(DateTimePicker::className(), [
                        'language' => 'zh-CN',
                        'size' => 'ms',//输入框的长度
                        'template' => '{input}{reset}{button}',
                        'pickButtonIcon' => 'glyphicon glyphicon-time',
                        'inline' => false,
                        'clientOptions' => [
                            'startView' => 4,
                            'minView' => 1,
                            'maxView' => 4,
                            'autoclose' => true,
                            'linkFormat' => 'yyyy-mm-dd H:ii:ss', // if inline = true
                            'format' => 'yyyy-mm-dd H:ii:ss', // if inline = false
                            'todayBtn' => true
                        ]
                    ]);?>
                    <?= $form->field($model,'rule')->label('活动规则')->widget(UEditor::className(),[
                        'clientOptions' => [
                            //编辑区域大小
                            'initialFrameHeight' => '200',
                            //设置语言
                            'lang' =>'en', //中文为 zh-cn
                            //定制菜单
                            'toolbars' => [
                                [
                                    'fullscreen', 'source', 'undo', 'redo', '|',
                                    'fontsize',
                                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                                    'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                                    'forecolor', 'backcolor', '|',
                                    'lineheight', '|',
                                    'indent', '|'
                                ],
                            ]
                        ]
                    ]);
                    ?>
                    <?=$form->field($model, 'wapUrl')->textInput()->label('移动端活动链接') ?>
                    <?=$form->field($model, 'pcUrl')->textInput()->label('PC端活动链接') ?>
                    <?= $form->field($model, 'status', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(GlobalArray::$activityStatusArray, ['prompt' => '请选择活动状态'])->label('活动状态'); ?>
                    <?= $form->field($model, 'isShow', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(GlobalArray::$activityIsShowArray, ['prompt' => '请选择活动展示介质'])->label('活动展示'); ?>
                    <?= $form->field($model, 'discount')->textInput(['placeholder'=>'没有可不填'])->label('活动优惠折扣') ?>
                    <?= $form->field($model, 'reduceMoney')->textInput(['placeholder'=>'没有可不填'])->label('活动优惠金额') ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('更新', ['class' => 'btn btn-primary', 'name' => 'add-activity-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$activityList_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
