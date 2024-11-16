<?php
class AdAccountsController{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewAcc()
    {
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