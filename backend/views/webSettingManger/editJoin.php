<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use common\widgets\Tool;
            use yii\web;
            use yii\base;
            $admin_cur="join";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='编辑加盟申请状态';
            echo  Tool::setBreadcrumbs([['加盟申请列表',\common\widgets\Variable::$joinList_url],[$this->title]])
            ?>
            <div class="" id="adminUser-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'edit-adminUser-form',
                        'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editJoin_url,'id'=>Tool::echoEncodeString($joinModel->id)]),
                        'method'=>'post'
                    ]);
                    ?>
                    <?= $form->field($model, 'username', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('姓名') ?>
                    <?= $form->field($model, 'mobile', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('手机号') ?>
                    <?= $form->field($model, 'email', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('邮箱') ?>
                    <?= $form->field($model, 'company', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('公司名称') ?>
                    <?= $form->field($model, 'industry', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('行业性质') ?>
                    <?= $form->field($model, 'nature', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('公司性质') ?>
                    <?= $form->field($model, 'inCity', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('所在城市') ?>
                    <?= $form->field($model, 'area', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('代理区域') ?>
                    <?= $form->field($model, 'inMoney', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('投入资金') ?>
                    <?= $form->field($model, 'inCount', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->textInput(['disabled'=>true])->label('投放数量') ?>
                    <?= $form->field($model, 'inPlace', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput(['disabled'=>true])->label('投放场所') ?>
                    <?= $form->field($model, 'inSource', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textarea(['disabled'=>true])->label('渠道资源') ?>
                    <?= $form->field($model, 'hardwareSource', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textarea(['disabled'=>true])->label('硬件资源') ?>
                    <?= $form->field($model, 'experience', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput(['disabled'=>true])->label('申请时间') ?>
                    <?= $form->field($model, 'status', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$jionStatusArr)->label('状态');
                    ?>
                    <?php
                    echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'edit-adminUser-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$joinList_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
