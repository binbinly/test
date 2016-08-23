<?php
/**
 * Created by PhpStorm.
 * User: tanbin2
 * Date: 2016/6/21
 * Time: 15:01
 */

namespace app\controllers;

class LoginBaseController extends BaseController{

    public function init() {
        parent::init();
        $this->layout='@app/themes/default/layouts/main_user.php';
    }

}