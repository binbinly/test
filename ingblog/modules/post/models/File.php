<?php
namespace app\modules\post\models;

use app\components\FileUtils;
use app\components\Utils;
use Yii;
use yii\data\Pagination;
use yii\helpers\FileHelper;

class File extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%file}}';
    }

    public function addFile($savePath, $fileInfo) {
        $this->isNewRecord = true;
        $filePath = Yii::$app->params['imagesDir'].$savePath;
        //获取图片md5值
        $this->md5 = md5_file($filePath);
        $size = getimagesize($filePath);
        $this->width = $size[0];
        $this->height = $size[1];
        $this->savename = substr($savePath, strrpos($savePath, '/')+1);
        $this->savepath = $savePath;
        $this->ctime = time();
        $this->ext = $fileInfo->extension;
        $this->name = substr($fileInfo->name, 0, strrpos($fileInfo->name, '.'));
        $this->size = $fileInfo->size;
        $this->mime = $fileInfo->type;
        $this->id = null;
        if(in_array($this->ext, Yii::$app->params['image_ext_arr'])) {
            $this->type = 1;
        }
        if($this->save()){
            return $this->primaryKey;
        }else{
            return null;
        }
    }

    public static function fileDelete($id) {
        $info = static::findOne($id);
        if($info) {
            //删除文件
            FileUtils::delImage($info->savepath);
            return $info->delete();
        }
    }

    public static function getFileList() {
        $page_size = 40;
        $p = Yii::$app->request->get('p', 1);
        $offset = ($p-1)*$page_size;
        $query = File::find()->where(['type'=>1])->orderBy('ctime desc');
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->defaultPageSize = $page_size;
        $pagination->pageParam = 'p';

        $model = $query->offset($offset)->limit($page_size)->all();
        return ['model'=>$model, 'page'=>$pagination];
    }

    public function checkFileMd5($savePath){
        $filePath = Yii::$app->params['imagesDir'].$savePath;
        $md5 = md5_file($filePath);
        $model = static::findOne(['md5'=>$md5]);
        if($model) {
            return $model->id;
        }else{
            return false;
        }
    }
}
