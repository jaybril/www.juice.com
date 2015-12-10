<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use common\widgets\Tool;
            use yii\widgets\LinkPager;
            use common\widgets\Variable;
            use yii\helpers\Html;
            $admin_cur="proBanner";
            $this->title='产品轮播图';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([[$this->title]]) ?>
            <div class="member">
                <div class="member-head">
                    <div class="seller-head">
                        <a href="<?=Variable::$addProBanner_url?>" class="seller-head-add">+添加产品轮播图</a>
                    </div>
                </div>
                <div class="member-con articleM-con">
                    <table cellpadding="0" cellspacing="0" border="0" class="admin-table">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>是否启用</th>
                            <th>缩略图</th>
                            <th>显示顺序</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        foreach($countries as $k=>$v){
                            echo ' <tr>';
                            echo '<td>'.($k+1).'</td>';
                            echo '<td>'.\common\widgets\GlobalArray::$materialIsShowArray[Tool::echoEncodeString($v->isShow)].'</td>';
                            echo '<td><a target="_blank" href="'.Tool::echoEncodeString($v->address).'"><img width="180" height="100" src="'.Tool::echoEncodeString($v->address).'"></a></td>';
                            echo '<td>'.Tool::echoEncodeString($v->sort,0).'</td>';
                            echo '<td><a href="'.Yii::$app->urlManager->createUrl([Variable::$editProBanner_url,'id'=>Html::encode($v['id'])]).'"  >编辑</a><a onclick="deleteMaterial(this,'.Tool::echoEncodeString($v->id).')">删除</a></td>';
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