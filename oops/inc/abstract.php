<?php 

Abstract class Person
{

	Abstract public function setName($name);
	Abstract public function getSalary();

	function getTest(){
		return 'test abstract function';
	}

}

class Employee extends Person
{
	private $__salary='';
	private $__name='';

	function __construct($name,$salary)
	{
		$this->setSalary($salary);
		$this->setName($name);
	}

	function setName($name){
		$this->__name = $name;
	}
	
	function getName(){
		return $this->__name;
	}
	
	function setSalary($salary){
		$this->__salary = $salary;	
	}
	function getSalary(){
		return $this->__salary;	
	}
	
}

$emp = new Employee('neeraj','123456');
echo $emp->getTest();
 ?>