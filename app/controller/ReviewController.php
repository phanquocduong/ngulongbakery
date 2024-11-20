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
            $images = null;
            if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
                $images = time() . '_' . basename($_FILES['imageUpload']['name']);
                $targetFilePath = './public/upload/review/' . $images;
                if (!move_uploaded_file($_FILES['imageUpload']['tmp_name'], $targetFilePath)) {
                    echo '<script>alert("Lỗi khi upload hình ảnh.");</script>';
                    exit;
                }
            }
        
            // Lấy chi tiết đơn hàng và thêm đánh giá
            $productsDetails = $this->order->getOrderDetails($orderId);
            foreach ($productsDetails as $productDetails) {
                $product = $this->product->getProductByName($productDetails['product_name']);
                $result = $this->review->addReview($_SESSION['user']['id'], $rating, $images, $comment, $product['id']);
                if (!$result) {
                    echo '<script>alert("Có lỗi xảy ra, vui lòng thử lại.");</script>';
                    echo '<script>window.location.href = "index.php?page=account";</script>';
                    exit;
                }
            }
        
            // Redirect sau khi xử lý xong
            header('Location: index.php?page=account');
            exit;
        }
        
    }
?>