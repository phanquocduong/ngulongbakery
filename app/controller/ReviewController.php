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

        function review($base_url) {
            $orderId = $_POST['orderId'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'] ?? "";

            if (empty($orderId) || !is_numeric($orderId)) {
                $_SESSION['error'] = "Mã đơn hàng không hợp lệ.";
                header("Location: $base_url/account");
                exit;
            }            
            if (empty($rating) || !is_numeric($rating) || $rating < 1 || $rating > 5) {
                $_SESSION['error'] = "Xếp hạng không hợp lệ.";
                header("Location: $base_url/account");
                exit;
            }            
        
            $uploadedImages = [];
            if (isset($_FILES['imageUpload'])) {
                $fileCount = count($_FILES['imageUpload']['name']);
        
                if ($fileCount > 3) {
                    $_SESSION['error'] = "Bạn chỉ được phép tải lên tối đa 3 ảnh.";
                    header("Location: $base_url/account");
                    exit;
                }
        
                $allowedTypes = ['image/jpeg', 'image/png'];
                for ($i = 0; $i < $fileCount; $i++) {
                    // Xử lý định dạng ảnh                   
                    if (!in_array($_FILES['imageUpload']['type'][$i], $allowedTypes)) {
                        $_SESSION['error'] = "Chỉ hỗ trợ file ảnh PNG và JPEG!";
                        header("Location: $base_url/account");
                        exit;
                    }

                    // Xử lý kích thước ảnh
                    if ($_FILES['imageUpload']['size'][$i] > 5000000) {  // 5MB
                        $_SESSION['error'] = "Kích thước file quá lớn! Vui lòng chọn ảnh nhỏ hơn 5MB.";
                        header("Location: $base_url/account");
                        exit;
                    }

                    // Xử lý upload ảnh
                    if ($_FILES['imageUpload']['error'][$i] === UPLOAD_ERR_OK) {
                        $fileName = time() . '_' . $_FILES['imageUpload']['name'][$i];
                        $targetFilePath = './public/upload/review/' . $fileName;
        
                        if (move_uploaded_file($_FILES['imageUpload']['tmp_name'][$i], $targetFilePath)) {
                            $uploadedImages[] = $fileName;
                        } else {    
                            $_SESSION['error'] = "Lỗi khi upload hình ảnh.";
                            header("Location: $base_url/account");
                            exit;
                        }
                    }
                }
            }
        
            // Lấy chi tiết đơn hàng và thêm đánh giá
            $productsDetails = $this->order->getOrderDetails($orderId);
            foreach ($productsDetails as $item) {
                $product = $this->product->getProductByName($item['product_name']);
                $uploadedImagesString = implode(',', $uploadedImages);

                $result = $this->review->addReview($_SESSION['user']['id'], $rating, $uploadedImagesString, $comment, $product['id'], 1);
                $updateStatusResult = $this->order->updateReviewStatusOfOrder($orderId);

                if (!$result || !$updateStatusResult) {
                    $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại.";
                    header("Location: $base_url/account");
                    exit;
                }

                $reviewsOfProduct = $this->review->getReviewsOfProduct('WHERE product_id = ?', [$product['id']]);
                $countReviewsOfProduct = $this->review->getReviewCount('WHERE product_id = ?', [$product['id']]);

                $totalRatingOfProducts = array_reduce($reviewsOfProduct, function($total, $item) {return $total + $item['rating'];}, 0);
                $averageRatingOfProduct = round($totalRatingOfProducts / $countReviewsOfProduct);

                $this->product->updateRatingOfProduct($product['id'], $averageRatingOfProduct);
            }
        
            $_SESSION['success'] = "Đánh giá thành công";
            header("Location: $base_url");
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
            if ($numberPages > 1) {
                for ($i = 1; $i <= $numberPages; $i++) {
                    $activeClass = $i == $currentPage ? 'pagination-link--active' : '';
                    $html .= '<a href="#" data-page="' . $i . '" class="pagination-link ' . $activeClass . '">' . $i . '</a>';
                }
            }
            if ($currentPage < $numberPages) {
                $html .= '<a href="#" data-page="' . ($currentPage + 1) . '" class="pagination-link__icon-next"><i class="fa-solid fa-chevron-right"></i></a>';
            }
            $html .= '</div>';
            return $html;
        }
        
    }
?>