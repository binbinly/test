<?php

namespace app\modules\other\controllers;

use app\controllers\UserBaseController;
use yii\web\Controller;

/**
 * Default controller for the `other` module
 */
class DefaultController extends UserBaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
