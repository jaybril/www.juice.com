
    <div class="container adminIndex">
<!--			--><?php //include('adminhead.php'); ?>

<div class="adminIndex-con">
    <div class="adminCon-left">
        <?php
            use yii\data\Pagination;
            use yii\bootstrap\Widget;
            use common\widgets\Variable;
            use yii\widgets\LinkPager;
            use common\widgets\Tool;
            use yii\widgets\Breadcrumbs;
            $admin_cur="activity";
            $this->title='活动管理';
        ?>
        <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
    </div>
    <div class="adminCon-right">
        <?= Tool::setBreadcrumbs([[$this->title]]) ?>
        <div class="member">
            <div class="member-head activity-head">
<!--							<span class="meber-span">活动状态-->
<!--								<select>-->
<!--                                    <option>全部</option>-->
<!--                                    <option>进行中</option>-->
<!--                                    <option>未开始</option>-->
<!--                                    <option>已结束</option>-->
<!--                                </select>-->
<!--							</span>-->
                <form>
<!--                    <input type="text" class="member-form-text" placeholder="开始日期" />-->
<!--                    <input type="text" class="member-form-text" placeholder="结束日期" />-->
<!--                    <input type="submit" value="查询" class="member-form-btn" />-->
                    <a href="<?=Variable::$addActivity_url ?>" class="release">发布活动</a>
                </form>
            </div>
            <div class="member-con activityM-con">
                <table cellpadding="0" cellspacing="0" border="0" class="admin-table">
                    <tr class="table_body_head">
                        <th>序号</th>
                        <th>活动主题</th>
                        <th>开始日期</th>
                        <th>结束日期</th>
                        <th>活动状态</th>
                        <th>操作</th>
                    </tr>
                    <?php
                        foreach($countries as $k=>$v){
                            echo '<tr>';
                            echo '  <td>'.($k+1).'</td>';
                            echo '<td>'.Tool::echoEncodeString($v->name).'</td>';
                            echo ' <td>'.Tool::echoEncodeString($v->startTime).'</td>';
                            echo ' <td>'.Tool::echoEncodeString($v->endTime).'</td>';
                            echo ' <td>'.\common\widgets\GlobalArray::$activityStatusArray[Tool::echoEncodeString($v->status,'0')].'</td>';
                            echo '<td> <a href="'.Yii::$app->urlManager->createUrl([\common\widgets\Variable::$editActivity_url,'id'=>Tool::echoEncodeString($v->id)]).'">编辑</a><a onclick="deleteActivity(this,'.Tool::echoEncodeString($v->id).')">删除</a></td>';
                            echo ' </tr>';
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

<div class="activity-fixed">
    <div class="activity-close">×</div>
    <div class="activity-head">添加活动</div>
    <div class="activity-con">
        <form>
            <input type="text" placeholder="活动标题" />
            <input type="text" placeholder="开始时间" />
            <input type="text" placeholder="结束时间" />
            <input type="text" placeholder="活动链接" />
            <input type="submit" value="添加活动" class="act-btn" />
        </form>
    </div>
</div>