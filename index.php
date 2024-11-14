<?php
    session_start();
    ob_start();
    require_once 'app/model/database.php';
    require_once 'app/model/CategoryModel.php';
    require_once 'app/model/ProductModel.php';
    require_once 'app/model/UserModel.php';
    require_once 'app/model/OrderModel.php';
    require_once 'app/controller/HomeController.php';
    require_once 'app/controller/ProductController.php';
    require_once 'app/controller/UserController.php';
    require_once 'app/controller/AboutController.php';
    require_once 'app/controller/ContactController.php';
    require_once 'app/controller/CartController.php';
    require_once 'app/controller/PaymentController.php';
    require_once 'app/controller/OrderController.php';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'handle-add-to-cart':
                $cart = new CartController();
                $cart->handleAddToCart();
                break;
            
            default:
                $css = 'home.css';
                $js = 'home.js';
                $home = new HomeController();
                $home->viewHome($css, $js);
                break;
        }
    } else {
        $css = 'home.css';
        $js = 'home.js';
        $home = new HomeController();
        $home->viewHome($css, $js);
    }

    
?>