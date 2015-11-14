<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\data\Pagination;
                use yii\bootstrap\Widget;
                use common\widgets\Tool;
                use yii\widgets\LinkPager;
                use yii\widgets\Breadcrumbs;
                $admin_cur="activitywater";
                $this->title='活动记录';
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?= Tool::setBreadcrumbs([[$this->title]]) ?>
            <div class="member">
                <div class="member-head activity-head">
                    <div class="member-head activity-head">
<!--							<span class="meber-span">活动状态-->
<!--								<select>-->
<!--                                    <option>全部</option>-->
<!--                                    <option>进行中</option>-->
<!--                                    <option>未开始</option>-->
<!--                                    <option>已结束</option>-->
<!--                                </select>-->
<!--							</span>-->
<!--                        <form>-->
<!--                            <input type="text" class="member-form-text" placeholder="开始日期" />-->
<!--                            <input type="text" class="member-form-text" placeholder="结束日期" />-->
<!--                            <input type="submit" value="查询" class="member-form-btn" />-->
<!--                            <a href="javascript:;" class="release">发布活动</a>-->
<!--                        </form>-->
                    </div>
                </div>
                <div class="acwater">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>活动名</th>
                            <th>参与人</th>
                            <th>订单号</th>
<!--                            <th>状态</th>-->
                            <th>参与活动时间</th>
                            <th>活动优惠</th>
                            <th>活动优惠折扣</th>
                            <th>备注</th>
                        </tr>
                        <?php
                            foreach($countries as $k=>$v){
                                echo '<tr>';
                                echo '  <td>'.($k+1).'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->activity->name).'</td>';
                                echo ' <td>'.Tool::echoEncodeString($v->user->nickName).'</td>';
                                echo ' <td>'.Tool::echoEncodeString($v->orderId,'无').'</td>';
//                                echo ' <td>'.\common\widgets\GlobalArray::$activityStatusArray[Tool::echoEncodeString($v->status,'0')].'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->time).'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->discount,'0').'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->money,'0').'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->description,'无').'</td>';
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

<div class="discount-fixed seller-fixed" id="seller-fixed">
    <div class="dis-close">×</div>
    <div class="dis-head">添加管理员</div>
    <div class="dis-con">
        <form>
            <input type="text" placeholder="用户名" />
            <input type="password" placeholder="密码" />
            <input type="text" placeholder="手机号码" />
            <input type="text" placeholder="角色" />
            <input type="submit" value="确定" class="dis-btn" />
        </form>
    </div>
</div>