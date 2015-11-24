<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use yii\web;
            use yii\base;
            use kucha\ueditor\UEditor;
            use common\widgets\Tool;
            use common\widgets\Variable;
            $admin_cur="liftObject";
            $this->title='编辑';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['鲜橙生活',\common\widgets\Variable::$liftObject_url],[$this->title]]) ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-activity-form',
                        'action'=>Yii::$app->urlManager->createUrl([Variable::$editLiftObject_url,'id'=>$articleModel->id]),
                        'method'=>'post',
                        'options' => [ 'enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <?=$form->field($model, 'title',['options' => ['class' => 'form-group col-lg-7  paddingLeft']])->textInput(['disabled'=>true])->label('项目名称') ?>
                    <?= $form->field($model,'content',['options' => ['class' => 'form-group col-lg-12  paddingLeft']])->label('内容')->widget(UEditor::className(),[
                        'clientOptions' => [
                            //编辑区域大小
                            'initialFrameHeight' => '450',
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
                        <a class="btn-cancel" href="<?php echo Variable::$liftObject_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
