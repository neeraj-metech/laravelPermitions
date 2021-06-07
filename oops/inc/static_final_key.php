<?php 

//Static methods can be called directly - without creating an instance of the class first.
//Static methods are declared with the static keyword:



class Employee
{
	public function __construct() {
	    self::staticMethod();
	}

	public static function staticMethod() {
	    echo "Hello World!";
	}

	public static function staticMethod2() {
	    echo "Hello World!2";
	}
	
}

class EmployeeSecond extends Employee{
	public function __construct() {
	    parent::staticMethod2();
	}	
}


// echo Employee::staticMethod();
// $emp = new EmployeeSecond;



// Final key

//Prevent inheritance of a class using the final keyword:
// final class can not extends in other class
final class MyClass {
  public $name = "John";
}

$f = new MyClass;
echo $f->name;
 ?>