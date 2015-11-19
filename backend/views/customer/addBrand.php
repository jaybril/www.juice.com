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
            $admin_cur="brand";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='添加品牌';
            echo  Tool::setBreadcrumbs([['品牌管理',\common\widgets\Variable::$customerBrand_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-seller-form',
                        'action'=>\common\widgets\Variable::$addBrand_url,
                        'method'=>'post'
                    ]);
                    ?>
                    <div class="row margin0">
                        <?= $form->field($model, 'name', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput()->label('品牌名称') ?>
                        <?=$form->field($model, 'sort', ['options' => ['class' => 'form-group col-lg-6 paddingLeft']])->textInput()->label('展示顺序');?>
                    </div>

                    <div class="row margin0">
                        <?=$form->field($model, 'parentId', ['options' => ['class' => 'form-group col-lg-3 paddingLeft']])->dropDownList(ArrayHelper::map($catModel,'id','name'), ['prompt' => '请选择所属客户分类'])->label('所属客户分类');?>
                    </div>
                    <?= $form->field($model, 'clogo')->label('品牌logo（灰色）')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?= $form->field($model, 'blogo')->label('品牌logo（彩色）')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?php
                    echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary', 'name' => 'add-seller-button','error'=>'ss']) ?>
                        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button','error'=>'ss']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$customerBrand_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
