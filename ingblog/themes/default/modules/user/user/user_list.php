<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;
//日期组件：composer require kartik-v/yii2-widget-datepicker "@dev"
//use kartik\date\DatePicker;
$this->title = '管理员列表';
?>
<style type="text/css">
    .pull-right a{color:white;}
</style>
<div class="row">
    <? foreach($user_list as $user):?>
    <div class="col-lg-4">
        <div class="contact-box">
            <div class="col-sm-4">
                <div class="text-center">
                    <img alt="image" class="img-circle m-t-xs img-responsive" src="<?= $user['avatar_url']?>">
                    <div class="m-t-xs font-bold"><?= $user['group_name']?>
                        <? if($user['gender'] == 1):?>
                        <i class="fa fa-mars" style="color:blue;"></i>
                        <? else:?>
                        <i class="fa fa-venus" style="color:mediumvioletred;"></i>
                        <? endif;?>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <h3><strong><?= $user['nickname'];?></strong></h3>
                <p><i class="fa fa-map-marker"></i> <?= $user['location']?></p>
                <address>
                    qq：<?= $user['qq'];?><br>
                    生日：<?= $user['birthday'];?><br>
                    签名：<?= $user['signature'];?><br>
                </address>
            </div>
            <div class="row">
                <div class="pull-right">
                    <a title="编辑" href="<?= \yii\helpers\Url::to(['/user/user/modify-info'])?>?uid=<?= $user['id']?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <button title="删除" data-index="0" data-id="<?= $user['id']?>" class="btn btn-xs btn-danger del-user"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <? endforeach;?>
</div>
<? AppAsset::addCss($this,'@web/plugins/My97DatePicker/skin/WdatePicker.css'); ?>
<? AppAsset::addScript($this,'@web/plugins/My97DatePicker/WdatePicker.js'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.contact-box').each(function () {
            animationHover(this, 'pulse');
        });

        $(".contact-box").on('click', '.del-user', function(){
            var user_id = $(this).attr('data-id');
            var url = '<?= \yii\helpers\Url::to(['/user/user/delete'])?>';
            var _this = $(this);
            layer.confirm('确定要删除吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {id:user_id}, function(data){
                    if(data.code == 1) {
                        layer.msg(data.msg, {icon: 1});
                        _this.parents('.contact-box').remove();
                    }else{
                        layer.msg(data.msg, {icon: 11});
                    }
                },'json');

            }, function(){
                layer.msg('主人爱你哦!', {icon:1});
            });
        });
    });
</script>
