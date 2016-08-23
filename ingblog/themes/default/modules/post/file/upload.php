<?php
use yii\helpers\Html;
use app\assets\AppAsset;
$this->title = '文件上传';
?>
<div class="row">
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
                <form id="my-awesome-dropzone" class="dropzone" action="#">
                    <div class="dropzone-previews"></div>
                    <input type="hidden" value="<?php echo Yii::$app->getRequest()->getCsrfToken(); ?>" name="_csrf"/>
                    <button type="submit" class="btn btn-primary pull-right">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>

<? AppAsset::addCss($this,'@web/plugins/dropzone/basic.css'); ?>
<? AppAsset::addCss($this,'@web/plugins/dropzone/dropzone.css'); ?>
<? AppAsset::addScript($this,'@web/plugins/dropzone/dropzone.js'); ?>
<script>
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
                this.on("successmultiple", function (files, response) {});
                this.on("errormultiple", function (files, response) {});
            }

        }

    });
</script>

