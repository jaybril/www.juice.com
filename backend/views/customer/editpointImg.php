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
            $this->title='点位照片';
            echo  Tool::setBreadcrumbs([['品牌管理',\common\widgets\Variable::$customerBrand_url],[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="connected-carousels">
                    <div class="stage">
                        <div class="carousel carousel-stage">
                            <ul>
                                <?php
                                if($list) {
                                    foreach ($list as $k => $v) {
                                        echo '<li class="imgli" ><img id="' . $list[$k] . '" src="' . $list[$k] . '" width="600" height="400" alt=""><div class="deleteImg"><a >删除</a></div></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <style>
                            .imgli{
                                position: relative;
                            }
                            .deleteImg{
                                /*display: block;*/
                                /*width: 100%;*/
                                /*height: 100%;*/
                                /*top: 0;*/
                                /*background-color: #B25D5D;*/
                                /*position: absolute;*/
                                /*left: 0;*/
                                /*z-index: 1000;*/
                            }
                        </style>
                        <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
                        <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
                    </div>
                    <div class="navigation">
<!--                        <a href="#" class="prev prev-navigation">&lsaquo;</a>-->
<!--                        <a href="#" class="next next-navigation">&rsaquo;</a>-->
                        <div class="carousel carousel-navigation">
                            <ul>
                                <?php
                                if($list) {
                                    foreach ($list as $k => $v) {
                                        echo '<li><img src="' . $list[$k] . '" width="50" height="50" alt=""></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dis-con">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-seller-form',
                        'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editPointImg_url,'id'=>Tool::echoEncodeString($model->id)]),
                        'method'=>'post'
                    ]);
                    ?>
                    <?= $form->field($model, 'img1',['options'=>['class'=>'col-lg-6']])->label('点位图片1')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?= $form->field($model, 'img2',['options'=>['class'=>'col-lg-6']])->label('点位图片2')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?= $form->field($model, 'img3',['options'=>['class'=>'col-lg-6']])->label('点位图片3')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?= $form->field($model, 'img4',['options'=>['class'=>'col-lg-6']])->label('点位图片4')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?= $form->field($model, 'img5',['options'=>['class'=>'col-lg-12']])->label('点位图片5')->widget('common\widgets\file_upload\FileUpload',[
                        'config'=>[]
                    ]) ?>
                    <?php
                    echo   $form->errorSummary($model,['header'=>false]);
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-large btn-primary ']) ?>
                        <a class="btn-cancel" href="<?php echo \common\widgets\Variable::$customerBrand_url ;?>">返回</a>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
