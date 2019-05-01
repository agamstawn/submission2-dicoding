<?php
if(isset($_POST['btn-upload']))
{
	$img = rand(1000,100000)."-".$_FILES['img']['name'];
	$img_loc = $_FILES['img']['tmp_name'];
	$folder="uploads/";
	if(move_uploaded_file($img_loc,$folder.$img))
	{
		echo "<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%3Ealert('Upload%20Sukses!!!')%3B%3C%2Fscript%3E" data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="<script>" title="<script>" />";
	}
	else
	{
		echo "<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%3Ealert('Upload%20Gagal')%3B%3C%2Fscript%3E" data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="<script>" title="<script>" />";
	} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload file dengan PHP</title>
</head>
<body>
<br />
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="img" />
	<button type="submit" name="btn-upload">upload</button>
</form>
<p>
</body>
</html>
