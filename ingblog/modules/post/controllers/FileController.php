<?php

namespace app\modules\post\controllers;

use app\controllers\UserBaseController;
use app\models\BaseService;
use app\models\UploadService;
use app\modules\post\models\File;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

/**
 * Default controller for the `post` module
 */
class FileController extends UserBaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['file_model'=> File::getFileList()]);
    }

    public function actionUpload() {
        if(Yii::$app->request->isPost) {
            $model = new UploadService();
            $model->scenario = 'images';
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->uploadImages()) {
                $this->returnAjax(1, '上传成功', $model->images);
            }else{
                $this->returnAjax(-1, '该文件已上传过');
            }
        }
    }

    public function actionFileInfo() {
        if(Yii::$app->request->isAjax) {
            $file_id = Yii::$app->request->post('id', 0);
            $file_info = File::find()->where(['id'=>$file_id])->asArray()->one();
            if($file_info) {
                $file_info = $this->_format($file_info);
                $this->returnAjax(1, '获取成功', $file_info);
            }else{
                $this->returnAjax(-1, '操作不合法');
            }
        }
    }

    public function actionDelete() {
        if(Yii::$app->request->isAjax) {
            $file_id = Yii::$app->request->post('id', 0);
            if($file_id) {
                $succ = File::fileDelete($file_id);
                if($succ) {
                    $this->returnAjax(1, '删除成功');
                }else{
                    $this->returnAjax(-1, '删除失败');
                }
            }
        }
    }

    public function actionUpdate(){
        if(Yii::$app->request->isAjax) {
            $file_id = Yii::$app->request->post('id', 0);
            $name = Yii::$app->request->post('name', '');
            $desc = Yii::$app->request->post('desc', '');
            $file_model = File::findOne($file_id);
            if($file_model) {
                $file_model->name = $name;
                $file_model->desc = $desc;
                $file_model->save();
            }
        }
    }

    private function _format($file) {
        $file['url'] = BaseService::getTypeFileUrl($file['savepath'], 'imagesDir');
        $file['ctime'] = date('Y-m-d', $file['ctime']);
        $file['size'] = intval($file['size'] / 1024) . 'K';
        return $file;
    }
}
