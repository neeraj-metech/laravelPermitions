<?php 

trait getDetails{
	function getName(){
		return $this->__name;
	}

	function getSalary(){
		return $this->__salary;	
	}
}

interface Person
{

	function setName($name);

}

class Employee implements Person
{
	private $__salary='';
	private $__name='';

	use getDetails;
	
	function __construct($name,$salary)
	{
		$this->setSalary($salary);
		$this->setName($name);
	}

	function setName($name){
		$this->__name = $name;
	}
	
	function setSalary($salary){
		$this->__salary = $salary;	
	}
	
}

$emp = new Employee('neeraj','123456');
echo $emp->getSalary();
 ?>