<?php

namespace Home\Model;

use Think\Model;
class FileModel extends Model{

    /**
     * 根据id获取文件信息
     * @param $ids
     */
    public function getFileList($ids, $limit=10) {
        if(!$ids) {
            return null;
        }
        $where['id'] = array('in', $ids);
        $list = $this->field('name,savepath')->where($where)->limit($limit)->select();
        return $list;
    }

}