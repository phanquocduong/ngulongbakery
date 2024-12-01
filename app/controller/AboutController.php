<?php
    class AboutController {
        private $about;
        private $category;
        private $review;        

        function __construct() {
            $this->about = new CategoryModel();
            $this->category = new CategoryModel();
            $this->review = new ReviewModel();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewAbout($css, $js) {
            $data['featuredReview'] = $this->review->getFeaturedReviews(1);
            $this->renderView('about', $css, $js, $data);
        }
    }
?>
