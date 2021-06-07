<?php
Class loginConfig {
    private $is_login;
    private $cntfig;
    public function __construct(){
        require_once 'lib/ControllerConfig.php';
        $logcntr = new ControllerConfig();
        $this->cntfig = $logcntr->read();
        $this->is_login();
    }
    
    public function is_login(){
        if(isset($_SESSION['user_id']) || $this->cntfig['islogin']==false){
            $controller = $this->cntfig['login'];
            $action = 'index';
            $cc_file = "controller/$controller.php";
            if(file_exists($cc_file)){
                require_once $cc_file;
                call_user_func(array(new $controller,$action));
            }else{
                $this->err();
            }
        }else{
            $this->err();
        }

    }

    public function err(){
        require 'lib/View.php';
        $this->_view = new View();
        $this->_view->title = TITEL_404;
        $this->_view->headline = HEADLINE_404;
        $this->_view->display('404/error.php');
    }
}
?>