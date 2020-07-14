<?php 

  if(isset($_POST["action"])) {
    
    if($_POST["action"] === "load") {
      
      $path = 'root/';

      $folders = new DirectoryIterator($path);

      foreach($folders as $folder) {
        if($folder->isDot()) continue;
        $type = $folder->getType();
        $name = $folder->getFilename();
        $size = $folder->getSize();
        $modified = date ("F d Y H:i:s.", ($folder->getATime()));

        if ($folder->isDir()) {
          echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><a href='root/$name'>$name</a></th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>$modified</th>
            <td><button type='button' class='btn btn-warning'>Update</button></td>
            <td><button type='button' class='btn btn-danger'>Delete</button></td>
        </tr>";
        } else {
          echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><a href=''>$name</a></th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>$modified</th>
            <td><button type='button' class='btn btn-warning'>Update</button></td>
            <td><button type='button' class='btn btn-danger'>Delete</button></td>
            </tr>";
        }

      }

    }
  }

  if(isset($_POST["submit"])) {
    if($_POST["folder"]) {
      $path = 'root/';
      mkdir($path.$_POST["folder"]);
      header("Location: index.php");
    }
  }
