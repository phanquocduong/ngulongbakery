<?php
    class ProductController {
        private $product;
        private $category;
        private $review;
        private $favorite_products;

        function __construct() {
            $this->product = new ProductModel();
            $this->category = new CategoryModel();
            $this->review = new ReviewModel();
            $this->favorite_products = new FavoriteProductsModel();
        }

        private function renderView($view, $css, $js, $data = null, $numberPages = null) {
            $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
            require_once 'app/view/template.php';
        }

        private function viewProducts($view, $css, $js, $condition = '', $params = [], $order = '') {
            $num = $_GET['num'] ?? 1;
            $start = ($num - 1) * 9;
            $data = $this->product->getProducts($condition, $params, $order, $start, 9);
            $quantity = $this->product->getProductCount($condition, $params);
            $numberPages = ceil($quantity / 9);
            $this->renderView($view, $css, $js, $data, $numberPages);
        }

        public function viewCollection($css, $js) {
            $this->renderView('collection', $css, $js);
        }

        public function handleProductsDisplay() {
            // Lấy các tham số từ URL
            $num = isset($_GET['num']) ? (int)$_GET['num'] : 1;
            $limit = 9;
            $start = ($num - 1) * $limit;

            $categoryId = isset($_GET['category']) ? $_GET['category'] : '';
            $prices = isset($_GET['price']) ? explode(',', $_GET['price']) : [];
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
        
            // Mảng chứa các điều kiện lọc
            $conditions = [];
            $params = [];
        
            // Điều kiện lọc theo category_id
            if (!empty($categoryId)) {
                $conditions[] = "category_id = ?";
                $params[] = $categoryId;
            }
        
            // Điều kiện lọc theo giá
            if (!empty($prices)) {
                $priceConditions = [];
                foreach ($prices as $priceRange) {
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
            $whereConditions = '';
            if (!empty($conditions)) {
                $whereConditions = 'WHERE ' . implode(' AND ', $conditions) . ' AND status = 1 AND stock_quantity > 0';
            }

            // Xử lý điều kiện sắp xếp
            $order = '';
            if ($sort == 'price_asc') {
                $order = "price ASC";
            } elseif ($sort == 'price_desc') {
                $order = "price DESC";
            } elseif ($sort == 'name_asc') {
                $order = "name ASC";
            } elseif ($sort == 'name_desc') {
                $order = "name DESC";
            } elseif ($sort == 'featured') {
                $order = "views DESC";
            }
        
            // Truy vấn sản phẩm
            $products = $this->product->getProducts($whereConditions, $params, $order, $start, $limit);
            $totalProducts = $this->product->getProductCount($whereConditions, $params);
            $numberPages = ceil($totalProducts / $limit);

            // Lấy thông tin danh mục
            if (empty($categoryId)) {
                $category = [
                    'name' => '',
                    'description' => ''
                ];
            } else {
                $category = $this->category->getCategory($categoryId);
            }
    
            // Trả về kết quả dưới dạng JSON
            header('Content-Type: application/json');
            echo json_encode([
                'products' => $products,
                'category' => $category,
                'pagination' => $this->renderPagination($num, $numberPages),
                'message' => $totalProducts == 0 ? 'Không có sản phẩm nào phù hợp với bộ lọc của bạn!' : ''
            ]);
        }   

        private function renderPagination($currentPage, $numberPages) {
            $html = '';
            if ($currentPage > 1) {
                $html .= '<a href="#" data-page="' . ($currentPage - 1) . '" class="pagination-link__icon-prev"><i class="fa-solid fa-chevron-left"></i></a>';
            }
            for ($i = 1; $i <= $numberPages; $i++) {
                $activeClass = $i == $currentPage ? 'pagination-link--active' : '';
                $html .= '<a href="#" data-page="' . $i . '" class="pagination-link ' . $activeClass . '">' . $i . '</a>';
            }
            if ($currentPage < $numberPages) {
                $html .= '<a href="#" data-page="' . ($currentPage + 1) . '" class="pagination-link__icon-next"><i class="fa-solid fa-chevron-right"></i></a>';
            }
            return $html;
        }
        
        public function viewProductDetails($css, $js) {
            if (isset($_GET['id'])) {
                $data['product'] = $this->product->getProduct($_GET['id']);
                if ($data['product'] == null) {
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    $this->product->increaseProductViews($_GET['id']);
                    $data['relatedProducts'] = $this->product->getRelatedProducts($data['product']['category_id'], $_GET['id']);
                    if (isset($_SESSION['user'])) {
                        $favorite =  $this->favorite_products->getFavoriteProduct($_SESSION['user']['id'], $_GET['id']);
                        if ($favorite) {
                            $data['favorite'] = $favorite;
                        }
                    }
                    $this->renderView('product-details', $css, $js, $data);
                }
            }
        }

        public function viewSearchProducts($css, $js) {
            $this->viewProducts('search-products', $css, $js, 'WHERE name LIKE "%'.$_GET['keyword'].'%" AND status = 1 AND stock_quantity > 0', []);
        }

        public function handleFavoriteProduct() {
            $data = json_decode(file_get_contents('php://input'), true);
            $productId = $data['productId'] ?? null;
            $userId = $data['userId'] ?? null;
            if (!$productId || !$userId) {
                echo json_encode(['success' => false, 'error' => 'Dữ liệu không hợp lệ.']);
                exit;
            }
            $favorite = $this->favorite_products->getFavoriteProduct($userId, $productId);
            if ($favorite) {
                $this->favorite_products->deleteFavoriteProduct($userId, $productId);
                echo json_encode(['success' => true, 'isFavorite' => false]);
            } else {
                $this->favorite_products->addFavoriteProduct($userId, $productId);
                echo json_encode(['success' => true, 'isFavorite' => true]);
            }
        }
    }
?>
