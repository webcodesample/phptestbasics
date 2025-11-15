<?php
include_once 'common_include.php';
include_once 'head.php';

$serchextensions = 'pdf,jpg,png,jpeg,PNG';

//$files = glob('uploads/*.{'.$serchextensions.'}', GLOB_BRACE);
//$files = glob('uploads/*', GLOB_ONLYDIR);
$files = scandir('uploads/test1');

foreach($files AS $file)
{
	if($file == '..')
	$name = 'Parent Dir';
	elseif($file == '.')
	$name = 'Current Dir';
	else
	$name = strtoupper(pathinfo($file,PATHINFO_FILENAME));

	echo '<div class="m-1"><a href="'.$file.'" class="text-decoration-none" target="_blank">'.$name.'</a></div>';
}
//echo '<a href=".">Parent</a>';

include_once 'foot.php';
?>