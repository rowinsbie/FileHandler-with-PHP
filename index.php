<?php
include "lib/FileHandler.php";
$file = new FileHandler();
if(isset($_POST['up']))
{
	$file->selectFile("test");
	$file->setDirectory("/");
	$file->set_allowed_ext(array(
			"jpg"
	));
	$file->Validate_extension();

	if($file->isFileAllowed())
	{
		$file->Upload();
	}


}
?>


<!DOCTYPE html>
<html>
<head>
	<title>File Handler</title>
</head>
<body>
<form method="POST" action="index.php" enctype="multipart/form-data">
	<input type="file" name="test">
	<input type="submit" value="Upload" name="up">
</form>
<span><?php echo $file->get_error("file_err"); ?></span>
</body>
</html>
