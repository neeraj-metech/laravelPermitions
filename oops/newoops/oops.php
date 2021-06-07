<?php
class Database{
    public $con;

    public function __construct(){
        $this->con = mysqli_connect("localhost","root","","socialshare");
        if(!$this->con){
            echo "database not connected ".mysqli_connect_error($this->con);
        }
    }

    public function select($table_name){
        //$array = array();
        $query = "SELECT * FROM ".$table_name."";
        $result = mysqli_query($this->con, $query);
        while($row=mysqli_fetch_assoc($result)){
            $array[] = $row;
        }
        return $array;
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
}
?>