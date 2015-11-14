<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use common\widgets\Tool;
                use yii\helpers\Html;
                use yii\grid\GridView;
                $admin_cur="article";
                $this->title='文章管理';
                echo   $this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view);
            ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs($this->title) ?>
            <div class="member">
<!--                <div class="member-head">-->
<!--                        <p>-->
<!--                            = Html::a('添加评论', ['create'], ['class' => 'btn btn-success']) -->
                <!--                        </p>-->
<!--                </div>-->
                <div class="member-con articleM-con">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'label' => '真实姓名',
                                'value' => 'user.nickName',
                            ],

                                  'type',


                               'score',

                            [
                                'label' => '内容',
                                'value' => 'content',
                            ],
                            [
                                'label' => '有用数',
                                'value' => 'useCount',
                            ],
                            [
                                'label' => '无用数',
                                'value' => 'useLessCount',
                            ],
                            [
                                'label' => '发布时间',
                                'value' => 'publishTime',
                            ],
                            [
                                'label' => '状态',
                                'value' => 'status',
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>

        </div>
    </div>
</div>