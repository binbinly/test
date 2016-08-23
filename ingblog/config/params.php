<?php

return [
    'adminEmail' => 'admin@example.com',
    'gender' => ['1'=>'男','2'=>'女'],
    'defaultUserImage' => 'default.jpg',
    'avatarDir' => './Uploads/avatar/',
    'editorDir' => './Uploads/editor/',
    'imagesDir' => './Uploads/images/',
    'mailerUser' => '784853640@qq.com',
    'siteName' => 'tanbin',
    'adminId' => 1, //超级管理员id
    'dataTables_message_cn' => '/js/plugins/dataTables/china.json',
    'image_ext_arr' => ['jpg','jpeg','gif','png'],
    //生成缩略图数组
    'imageThumbSize' => array(
        'min' => array('200'),
        'mid' => array('500'),
        'big' => array('800'),
    ),
    'avatarThumbSize' => array(
        'min' => array('50'),
        'mid' => array('100'),
        'big' => array('200'),
    ),
    'file_type' => [
        '1' => ['id'=>1, 'title'=>'图片'],
        '2' => ['id'=>2, 'title'=>'音乐'],
        '3' => ['id'=>3, 'title'=>'文件'],
    ],
    'post_type' => [
        '1' => ['id'=>1, 'title'=>'文章'],
        '2' => ['id'=>2, 'title'=>'图册'],
    ],
    'configType' => [
        '1' => ['id'=>'1', 'title'=>'基本', 'name'=>'basic'],
        '2' => ['id'=>'2', 'title'=>'会员', 'name'=>'member'],
        '3' => ['id'=>'3', 'title'=>'邮件', 'name'=>'email'],
        '99' => ['id'=>'99', 'title'=>'系统', 'name'=>'system'],
     ],
    'configValueType' => [
        'text' => ['id'=>1, 'name'=>'text', 'title'=>'单行文本'],
        'string' => ['id'=>2, 'name'=>'string', 'title'=>'字符串'],
        'password' => ['id'=>3, 'name'=>'password', 'title'=>'密码'],
        'textarea' => ['id'=>4, 'name'=>'textarea', 'title'=>'文本框'],
        'bool' => ['id'=>5, 'name'=>'bool', 'title'=>'布尔值'],
        'select' => ['id'=>6, 'name'=>'select', 'title'=>'选择'],
        'num' => ['id'=>7, 'name'=>'num', 'title'=>'数字'],
        'decimal' => ['id'=>8, 'name'=>'decimal', 'title'=>'金额'],
        'tags' => ['id'=>9, 'name'=>'tags', 'title'=>'标签'],
        'datetime' => ['id'=>10, 'name'=>'datetime', 'title'=>'时间控件'],
        'date' => ['id'=>11, 'name'=>'date', 'title'=>'日期控件'],
        'editor' => ['id'=>12, 'name'=>'editor', 'title'=>'编辑器'],
        'bind' => ['id'=>12, 'name'=>'bind', 'title'=>'模型绑定'],
        'images' => ['id'=>12, 'name'=>'images', 'title'=>'多图上传'],
        'image' => ['id'=>12, 'name'=>'image', 'title'=>'图片上传'],
        'attach' => ['id'=>12, 'name'=>'attach', 'title'=>'文件上传'],
    ],
    'menuType' => [
        '1' => ['id'=>1, 'name'=>'后台菜单'],
        '2' => ['id'=>2, 'name'=>'前台导航'],
    ],
];
