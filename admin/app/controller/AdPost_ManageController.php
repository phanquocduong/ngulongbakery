<?php
class AdPost_ManageController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view
    private $post;
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
        $this->data['post'] = $this->post->getPost();
        $this->renderview('post_manage', $this->data);
    }
    public function viewAddPost(){
        $this->renderview('add_post', $this->data);
    }
    public function viewPost_Detail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $postdetail = $this->post->getIdPost($id);

        if (is_array($postdetail)) {
            $this->data['postdetail'] = $postdetail;
            $this->renderview('post_detail', $this->data);
        } else {
            echo "Not found....";
        }
    }
    public function viewComments()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $comments = $this->post->getComments($id);
        if (is_array($comments)) {
            $this->data['comments'] = $comments;
            $this->renderview('comments', $this->data);
        } else {
            echo "Not found....";
        }
    }

    public function viewEditPost(){
        $this->renderview('edit_post', $this->data);
    }
    public function addPost()
    {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['title'] = $_POST['title'];
            $data['content'] = $_POST['content'];
            $data['created_at'] = $_POST['create_date'];
            $data['status'] = $_POST['status'];
            $data['author_id'] = $_POST['user'];
            $data['category_id'] = $_POST['type'];
            $this->post->insertPost($data);
            echo '<script>alert("Thêm bài viết thành công")</script>';
            echo '<script>location.href="index.php?page=post_manage"</script>';
        }
    }
        public function editPost(){
            if(isset($_POST['submit'])){
                $data = [];
                $data['id'] = $_POST['id'];
                $data['title'] = $_POST['title'];
                $data['content'] = $_POST['content'];
                $data['created_at'] = $_POST['create_date'];
                $data['status'] = $_POST['status'];
                $data['author_id'] = $_POST['user'];
                $data['category_id'] = $_POST['type'];
                $this->post->updatePost($data);
                echo '<script>alert("Sửa bài viết thành công")</script>';
                echo '<script>location.href="index.php?page=post_manage"</script>';
            }
        }

        public function deletePost(){
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $this->post->deletePost($id);
            echo '<script>alert("Xóa bài viết thành công")</script>';
            echo '<script>location.href="index.php?page=post_manage"</script>';
        }
    }
?>