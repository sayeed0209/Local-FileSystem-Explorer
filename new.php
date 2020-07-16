<?php

if (isset($_POST["action"])) {
  if ($_POST["action"] === "create") {
          echo $_POST["path"] . "/" . $_POST["name"];
           mkdir($_POST["path"] . "/" . $_POST["name"]); 
      }
    }


    if ($_POST["action"] === 'change') {
      if (!file_exists($_POST["newName"])) {
        rename($_POST["path"] . "/" .  $_POST["oldName"], $_POST["path"] . "/" .  $_POST["newName"]);
        echo "Folder name changed";
      } else {
        echo 'folder already created';
      }
    }

    

    if ($_POST['action'] === "delete") {
      if (is_dir($_POST["path"] . "/" . $_POST["name"])) {
  
        rmdir($_POST["path"] . "/" . $_POST["name"]);
        echo 'Folder deleted';
      }
    }