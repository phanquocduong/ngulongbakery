<?php
    class ProductController {
        private $product;
        private $category;
        private $review;

        function __construct() {
            $this->product = new ProductModel();
            $this->category = new CategoryModel();
            $this->review = new ReviewModel();
        }

        private function renderView($view, $css, $js, $data = null, $numberPages = null) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm'", [], 'display_order ASC');
            require_once 'app/view/header.php';
            $viewPath = 'app/view/' . $view . '.php';
            require_once $viewPath;
            require_once 'app/view/footer.php';
        }

        private function viewProducts($view, $css, $js, $condition = '', $params = [], $order = '') {
            $num = $_GET['num'] ?? 1;
            $start = ($num - 1) * 18;
            $data = $this->product->getProducts($condition, $params, $order, $start, 18);
            $quantity = $this->product->getProductCount($condition, $params);
            $numberPages = ceil($quantity / 18);
            $this->renderView($view, $css, $js, $data, $numberPages);
        }

        public function viewCollection($css, $js) {
            $this->viewProducts('collection', $css, $js, '', [], '');
        }

        public function handleProductsDisplayByFilter() {
            $categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;
            if ($categoryId == 0) {
                $categoryId = null;
            }
            $priceArray = isset($_GET['price']) ? json_decode($_GET['price'], true) : [];
        
            // Mảng chứa các điều kiện lọc
            $conditions = [];
            $params = [];
        
            // Điều kiện lọc theo category_id
            if ($categoryId) {
                $conditions[] = "category_id = ?";
                $params[] = $categoryId;
            }
        
            // Điều kiện lọc theo giá
            if (!empty($priceArray)) {
                $priceConditions = [];
                foreach ($priceArray as $priceRange) {
                    if ($priceRange == 'under25') {
                        $priceConditions[] = "price < 25000";
                    } elseif ($priceRange == '25-50') {
                        $priceConditions[] = "price BETWEEN 25000 AND 50000";
                    } elseif ($priceRange == '50-75') {
                        $priceConditions[] = "price BETWEEN 50000 AND 75000";
                    } elseif ($priceRange == '75-100') {
                        $priceConditions[] = "price BETWEEN 75000 AND 100000";
                    } elseif ($priceRange == 'over100') {
                        $priceConditions[] = "price > 100000";
                    }
                }
                if (!empty($priceConditions)) {
                    $conditions[] = ' (' . implode(' OR ', $priceConditions) . ') ';
                }
            }
        
            // Xây dựng điều kiện SQL
            $sql = '';
            if (!empty($conditions)) {
                $sql = 'WHERE ' . implode(' AND ', $conditions);
            }
        
            // Truy vấn sản phẩm
            $products = $this->product->getProducts($sql, $params);
            if ($categoryId === null) {
                $category = [
                    'name' => '',
                    'description' => ''
                ];
            } else {
                $category = $this->category->getCategory($categoryId);
            }
        
            // Đảm bảo header đúng cho JSON
            header('Content-Type: application/json');
            echo json_encode([
                'products' => $products,
                'category' => $category
            ]);
        }   
        
        public function viewProductDetails($css, $js) {
            if (isset($_GET['id'])) {
                $data['product'] = $this->product->getProduct($_GET['id']);
                $data['productReviews'] = $this->review->getProductReviews($_GET['id']);
                if ($data['product'] == null) {
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    $data['relatedProducts'] = $this->product->getRelatedProducts($data['product']['category_id'], $_GET['id']);
                    $this->renderView('product-details', $css, $js, $data);
                }
            }
        }
    }
?>
