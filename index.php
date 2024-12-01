<?php
    session_start();
    ob_start();
    require_once 'vendor/autoload.php';
    require_once 'app/model/database.php';
    require_once 'app/model/CategoryModel.php';
    require_once 'app/model/ProductModel.php';
    require_once 'app/model/UserModel.php';
    require_once 'app/model/OrderModel.php';
    require_once 'app/model/ReviewModel.php';
    require_once 'app/model/FavoriteProductsModel.php';
    require_once 'app/model/LocationModel.php';
    require_once 'app/model/DiscountModel.php';
    require_once 'app/model/NewsModel.php';
    require_once 'app/model/CommentsModel.php';
    require_once 'app/controller/HomeController.php';
    require_once 'app/controller/ProductController.php';
    require_once 'app/controller/UserController.php';
    require_once 'app/controller/AboutController.php';
    require_once 'app/controller/ContactController.php';
    require_once 'app/controller/CartController.php';
    require_once 'app/controller/PaymentController.php';
    require_once 'app/controller/OrderController.php';
    require_once 'app/controller/ReviewController.php';
    require_once 'app/controller/MailController.php';
    require_once 'app/controller/NewsController.php';

    $base_url = 'http://localhost/ngulongbakery';

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
                $cart->handleDeleteCart($base_url);
                break;
            case 'collection':
                $css = 'collection.css';
                $js = 'collection.js';
                $product = new ProductController();
                $product->viewCollection($css, $js);
                break;
            case 'handle-products-display':
                $product = new ProductController();
                $product->handleProductsDisplay();
                break;
            case 'product-details':
                $css = 'product-details.css';
                $js = 'product-details.js';
                $product = new ProductController();
                $product->viewProductDetails($base_url, $css, $js);
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
                $user->handleRegister($base_url, $css, $js);
                break;
            case 'verify':
                $user = new UserController();
                $user->verify($base_url);
                break;
            case 'login':
                $css = 'login.css';
                $js = 'login.js';
                $user = new UserController();
                $user->viewLogin($base_url, $css, $js);
                break;
            case 'handle-login':
                $css = 'login.css';
                $js = 'login.js';
                $user = new UserController();
                $user->handleLogin($base_url, $css, $js);
                break;
            case 'handle-forgot-pass':
                $css = 'login.css';
                $js = 'login.js';
                $user = new UserController();
                $user->handleForgotPassword($base_url, $css, $js);
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
                $user->handleResetPassword($base_url, $css, $js);
                break;
            case 'logout':
                $user = new UserController();
                $user->logout($base_url);
                break;
            case 'account':
                $css = 'account.css';
                $js = 'account.js';
                $user = new UserController();
                $user->viewAccount($css, $js);
                break;
            case 'handle-update-information':
                $user = new UserController();
                $user->handleUpdateInformation($base_url);
                break;
            case 'change-password':
                $css = 'change-password.css';
                $js = 'change-password.js';
                $user = new UserController();
                $user->viewChangePassword($css, $js);
                break;
            case 'handle-change-password':
                $css = 'change-password.css';
                $js = 'change-password.js';
                $user = new UserController();
                $user->handleChangePassword($base_url, $css, $js);
                break;
            case 'cancel-order':
                $order = new OrderController();
                $order->cancelOrder($base_url);
                break;
            case 'buy-back-order':
                $order = new OrderController();
                $order->buyBackOrder($base_url);
                break;
            case 'review':
                $review = new ReviewController();
                $review->review($base_url);
                break;
            case 'search':
                $css = 'search-products.css';
                $js = '';
                $product = new ProductController();
                $product->viewSearchProducts($css, $js);
                break;
            case 'handle-favorite-product':
                $product = new ProductController();
                $product->handleFavoriteProduct();
                break;
            case 'contact':
                $css = 'contact.css';
                $js = '';
                $contact = new ContactController();
                $contact->viewContact($css, $js);
                break;
            case 'handle-contact':
                $css = 'contact.css';
                $js = '';
                $contact = new ContactController();
                $contact->handleContact($base_url);
                break;
            case 'payment':
                $css = 'payment.css';
                $js = 'payment.js';
                $payment = new PaymentController();
                $payment->viewPayment($base_url, $css, $js);
                break;
            case 'get-districts':
                $payment = new PaymentController();
                $payment->handleGetDistricts();
                break;
            case 'get-wards':
                $payment = new PaymentController();
                $payment->handleGetWards();
                break;
            case 'apply-discount':
                $payment = new PaymentController();
                $payment->handleApplyDiscount();
                break;
            case 'handle-payment':
                $payment = new PaymentController();
                $payment->handlePayment($base_url);
                break;
            case 'handle-product-reviews-display':
                $review = new ReviewController();
                $review->handleProductReviewsDisplay();
                break;
            case 'about':
                $css = 'about.css';
                $js = 'about.js';
                $about = new AboutController();
                $about->viewAbout($css, $js);
                break;
            case 'handle-orders-display':
                $order = new OrderController();
                $order->handleOrdersDisplay();
                break;
            case 'news':
                $css = 'news.css';
                $js = 'news.js';
                $news = new NewsController();
                $news->viewNews($css, $js);
                break;
            case 'news-details':
                $css = 'detailnews.css';
                $js = 'detailnews.js';
                $news = new NewsController();
                $news->viewNewsDetail($css, $js);
                break;
            case 'addCmt':
                $cmt = new NewsController();
                $cmt->addComment();
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