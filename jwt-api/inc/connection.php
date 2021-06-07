<?php 


class connection
{
	private $localhost='localhost';
	private $username='root';
	private $password='';
	private $dbname='tt';
	public  $con;

	function con()
	{
		try {
			$this->con = new PDO('mysql:host='.$this->localhost.'; dbname='.$this->dbname, $this->username, $this->password);  
		    $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			return $this->con;	
		} catch (Exception $e) {
			echo 'There is somerror '.$e->getMessage();
		}
	    
	}


}

$db = new connection;
$db->con();



?>