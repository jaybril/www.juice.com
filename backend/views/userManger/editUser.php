<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use yii\helpers\ArrayHelper;
                use common\widgets\Tool;
                use yii\web;
                use yii\base;
                $admin_cur="user";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='编辑用户信息';
                echo  Tool::setBreadcrumbs([['用户管理',\common\widgets\Variable::$userMange_url],[$this->title]]);
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'edit-user-form',
                            'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editUser_url,'id'=>Tool::echoEncodeString($userModel->id)]),
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?= $form->field($model, 'nickName')->textInput(['disabled' => true])->label('用户昵称') ?>
                    <?= $form->field($model, 'realName')->textInput()->label('用户真实姓名') ?>
                    <?= $form->field($model, 'password')->passwordInput(['disabled' => true])->label('密码') ?>
                    <?= $form->field($model, 'mobile')->textInput()->label('手机号码') ?>
                    <?= $form->field($model, 'email')->textInput()->label('邮箱') ?>
                    <?= $form->field($model, 'userStatus', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$userStatusArray, ['prompt' => '请选择用户状态'])->label('用户状态');
                    ?>
                    <?= $form->field($model, 'frozenReason')->textInput(['placeholder'=>'如冻结状态请填写冻结原因'])->label('冻结原因') ?>
                    <?= $form->field($model, 'comeFrom', ['options' => ['class' => 'form-group  paddingLeft']])->dropDownList(\common\widgets\GlobalArray::$userRegComeFromArray, ['prompt' => '请选择注册来源'])->label('注册来源');
                    ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('修改', ['class' => 'btn btn-primary', 'name' => 'edit-user-button']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$userMange_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
