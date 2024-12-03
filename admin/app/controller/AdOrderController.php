<?php

use App\Model\OrderModel;

class AdOrderController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view
    private $orderModel;
    private $mailController;
    public function __construct()
    {
        require_once './app/model/OrderModel.php';
        // $this->data = new OrderModel();
        $this->orderModel = new OrderModel();
        $this->mailController = new AdMailController();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewOrder()
    {
        $this->data['orders'] = $this->orderModel->getOrder();
        $this->renderview('Order', $this->data);
    }
    public function viewOrder_Detail()
    {
        $this->renderview('Order_Detail', $this->data);
    }
    public function confirmOder()
    {


        $status = $_POST['order-status'];
        $IdOder = $_POST['oderCom-id'];
        /*     cập nhật trạng thái đơn hàng */
        $resus = $this->orderModel->chanceStatuspr($status, $IdOder);
        if ($resus) {
            $_SESSION['success'] = "Đơn hàng hiện $status ";

            $emailuser = $_POST['odermaildl'];;
            $checkuser = $this->mailController->statusPr($emailuser, $status);
            /*   $_SESSION['success'] = "Chúng tôi sẽ cố gắng liên hệ lại với bạn trong thời gian sớm nhất!";
 */
            header('Location: ./index.php?page=order_detail&id=' . $IdOder);
        } else {
            echo "  <script>
                alert('khong gui dc ')
              </script>";
            /*  $this->viewOrder(); */
        }
    }
}
?>