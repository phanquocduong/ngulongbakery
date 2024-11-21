<?php
    class NewsController {
        private $news;
        private $category;

        function __construct() {
            $this->new = new CategoryModel();
            $this->category = new CategoryModel();
        }

        // Đảm bảo tham số không bắt buộc được khai báo sau tham số bắt buộc
        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewNews($css, $js) {
            // Thêm tham số đúng thứ tự
            $this->renderView('news', $css, $js, []);
        }
    }
?>
