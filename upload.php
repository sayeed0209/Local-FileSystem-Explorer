
<?php

// require 'script.php';
// upload folder
if (isset($_POST['upload'])) {

    $file = $_FILES['file'];
    print_r($file);
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_tmp_location = $_FILES['file']['tmp_name'];
    $file_error = $_FILES['file']['error'];
    $file_size = $_FILES['file']['size'];
    

}
