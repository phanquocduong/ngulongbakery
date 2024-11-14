<?php
session_start();
ob_start();
require_once '../app/model/database.php';
require_once './app/view/Header.php';
require_once './app/controller/MainController.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'handle-add-to-cart':
            $cart = new CartController();
            $cart->handleAddToCart();
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
require_once 'admin/app/view/Footer.php';

?>