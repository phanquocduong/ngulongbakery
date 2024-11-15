<?php
session_start();
ob_start();
require_once '../app/model/database.php';
require_once './app/view/Header.php';
require_once './app/controller/MainController.php';
require_once './app/controller/AdProductsController.php';
require_once './app/controller/AdOrderController.php';
require_once './app/controller/AdPost_ManageController.php';
require_once './app/controller/AdVoucherController.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'products':
            $products = new AdProductsController();
            $products->viewProducts();
            break;
        case 'order':
            $order = new AdOrderController();
            $order->viewOrder();
            break;
        case 'post_manage':
            $order = new AdPost_ManageController();
            $order->viewPost_Manage();
            break;
        case 'voucher':
            $order = new AdVoucherController();
            $order->viewVoucher();
            break;
        default:
            $main = new MainController();
            $main->viewMain();
            break;
    }
} else {
    $main = new MainController();
    $main->viewMain();
}
require_once './app/view/Footer.php';

?>