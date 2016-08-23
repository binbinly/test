<?php

namespace app\modules\user\controllers;

use app\modules\user\models\LoginForm;
use Yii;
use app\controllers\LoginBaseController;

/**
 * Default controller for the `user` module
 */
class DefaultController extends LoginBaseController
{

//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => \yii\filters\AccessControl::className(),
//                'only' => ['logout','signin','activate-account','find-password','reset-password','modify-password','modify-info','modify-image','send-message',
//                    'focus','nofocus','show-fans','show-fans2','show-focus','show-focus2'],
//                'rules' => [
//                    ['actions' => ['activate-account','find-password','reset-password'],'allow' => true,'roles'=>['?']],
//                    ['actions' => ['logout','modify-password','modify-info','modify-image','signin','send-message','focus','nofocus','show-fans','show-fans2','show-focus','show-focus2'],
//                        'allow' => true,'roles'=>['@']
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => \yii\filters\VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLogin(){
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionRegister(){
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->register()) {
            return $this->goHome();
        }
        return $this->render('register', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/user/default/login']);
    }
}
