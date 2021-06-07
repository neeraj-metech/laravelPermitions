<?php
include 'test.php';

class Database extends Test{
    public $con;

    public function __construct(){
        $this->con = mysqli_connect("localhost","root","","test");
        if(!$this->con){
            echo "database not connected ".mysqli_connect_error($this->con);
        }
    }

    public function select($table_name){
        $response = array();
        $query = "SELECT * FROM ".$table_name."";
        $result = mysqli_query($this->con, $query);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while($row=mysqli_fetch_assoc($result)){
                $array[] = $row;
            }
            $response['data'] = $array;
            $response['msg_code'] = 'OOPS0000';
            $response['msg'] = 'successfull';
        }else{
         $response['msg_code'] = 'OOPS0001';
        $response['msg'] = 'No data found!!';
        }
        return $response;
    }

    public function insert($table_name, $data){
        $query = "INSERT INTO ".$table_name." (";
        $query .= implode(",", array_keys($data)) . ') VALUES (';
        $query .= "'" . implode("','", array_values($data)) . "')";
        mysqli_query($this->con,$query);
        return $query;
        // if(mysqli_query($this->con,$query)){
        //     return true;
        // }else{
        //     echo mysqli_error($this->con);
        // }
    }
    public function test(){
        // echo $this->testcalssfun();
        //OR
        echo parent::testcalssfun();
    }
    protected function test1(){
       return 'it is protected.';
    }

    function getProtectedfun(){
        return $this->test1();
    }
    private function test2(){
       return 'it is private.';
    }

    function getPrivatefun(){
        return $this->test2();
    }
}
?>

