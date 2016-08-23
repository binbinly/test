<?php

namespace app\modules\post\controllers;

use app\controllers\UserBaseController;
use yii\web\Controller;

/**
 * Default controller for the `post` module
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
