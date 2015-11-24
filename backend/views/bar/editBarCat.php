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
            use yii\helpers\ArrayHelper;
            $admin_cur="bar";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='编辑顶级导航栏';
            echo  Tool::setBreadcrumbs([['导航栏管理',\common\widgets\Variable::$barIndex_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-seller-form',
                        'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editBarCat_url,'id'=>$model->id]),
                        'method'=>'post'
                    ]);
                    ?>
                    <?= $form->field($model, 'name', ['options' => ['class' => 'form-group col-lg-7 paddingLeft']])->textInput()->label('导航栏名称') ?>
                    <?=$form->field($model, 'link', ['options' => ['class' => 'form-group col-lg-7 paddingLeft']])->textInput([''])->label('导航栏链接');?>
                    <?=$form->field($model, 'sort', ['options' => ['class' => 'form-group col-lg-7 paddingLeft']])->textInput()->label('展示顺序');?>

                    <?php
                    echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group col-lg-12">
                        <?= Html::submitButton('更新', ['class' => 'btn btn-primary', 'name' => 'add-seller-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$barIndex_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
