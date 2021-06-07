<?php
    require 'lib/constant.php';
    function __autoload($className){
        require_once "lib/$className.php";
    }
    $view = new loginConfig;

?>