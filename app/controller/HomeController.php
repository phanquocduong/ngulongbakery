<?php
    class HomeController {
        private $product;
        private $category;

        function __construct() {
            $this->product = new ProductModel();
            $this->category = new CategoryModel();
        }

        private function renderView($view, $data = [], $css, $js) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", [], 'display_order ASC');
            require_once 'app/view/header.php';
            $viewPath = 'app/view/' . $view . '.php';
            require_once $viewPath;
            require_once 'app/view/footer.php';
        }
        
        public function viewHome($css, $js) {
            $data['featuredProducts'] = $this->product->getProducts('WHERE stock_quantity > 0 AND status = 1', [], 'views DESC', 0, 4);
            $data['discountProductsPC'] = $this->product->getProducts('WHERE sale IS NOT NULL AND stock_quantity > 0 AND status = 1', [], 'views DESC', 0, 8);
            $data['discountProductsMobile'] = $this->product->getProducts('WHERE sale IS NOT NULL AND stock_quantity > 0 AND status = 1', [], 'views DESC', 0, 4);
            $this->renderView('home', $data, $css, $js);
        }
    }
?>