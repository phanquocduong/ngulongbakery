<?php
    class DetailnewsController {
        private $detailnews;
        private $category;

        function __construct() {
            $this->detailnews = new CategoryModel();
            $this->category = new CategoryModel();
        }

        // Đảm bảo tham số không bắt buộc được khai báo sau tham số bắt buộc
        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewDetailnews($css, $js) {
            // Thêm tham số đúng thứ tự
            $this->renderView('detailnews', $css, $js, []);
        }
    }
?>
