<?php
class AdAccountsController{
    private $data;
    private $user;
    public function __construct()
    {
        require_once './app/model/UserModel.php';
        $this->user = new UserModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewAcc()
    {
        $user = new UserModel();
        $this->data['user'] = $this->user->getUser();
        $this->renderview('Accounts_Manage', $this->data);
    }
    public function viewAddAccount(){
        $this->renderview('add_account', $this->data);
    }
    public function viewAccount_Detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $accountDetail = $this->user->getIdUser($id);

            if (is_array($accountDetail)) {
                $this->data['accountDetail'] = $accountDetail;
                $this->renderview('account_detail', $this->data);
            } else {
                echo "Not found....";
            }
    }
    public function viewEditAccount(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $editaccountDetail = $this->user->getIdUser($id);

            if (is_array($editaccountDetail)) {
                $this->data['editaccountDetail'] = $editaccountDetail;
                $this->renderview('edit_account', $this->data);
            } else {
                echo "Not found....";
            }
        
    }
}

?>