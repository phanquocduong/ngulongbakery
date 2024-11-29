<?php
session_start();

if (!isset($_SESSION['user']['role_id']) || $_SESSION['user']['role_id'] !== 1) {
    echo 'Không có quyền truy cập';
    exit();
}
ob_start();
require_once '.././app/model/database.php';
require_once './app/view/Header.php';
require_once './app/controller/MainController.php';
require_once './app/controller/AdProductsController.php';
require_once './app/controller/AdCategoriesController.php';
require_once './app/controller/AdOrderController.php';
require_once './app/controller/AdUserController.php';
require_once './app/controller/AdPost_ManageController.php';
require_once './app/controller/AdVoucherController.php';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'account_admin':
            echo '<script>location.href="/ngulongbakery/index.php?page=account"</script>';
            break;
        case 'products':
            $products = new AdProductsController();
            $products->viewProducts();
            break;
        case 'products_detail':
            $products_detail = new AdProductsController();
            $products_detail->viewProducts_Detail();
            break;
        case 'viewAddPro':
            $products = new AdProductsController();
            $products->viewAddProducts();
            break;
        case 'addPro':
            $products = new AdProductsController();
            $products->addPro();
            break;
        case 'viewEdit_products':
            $products = new AdProductsController();
            $products->viewEditProducts();
            break;
        case 'editPro':
            $products = new AdProductsController();
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $products->editPro($id);
            break;
        case 'delProducts':
            $products = new AdProductsController();
            $products->delPro();
            break;
        case 'categories':
            $categories = new AdCategoriesController();
            $categories->viewCategories();
            break;
        case 'view_categories':
            $products = new AdCategoriesController();
            $products->viewCategories_Detail();
            $products->viewCategories_Detail();
            $products->viewCategoriesDetail();
            break;
        case 'addCategories':
            $categories = new AdCategoriesController();
            $categories->viewAddCategories();
            break;
        case 'addCate':
            $categories = new AdCategoriesController();
            $categories->addCate();
            break;
        case 'delete_categories':
            $categories = new AdCategoriesController();
            $categories->delCate();
            break;
        case 'edit_categories':
            $categories = new AdCategoriesController();
            $categories->viewEditCategories();
            break;
        case 'editcate':
            $categories = new AdCategoriesController();
            $categories->editCate();
            break;
        case 'order':
            $order = new AdOrderController();
            $order->viewOrder();
            break;
        case 'order_detail':
            $order_detail = new AdOrderController();
            $order_detail->viewOrder_Detail();
            break;
        case 'accounts':
            $acc = new AdAccountsController();
            $acc->viewAcc();
            break;
        case 'addaccount':
            $acc = new AdAccountsController();
            $acc->addAccount();
            break;
        case 'edit_account':
            $acc = new AdAccountsController();
            $acc->viewEditAccount();
            break;
        case 'editaccount':
            $acc = new AdAccountsController();
            $acc->editAccount();
            break;
        case 'account_detail':
            $acc = new AdAccountsController();
            $acc->viewAccount_Detail();
            break;
        case 'deluser':
            $acc = new AdAccountsController();
            $acc->delUser();
            break;
        case 'logout':
            $acc = new AdAccountsController();
            $acc->logout();
            break;
        case 'blockuser':
            $acc = new AdAccountsController();
            $acc->blockUser();
            break;
        case 'post_manage':
            $post_manage = new AdPost_ManageController();
            $post_manage->viewPost_Manage();
            break;
        case 'add_post':
            $post_manage = new AdPost_ManageController();
            $post_manage->viewAddPost();
            break;
        case 'addPost':
            $post_manage = new AdPost_ManageController();
            $post_manage->addPost();
            break;
        case 'edit_post':
            $post_manage = new AdPost_ManageController();
            $post_manage->viewEditPost();
            break;
        case 'editPost':
            $post_manage = new AdPost_ManageController();
            $post_manage->editPost();
            break;
        case 'del_post':
            $post_manage = new AdPost_ManageController();
            $post_manage->deletePost();
            break;
        case 'post_detail':
            $post_detail = new AdPost_ManageController();
            $post_detail->viewPost_Detail();
            break;
        case 'voucher':
            $voucher = new AdVoucherController();
            $voucher->viewVoucher();
            break;
        case 'add_voucher':
            $voucher = new AdVoucherController();
            $voucher->viewAddVoucher();
            break;
        case 'addvoucher':
            $voucher = new AdVoucherController();
            $voucher->addVoucher();
            break;
        case 'edit_voucher':
            $voucher = new AdVoucherController();
            $voucher->viewEditVoucher();
            break;
        case 'editvoucher':
            $voucher = new AdVoucherController();
            $voucher->editVoucher();
            break;
        case 'delete_voucher':
            $voucher = new AdVoucherController();
            $voucher->deleteVoucher();
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