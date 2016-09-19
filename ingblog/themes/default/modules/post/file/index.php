<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\assets\AppAsset;
$this->title = '文件管理';
?>
<div class="row">
	<div class="panel-options">

		<ul class="nav nav-tabs">
			<li class="active"><a href="#file" data-toggle="tab" aria-expanded="true">媒体库</a>
			</li>
			<li class=""><a href="#upload" data-toggle="tab" aria-expanded="false">文件上传</a>
			</li>
		</ul>
	</div>
</div>
<div class="row">
<div class="panel-body">
	<div class="tab-content">
	<div class="row tab-pane active" id="file">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="file-manager">
						<h5>文件夹</h5>
						<ul style="padding: 0" class="folder-list">
							<? foreach(Yii::$app->params['file_type'] as $item): ?>
							<li><a href="javascript::"><i class="fa fa-folder"></i> <?= $item['title']?></a></li>
							<? endforeach; ?>
						</ul>
						<div class="clearfix"></div>
						<div class="file-info hide">
							<h5>文件详情</h5>
							<div class="row border-bottom">
								<div class="col-lg-8">
									<img src="" style="width:100%" class="file-url"/>
								</div>
								<div class="col-lg-4">
									<input type="hidden" value="" class="file-id"/>
									<p class="file-time"></p>
									<p class="file-size"></p>
									<p class="file-dimensions"></p>
									<button type="button" class="btn btn-xs btn-danger clearImage">永久删除</button>
								</div>
							</div>
							<div class="form-horizontal" style="margin-top:10px;">
								<div class="form-group">
									<label class="col-sm-4 control-label">标题：</label>
									<div class="col-sm-8">
										<input type="text" value="" class="form-control input-sm file-name file-info-input">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">描述：</label>
									<div class="col-sm-8">
										<textarea class="form-control input-sm file-desc file-info-input"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 animated fadeInRight">
			<div class="row" id="fileList">
					<? foreach($file_model['model'] as $item): ?>
					<div class="file-box">
						<div class="file" data-id="<?= $item->id?>">
							<a href="javascript:;">
								<span class="corner"></span>

								<div class="image">
									<img src="<?= \app\models\BaseService::getTypeFileUrl($item->savepath,'imagesDir');?>" data-id="<?= $item->id?>" class="img-responsive" alt="<?= $item->name?>">
								</div>
<!--								<div class="icon">-->
<!--									<i class="fa fa-file"></i>-->
<!--								</div>-->
								<div class="file-name">
									<?= $item->name;?>
									<br>
									<small>添加时间：<?= date("Y-m-d", $item->ctime)?></small>
								</div>
							</a>
						</div>
					</div>
					<? endforeach; ?>
			</div>
			<? echo LinkPager::widget(['pagination' => $file_model['page']]); ?>
		</div>
	</div>

	<div class="row tab-pane" id="upload">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>文件上传</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<form id="my-awesome-dropzone" class="dropzone" action="<?= \yii\helpers\Url::to(['/post/file/upload'])?>">
						<div class="dropzone-previews"></div>
						<input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf"/>
						<button type="submit" class="btn btn-primary pull-right">提交</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#fileList").on('click', '.file', function(){
			var file_id = $(this).attr('data-id');
			var url = '<?= \yii\helpers\Url::to(['/post/file/file-info'])?>';
			$.post(url, {id:file_id}, function(data){
				$(".file-url").attr('src', data.data.url);
				$('.file-time').html(data.data.ctime);
				$('.file-size').html(data.data.size);
				$('.file-dimensions').html(data.data.width+'×'+data.data.height);
				$(".file-id").val(data.data.id);
				$(".file-name").val(data.data.name);
				$('.file-desc').html(data.data.desc);
				$('.file-info').removeClass('hide');
			}, 'json');
		});
		$(".clearImage").click(function(){
			var file_id = $(".file-id").val();
			if(!file_id) {
				layer.msg('非法操作', {icon:11});return ;
			}
			layer.confirm('确定要删除吗?', {
				btn: ['确定','取消'] //按钮
			}, function(){
				var url = '<?= \yii\helpers\Url::to(['/post/file/delete'])?>';
				$.post(url, {id:file_id}, function(data){
					if(data.code == 1) {
						layer.msg(data.msg, {icon: 1});
						$('.file-info').addClass('hide');
						delFileNode(file_id);
					}else{
						layer.msg(data.msg, {icon: 11});
					}
				},'json');

			}, function(){
				layer.msg('主人,我依然爱你!!', {icon:1});
			});
		});
		$(".file-info-input").blur(function(){
			var file_id = $(".file-id").val();
			if(!file_id) {
				return ;
			}
			var url = '<?= \yii\helpers\Url::to(['/post/file/update'])?>';
			var name = $('.file-name').val();
			var desc = $(".file-desc").val();
			$.post(url, {id:file_id, name:name, desc:desc}, function(data){
				console.log(data);
			});
		});
	});
	function delFileNode(file_id) {
		$.each($(".file-box"), function(k,v){
			if($(this).find('.file').attr('data-id') == file_id) {
				$(this).remove();
				return ;
			}
		});
	}
</script>
<? AppAsset::addCss($this,'@web/plugins/dropzone/basic.css'); ?>
<? AppAsset::addCss($this,'@web/plugins/dropzone/dropzone.css'); ?>
<? AppAsset::addScript($this,'@web/plugins/dropzone/dropzone.js'); ?>
<script type="text/javascript">
	$(document).ready(function () {

		Dropzone.options.myAwesomeDropzone = {
			paramName:'UploadService[imageFiles]',
			autoProcessQueue: false,
			uploadMultiple: true,
			parallelUploads: 100,
			maxFiles: 100,
			maxFilesize:12,
			acceptedFiles:".jpg,.jpeg,.gif,.png",
			addRemoveLinks:true,    //添加删除链接
			dictDefaultMessage:'请选择文件',
			dictRemoveFile:'删除',
			dictCancelUpload:'取消',
			// Dropzone settings
			init: function () {
				var myDropzone = this;

				this.element.querySelector("button[type=submit]").addEventListener("click", function (e) {
					e.preventDefault();
					e.stopPropagation();
					myDropzone.processQueue();
				});
				this.on("sendingmultiple", function () {});
				this.on("successmultiple", function (files, response) {
					var responseObj = eval('(' + response + ')');
					console.log(responseObj);
					if(responseObj.code == 1) {
						$.each(responseObj.data, function(index, item){
							var html= '<div class="file-box"> <div data-id="'+item.id+'" class="file"> ' +
								'<a href="javascript:;"> ' +
								'<span class="corner"></span> ' +
								'<div class="image"> ' +
								'<img alt="'+item.name+'" class="img-responsive" data-id="'+item.id+'" src="'+item.url+'"> </div> ' +
								'<div class="file-name">'+files.name+'<br> <small>添加时间：'+item.time+'</small> </div> </a></div></div>';
							$("#fileList").prepend(html);
							$("#upload").removeClass('active');
							$("#file").addClass("active");
						});
					}else{
						layer.msg(responseObj.msg,{icon:11});
					}
				});
				this.on("errormultiple", function (files, response) {
					layer.msg('上传出错',{icon:11});
				});
			}

		}

	});
</script>

