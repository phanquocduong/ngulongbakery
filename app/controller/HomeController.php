<?php
    class HomeController {
        private $product;
        private $category;
        private $review;
        private $banner;

        function __construct() {
            $this->product = new ProductModel();
            $this->category = new CategoryModel();
            $this->review = new ReviewModel();
            $this->banner = new BannerModel();
        }

        private function renderView($view, $css, $js, $data = []) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        public function viewHome($css, $js) {
            $data['featuredProducts'] = $this->product->getProducts('WHERE stock_quantity > 0 AND status = 1', [], 'sold DESC', 0, 4);
            $data['discountProducts'] = $this->product->getProducts('WHERE sale IS NOT NULL AND stock_quantity > 0 AND status = 1', [], 'views DESC', 0, 8);
            $data['featuredReviews'] = $this->review->getFeaturedReviews(2);
            $data['banner'] = $this->banner->getBanners('WHERE status = 1');
           
            $this->renderView('home', $css, $js, $data);
        }
    }
?>
