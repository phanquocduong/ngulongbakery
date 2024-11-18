<?php
    class AdVoucherController{
        private $data; // biến lưu trữ dữ liệu từ controller sang view
        private $voucher;
        public function __construct()
        {
            require_once './app/model/VoucherModel.php';
            $this->voucher = new VoucherModel();
            $this->data = [];
        }
        public function renderview($view, $data = null)
        {
            $view = './app/view/' . $view . '.php';
            require_once $view;
        }
    
        public function viewVoucher()
        {
            $voucher = new VoucherModel();
            $this->data['voucher'] = $this->voucher->getVoucher();
            $this->renderview('voucher', $this->data);
        }
        public function viewAddVoucher()
        {
            $this->renderview('add_voucher', $this->data);
        }
        public function addVoucher(){
            if (isset($_POST['submit'])) {
                $data = [];
                $data['code'] = $_POST['code'];
                $data['discount_value'] = $_POST['discount_value'];
                $data['start_date'] = $_POST['start_date'];
                $data['end_date'] = $_POST['end_date'];
                $data['usage_limit'] = $_POST['usage_limit'];
                $data['min_order_value'] = $_POST['min_order_value'];
                $data['active'] = $_POST['active'];
                $result = $this->voucher->insertVoucher($data);
                if ($result) {
                    echo '<script>alert("Thêm Voucher thành công")</script>';
                    echo '<script>location.href="index.php?page=voucher"</script>';
                } else {
                    echo '<script>alert("Lỗi khi thêm voucher vào cơ sở dữ liệu.")</script>';
                }
            }
        }
        public function viewEditVoucher()
        {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $voucherdetail = $this->voucher->getIdVocher($id);

            if (is_array($voucherdetail)) {
                $this->data['voucherdetail'] = $voucherdetail;
                $this->renderview('edit_voucher', $this->data);
            } else {
                echo "Not found....";
            }
        }
        public function editVoucher() {
            if (isset($_POST['submit'])) {
                $data = [];
                $data['id'] = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $data['code'] = $_POST['code'] ?? '';
                $data['discount_value'] = $_POST['discount_value'] ?? '';
                $data['start_date'] = $_POST['start_date'] ?? '';
                $data['end_date'] = $_POST['end_date'] ?? '';
                $data['usage_limit'] = $_POST['usage_limit'] ?? '';
                $data['min_order_value'] = $_POST['min_order_value'] ?? '';
                $data['active'] = isset($_POST['active']) ? intval($_POST['active']) : 0;
        
                // Cập nhật dữ liệu
                $this->voucher->updateVoucher($data);
                // print_r($data['id']);
                echo '<script>alert("Cập nhật voucher thành công")</script>';
                echo '<script>location.href="index.php?page=voucher"</script>';
            }
        }
        function deleteVoucher(){
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $deleteVoucher = $this->voucher->deleteVoucher($id);
            echo '<script>alert("Đã xóa voucher thành công")</script>';
            echo '<script>location.href="index.php?page=voucher"</script>';
        }
    }
?>