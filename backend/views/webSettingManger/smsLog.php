<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                $admin_cur="smslog";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='短信日志列表';
                echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="seller">
                <div class="seller-head">

                </div>

                <div class="smslog">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr class="table_body_head">
                            <th>序号</th>
                            <th>手机号码</th>
                            <th>短信内容</th>
                            <th>验证码</th>
                            <th>类型</th>
                            <th>时间</th>
                            <th>备注</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>11111111111</td>
                            <td>12</td>
                            <td>123456</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>11111111111</td>
                            <td>12</td>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>

            <ul class="adminpage">
                <li class="adminpage-first"><a href=""><img src="img/u107.png" /></a></li>
                <li class="adminpage-prev"><a href=""><img src="img/u105.png" /></a></li>
                <li><a href="">1</a></li>
                <li class="active"><a href="">2</a></li>
                <li class="adminpage-point"><a href="">...</a></li>
                <li><a href="">45</a></li>
                <li><a href="">46</a></li>
                <li class="adminpage-next"><a href=""><img src="img/u111.png" /></a></li>
                <li class="adminpage-last"><a href=""><img src="img/u109.png" /></a></li>
                <li class="adminpage-search"><input type="text" /><a href="">GO</a></li>
            </ul>
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