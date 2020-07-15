<?php

function loadContent($path) {

  $folderArray = array();


  $folders = new DirectoryIterator($path);

  foreach ($folders as $folder) {
    if ($folder->isDot()) continue;

    $folderObject = new stdClass();

    $folderObject->name = $folder->getFilename();
    $folderObject->type = $folder->getType();
    $folderObject->size = $folder->getSize();
    $folderObject->path = $folder->getPath();
    $folderObject->date = date("F d Y H:i:s.", ($folder->getATime()));

    array_push($folderArray, $folderObject);

  }

  $encodedArray =json_encode($folderArray);
  echo $encodedArray;

}

if (isset($_POST["action"])) {
  if ($_POST["action"] === "load") {
    loadContent($_POST["currentPath"]);   
  }
}

/* if (isset($_POST["submit"])) {
  if ($_POST["folder"]) {
    $path = $_POST["rt"];
    mkdir($path . "/" . $_POST["folder"]);    
    header("Location: index.php");
  }
}

if ($_POST["action"] === 'change') {
  if (!file_exists($_POST["folder"])) {
    $path = 'root/';
    rename($path . $_POST["old_name"], $path . $_POST["folder"]);
    echo "Folder name changed";
    header("Location: index.php");
  } else {
    echo 'folder already created';
  }
}

// remove folder
if ($_POST['action'] == "delete_file") {
  $path = "root/";
  if (is_dir($path . $_POST["path"])) {
    $path = "root/";
    rmdir($path . $_POST['path']);
    echo 'file deleted';
  }
}

// remove file
/*if ($_POST['action'] == "delete_file") {
  if (file_exists($_POST["path"])) {
    $path = "root/";
  
    // unlink($_POST['path'].$path);
 rmdir($path.$_POST['path']);
    echo 'file deleted';
  }
}*/


if ($_POST["action"] === 'folders') {


    $fpath = "root/" . $_POST["fname"];
    
    loadContent($fpath);

  }


if ($_POST['action'] == 'showfolder') {
  $dir = array_filter(scandir($_POST['actualPath']), function ($item) {
    return is_dir($_POST['actualPath'] . $item);
  });

  $dir = array_diff($dir, array('.', '..'));
  $dir = array_values($dir);

  echo json_encode($dir);
}




// // remove file
// if ($_POST['action'] == "delete_file") {
//   if (file_exists($_POST["path"])) {
//     $path = "root/";
  
//     // unlink($_POST['path'].$path);
//  rmdir($path.$_POST['path']);
//     echo 'file deleted';
//   }
// }
