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
        $this->renderview('account_detail', $this->data);
    }
    public function viewEditAccount(){
        $this->renderview('edit_account', $this->data);
    }
}

?>