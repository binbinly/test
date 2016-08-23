<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:;"><i class="fa fa-bars"></i> </a>
<!--            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">-->
<!--                <div class="form-group">-->
<!--                    <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">-->
<!--                </div>-->
<!--            </form>-->
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message"><a href="<?= Url::to(['/index'])?>" title="返回首页"><i class="fa fa-home"></i></a>欢迎你，<?= \app\modules\user\models\User::getUserName()?></span>
            </li>
            <li>
                <a href="<?=Url::to(['/user/default/logout']);?>">
                    <i class="fa fa-sign-out"></i> 退出
                </a>
            </li>
        </ul>

    </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <?= \app\controllers\BaseController::formatNav();?>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<?
use yii\bootstrap\Alert;
if( Yii::$app->getSession()->hasFlash('success') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success', //这里是提示框的class
        ],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);
}
if( Yii::$app->getSession()->hasFlash('error') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-danger',
        ],
        'body' => Yii::$app->getSession()->getFlash('error'),
    ]);
}
?>
