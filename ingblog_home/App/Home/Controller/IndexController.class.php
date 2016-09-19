<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    private $post_model = null;
    private $file_model = null;
    private $tag_model = null;
    private $comment_model = null;
    private $cat_model = null;

    public function __construct()
    {
        parent::__construct();
        $this->post_model = D("Post");
        $this->file_model = D("File");
        $this->tag_model = D("Tag");
        $this->comment_model = D("comment");
        $this->cat_model = D("Cat");

        $hot_list = $this->post_model->hotPost();
        $this->assign('hot', $hot_list);
        $tag = $this->tag_model->tagListAll();
        $this->assign('tagAll', $tag);
    }

    public function index(){
        $data['post'] = $this->setData();
        $data['photo'] = $this->setData(['cat_id'=>C('PHOTO_CAT_ID')], 4);
        $this->assign($data);
        $this->display();
    }

    public function about(){
        $this->display();
    }

    public function contact(){
        $count = $this->comment_model->commentCount(0);
        $limit = $this->setPage($count);
        $commentList = $this->comment_model->commentList(0, $limit);
        $this->assign('commentList',$commentList);
        $this->display();
    }

    public function photo(){
        $count = $this->post_model->getPostCount(['cat_id'=>C('PHOTO_CAT_ID')]);
        $limit = $this->setPage($count);
        $list = $this->setData(['cat_id'=>C('PHOTO_CAT_ID')], $limit);
        $this->assign('list', $list);
        $this->display();
    }

    public function study(){
        $count = $this->post_model->getPostCount(['cat_id'=>C('STUDY_CAT_ID')]);
        $limit = $this->setPage($count);
        $list = $this->setData(['cat_id'=>C('STUDY_CAT_ID')], $limit);
        $this->assign('post', $list);
        $this->display();
    }

    public function search(){
        $map['cat_id'] = I("get.cat", 0, 'intval');
        $map['tag_id'] = I("get.tag", 0, 'intval');
        $map['keyword'] = I("request.word", '');
        if($map['cat_id'] || $map['tag_id'] || $map['keyword']) {
            $count = $this->post_model->getPostCount($map);
            $map['tag_id'] && $this->assign('tag_name', $this->tag_model->getTagName($map['tag_id']));
            $map['cat_id'] && $this->assign('cat_name', $this->cat_model->getCatName($map['cat_id']));
            $map['keyword'] && $this->assign('keyword', $map['keyword']);
        }else {
            $this->redirect('index');
        }
        $limit = $this->setPage($count);
        $list = $this->setData($map, $limit);
        $this->assign('post', $list);
        $this->display('study');
    }

    public function shortcodes(){
        $this->display();
    }

    public function single(){
        $id = \I("get.id", 0, 'intval');
        if($id == 0) {
            $this->error('非法操作!');
        }
        $info = $this->post_model->getPostById($id);
        if(!$info) $this->error("参数不合法!!");
        $info['file'] = $this->file_model->getFileList($info['content']);

        //点击数+1
        $this->post_model->setInc('click_count');
        //评论列表
        $count = $this->comment_model->commentCount($info['id']);
        $limit = $this->setPage($count);
        $commentList = $this->comment_model->commentList($info['id'], $limit);

        $this->assign('navHtml', $this->cat_model->getCatHtml($info['cat_id']));
        $this->assign($this->post_model->getNextAndPrevPost($id, $info['cat_id']));
        $this->assign('commentList', $commentList);
        $this->assign('info', $info);
        if($info['type'] == 2) {
            $this->display('photoDetail');
        }else {
            $this->display();
        }
    }

    public function ajaxGetPhotoList() {
        $id = \I("post.id", 0, 'intval');
        if($id == 0) {
            $this->error('非法操作!');
        }
        $info = $this->post_model->getPostById($id);
        if(!$info) $this->returnData(-1, "参数不合法!!");
        $p = \I("post.p", 2, 'intval');
        $page_size = C('PAGE_SIZE');
        $start = ($p-1)*$page_size;
        $limit = " {$start}, {$page_size}";
        $file = $this->file_model->getFileList($info['content'], $limit);
        if(!$file) {
            $this->returnData(-1, '数据已加载完成');
        }
        foreach($file as &$val) {
            $val['savepath'] = getTypeFileUrl($val['savepath'], 'imagesDir');
        }
        $this->returnData(1, '加载成功', $file, ['p'=>$p]);
    }

    public function ajaxAddComment(){
        $content = I("post.comment_text", "");
        $post_id = I("post.post_id", 0, 'intval');
        $type = I("post.type", 1, 'intval');
        $tourist_id = session('tourist_id');
        if(!$content) {
            $this->returnData(-2, "内容不能为空哦!");
        }
        if(!$tourist_id){
            $username = $data['username']= I("post.username", '');
            $email = $data['email'] = I("post.email", "");
            $data['avatar'] = I("post.avatar", 0, 'intval');
            if(!$username || !$email) {
                $this->returnData(-1, '参数不合法!');
            }
            $data['ip'] = get_client_ip();
            $data['ctime'] = time();
            $tourist_id = M("Tourist")->add($data);
            if($tourist_id) {
                session('tourist_id', $tourist_id);
                session('username', $username);
                session('avatar', $data['avatar']);
            }else{
                $this->returnData(-3, '操作失败!');
            }
        }

        if($tourist_id) {
            $comment['tourist_id'] = $tourist_id;
            $comment['post_id'] = $post_id;
            $comment['ctime'] = time();
            $comment['comment_content'] = $content;
            $comment['comment_type'] = $type;
            $comment['reply_tourist_id'] = I("post.reply_tourist_id", 0, 'intval');
            $comment['reply_comment_id'] = I("post.reply_comment_id", 0, 'intval');
            $id = $this->comment_model->addComment($comment);
            if($id) {
                $this->returnData(1, '操作成功!', ['comment_id'=>$id, 'uid'=>$tourist_id]);
            }else{
                $this->returnData(-1, '操作失败!');
            }
        }
    }

    public function setData($map = null, $limit = 10) {
        $list = $this->post_model->getPostList($map, $limit);

        foreach($list as &$val) {
            if($val['type'] == 2) {
                $val['file'] = $this->file_model->getFileList($val['content']);
            }
            $val['tagList'] = $this->tag_model->TagList($val['id']);
        }

        return $list;
    }

    public function setPage($count) {
        $Page       = new \Think\Page($count, C('PAGE_SIZE'));
        $show       = $Page->show();// 分页显示输出
        $this -> assign('page', $show);
        return $Page->firstRow.','.$Page->listRows;
    }

    public function returnData($code, $msg, $data = null, $expr = null) {
        $return['code'] = $code;
        $return['msg'] = $msg;
        if($data !== null) {
            $return['data'] = $data;
        }
        if($expr) {
            foreach($expr as $key=>$item) {
                $return[$key] = $item;
            }
        }
        exit(json_encode($return));
    }
}