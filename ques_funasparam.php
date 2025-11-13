<?php
function fun1()
{
	echo "Function1";
}

function fun2($cbfun)
{
	$cbfun();
}

fun2('fun1');
?>