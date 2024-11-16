<?php
class AdPost_ManageController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view
    private $post;
    private $category;
    public function __construct()
    {
        require_once './app/model/PostModel.php';
        $this->post = new PostModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }
    public function viewPost_Manage()
    {
        $post = new PostModel();
        $this->data['post'] = $this->post->getPost();
        $this->renderview('post_manage', $this->data);
    }
    public function viewAddPost(){
        $this->renderview('add_post', $this->data);
    }
    public function viewPost_Detail()
    {
        $this->renderview('post_detail', $this->data);
    }
    public function viewEditPost(){
        $this->renderview('edit_post', $this->data);
    }


}
?>