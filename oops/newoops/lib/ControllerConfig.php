<?php
Class ControllerConfig {
    private $cntfig;

    public function __construct(){
        //controller for without login user
        $this->cntfig['islogin'] = false;
        $this->cntfig['login'] = 'loginController';
        //controller for login user
        $this->cntfig['userlogin'] = 'homeController';
    }

    public function read(){
        return $this->cntfig;
    }
}

?>