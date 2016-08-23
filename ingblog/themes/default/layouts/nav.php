<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\modules\user\models\UserInfo;

$service_model = new \app\models\UploadService();
$avatar = $service_model->showAvatar();
?>
<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">

                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?= $avatar; ?>" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= \app\modules\user\models\User::getUserName()?></strong>
                             </span> <span class="text-muted text-xs block">超级管理员 <b class="caret"></b></span> </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?= Url::to(['/user/user/modify-image'])?>">修改头像</a></li>
                                <li><a href="<?= Url::to(['/user/user/modify-password']);?>">修改密码</a></li>
                                <li><a href="<?= Url::to(['/user/user/user-list'])?>">联系我们</a></li>
                                <li><a href="<?= Url::to(['/post/post/create'])?>">写文章</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= Url::to(['/user/default/loyout']);?>">安全退出</a></li>
                            </ul>
                        </div>
                        <div class="logo-element"><?= \app\modules\user\models\User::getUserName()?></div>
                    </li>
                    <? foreach(\app\modules\system\models\Menu::getAdminMenuList('tier') as $item):?>
                        <li <? if($item['url'] == Yii::$app->controller->module->id || (Yii::$app->controller->module->id=='index' && $item['url']=='/')): ?> class="active" <?endif?> >
                            <a href="<?= Url::to([$item['url']])?>"><i class="fa <?= $item['icon']?>"></i> <span class="nav-label"><?= $item['title']?></span></a>
                            <? if (isset($item['_child']) && is_array($item['_child'])): ?>
                                <ul class="nav nav-second-level">
                                <? foreach($item['_child'] as $child): ?>
                                    <li <? if($child['url'] == '/'.Yii::$app->request->resolve()[0]): ?>class="active" <? endif; ?>><a href="<?= Url::to([$child['url']])?>"><?= $child['title']?></a></li>
                                <? endforeach; ?>
                                </ul>
                            <? endif;?>
                        </li>
                    <? endforeach;?>
                </ul>
            </div>
        </nav>
<?
//echo $name = Yii::$app->controller->id;  // controller
//
//echo $name = Yii::$app->controller->action->id;
//
//echo $name = Yii::$app->controller->module->id;
?>