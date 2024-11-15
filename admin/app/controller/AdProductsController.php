<?php
    class AdProductsController{
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
    
        public function viewProducts()
        {
            $this->renderview('products', $this->data);
        }
    }
?>