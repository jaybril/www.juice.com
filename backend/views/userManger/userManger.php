<?php
    use yii\widgets\LinkPager;
    use common\widgets\Tool;
    use common\widgets\GlobalArray;
    use common\widgets\Variable;
    $admin_cur="index";
    $this->title='会员管理';
?>
<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='会员管理';
                echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="member">
                <div class="member-head vmember-head activity-head">
<!--							<span class="meber-span">状态-->
<!--								<select>-->
<!--                                    <option>全部</option>-->
<!--                                    <option>正常</option>-->
<!--                                    <option>冻结</option>-->
<!--                                </select>-->
<!--							</span>-->

<!--                        <input type="submit" value="查询" class="member-form-btn" />-->
                        <a href="javascript:;" class="release adduser">添加用户</a>

                </div>
                <div class="member-con">
                    <table cellpadding="0" cellspacing="0" border="0" class="admin-table vadmin-table">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>姓名</th>
                            <th>昵称</th>
                            <th>手机号码</th>
<!--                            <th>邮箱</th>-->
                            <th>状态</th>
                            <th>注册时间</th>
                            <th>最后登录</th>
                            <th>注册来源</th>
                            <th>操作</th>
                        </tr>
                        <?php
                            foreach($countries as $k=>$v){
                                echo '<tr>';
                                echo '<td>'.($k+1).'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->realName,'无').'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->nickName).'</td>';
                                echo '<td>'.Tool::echoEncodeString($v->mobile,'无').'</td>';
//                                echo '<td>'.Tool::echoEncodeString($v['email'],'无').'</td>';
                                echo '<td>'.GlobalArray::$userStatusArray[Tool::echoEncodeString($v->userStatus,'0')].'</td>';
                                echo '<td>'.Tool::echoEncodeString(date('Y-m-d H:i',strtotime($v->registerTime))).'</td>';
                                echo '<td>'.Tool::echoEncodeString(date('Y-m-d H:i',strtotime($v->lastLoginTime))).'</td>';
                                echo '<td>'.GlobalArray::$userRegComeFromArray[Tool::echoEncodeString($v->comeFrom,'0')].'</td>';
                                echo '<td class="vip-td-a"><a href="'.Yii::$app->urlManager->createUrl([Variable::$editUser_url,'id'=> Tool::echoEncodeString($v->id)]).'"  class="frozen">编辑</a><a onclick="deleteUser(this,'.Tool::echoEncodeString($v->id).')" href="javascript::">删除</a><br><a href="'.Yii::$app->urlManager->createUrl([Variable::$userAddress_url,'id'=>Tool::echoEncodeString($v->id)]).'">收货地址列表</a></td>';
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
<div class="discount-fixed" id="adduser-fixed">
    <div class="dis-close">×</div>
    <div class="dis-head">添加用户</div>
    <div class="dis-con">
        <form>
            <input type="text" placeholder="姓名" id="addCustomer_realName" />
            <input type="text" placeholder="昵称" id="addCustomer_nickName" />
            <input type="password" placeholder="密码"  id="addCustomer_password"/>
            <input type="text" placeholder="手机号码" id="addCustomer_mobile" />
            <input type="button" value="确定" class="dis-btn"   id="addCustomerBtn" />
        </form>
    </div>
</div>

<div class="discount-fixed vipindex-fixed">
    <div class="dis-close">×</div>
    <div class="dis-head">冻结账号</div>
    <div class="dis-con">
        <form>
            <p>冻结账号：刘玲玲</p>
            <textarea placeholder="冻结原因"></textarea>
            <input type="submit" value="确定" class="dis-btn" />
        </form>
    </div>
</div>