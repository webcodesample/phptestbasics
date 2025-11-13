<?php
/*
echo abs(-5.25); // Output: 5
echo '<br>';
echo round(4.6);     // Output: 5
echo '<br>';
echo round(4.4);     // Output: 4
echo '<br>';
echo round(3.14159, 3);
echo '<br>';
echo sqrt(18);
echo '<br>';*/
$days = 31;

echo pow(2, $days);
echo '<br>';
//echo exp(2);
echo '<br>';

echo cal($days);
function cal($days)
{
	$sum = 0;
	for($i=0;$i<$days;$i++)
	{
		$sum += pow(2,$i);
	}
	return $sum;
}
?>