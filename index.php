<?php
session_start();
ob_start();
/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php'; */
/* form gui mail */
require_once 'vendor/autoload.php';
require_once 'app/model/database.php';
require_once 'app/model/CategoryModel.php';
require_once 'app/model/ProductModel.php';
require_once 'app/model/UserModel.php';
require_once 'app/model/OrderModel.php';
require_once 'app/model/ReviewModel.php';
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
        case 'cart':
            $css = 'cart.css';
            $js = 'cart.js';
            $cart = new CartController();
            $cart->viewCart($css, $js);
            break;
        case 'handle-update-cart':
            $cart = new CartController();
            $cart->handleUpdateCart();
            break;
        case 'handle-delete-cart':
            $cart = new CartController();
            $cart->handleDeleteCart();
            break;
        case 'collection':
            $css = 'collection.css';
            $js = 'collection.js';
            $product = new ProductController();
            $product->viewCollection($css, $js);
            break;
        case 'handle-products-display-by-filter':
            $product = new ProductController();
            $product->handleProductsDisplayByFilter();
            break;
        case 'product-details':
            $css = 'product-details.css';
            $js = 'product-details.js';
            $product = new ProductController();
            $product->viewProductDetails($css, $js);
            break;
        case 'register':
            $css = 'register.css';
            $js = 'register.js';
            $user = new UserController();
            $user->viewRegister($css, $js);
            break;
   
        case 'handle-register':
            $css = 'register.css';
            $js = 'register.js';
            $user = new UserController();
            $user->handleRegister($css, $js);
            break;
        case 'verify':
            $user = new UserController();
            $user->verify();
            break;
        case 'login':
            $css = 'login.css';
            $js = 'login.js';
            $user = new UserController();
            $user->viewLogin($css, $js);
            break;
        case 'handle-login':
            $css = 'login.css';
            $js = 'login.js';
            $user = new UserController();
            $user->handleLogin($css, $js);
            break;
        case 'handle-forgot-pass':
            $css = 'login.css';
            $js = 'login.js';
            $user = new UserController();
            $user->handleForgotPassword($css, $js);
            break;
        case 'reset-password':
            $css = 'reset-password.css';
            $js = 'reset-password.js';
            $user = new UserController();
            $user->viewResetPassword($css, $js);
            break;
        case 'handle-reset-password':
            $css = 'reset-password.css';
            $js = 'reset-password.js';
            $user = new UserController();
            $user->handleResetPassword($css, $js);
            break;
        case 'logout':
            $user = new UserController();
            $user->logout();
            break;
        case 'account':
            $css = 'account.css';
            $js = 'account.js';
            $user = new UserController();
            $user->viewAccount($css, $js);
            break;
        case 'contact-handle':
            $css = 'contact.css';
            $js = '';
            $home = new Contactcontroller();
            $home->viewContact($css, $js);
            break;
        case 'sumbit-getcontact':
            $css = 'contact.css';
            $js = '';
            $home = new Contactcontroller();
            $home->getfromct($css, $js);
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
