<?php
class AdAccountsController{
    private $data;
    private $user;
    public function __construct()
    {
        require_once './app/model/UserModel.php';
        $this->user = new UserModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewAcc()
    {
        $user = new UserModel();
        $this->data['user'] = $this->user->getUser();
        $this->renderview('Accounts_Manage', $this->data);
    }
    public function viewAccount_Detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $accountDetail = $this->user->getIdUser($id);

            if (is_array($accountDetail)) {
                $this->data['accountDetail'] = $accountDetail;
                $this->renderview('account_detail', $this->data);
            } else {
                echo "Not found....";
            }
    }
    public function viewEditAccount(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $editaccountDetail = $this->user->getIdUser($id);

            if (is_array($editaccountDetail)) {
                $this->data['editaccountDetail'] = $editaccountDetail;
                $this->renderview('edit_account', $this->data);
            } else {
                echo "Not found....";
            }
        
    }
    public function editAccount() {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['id'] = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $data['email'] = $_POST['email'] ?? '';
            $data['full_name'] = $_POST['full_name'] ?? '';
            $data['phone'] = $_POST['phone'] ?? '';
            $data['address'] = $_POST['address'] ?? '';
            $data['role_id'] = isset($_POST['role_id']) ? intval($_POST['role_id']) : 0;
            $data['avatar'] = $_POST['existing_image'] ?? '';
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 0;
            
            // update ảnh mới khi có
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $_FILES['image']['name'];
                $file = '../public/upload/avatar/' . $data['image'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                    echo '<script>alert("Upload hình ảnh thất bại")</script>';
                    return;
                }
            }
            // Cập nhật dữ liệu
            $this->user->updateUser($data);
            // print_r($data);
            echo '<script>alert("Cập nhật user thành công")</script>';
            echo '<script>location.href="index.php?page=accounts"</script>';
        }
    }
    public function delUser()
    {
        $this->user->isForeignKey($_GET['id']);
        $this->user->deleteRelatedData($_GET['id']);

        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $data = $this->user->getIdUser($id);
    
            // Xoá ảnh chính
            $file = '../public/upload/avatar/' . $data['avatar'];
            if (file_exists($file)) {
                unlink($file);
            }
    
            $this->user->deleteUser($id);
            echo '<script>alert("Đã xóa thành công!")</script>';
        }
        echo '<script>location.href="index.php?page=accounts"</script>';
    }
    public function blockUser(){
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $id = $_GET['id'];
            $status = $_GET['status'];
            $newStatus = $this->user->updateStatus($id, $status);
            echo '<script>location.href="index.php?page=accounts"</script>';
            exit();
        } else {
            echo "Không tìm thấy thông tin cần thiết!";
        }
    }
    public function logout() {
        unset($_SESSION['user']);
        setcookie('rememberMe', '', time() - 3600, '/');
        header("Location: http://localhost/ngulongbakery/");

    }
}

?>