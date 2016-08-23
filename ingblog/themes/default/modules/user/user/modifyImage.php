<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;
$this->title = '更换头像';
?>
<style type="text/css">
#target{max-width:800px;}
#file1, #btnUpload{display:inline;}
    .label{font-size:12px;}
</style>
<div class='row'>
    <div class='col-md-12'>
        <div class="ibox">
            <div class="ibox-title">
                <h5>修改头像</h5>
            </div>
            <div class='ibox-content'>
                <div class="container">
                    <div class="section">
                        <div class="row">
                            <label><span class="label">当前头像：</span></label>
                            <img id="avatar" src="<?=$model->showAvatar();?>" />
                        </div>
                        <div class="row" style="margin-top:15px;">
                            <label><span class="label">上传图片：</span></label>
                            <input type="file" id="file1" name="UploadService[avatar_url]"/>
                            <input type="hidden" id="img" name="img" />
                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />
                            <button class="btn btn-success " type="button" id="btnUpload">
                                <i class="fa fa-upload"></i>
                                <span class="bold">上传</span>
                            </button>
                        </div>
                        <div class="row imgchoose" style="display:none;"><label><span class="label">编辑头像：</span></label><img src="" id="target" /></div>
                        <div class="row imgchoose" style="display:none;">
                            头像预览：<br />
                            <div style="width:200px;height:200px;margin:10px 10px 10px 0;overflow:hidden; float:left;"><img class="preview" id="preview3" src="" /></div>
                            <div style="width:130px;height:130px;margin:80px 0 10px;overflow:hidden; float:left;"><img class="preview" id="preview2" src="" /></div>
                            <div style="width:112px;height:112px;margin:98px 0 10px 10px;overflow:hidden; float:left;"><img class="preview" id="preview" src="" /></div>
                        </div>
                        <div class="row imgchoose" style="display:none;">
                            <button class="btn btn-info " type="button" id="avatar_submit">
                                <i class="fa fa-paste"></i>
                                裁切
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? AppAsset::addScript($this,'@web/js/jquery.ajaxfileupload.js'); ?>
<? //AppAsset::addScript($this,'@web/plugins/uploadify/jquery.uploadify-3.1.js'); ?>
<? AppAsset::addScript($this,'@web/plugins/jcrop/jquery.Jcrop.min.js'); ?>
<? //AppAsset::addCss($this,'@web/plugins/uploadify/uploadify.css'); ?>
<? AppAsset::addCss($this,'@web/plugins/jcrop/jquery.Jcrop.css'); ?>
<script type="text/javascript">
$(function(){
        $("#btnUpload").click(function () {

            ajaxFileUpload();

        });
        function ajaxFileUpload() {
            $.ajaxFileUpload({
                url: '', //用于文件上传的服务器端请求地址
                secureuri: false, //一般设置为false
                fileElementId: 'file1', //文件上传空间的id属性  <input type="file" id="file" name="file" />
                dataType: 'json', //返回值类型 一般设置为json
                success: function (data, status)  //服务器成功响应处理函数
                {
                    var avatarUrl = '<?=substr(Yii::$app->params['avatarDir'],1);?>' + data.avatar_url;
                    $("#img").val( data.avatar_url );
                    $("#target").attr("src",avatarUrl);
                    $(".preview").attr("src",avatarUrl);
                    $('#target').Jcrop({
                            minSize: [50,50],
                            setSelect: [0,0,200,200],
                            onChange: updatePreview,
                            onSelect: updatePreview,
                            onSelect: updateCoords,
                            aspectRatio: 1
                        },
                        function(){
                            // Use the API to get the real image size
                            var bounds = this.getBounds();
                            boundx = bounds[0];
                            boundy = bounds[1];
                            // Store the API in the jcrop_api variable
                            jcrop_api = this;
                        });
                    $(".imgchoose").show(1000);
                    $("#avatar_submit").show(1000);

                },
                error: function (data, status, e)//服务器响应失败处理函数
                {
                    alert(e);
                }
            })
            return false;
        }
        //首页轮播图1
//        $("#avatarUpload").uploadify({
//            'multi'				: false,
//            'uploadLimit'		: 1,
//            'buttonText'		: '请选择图片',
//            'height'			: 20,
//            'width'				: 120,
//            'removeCompleted'	: false,
//            'swf'				: 'http://localhost/ingblog/web/plugins/uploadify/uploadify.swf',
//            'uploader'			: '',
//            'fileTypeExts'		: '*.gif; *.jpg; *.jpeg; *.png;',
//            'fileSizeLimit'		: '1024KB',
//            'fileObjName'       : 'UploadService[avatar_url]',
//            'method'            : 'Post',
//            'formData'          : {'UploadService[avatar_url]':'aaa','_csrf':'ZThwLkMwSnMyXwdfDgQ/QyltN1YOVRADKXYxfTtGCF4zfTpFckQHSw==' },
//            'onUploadSuccess' : function(file, data, response) {
//                var msg = $.parseJSON(data);
//                if( msg.result_code == 1 ){
//                    $("#img").val( msg.result_des );
//                    $("#target").attr("src",msg.result_des);
//                    $(".preview").attr("src",msg.result_des);
//                    $('#target').Jcrop({
//                            minSize: [50,50],
//                            setSelect: [0,0,200,200],
//                            onChange: updatePreview,
//                            onSelect: updatePreview,
//                            onSelect: updateCoords,
//                            aspectRatio: 1
//                        },
//                        function(){
//                            // Use the API to get the real image size
//                            var bounds = this.getBounds();
//                            boundx = bounds[0];
//                            boundy = bounds[1];
//                            // Store the API in the jcrop_api variable
//                            jcrop_api = this;
//                        });
//                    $(".imgchoose").show(1000);
//                    $("#avatar_submit").show(1000);
//                } else {
//                    alert('上传失败');
//                }
//            },
//            'onClearQueue' : function(queueItemCount) {
//                alert( $('#img1') );
//            },
//            'onCancel' : function(file) {
//                alert('The file ' + file.name + ' was cancelled.');
//            }
//        });

        //头像裁剪
        var jcrop_api, boundx, boundy;

        function updateCoords(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };
        function checkCoords()
        {
            if (parseInt($('#w').val())) return true;
            layer.msg('请选择图片上合适的区域', {icon:11});
            return false;
        };
        function updatePreview(c){
            if (parseInt(c.w) > 0){
                var rx = 112 / c.w;
                var ry = 112 / c.h;
                $('#preview').css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
            {
                var rx = 130 / c.w;
                var ry = 130 / c.h;
                $('#preview2').css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
            {
                var rx = 200 / c.w;
                var ry = 200 / c.h;
                $('#preview3').css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        };

        $("#avatar_submit").click(function(){
            var img = $("#img").val();
            var x = $("#x").val();
            var y = $("#y").val();
            var w = $("#w").val();
            var h = $("#h").val();
            if( checkCoords() ){
                $.ajax({
                    type: "POST",
                    url: '<?=\yii\helpers\Url::to(['/user/user/cutimg']);?>',
                    data: {"img":img,"x":x,"y":y,"w":w,"h":h},
                    dataType: "json",
                    success: function(msg){
                        if( msg.code == 1 ){
                            $('html,body').animate({scrollTop:$('#avatar').offset().top-150},1000,'swing',function(){
                                $('#avatar_msg').show();
                                $('#avatar').attr('src',msg.data);
                                $(".imgchoose").hide();
                                layer.msg('头像修改成功!', {icon:1});
                            });
                        } else {
                            layer.msg('操作失败!', {icon:11});
                        }
                    }
                });
            }
        });
});
</script>