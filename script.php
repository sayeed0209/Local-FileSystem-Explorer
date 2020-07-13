<?php 

  if(isset($_POST["action"])){
    
    if($_POST["action" ]== "load") {
      $structure = glob('*');
      $folders = array_filter($structure, 'is_dir');

      foreach ($folders as $folder) {
        
      }
    }
  }