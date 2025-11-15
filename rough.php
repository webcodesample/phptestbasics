<?php
$arr1 = [1,2,3,4,5,6,7];
$arr2 = [4,5,9];

print_r(array_diff($arr2,$arr1));

die();

//declare(strict_types=1);

function add(int $a, int $b) : float {
    return $a + $b;
}

echo add(5, 10);
die();
$x=10;
//$x++;
echo 'result of $x :'.$x;
echo '<br>result of $x++ :'.$x++;
echo '<br>result of ($x++) :'.($x++);
echo '<br>';
echo -1+1;
?>