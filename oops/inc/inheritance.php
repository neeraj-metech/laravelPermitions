<?php 

class Person
{
	private $__name='';

	function setName($name)
	{
		$this->__name = $name;
	}

	function getName(){
		return $this->__name;
	}
}

class Employee extends Person
{
	private $__salary='';
	
	function __construct($name,$salary)
	{
		$this->setSalary($salary);
		$this->setName($name);
	}


	function setSalary($salary){
		$this->__salary = $salary;	
	}
	function getSalary(){
		return $this->__salary;	
	}
}


 ?>