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
require_once './app/controller/AdPost_DetailController.php';
require_once './app/controller/AdProducts_DetailController.php';
require_once './app/controller/AdOrder_DetailController.php';
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
            $post_manage = new AdPost_ManageController();
            $post_manage->viewPost_Manage();
            break;
        case 'voucher':
            $voucher = new AdVoucherController();
            $voucher->viewVoucher();
        break;
        case 'post_detail':
            $post_detail = new AdPost_DetailController();
            $post_detail->viewPost_Detail();
        break;
        case 'products_detail':
            $products_detail = new AdProducts_DetailController();
            $products_detail->viewProsucts_Detail();
        break;
        case 'order_detail':
            $order_detail = new AdOrder_DetailController();
            $order_detail->viewOrder_Detail();
        break;
        case 'categories':
            $cate = new CategoriesController();
            $cate->viewCate();
        break;
        case 'accounts':
            $acc = new AcccountsController();
            $acc->viewAcc();
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