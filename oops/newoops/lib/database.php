<?php
class Database {

    function __construct(){
        $this->connect();
    }

    private function connect(){
        $conn = mysqli_connect("localhost","root","","socialshare");
        if(!$conn){
            echo "database not connected ".mysqli_connect_error($con);
        }
    }
}

?>