<?php
namespace app\components;

use Yii;

class FileUtils{

    //删除图片
    public static function delImage($savepath) {
        foreach(Yii::$app->params['imageThumbSize'] as $key => $val) {
            $filePath = Yii::$app->params['imagesDir'].str_replace('.', '_thumb_'.$key.'.', $savepath);
            if(file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

}