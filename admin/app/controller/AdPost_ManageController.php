<?php
    class AdPost_ManageController{
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
    
        public function viewPost_Manage()
        {
            $this->renderview('post_manage', $this->data);
        }
    }
?>