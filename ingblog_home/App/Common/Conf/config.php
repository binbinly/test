<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL' => '2',
    'DEFAULT_FILTER'        =>  'strip_tags,addslashes,htmlspecialchars',


    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'ingblog', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'blog_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集

    'IMAGE_URL' => 'http://www.ingblog.lo',
    'avatarDir' => '/Uploads/avatar/',
    'editorDir' => '/Uploads/editor/',
    'imagesDir' => '/Uploads/images/',

    'PHOTO_CAT_ID' => 28,
    'STUDY_CAT_ID' => 29,
    'PAGE_SIZE' => 10,
);