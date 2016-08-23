<?php

namespace app\modules\user\controllers;

use app\models\BaseService;
use app\modules\user\models\District;
use app\modules\user\models\ModifyPasswordForm;
use app\modules\user\models\User;
use app\modules\user\models\UserInfo;
use app\models\UploadService;
use app\modules\user\service\UserInfoService;
use lib\Thumb;
use Yii;
use app\controllers\UserBaseController;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * Default controller for the `user` module
 */
class UserController extends UserBaseController
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
    public $enableCsrfValidation = false;

    //知道密码的情况下修改密码
    public function actionModifyPassword()
    {
        $model = new ModifyPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->modifyPassword()){
            Yii::$app->getSession()->setFlash('success','密码修改成功');
            return $this->refresh();
        }
        return $this->render('modifyPassword',['model'=>$model]);
    }

    //修改个人信息
    public function actionModifyInfo()
    {
        $uid = Yii::$app->request->get('uid');
        $model = new UserInfoService();
        if($uid) $model->scenario = 'edit';
        if ($model->load(Yii::$app->request->post()) && $model->saveUserInfo()){
            Yii::$app->getSession()->setFlash('success','个人信息修改成功');
            return $this->refresh();
        }
        return $this->render('modifyInfo',['model'=>$model->getInfo($uid)]);
    }

    public function actionAjaxPostChildrenArea()
    {
        if(\Yii::$app->request->isAjax){
            $pid = \Yii::$app->request->post('pid');
            $level = \Yii::$app->request->post('level');
            $area_children = District::getChildrenList($pid,$level);
            $option = "";
            if(count($area_children)>0){
                foreach($area_children as $k => $v){
                    $option .= Html::tag('option',Html::encode($v['name']),['value'=>$v['id']]);
                }
            }
            echo $option;
        }
    }

    //更换头像
    public function actionModifyImage()
    {
        $model = new UploadService();
        $model->scenario = 'avatar';
        if (Yii::$app->request->isPost) {
            $model->avatar_url = UploadedFile::getInstance($model, 'avatar_url');
            if ($model->uploadAvatar()) {
                echo json_encode(array('avatar_url'=>$model->avatar_url,'result'=>'上传成功'));exit;
            }
        }

        return $this->render('modifyImage', ['model' => $model]);
    }

    public function actionCutimg(){
        $thumb = new Thumb();
        $img = Yii::$app->request->post('img');
        $file = Yii::$app->params['avatarDir'].$img;
        $x = Yii::$app->request->post('x');
        $y = Yii::$app->request->post('y');
        $w = Yii::$app->request->post('w');
        $h = Yii::$app->request->post('h');
        list($owidth, $oheight) = getimagesize($file);
        if($owidth> 800) {
            $scale = $owidth / 800;
            $x *= $scale;
            $y *= $scale;
            $w *= $scale;
            $h *= $scale;
        }
        //生成缩略图数组
        $thumb_arr = Yii::$app->params['avatarThumbSize'];

        //裁剪后的图片路径
        $cutPicPath = substr(Yii::$app->params['avatarDir'], 2).str_replace('.', '_thumb.', $img);

        $param = array(
            'type' => 'crop',
            'width' => $w,
            'height' => $h,
            'bgcolor' => '#FFF',
            'croppos' => 'OTHER',
            'x'=>$x,
            'y'=>$y,
        );

        $thumb->set_config($param, $thumb_arr);
        $flag = $thumb->create_thumb($file, $cutPicPath);

        if($flag){
            $this->returnAjax(1, '操作成功!', BaseService::getTypeFileUrl($img, 'avatarDir', 'mid'));
        }else{
            $this->returnAjax(-1, '操作失败');
        }


    }

    //用户列表
    public function actionUserList() {
        $user_list = User::getUserInfoList();
        $user_list = $this->format($user_list);
        return $this->render('user_list', ['user_list'=>$user_list]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        $model = User::findOne($id);
        if($model) {
            $model->status = 0;
            $succ = $model->save();
            if($succ) {
                $this->returnAjax(1, '删除成功!');
            }else{
                $this->returnAjax(-1, '删除失败!');
            }
        }else{
            $this->returnAjax(-2, '参数不合法!');
        }
    }

    public function format($user_list){
        foreach($user_list as &$item) {
            $item['avatar_url'] && $item['avatar_url'] = BaseService::getTypeFileUrl($item['avatar_url'], 'avatarDir', 'mid');
            $item['birthday'] && $item['birthday'] = date('Y-m-d', $item['birthday']);
            $item['location'] && $item['location'] = District::formatDistrict($item['location']);
            if(!$item['nickname']) $item['nickname'] = $item['user_login'];
        }
        return $user_list;
    }
}