<?php
class Person{
	public function displayName($name)
	{
		echo $name;
	}
}
$person = new Person();
$person->displayName('Amit');
?>