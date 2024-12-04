<?php
    class ReviewController {
        private $review;
        private $order;
        private $product;

        function __construct() {
            $this->review = new ReviewModel();
            $this->order = new OrderModel();
            $this->product = new ProductModel();
        }

        function review() {
            $orderId = $_POST['orderId'];
            $rating = $_POST['rating'];
            $comment = htmlspecialchars($_POST['comment']); // Lọc XSS
        
            // Xử lý upload ảnh
            $uploadedImages = [];
            if (isset($_FILES['imageUpload'])) {
                $fileCount = count($_FILES['imageUpload']['name']);
        
                if ($fileCount > 3) {
                    $_SESSION['error'] = "Bạn chỉ được phép tải lên tối đa 3 ảnh.";
                    header("Location: index.php?page=account");
                    exit;
                }
        
                for ($i = 0; $i < $fileCount; $i++) {
                    if ($_FILES['imageUpload']['error'][$i] === UPLOAD_ERR_OK) {
                        $fileName = time() . '_' . $_FILES['imageUpload']['name'][$i];
                        $targetFilePath = './public/upload/review/' . $fileName;
        
                        if (move_uploaded_file($_FILES['imageUpload']['tmp_name'][$i], $targetFilePath)) {
                            $uploadedImages[] = $fileName;
                        } else {
                            $_SESSION['error'] = "Lỗi khi upload hình ảnh.";
                            header("Location: index.php?page=account");
                            exit;
                        }
                    }
                }
            }
        
            // Lấy chi tiết đơn hàng và thêm đánh giá
            $productsDetails = $this->order->getOrderDetails($orderId);
            foreach ($productsDetails as $productDetails) {
                $product = $this->product->getProductByName($productDetails['product_name']);
                $uploadedImagesString = implode(',', $uploadedImages);
                $result = $this->review->addReview($_SESSION['user']['id'], $rating, $uploadedImagesString, $comment, $product['id'], 1);
                $updateStatusResult = $this->order->updateReviewStatusOfOrder($orderId);
                if (!$result || !$updateStatusResult) {
                    $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại.";
                    header("Location: index.php?page=account");
                    exit;
                }
            }
        
            // Redirect sau khi xử lý xong
            header('Location: index.php?page=account');
            exit;
        }

        public function handleProductReviewsDisplay() {
            $productId = isset($_GET['product-id']) ? $_GET['product-id'] : null;
            $num = isset($_GET['num']) ? (int)$_GET['num'] : 1;
            $limit = 5;
            $start = ($num - 1) * $limit;
    
            $whereConditions = 'WHERE product_id = ?';
            $params = [$productId];
            $order = 'created_at DESC';

            $reviews = $this->review->getReviewsOfProduct($whereConditions, $params, $order, $start, $limit);
            $totalReviews = $this->review->getReviewCount($whereConditions, $params);
            $numberPages = ceil($totalReviews / $limit);
    
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'reviews' => $reviews,
                'pagination' => $this->renderPagination($num, $numberPages),
                'reviewCount' => $totalReviews
            ]);
        }

        private function renderPagination($currentPage, $numberPages) {
            $html = '<div class="pagination">';
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
            $html .= '</div>';
            return $html;
        }
        
    }
?>