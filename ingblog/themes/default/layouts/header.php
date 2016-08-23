<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper">
    <?=$this->render('nav');?>
    <div id="page-wrapper" class="gray-bg dashbard-1">
    <?=$this->render('right_top');?>
    <div class="wrapper wrapper-content">
    <?= $content ?>
    </div>
    </div>
</div>
<?=$this->render('footer');?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
