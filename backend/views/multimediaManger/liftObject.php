<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use common\widgets\Variable;
            use yii\helpers\Html;
            $admin_cur="liftObject";
            $this->title='鲜橙生活';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([[$this->title]]) ?>
            <div class="member">
                <div class="member-head">
                    <div class="seller-head">
                    </div>
                </div>
                <div class="member-con articleM-con">
                    <table cellpadding="0" cellspacing="0" border="0" class="admin-table">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>标题</th>
                            <th>作者</th>
                            <th>修改时间</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($countries as $k=>$v){
                            echo ' <tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([Variable::$showLiftObject_url,'id'=>Html::encode($v['id'])]).'"  >'.Tool::echoEncodeString($v->title).'</a></td>';
                            echo '<td>'.Tool::echoEncodeString($v->adminUser->username).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->publishTime).'</td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([Variable::$showLiftObject_url,'id'=>Html::encode($v['id'])]).'"  >查看</a><a href="'.Yii::$app->urlManager->createUrl([Variable::$editLiftObject_url,'id'=>Html::encode($v['id'])]).'"  >编辑</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>