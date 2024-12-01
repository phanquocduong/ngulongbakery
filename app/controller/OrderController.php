<?php
    class OrderController {
        private $order;

        function __construct() {
            $this->order = new OrderModel();
        }

        function cancelOrder($base_url) {
            if (isset($_GET['id'])) {
                if($this->order->changeStatus($_GET['id'], 'Đã huỷ')) {
                    $_SESSION['success'] = "Huỷ đơn hàng thành công";
                    header("Location: $base_url/account");
                    exit;
                }
            }
        }

        function buyBackOrder($base_url) {
            if (isset($_GET['id'])) {
                if($this->order->changeStatus($_GET['id'], 'Chờ xác nhận')) {
                    $_SESSION['success'] = "Đặt lại đơn hàng thành công";
                    header("Location: $base_url/account");
                    exit;
                }
            }
        }

        public function handleOrdersDisplay() {
            $userId = $_SESSION['user']['id'];
            $num = isset($_GET['num']) ? (int)$_GET['num'] : 1;
            $limit = 10;
            $start = ($num - 1) * $limit;

            $orders = $this->order->getOrders('WHERE user_id = ?', [$userId], 'id DESC', $start, $limit);
            $totalOrders = $this->order->getOrderCount('WHERE user_id = ?', [$userId]);
            $numberPages = ceil($totalOrders / $limit);

            foreach ($orders as &$order) {
                $order['details'] = $this->order->getOrderDetails($order['id']);
            }

            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'orders' => $orders,
                'pagination' => $this->renderPagination($num, $numberPages),
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