<?php
	include'../class/db.php';
	include'../class/controller.php';
	include'../class/view.php';
	include'../class/auth.php';

    if(isset($_POST['submit'])){
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf','docx');
        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 500000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "../Storage/Disbursement/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo $fileNameNew." Upload Success";
                }else{
                    echo "Filesize is too big, Upload failed.";
                }
            }else{
                echo "Error uploading file!";
            }
        }else{
            echo "You cannot upload files of this type.";
        }
    }

?>
<form action="fileupload.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" name="submit">
</form>