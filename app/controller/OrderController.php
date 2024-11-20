<?php
    class OrderController {
        private $order;

        function __construct() {
            $this->order = new OrderModel();
        }

        function cancelOrder() {
            if (isset($_GET['id'])) {
                if($this->order->changeStatus($_GET['id'], 'Đã huỷ')) {
                    echo '<script>alert("Bạn đã huỷ đơn hàng thành công")</script>';
                    echo '<script>window.location.href = "index.php?page=account";</script>';
                }
            }
        }

        function buyBackOrder() {
            if (isset($_GET['id'])) {
                if($this->order->changeStatus($_GET['id'], 'Chờ xác nhận')) {
                    echo '<script>alert("Bạn đã đặt lại đơn hàng thành công")</script>';
                    echo '<script>window.location.href = "index.php?page=account";</script>';
                }
            }
        }
    }
?>