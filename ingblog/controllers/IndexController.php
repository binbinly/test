<?php

namespace app\controllers;

use app\components\Utils;
use Yii;
use yii\web\Controller;

class IndexController extends UserBaseController{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public $layout = 'header';

    public function actionIndex() {
        $data['serverSoft'] = $_SERVER['SERVER_SOFTWARE'];
        $data['serverOs'] = PHP_OS;
        $data['phpVersion'] = PHP_VERSION;
        $data['fileupload'] = ini_get('file_uploads') ? ini_get('upload_max_filesize') : '禁止上传';
        $data['serverUri'] = $_SERVER['SERVER_NAME'];
        $data['maxExcuteTime'] = ini_get('max_execution_time') . ' 秒';
        $data['maxExcuteMemory'] = ini_get('memory_limit');
        $data['allow_url_fopen'] = ini_get('allow_url_fopen') ? '开启' : '关闭';
        $data['magic_quote_gpc'] = ini_get('magic_quote_gpc') ? '开启' : '关闭';
        $data['excuteUseMemory'] = function_exists('memory_get_usage') ? Utils::byteFormat(memory_get_usage()) : '未知';
        $dbsize = 0;
        $connection = Yii::$app->db;
        $sql = 'SHOW TABLE STATUS LIKE \'' . $connection->tablePrefix . '%\'';
        $command = $connection->createCommand($sql)->queryAll();
        foreach ($command as $table)
            $dbsize += $table['Data_length'] + $table['Index_length'];
        $mysqlVersion = $connection->createCommand("SELECT version() AS version")->queryAll();
        $data['mysqlVersion'] = $mysqlVersion[0]['version'];
        $data['dbsize'] = $dbsize ? Utils::byteFormat($dbsize) : '未知';
        return $this->render('index', array ('server' => $data ));
    }
}