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
                $admin_cur="product";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">

            <?php
                $this->title='添加产品展示图片';
                echo  Tool::setBreadcrumbs([['产品管理',\common\widgets\Variable::$productManger_url],[$this->title]]);
            ?>
            <div class="" id="seller-fixed">
                <div class="dis-con">
                    <div class="connected-carousels">
                        <div class="stage">
                            <div class="carousel carousel-stage">
                                <ul>
                                    <?php
                                    foreach($materialModel as $k=>$v){
                                        echo '<li><img id="'.$v->id.'" src="'.$v->address.'" width="600" height="400" alt=""></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
                            <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
                        </div>
                        <div class="navigation">
                            <a href="#" class="prev prev-navigation">&lsaquo;</a>
                            <a href="#" class="next next-navigation">&rsaquo;</a>
                            <div class="carousel carousel-navigation">
                                <ul>
                                    <?php
                                        foreach($materialModel as $k=>$v){
                                            echo '<li><img src="'.$v->address.'" width="50" height="50" alt=""></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                            $form = ActiveForm::begin([
                                'id' => 'add-productImages-form',
                                'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$addProductimages_url,'id'=>Tool::echoEncodeString($useId)]),
                                'method'=>'post',
                                'options' => [ 'enctype' => 'multipart/form-data']
                            ]);
                        ?>
                        <?php
                            echo $form->field($model, 'productImage')->fileInput(['class'=>'uploadProductImg'])->label('添加产品展示图片');
                        ?>
                        <?= $form->field($model, 'materialId', ['options' => ['class' => 'form-group col-lg-12 paddingLeft']])->dropDownList(ArrayHelper::map($materialCatModel, 'id', 'name'), ['prompt' => '请选择素材类型','disabled'=>true])->label('素材类型');
                        ?>
                        <?php
                            echo   $form->errorSummary($model,['header'=>false]);
                        ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定上传', ['class' => 'btn btn-primary', 'name' => 'add-productImages-button','error'=>'ss']) ?>
                        <a class="btn-cancel"   href="<?php echo \common\widgets\Variable::$productManger_url ;?>">返回</a>
                    </div>
                        <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
