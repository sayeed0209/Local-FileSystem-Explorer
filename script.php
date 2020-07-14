<?php

if (isset($_POST["action"])) {

  if ($_POST["action"] === "load") {

    $path = 'root/';

    $folders = new DirectoryIterator($path);

    foreach ($folders as $folder) {
      if ($folder->isDot()) continue;
      $type = $folder->getType();
      $name = $folder->getFilename();
      var_dump($name);
      $size = $folder->getSize();
      $modified = date("F d Y H:i:s.", ($folder->getATime()));

      if ($folder->isDir()) {
        echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><a href=''>$name</a></th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>$modified</th>
            <td><button type='button' class='btn btn-warning' data-name='$name' id='update'>Update</button></td>
            <td><button type='button' class='btn btn-danger'>Delete</button></td>
        </tr>";
      } else {
        echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><a href=''>$name</a></th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>$modified</th>
            <td><button type='button' class='btn btn-warning' data-name='$name' id='update'>Update</button></td>
            <td><button type='button' class='btn btn-danger'>Delete</button></td>
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
    rename($_POST["old_name"],$_POST["folder"]);
    echo "Folder name changed";
  } else {
    echo 'folder already created';
    header("Location: index.php");
  }
}
