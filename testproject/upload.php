<?php
//code for multifiles upload
print_r($_FILES);
echo $filecount = count($_FILES['docs']['name']);

$dest_path = 'uploads/';

if(!is_dir($dest_path))
mkdir($dest_path);

$allowedExtensions = ['jpeg','png','jpg','PNG','pdf'];
$allowedMimes = ['image/jpg','image/png','application/pdf'];

for($i=0;$i<$filecount;$i++)
{
	$file_name = $_FILES['docs']['name'][$i];
	$file_tmp_name = $_FILES['docs']['tmp_name'][$i];
	$ext = pathinfo($file_name,PATHINFO_EXTENSION);
	if(in_array($ext,$allowedExtensions))
	{
		if(in_array(getMimeType($file_tmp_name),$allowedMimes))
		{
			uploadFile($file_tmp_name,$ext,$dest_path);
		}
	}
}

function getMimeType($file_tmp_name)
{
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	return finfo_file($finfo, $file_tmp_name);
}

function uploadFile($file_tmp_name,$ext,$dest_path)
{
	$newfilename = uniqid('doc_');
	move_uploaded_file($file_tmp_name,$dest_path.$newfilename.'.'.$ext);
}

die();
?>

<?php
print_r($_FILES);
echo $ext = pathinfo($_FILES['docs']['name'],PATHINFO_EXTENSION);
//echo pathinfo($_FILES['docs']['name'],PATHINFO_FILENAME);
//echo pathinfo($_FILES['docs']['name'],PATHINFO_DIRNAME);
//echo pathinfo($_FILES['docs']['name'],PATHINFO_BASENAME);

$allowedMimes = ['image/jpeg','image/png','application/pdfs'];

//MIME Check
$file = $_FILES['docs']['tmp_name'];
//$mime_type = mime_content_type($file);

$finfo = finfo_open(FILEINFO_MIME_TYPE);
echo $mime_type = finfo_file($finfo, $file);
finfo_close($finfo);

if(!in_array($mime_type,$allowedMimes))
{
	echo 'restricted'; die();
}

if(!is_dir('uploads'))
mkdir('uploads');

$newfilename = uniqid('doc_');

if(move_uploaded_file($_FILES['docs']['tmp_name'],'uploads/'.$newfilename.'.'.$ext))
echo "<br>File Uploaded Successfuly";
?>