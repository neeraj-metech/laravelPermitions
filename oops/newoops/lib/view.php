<?php
Class view {
    private $controllName;
    private $arr = array();
    public function __construct(){
        require_once 'lib/ControllerConfig.php';
        $this->controllName = new ControllerConfig;

    }
    public function __set($name,$arg){
        $this->arr[$name] = $arg;
    }
    
    public function display($file){
        $c_name = $this->controllName->read();
        if($c_name['login']=='login'){
            include "view/$file";
        }else{
            include "view/$file";
        }

    }
}
?>