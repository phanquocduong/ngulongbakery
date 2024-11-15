<?php
    class AdVoucherController{
        private $data; // biến lưu trữ dữ liệu từ controller sang view

        public function __construct()
        {
            $this->data = [];
        }
        public function renderview($view, $data = null)
        {
            $view = './app/view/' . $view . '.php';
            require_once $view;
        }
    
        public function viewVoucher()
        {
            $this->renderview('voucher', $this->data);
        }
        public function viewAddVoucher()
        {
            $this->renderview('add_voucher', $this->data);
        }
        public function viewEditVoucher()
        {
            $this->renderview('edit_voucher', $this->data);
        }
    }
?>