<div class="container adminIndex">
    <div class="adminIndex-con">
        <div class="adminCon-left">
            <?php
            use yii\helpers\Html;
            use yii\bootstrap\ActiveForm;
            use common\widgets\Tool;
            use yii\web;
            use yii\base;
            use kucha\ueditor\UEditor;
            $admin_cur="video";
            ?>
            <?=$this->render(\common\widgets\Variable::$layoutAdminLeftMenu_view,['admin_cur'=>$admin_cur]); ?>
        </div>
        <div class="adminCon-right">
            <?php
            $this->title='视频管理';
            echo  Tool::setBreadcrumbs([[$this->title]])
            ?>
            <div class="" id="seller-fixed">
                <div class="row dis-con">
<!--                    <p style="color: red;font-size: 18px">系统检测：This browser does not support HTML5 video!</p>-->
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">本地上传</a></li>
<!--                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">网络视频源 </a></li>-->
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <form>
                                    <input id="projectfile" name="file" type="file" />
                                </form>

                            </div>
<!--                            <div role="tabpanel" class="tab-pane" id="profile">-->
<!--                                <div id="barform-name" class="multiple-input">-->
<!--                                    <table class="multiple-input-list table table-condensed" id="rowTable">-->
<!--                                        <thead>-->
<!--                                        <tr><th class="list-cell__user_id">网络链接</th>-->
<!--                                            <th class="list-cell__button"></th>-->
<!--                                        </tr>-->
<!--                                        </thead>-->
<!--                                        <tbody>-->
<!--                                        <input type="hidden" value="1020" id="barId">-->
<!--                                        <tr class="list__item">-->
<!--                                            <td class="list_name">-->
<!--                                                <div class="form-group">-->
<!--                                                    <input type="text" id="videoLink" class="input-priority col-lg-3 form-control barName" value="=$video->address">-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                            <td>-->
<!--                                                <div class="btn btn btn-success" onclick="submitVideo()">确定</div>-->
<!--                                                <!--                                                <div class="btn btn btn-cancel" style="margin-left: 4px;" onclick="deleteOnRowForCus(this,1020)">删除</div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>

                    </div>

                </div>
                <div class="row "style="margin-top: 30px">
                    <p>提示：</p>
                    <p>1）考虑到浏览器兼容性问题，请最好选择<b style="color: red">mp4、mov、mpeg等格式的视频上传</b></p>
                    <p>2）本地上传的视频文件不能超过<b style="color: red">50M</b></p>
                    <p>3）上传本地视频在下面的视频栏没有播放，则说明本地视文件格式不符合或者超出了50M，请重新上传</p>
<!--                    <p>2）上传本地视频或者添加的网络视频源在下面的视频栏没有播放，则说明本地视频或者网络视频源不存在，请重新上传</p>-->
                    <p>4）系统配置需要把php.ini里的upload_max_filesize=50</p>
                </div>
                <div class="row" style="margin-top: 50px">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6">
                        <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="264"

                               data-setup="{}">
                            <source src="<?=$video->address?>" type='video/swf' />
                            <source src="<?=$video->address?>" type='video/mp4' />
                            <source src="<?=$video->address?>" type='video/mp3' />
                            <source src="<?=$video->address?>" type='video/webm' />
                            <source src="<?=$video->address?>" type='video/ogg' />
                            <source src="<?=$video->address?>" type='video/mov' />
                            <source src="<?=$video->address?>" type='video/flv' />
                            <object data="<?=$video->address?>">
                            <track kind="captions" src="/video/demo.captions.vtt" srclang="en" label="English"></track>
                            <track kind="subtitles" src="/video/demo.captions.vtt" srclang="en" label="English"></track>
                        </video>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('myjs') ?>

$(function() {
$('#projectfile').uploadify({
'swf'      : '/uploadify/uploadify.swf',
'uploader' : '/websettingmanger/uploadvideo',
'formData': {'projectid': '${project.id}'},
'fileObjName' : 'file',
'fileSizeLimit' : '0',
'auto':true,
'width':'200',
'height':'60',
'buttonImg':'/img/index_03.png',
'cancelImg':'/img/index_03.png',
'fileDesc': '请选择视频',
'buttonText': '点击选择视频文件',
'multi': false,
'fileExt':'*.mp4;*.ogg,*.webm,*.flv,*.swf',
'onQueueComplete' : function(queueData) {
alert('文件上传成功');
LocationPageByTimeOut('', 1);
}
});
});

videojs.options.flash.swf = "/video/video-js.swf";
<?php $this->endBlock() ?>

<?php $this->registerJs($this->blocks['myjs'], \yii\web\View::POS_END); ?>