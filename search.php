<?php

if (isset($_POST["action"])) {
  if ($_POST["action"] === "search") {
    $input = $_POST["input"]; 
    
    $searchResults = array();
    $origin = 'root/';

    function searchContent (&$searchResults, $path) {

      $elements = new DirectoryIterator($path);

      foreach($elements as $elem) {
        if($elem->isDot()) continue;

        $n_path = $path . "/" . $elem->getFilename();

        if(strpos($elem->getFilename(), $_POST["input"]) !== false) {

            $found = new stdClass();
  
            $found->name = $elem->getFilename();
            $found->path = $elem->getPath();
            $found->type = $elem->getType();

            array_push($searchResults, $found);
            
          }
          if($elem->isDir()) searchContent ($searchResults, $n_path);
      }

    }


    searchContent($searchResults, $origin);
    echo json_encode($searchResults);
  }
}