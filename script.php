<?php

if (isset($_POST["action"])) {

  if ($_POST["action"] === "load") {
    $path = 'root/';
    $folders = new DirectoryIterator($path);
    foreach ($folders as $folder) {
      if ($folder->isDot()) continue;
      $type = $folder->getType();
      $name = $folder->getFilename();
      $size = $folder->getSize();
      $modified = date("F d Y H:i:s.", ($folder->getATime()));

      if ($folder->isDir()) {
        echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><a href=''>$name</a></th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>$modified</th>
            <td><button type='button' class='btn btn-warning' data-name='$name' id='update'>Update</button></td>
            <td><button type='button' class='delete_file btn btn-danger' id='$name' >Delete</button></td>
        </tr>";
      } else {
        echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><a href=''>$name</a></th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>$modified</th>
            <td><button type='button' class='btn btn-warning' data-name='$name' id='update'>Update</button></td>
            <td><button type='button' class='delete_file btn btn-danger' id=$name'>Delete</button></td>
            </tr>";
      }
    }
  }
}

if (isset($_POST["submit"])) {
  if ($_POST["folder"]) {
    $path = "root/";
    mkdir($path . $_POST["folder"]);
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
  if(is_dir($path.$_POST["path"])) {
    $path = "root/";
    rmdir($path.$_POST['path']);
    echo 'file deleted';
  }
}



if($_POST['action']=='showfolder'){
    $dir = array_filter(scandir($_POST['actualPath']),function($item){
      return is_dir($_POST['actualPath'].$item);
      
    });
    
  $dir = array_diff($dir,array('.','..'));
  $dir=array_values($dir);
  
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
