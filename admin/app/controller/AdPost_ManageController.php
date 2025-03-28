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
        $this->renderview('Post_Manage', $this->data);
    }
    public function viewAddPost()
    {
        $this->renderview('Add_Post', $this->data);
    }
    public function viewPost_Detail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $postdetail = $this->post->getIdPost($id);

        if (is_array($postdetail)) {
            $this->data['postdetail'] = $postdetail;
            $this->renderview('Post_Detail', $this->data);
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
            $this->renderview('Comments', $this->data);
        } else {
            echo "Not found....";
        }
    }

    public function viewEditPost()
    {
        $this->renderview('Edit_Post', $this->data);
    }
    public function addPost()
    {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['title'] = $_POST['title'];
            $data['image'] = $_FILES['avt-post']['name'];
            $data['content'] = $_POST['content'];
            $data['created_at'] = $_POST['create_date'] = date('Y-m-d H:i:s');
            $data['status'] = $_POST['status'];
            $data['author_id'] = $_POST['user'];
            $data['category_id'] = $_POST['type'];

            $files = '../public/upload/post/images/' . $data['image'];
            if (!move_uploaded_file($_FILES['avt-post']['tmp_name'], $files)) {
                echo '<script>alert("Upload ảnh không thành công")</script>';
                echo '<script>location.href="index.php?page=add_post"</script>';
                return;
            }
            $this->post->insertPost($data);
            echo '<script>alert("Thêm bài viết thành công")</script>';
            echo '<script>location.href="index.php?page=post_manage"</script>';
        }
    }
    public function editPost()
    {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['id'] = $_POST['id'];
            $data['title'] = $_POST['title'];

            if (!empty($_FILES['avt-post1']['name'])) {
                $data['image'] = $_FILES['avt-post1']['name'];
                $file = '../public/upload/post/images/' . $data['image'];
                if (!move_uploaded_file($_FILES['avt-post1']['tmp_name'], $file)) {
                    echo '<script>alert("Không thể tải lên ảnh bìa.")</script>';
                    exit;
                }
            } else {
                $data['image'] = !empty($_POST['existing_image']) ? 
                    htmlspecialchars(trim($_POST['existing_image'])) : 
                    'default-post-image.jpg'; // Default image if none exists
            }

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

    public function deletePost()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($this->post->isForeignKey($id)) {
            $this->post->deleteRelatedData($id);
        }
        $this->post->deletePost($id);
        echo '<script>alert("Xóa bài viết thành công")</script>';
        echo '<script>location.href="index.php?page=post_manage"</script>';
    }
}
?>