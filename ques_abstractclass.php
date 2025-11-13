<?php
abstract class ParentClass1{
	abstract function testfun();
	function testfun2($name)
	{
		echo $name;
	}
}

class Child extends ParentClass1{
	function testfun(){
		echo 'Abstract Function';
	}
}

$person = new Child();
$person->testfun();
$person->testfun2('amit');
?>