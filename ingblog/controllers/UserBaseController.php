<?php
/**
 * Created by PhpStorm.
 * User: tanbin2
 * Date: 2016/6/21
 * Time: 15:01
 */

namespace app\controllers;
use app\modules\system\models\Menu;
use app\modules\user\models\User;
use Yii;
use yii\helpers\Url;

class UserBaseController extends BaseController{

    public function init() {
        parent::init();
        $this->layout='@app/themes/default/layouts/header.php';

        $this->checkLogin();
    }

    private function checkLogin(){
        if(Yii::$app->user->isGuest){
            return $this->redirect(['/user/default/login']);
        }else{
            if(User::getUser()->group_id != Yii::$app->params['adminId']) {
                $this->checkAccess();
            }
        }
    }

    public function checkAccess() {
        if (empty(Yii::$app->catchAll)) {
            list ($route, $params) = Yii::$app->request->resolve();
        } else {
            $route = Yii::$app->catchAll[0];
            $params = Yii::$app->catchAll;
            unset($params[0]);
        }
        $access_list = Menu::getAccessNode();
        if($access_list) {
            if (!in_array('/' . $route, $access_list)) {
                Yii::$app->getSession()->setFlash('error', '没有权限哦!');
                return $this->redirect(['/']);
            }
        }
    }

}