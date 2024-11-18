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
    }
?>