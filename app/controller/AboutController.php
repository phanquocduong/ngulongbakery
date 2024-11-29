<?php
    class AboutController {
        private $about;
        private $category;

        function __construct() {
            $this->about = new CategoryModel();
            $this->category = new CategoryModel();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewAbout($css, $js) {
            $this->renderView('about', $css, $js, []);
        }
    }
?>
