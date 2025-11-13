<?php
function myfunc(){

	function innerfunc()
	{
		echo "Innerfunc";
	}
	innerfunc();
	echo "Function1";
}

echo myfunc();
echo innerfunc();
?>