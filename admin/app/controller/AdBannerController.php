<?php
class AdBannerController{
    private $data;
    private $banner;
    public function __construct()
    {
        require_once './app/model/BannerModel.php';
        $this->banner = new BannerModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }
    public function viewbanner()
    {
        $this->data['banner'] = $this->banner->get_banner();
        $this->renderview('banner', $this->data);
    }
    public function vieweditbanner()
    {
        $this->renderview('Edit_banner', $this->data);
    }
    public function viewaddbanner()
    {
        $this->renderview('Add_banner', $this->data);
    }
    
    public function addBanner()
    {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['tag'] = $_POST['tag'];
            $data['image'] = $_FILES['image']['name'];
            $data['status'] = $_POST['status'];
            // Upload ảnh chính
            $file = '../public/upload/slider/' . $data['image'];
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                echo '<script>alert("Không thể upload ảnh")</script>';
                return;
            }
            $result = $this->banner->insertBanner($data);
            if ($result) {
                echo '<script>alert("Thêm Banner thành công")</script>';
                echo '<script>location.href="index.php?page=banner"</script>';
            } else {
                echo '<script>alert("Lỗi khi thêm Banner vào cơ sở dữ liệu.")</script>';
            }
        }
    }
    public function editBanner()
    {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['id'] = $_POST['id'];
            $data['tag'] = $_POST['tag'];
            $data['status'] = $_POST['status'];
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $_FILES['image']['name'];
                $file = '../public/upload/slider/' . $data['image'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                    echo '<script>alert("Không thể tải lên ảnh.")</script>';
                    exit;
                }
            } else {
                $data['image'] = !empty($_POST['existing_image']) ? 
                    htmlspecialchars(trim($_POST['existing_image'])) : 
                    'default-post-image.jpg'; // Default image if none exists
            }
            $this->banner->updateBanner($data);
            echo '<script>alert("Sửa Banner thành công")</script>';
            echo '<script>location.href="index.php?page=banner"</script>';
        }
    }
    public function deletebanner()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $this->banner->deleteBanner($id);
        echo '<script>alert("Xóa Banner thành công")</script>';
        echo '<script>location.href="index.php?page=banner"</script>';
    
    }      

        
    }
?>