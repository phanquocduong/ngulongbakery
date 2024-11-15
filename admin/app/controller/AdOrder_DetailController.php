<?php
    class AdOrder_DetailController{
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
    
        public function viewOrder_Detail()
        {
            $this->renderview('order_detail', $this->data);
        }
    }
?>