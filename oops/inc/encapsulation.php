<?php 

class Employee
{
	public $_name='';
	protected $_salary='';
	private $_age;

	function __construct($name,$salary,$age)
	{
		$this->_name = $name;
		$this->_salary = $salary;
		$this->_age = $age;
	}

	function getSalary(){
		return $this->_salary;
	}

	function getAge(){
		return $this->_age;
	}
	
}

$emp = new Employee('neeraj','123456','23');
echo $emp->_name.'<br/>';
echo $emp->getSalary().'<br/>';
echo $emp->getAge().'<br/>';
 ?>