<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\helpers\Html;
                use yii\bootstrap\ActiveForm;
                use yii\helpers\ArrayHelper;
                use yii\web;
                use yii\base;
                use common\widgets\Tool;
                $admin_cur="seller";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='编辑商家';
                echo  Tool::setBreadcrumbs([['商家管理',\common\widgets\Variable::$sellerManger_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                        $form = ActiveForm::begin([
                            'id' => 'edit-seller-form',
                            'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editSeller_url,'id'=>Tool::echoEncodeString($sellerModel->id)]),
                            'method'=>'post',
                            'options' => [ 'enctype' => 'multipart/form-data']
                        ]);
                    ?>
                    <?= $form->field($model, 'sellerName')->textInput(['disabled' => true])->label('商家名称') ?>
                    <?php
//                        echo $form->field($sellerModel, 'sellerLogo')->fileInput()->label('商家logo');
                    ?>
                    <?php
                        echo Html::textInput('sellerCityHidden',$model->sellerCity,['hidden'=>true,'id'=>'sellerCityHidden']);
                        echo  $form->field($model, 'sellerProvince', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->dropDownList(ArrayHelper::map($provinceMode, 'id', 'name'), ['prompt' => '请选择省份'])->label('所在省份', ['class' => ''
                    ]);
                    ?>
                    <?= $form->field(
                        $model,
                        'sellerCity',
                        ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->dropDownList(ArrayHelper::map(array(), 'id', 'name'), ['prompt' => '请选择城市'])->label('所在城市', ['class' => '']
                    )
                    ?>
                    <?= $form->field($model, 'contacts')->textInput()->label('联系人') ?>
                    <?= $form->field($model, 'phone')->textInput()->label('联系电话') ?>
                    <?= $form->field($model, 'sellerBrief')->textarea()->label('简介') ?>
                    <?php
                        echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('修改', ['class' => 'btn btn-primary', 'name' => 'add-seller-button']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$sellerManger_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
