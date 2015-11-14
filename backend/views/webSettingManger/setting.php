<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                $admin_cur="web";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='网站参数设置';
                echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="seller">
<!--                <div class="seller-head">-->
<!--                    <a href="javascript:;" class="seller-head-add">+添加网站</a>-->
<!--                </div>-->

                <div class="webset">
                    <form>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td class="web-tdname">网站名称</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname"><span>标</span>题</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname"><span>网</span>址</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname web-tanamef"><span>关</span><span>键</span>字</td>
                                <td><textarea></textarea></td>
                            </tr>
                            <tr>
                                <td class="web-tdname">客服电话</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname">客服邮箱</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname web-tanamet">客<span>服</span>QQ</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname">公司名称</td>
                                <td><input type="text" /></td>
                            </tr>
                            <tr>
                                <td class="web-tdname"><span>描</span>述</td>
                                <td><textarea></textarea></td>
                            </tr>
                            <tr>
                                <td class="web-tdname"><span>备</span>注</td>
                                <td><textarea></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="保存" class="web-btn" /></td>
                            </tr>
                        </table>
                    </form>
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
    <div class="dis-head">添加网站</div>
    <div class="dis-con">
        <form>
            <input type="text" placeholder="网站名称" />
            <input type="text" placeholder="标题" />
            <input type="text" placeholder="网址" />
            <input type="text" placeholder="关键字" />
            <input type="text" placeholder="客服电话" />
            <input type="text" placeholder="客服邮箱" />
            <input type="text" placeholder="客服QQ" />
            <input type="text" placeholder="公司名称" />
            <textarea placeholder="描述"></textarea>
            <textarea placeholder="备注"></textarea>
            <input type="submit" value="确定" class="dis-btn" />
        </form>
    </div>
</div>