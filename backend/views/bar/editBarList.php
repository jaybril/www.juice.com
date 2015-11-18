<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use common\widgets\Variable;
            use unclead\widgets\MultipleInput;
            use yii\helpers\Html;
            use yii\widgets\ActiveForm;
            $admin_cur="bar";
            $this->title='编辑导航栏';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([['底部导航栏',Variable::$barIndex_url],[$this->title]]) ?>
            <div class="member">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'add-seller-form',
                    'action'=>Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editEmploy_url,'id'=>Tool::echoEncodeString($barModel->id)]),
                    'method'=>'post'
                ]);
                ?>
                <?= $form->field($model, 'name')->widget(MultipleInput::className(), [
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
                <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>