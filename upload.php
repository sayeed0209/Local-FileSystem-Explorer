
<?php

// require 'script.php';
// upload folder

if(isset($_POST['submit'])){
    $file = $_FILES['files'];
    $fileName =$_FILES['files']['name'];
    $fileTmpName =$_FILES['files']['tmp_name'];
    $fileSize =$_FILES['files']['size'];
    $fileError =$_FILES['files']['error'];
    $fileType =$_FILES['files']['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowedFile = array('jpg','jpeg','png','pdf','doc','csv','txt','zip','rar','exe','svg','mp3','mp4');
    if(in_array($fileActualExt,$allowedFile)) {
        if($fileError === 0){
            if($fileSize < 40000000){
                $newName = uniqid('',true).".".$fileActualExt;
                $fileDestination = $_POST["ac_path"]. "/" . $newName;
                move_uploaded_file($fileTmpName,$fileDestination);
                echo 'file has uploaded sucessfully';
                header('Location:index.php');
            }else{
                echo 'your file is too big';
            }
        }else{
            echo 'There waas an error uploading your file!';
        }
    }else{
        echo 'You cantnot upload files of this type!';
    }


    print_r($file);
}
