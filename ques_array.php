<?php
$nums = [1,2,5,4,6,3];

//display array length with inbuilt function
echo count($nums);

//display without inbuil function
echo '<br>Second Method without inbuilt function.<br>';
$count = 0;
foreach($nums AS $num)
{
	$count++;
}
echo $count;
?>