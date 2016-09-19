<?php

namespace Home\Model;

use Think\Model;
class CommentModel extends Model{

    public function addComment($comment) {
        $story = $this->where(['post_id'=>$comment['post_id']])->order('comment_story desc')->getField('comment_story');
        $comment['comment_story'] = ++$story;
        return $this->add($comment);
    }

    public function commentList($post_id, $limit = 10) {
        $where['is_del'] = 0;
        $where['post_id'] = $post_id;
        $join = ' as c left join blog_tourist as t on t.tourist_id = c.tourist_id';
        $field = 'c.*, t.username, avatar';
        $list = $this->field($field)->where($where)->order('ctime desc')->join($join)->limit($limit)->select();
        return $list;
    }

    public function commentCount($post_id) {
        $WHERE['is_del'] = 0;
        $where['post_id'] = $post_id;
        $count = $this->where($where)->count();
        return $count;
    }

}