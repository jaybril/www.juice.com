<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use common\widgets\Tool;
            use yii\web;
            use yii\base;
            use unclead\widgets\MultipleInput;
            use vova07\fileapi\Widget;
            $admin_cur="employ";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='添加后台用户';
            echo  Tool::setBreadcrumbs([['招聘管理',\common\widgets\Variable::$employIndex_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-seller-form',
                        'action'=>\common\widgets\Variable::$addEmploy_url,
                        'method'=>'post'
                    ]);
                    ?>
                    <div class="row margin0">
                        <?= $form->field($model, 'employName', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput()->label('职位名称') ?>
                        <?=$form->field($model, 'employCode', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput()->label('职位编号');?>
                    </div>

                    <div class="row margin0">
                        <?=$form->field($model, 'address', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput()->label('工作城市');?>
                        <?=$form->field($model, 'department', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput()->label('招聘部门');?>
                        <?=$form->field($model, 'count', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput()->label('招聘人数');?>
                        <?=$form->field($model, 'money', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput()->label('薪资情况');?>

                    </div>
                    <div class="row margin0">

                        <?=$form->field($model, 'group', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$employGroupArr, ['prompt' => '请选择招聘对象'])->label('招聘对象');?>
                        <?=$form->field($model, 'type', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$employTypeArr, ['prompt' => '请选择招聘类型'])->label('招聘类型');?>
                        <?=$form->field($model, 'category', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput()->label('职能类别');?>
                        <?=$form->field($model, 'sendEmail', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput()->label('接受邮应聘件的邮箱');?>
                    </div>

                    <?= $form->field($model, 'status', ['options' => ['class' => 'form-group col-lg-12 paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$employStatusArr, ['prompt' => '请选择职位状态'])->label('职位状态');
                    ?>
<!--                    --><?//=$form->field($model, 'description')->textarea()->label('职位描述');?>
                    <?= $form->field($model, 'description')->widget(MultipleInput::className(), [
                        'limit' => 4,
                        'columns' => [
                            [
                                'name'  => 'user_id',
                                'title' => '子栏目名',
                                'defaultValue' => 1,
                                'options' => [
                                    'class' => 'input-priority col-lg-3'
                                ]
                            ],
                            [
                                'name'  => 'priority',
                                'enableError' => true,
                                'title' => '链接地址',
                                'options' => [
                                    'class' => 'input-priority'
                                ]
                            ],
//                            [
//                                'name'  => 'file',
//                                'title' => 'File',
//                                'type'  => Widget::className(),
//                                'options' => [
//                                    'settings' => [
//                                        'url' => ['site/fileapi-upload']
//                                    ]
//                                ]
//                            ],
                        ],
                        'addButtonOptions' => [
                            'class' => 'btn btn-success',
                            'label' => '添加一行' // also you can use html code
                        ],
                        'removeButtonOptions' => [
                            'label' => '删除该行'
                        ]
                    ])->label("子栏目列表");
                    ?>
                    <?php
                    echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-seller-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$employIndex_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
