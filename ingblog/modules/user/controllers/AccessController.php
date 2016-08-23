<?php

namespace app\modules\user\controllers;

use app\controllers\UserBaseController;
use app\modules\system\models\Menu;
use Yii;

/**
 * Default controller for the `user` module
 */
class AccessController extends UserBaseController
{

    public function actionIndex(){
        if(Yii::$app->request->isAjax) {
            $offset = Yii::$app->request->post('start');
            $limit = Yii::$app->request->post('length');
            $search = Yii::$app->request->post('search');

            $where = ['m.type'=>1];
            $config_list = Menu::getAdminNodeAll($where, $search['value'], $limit, $offset);
            $config_count = Menu::getAdminMenuCount(['type'=>1]);

            $return['draw'] = intval(Yii::$app->request->post('draw'));
            $return['result'] = $config_list;
            $return['recordsTotal'] = $limit;
            $return['recordsFiltered'] = $config_count;
            //$return['error'] = '系统错误，请稍后再试!';
            echo json_encode($return);exit;
        }
        return $this->render('index');
    }
}