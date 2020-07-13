<?php 

  if(isset($_POST["action"])) {
    
    if($_POST["action"] === "load") {
      $structure = glob('*');
      $folders = array_filter($structure, 'is_dir');
      $files = array_filter($structure, 'is_file');

      foreach ($folders as $folder) {
        $size = filesize($folder);
        echo "<tr>
            <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'>$folder</th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>Modified</th>
        </tr>";
      };

      foreach ($files as $file) {

        $size = filesize($file);

        echo "<tr>
            <th scope='col'><img src='https://cdn3.iconfinder.com/data/icons/brands-applications/512/File-512.png' width='20' height='20'>$file</th>
            <th scope='col'>$size bytes</th>
            <th scope='col'>Modified</th>
        </tr>";
      }
    }
  }

  if(isset($_POST["createEl"])){
        if($_POST["createEl"]==="create"){
            mkdir('root');
        }
  }