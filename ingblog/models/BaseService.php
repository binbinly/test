<?php
namespace app\models;

use yii\base\Model;
use Yii;

class BaseService extends Model
{

    public static function getTypeFileUrl($url, $dir = 'avatarDir', $type = 'min') {
        $type && $url = str_replace('.', '_thumb_'.$type.'.', $url);
        $url = Yii::$app->params[$dir].$url;
        return substr($url, 1);
    }
}