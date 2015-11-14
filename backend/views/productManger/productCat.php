<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
                use yii\widgets\LinkPager;
                use yii\helpers\Html;
                use common\widgets\Tool;
                $admin_cur="type";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
                $this->title='产品分类列表';
                echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="seller">
                <div class="seller-head">
<!--                    <div class="seller-head-left">-->
<!--                        展示方式：-->
<!--                        <select>-->
<!--                            <option>按添加时间显示</option>-->
<!--                            <option>按字母顺序显示</option>-->
<!--                        </select>-->
<!--                    </div>-->
                    <a   class="seller-head-add" >+添加产品类别</a>
                </div>
                <ul class="ttype-ul cl">
                    <?php
                        foreach($countries as $k=>$v){
                            echo '<li>';
                            echo '<div class="ttype-li-head">';
                            echo Html::encode($v->categoryName).'<span>'.Html::encode($v->sort).'</span>';
                            echo '</div>';
                            echo '<div class="introduce">';
                            echo '<p>'.Html::encode($v->desc).'</p>';
                            echo ' <div class="ttype-attribute">产品属性：无</div>';
                            echo '</div>';
                            echo '<div class="seller-shade"></div>';
//                            echo '<div class="seller-shade-a"><a href="">删除</a></div>';
                            echo '</li>';
                        }
                    ?>
                </ul>
            </div>
            <?= LinkPager::widget(['pagination' => $pagination]); ?>
        </div>
    </div>
</div>

<div class="discount-fixed seller-fixed" id="ttpye-fixed1">
    <div class="dis-close">×</div>
    <div class="dis-head">编辑产品类别</div>
    <div class="dis-con">
        <form>
            <input type="text" value="茶叶" />
            <input type="text" value="A" />
            <textarea>产品类别简介</textarea>
            <textarea>产品属性（属性之间以逗号隔开）</textarea>
            <input type="submit" value="提交保存" class="dis-btn" />
        </form>
    </div>
</div>

<div class="discount-fixed seller-fixed" id="seller-fixed">
    <div class="dis-close">×</div>
    <div class="dis-head">添加产品类别</div>
    <div class="dis-con">
        <form>
            <input type="text" placeholder="产品类别名称" id="name" />
            <input type="text" placeholder="产品类别首字母（大写）" id="sort" />
            <textarea placeholder="产品类别简介" id="desc"></textarea>
            <textarea placeholder="产品属性（属性之间以逗号隔开）"></textarea>
            <input type="button" onclick="addProductCat()" value="确定" class="dis-btn" />
        </form>
    </div>
</div>