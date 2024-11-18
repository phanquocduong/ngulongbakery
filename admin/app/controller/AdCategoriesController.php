<?php
class AdCategoriesController
{
    private $data;
    private $cate;
    public function __construct()
    {
        require_once './app/model/CategoryModel.php';
        $this->cate = new CategoryModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewCategories()
    {
        $cate = new CategoryModel();
        $this->data['cate'] = $this->cate->getCate();
        $this->renderview('Categories', $this->data);
    }
    public function viewAddCategories()
    {
        $this->renderview('add_categories', $this->data);
    }
    public function addCate(){
        if (isset($_POST['submit'])) {
            $data = [];
            $data['name'] = $_POST['name'];
            $data['image'] = $_FILES['image']['name'];
            $data['description'] = $_POST['description'];
            $data['type'] = $_POST['type'];
            $data['status'] = $_POST['status'];
            // Upload ảnh chính
            $file = '../public/upload/category/' . $data['image'];
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                echo '<script>alert("Không thể ảnh")</script>';
                return;
            }
            $result = $this->cate->insertCate($data);
            if ($result) {
                echo '<script>alert("Thêm sản danh mục")</script>';
                echo '<script>location.href="index.php?page=categories"</script>';
            } else {
                echo '<script>alert("Lỗi khi thêm danh mục vào cơ sở dữ liệu.")</script>';
            }
        }
    }
    public function viewEditCategories()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $editcate = $this->cate->getIdCate($id);
            if (is_array($editcate)) {
                $this->data['editcate'] = $editcate;
                $this->renderview('edit_categories', $this->data);
            } else {
                echo "Not found....";
            }
    }
    public function editCate() {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['id'] = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $data['name'] = $_POST['name'] ?? '';
            $data['image'] = $_POST['existing_image'] ?? '';
            $data['description'] = $_POST['description'] ?? '';
            $data['type'] = $_POST['type'] ?? '';
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 0;
    
            // Upload ảnh nếu có file mới
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $_FILES['image']['name'];
                $file = '../public/upload/category/' . $data['image'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                    echo '<script>alert("Upload hình ảnh thất bại")</script>';
                    return;
                }
            }
    
            // Cập nhật dữ liệu
            $this->cate->updateCate($data);
            echo '<script>alert("Cập nhật danh mục thành công")</script>';
            echo '<script>location.href="index.php?page=categories"</script>';
            
        }
    }
    
    
    public function viewCategories_Detail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $procate = $this->cate->getIdPro($id);

            if (is_array($procate)) {
                $this->data['procate'] = $procate;
                $this->renderview('Categories_detail', $this->data);
            } else {
                echo "Not found....";
            }
    }
    public function delCate()
    {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $data = $this->cate->getIdCate($id);
    
            // Xoá ảnh chính
            $file = '../public/upload/category/' . $data['image'];
            if (file_exists($file)) {
                unlink($file);
            }
    
            $this->cate->deleteCate($id);
            echo '<script>alert("Đã xóa thành công!")</script>';
        }
        echo '<script>location.href="index.php?page=categories"</script>';
    }
}

?>