<?php
use yii\helpers\Html;
use app\assets\AppAsset;
$this->title = '添加文章';
?>
<style>
    .delete{  cursor:pointer;  }
    .delete:hover{  color: #ff103e;  }
    .green{background:green;}
    .min{width:50px;height:50px;margin:0 3px;}
    .imageTotal{font-size:16px;}
</style>
<form method="post" class="form-horizontal" id="postForm" action="<?= \yii\helpers\Url::to(['/post/post/create'])?>" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins">
            <div class="ibox-content mailbox-content">
                <div class="file-manager">
                    <div class="space-25"></div>
                    <h5>文件夹</h5>
                    <ul style="padding: 0" class="folder-list m-b-md">
                        <li>
                            <a href="mailbox.html"> <i class="fa fa-inbox "></i> 文章 <span class="label label-warning pull-right">16</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailbox.html"> <i class="fa fa-file-text-o"></i> 草稿 <span class="label label-danger pull-right">2</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailbox.html"> <i class="fa fa-trash-o"></i> 垃圾箱</a>
                        </li>
                    </ul>
                    <h5>分类</h5>
                    <div style="padding: 0" class="category-list">
                    </div>
                    <p>
                        <button class="btn btn-block btn-outline btn-primary" type="button" id="addCatShow"><i class="fa fa-plus-square"></i> 添加新分类</button>
                        <input type="hidden" name="PostService[cat_id]" id="cat_id" value="<?= $post_info['cat_id']?>"/>
                    </p>
                    <p id="cat-name">
                        <? if($post_info['cat_id']):?>
                            <span class="label label-primary">
                            <?= $post_info['name'];?>&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-times delete"></i>
                            </span>
                        <? endif; ?>
                    </p>
                    <div class="addCatDiv hidden">
                        <div class="input-group">
                            <input type="text" class="form-control" name="catName">
                            <span class="input-group-btn"> <button class="btn btn-primary" type="button" id="addCat">添加</button> </span>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-white" tabindex="-1" id="select_parent_id">选择父分类</button>
                            <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <input type="hidden" value="0" name="parent_id" />
                            <ul class="dropdown-menu catList-menu"></ul>
                        </div>
                    </div>
                    <h5 class="tag-title">标签</h5>
                    <ul style="padding: 0" class="tag-list">
                        <?php foreach($tagList as $tag):?>
                        <li name="<?= $tag['tag_id']?>"><a class="btn"><i class="fa fa-tag"></i> <?= $tag['tagname']?></a></li>
                        <?php endforeach;?>
                    </ul>
                    <div class="clearfix"></div>
                    <p>
                        <button class="btn btn-block btn-outline btn-success" type="button" id="addTagShow"><i class="fa fa-plus-square"></i> 添加新标签</button>
                        <input type="hidden" name="PostService[tag_ids]" id="tag_ids" value="<?= $post_info['tag_ids'];?>"/>
                    </p>
                    <p id="tag-name">
                        <? if($post_info['tag_ids']):
                            foreach($post_info['tag_list'] as $item):?>
                            <span name="<?= $item['tag_id']?>" class="label label-success tag_names"> <?= $item['tagname'];?>&nbsp;&nbsp;&nbsp;<i class="fa fa-times delete"></i></span>
                        <? endforeach; endif; ?>

                    </p>
                    <div class="input-group hidden addTagDiv">
                        <input type="text" class="form-control" name="tagName">
                        <span class="input-group-btn"> <button class="btn btn-success" type="button" id="addTag">添加</button> </span>
                    </div>
                    <h5 class="tag-title">封面图片</h5>
                    <p><input type="file" name="UploadService[editor_img]" class="control"></p>
                    <?
                    if($post_info['cover_url']):?>
                        <img src="<?= $post_info['cover_url']?>">
                    <? endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="mail-box-header">
            <div class="pull-right tooltip-demo">
                <button title="存为草稿" data-placement="top" data-toggle="tooltip" class="btn btn-white btn-sm addPost" name="2"><i class="fa fa-pencil"></i> 存为草稿</button>
                <a title="放弃" data-placement="top" data-toggle="tooltip" class="btn btn-danger btn-sm" href="<?= \yii\helpers\Url::to(['/post/post/index'])?>"><i class="fa fa-times"></i> 放弃</a>
            </div>
            <h2>
                写文章
            </h2>
        </div>
        <div class="mail-box">
            <form method="get" class="form-horizontal" id="postForm">

            <div class="mail-body">


                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题：</label>

                        <div class="col-sm-10">
                            <input type="text" value="<?= $post_info['title']?>" name="PostService[title]" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">作者：</label>

                        <div class="col-sm-10">
                            <input type="text" value="<? if($post_info['author']){echo $post_info['author'];}else{echo $nickname;}?>" name="PostService[author]" id="author" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">类型：</label>

                        <div class="col-sm-10">
                            <select name="PostService[type]" class="form-control" id="type">
                            <? foreach(Yii::$app->params['post_type'] as $item): ?>
                                <option value="<?= $item['id'];?>" <? if($item['id'] == $post_info['type']): ?> selected <? endif; ?>><?= $item['title'];?></option>
                            <? endforeach; ?>
                            </select>
                        </div>
                    </div>

            </div>
                <div class="mail-body">
                    <button data-target="#myModal" data-toggle="modal" class="btn btn-default" type="button">
                        添加媒体文件
                    </button>
                </div>
            <div class="mail-text h-200">
                <input type="hidden" name="PostService[content]" id="content" value=""/>
                <div id="summernote"><?= $post_info['content'];?></div>
                <div class="clearfix"></div>
            </div>
            <div class="mail-body text-right tooltip-demo">
                <input type="hidden" name="PostService[id]" value="<?= $post_info['id'];?>">
                <input type="hidden" name="PostService[is_del]" value="0" class="is_del">
                <button type="submit" class="btn btn-primary addPost">提交</button>
                <a title="放弃" data-placement="top" data-toggle="tooltip" class="btn btn-white btn-sm" href="<?= \yii\helpers\Url::to(['/post/post/index'])?>"><i class="fa fa-times"></i> 放弃</a>
                <button type="submit" title="存为草稿" data-placement="top" data-toggle="tooltip" class="btn btn-white btn-sm addPost" name="2"><i class="fa fa-pencil"></i> 存为草稿</button>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>
</form>
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal inmodal" style="overflow:hidden;">
    <div class="modal-dialog modal-lg" style="width:95%;">
        <div class="modal-content animated bounceInRight">
            <div class="ibox-title"><h3>媒体库</h3></div>
            <div class="">
                <div class="model-body" style="max-height:580px;overflow-y:auto;overflow-x:hidden; ">
                <?= $this->render('../file/index', ['file_model'=>$file_model]);?>
                </div>
                <div class="modal-footer row">
                    <div class="col-lg-1">
                        <span class="imageTotal">已选0个</span>
                        <button class="btn btn-xs btn-danger clearImage" type="button">清空</button>
                    </div>
                    <div class="col-lg-9 text-left imageSelect">

                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary addImages">插入</button></div>
                </div>
            </div>
            <small class="font-bold"></small></div>
        <small class="font-bold"></small>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".file-box .file").click(function(){
            if($(this).find(".corner").hasClass("green")) {
                $(this).find(".corner").removeClass('green');
                removeImage($(this).attr("data-id"));
            }else{
                $(this).find(".corner").addClass('green');
                $(".imageSelect").append($(this).find(".image").html());
                $(".imageSelect img").removeClass("img-responsive").addClass("min");
            }
            $(".imageTotal").html("已选"+$(".imageSelect img").length+"个");
        });
        $(".clearImage").click(function(){
            $(".imageSelect").html("");
            $(".imageTotal").html("已选0个");
        });
        $(".addImages").click(function(){
            var file_ids = getImageIds();

            var type = $("#type").val();
            if(type == 1) {cancel_model(); return ;}

            if(file_ids.length==0) {
                layer.msg('请选择媒体',{icon:11});
                return ;
            }
            cancel_model();
            $('#summernote').summernote('code', file_ids.join(','));
        });
    });
    function removeImage(id) {
        $.each($(".imageSelect img"), function(){
            if($(this).attr('data-id') == id) {
                $(this).remove();
            }
        });
    }
    function getImageIds() {
        var type = $("#type").val();
        var ids = [];
        $.each($(".imageSelect img"), function(k){
            if(type == 1){//文章
                $('#summernote').summernote('insertImage', $(this).attr('src').replace('min','big'), $(this).attr('alt'));
            }else {
                ids[k] = $(this).attr('data-id');
            }
        });
        return ids;
    }
    function cancel_model(){
        $("#myModal").hide();
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
    }
</script>
<? AppAsset::addCss($this,'@web/css/plugins/summernote/summernote.css'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/summernote/summernote.min.js'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/summernote/summernote-zh-CN.min.js'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/validate/jquery.validate.min.js'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/treeview/bootstrap-treeview.js'); ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('#summernote').summernote({
            lang: 'zh-CN',
            height: 300,
            focus:true,
            callbacks: {
                onImageUpload: function(files) {
                    sendFile(files[0]);
                }
            },
//            toolbar: [
//                ['style', ['bold', 'italic', 'underline', 'clear']],
//                ['font', ['strikethrough', 'superscript', 'subscript']],
//                ['fontsize', ['fontsize']],
//                ['color', ['color']],
//                ['para', ['ul', 'ol', 'paragraph']],
//                ['insert',['link','table','hr']],
//                ['height', ['height']]
//            ]
        });

        //以下为修改jQuery Validation插件兼容Bootstrap的方法，没有直接写在插件中是为了便于插件升级
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: "span",
            errorClass: "help-block m-b-none",
            validClass: "help-block m-b-none"


        });
        $("#postForm").validate({
            rules: {
                'PostService[title]': {
                    required: true,
                    minlength: 2
                },
                'PostService[author]': {
                    required: true,
                    minlength: 2
                },
                'PostService[content]': {
                    required: true,
                    minlength: 20,
                },
            },
            messages: {
                'PostService[title]': {
                    required: "请填写标题",
                    minlength: "标题必须两个字符以上"
                },
                'PostService[author]': {
                    required: "请填写作者",
                    minlength: "作者必须2个字符以上"
                },
                'PostService[content]': {
                    required: "内容不能为空哦",
                    minlength: "内容必须3个字符以上",
                },
            }
        });

        $(".addPost").click(function(){
            var content = $('#summernote').summernote('code');
            if(content.length < 3) {
                layer.msg('内容必须3个字符以上', {icon:2});
                return false;
            }
            var is_del = $(this).attr("name");
            if(is_del == 2) {
                $(".is_del").val(2);
            }
            $("#content").val(content);

        });
    });

    $(function(){
        //分类树形结构
        $(".category-list").treeview({
            data:'<?= $catList?>',
            levels: 10,
            nodeIcon: 'fa fa-circle',
            selectedBackColor: '#1ab394',
            onNodeSelected: function (event, node) {
                set_cat(node.cat_id, node.text);
            }
        });
        $(".catList-menu").treeview({
            data:'<?= $catList?>',
            levels: 10,
            nodeIcon: 'fa fa-circle',
            selectedBackColor: '#1ab394',
            onNodeSelected: function (event, node) {
                $("input[name=parent_id]").val(node.cat_id);
                $("#select_parent_id").html(node.text);
            }
        });
        //显示添加分类div
        $("#addCatShow").click(function(){
            $(".addCatDiv").removeClass('hidden');
        });
        //添加分类
        $("#addCat").click(function(){
            var parent_id = $("input[name=parent_id]").val();
            var name = $("input[name=catName]").val();
            if(name == '') {
                layer.msg('请输入分类名',{icon:11});return ;
            }
            var url = '<?= \yii\helpers\Url::to(['/post/cat/ajax-add-cat'])?>';
            $.post(url, {name:name, parent_id:parent_id}, function(data){
                if(data.code == 1) {
                    set_cat(data.data.cat_id, name);
                    layer.msg(data.msg, {icon:1});
                }else{
                    layer.msg(data.msg, {icon:11});
                }
            }, 'json');
        });

        //显示添加标签div
        $("#addTagShow").click(function(){
            $(".addTagDiv").removeClass('hidden');
        });

        //添加标签
        $("#addTag").click(function(){
            var tagName = $("input[name=tagName]").val();
            if(tagName == '') {
                layer.msg('请输入标签名', {icon:11});
            }
            var url = '<?= \yii\helpers\Url::to(['/post/tag/ajax-add-tag'])?>';
            $.post(url, {tagName:tagName}, function(data) {
                if(data.code == 1) {console.log(data);
                    set_tag(data.data.tag_id, tagName);
                    layer.msg(data.msg, {icon:1});
                }else{
                    layer.msg(data.msg, {icon:11});
                }
            },'json');
        });
        $(".tag-list li").click(function(){
            set_tag($(this).attr("name"), $(this).text());
        });

        $("#tag-name").on('click','.delete', function(){
            $(this).parent().remove();
            $("#tag_ids").val(get_tag_ids());
        });
        $("#cat-name").on('click','.delete', function(){
            $(this).parent().remove();
            $("#cat_id").val('');
        });
    });

    function set_tag(id, name){
        if(check_exist(name)) return ;
        $("#tag-name").append('<span class="label label-success tag_names" name="'+id+'">'+name+'&nbsp;&nbsp;&nbsp;<i class="fa fa-times delete"></i></span>');
        $("#tag_ids").val(get_tag_ids());
    }

    function set_cat(id, name) {
        $("#cat-name").html('<span class="label label-primary">'+name+'&nbsp;&nbsp;&nbsp;<i class="fa fa-times delete"></i></span>');
        $("#cat_id").val(id);
    }

    function check_exist(name) {
        var is_return = 0;
        $(".tag_names").each(function(k, v){
            if($(this).text().trim() == name.trim()) {
                is_return = 1;return ;
            }
        });
        if(is_return == 1) {
            return true;
        }else{
            return false;
        }
    }

    function get_tag_ids() {
        var ids = [];
        $(".tag_names").each(function(k, v){
            ids[k] = $(this).attr("name");
        });
        if(ids.length == 0) return '';
        return ids.join(',');
    }

    function sendFile(file) {
        var data = new FormData();
        data.append("UploadService[editor_img]", file);
        var url = '<?= \yii\helpers\Url::to(['/post/post/editor-upload-image'])?>';
        $.ajax({
            data: data,
            type: "POST",
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            success: function(result) {
                if(result.code == 1) {
                    $('#summernote').summernote('insertImage', result.data, 'editor');
                }else{
                    layer.msg(result.msg);
                }
            }
        });
    }
</script>
