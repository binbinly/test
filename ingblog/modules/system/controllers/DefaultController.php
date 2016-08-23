<?php

namespace app\modules\system\controllers;

use app\controllers\UserBaseController;
use yii\web\Controller;

/**
 * Default controller for the `system` module
 */
class DefaultController extends UserBaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
