<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use yii\widgets\LinkPager;
            use common\widgets\Variable;
            use yii\helpers\Html;
            $admin_cur="customer";
            $this->title='客户分类管理';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([[$this->title]]) ?>
            <div class="member">
                <div class="member-head">
                                        <div class="seller-head">
                                            <a href="<?=Variable::$editCusCatList_url?>" class="seller-head-add">+添加客户分类</a>
                                        </div>
                </div>
                <div class="member-con articleM-con">
                    <table cellpadding="0" cellspacing="0" border="0" class="admin-table">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>客户分类名</th>
<!--                            <th>品牌个数</th>-->
                            <th>操作人</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($countries as $k=>$v){
                            echo ' <tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->name).'</td>';
//                            echo '<td>'.Tool::echoEncodeString($v->count).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->adminUser->username,0).'</td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([Variable::$editCusCatList_url,'id'=>Html::encode($v['id'])]).'"  >编辑</a><a onclick="deleteCus(this,'.Tool::echoEncodeString($v->id).')">删除</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'firstPageLabel'=>'首页',
                'lastPageLabel'=>'末页'
            ]); ?>
        </div>
    </div>
</div>