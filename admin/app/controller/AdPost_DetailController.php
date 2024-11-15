<?php
    class AdPost_DetailController{
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
    
        public function viewPost_Detail()
        {
            $this->renderview('post_detail', $this->data);
        }
    }
?>