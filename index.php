<?php
include 'upload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coverfy</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/c5a42aa6b7.js" crossorigin="anonymous"></script>

</head>

<body>
  <div class="container mt-3">
    <!-- Bootstrap NavBar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <i class="fas fa-book-open" id="logo"></i>
        <button type="button" class="btn btn btn-info my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal" id="btn-create">New<i class="fas fa-plus-circle" id="plus"></i></button>
        <span class="menu-collapsed">Local-FileSystem-Explorer</span>
      </a>

      <form action="upload.php" class="upload" method="POST" enctype="multipart/form-data">
      <label> Upload File <i class="fas fa-file-download"></i>
          <input type="file" name="file" >
        </label>
        <input type="submit" class="btn btn btn-info my-2 my-sm-0" value="Upload" name="upload">
      </form>

      <form class="form-inline">
        <input class="form-control mr-sm-2 ml-5" type="search" placeholder="Search" aria-label="Search">
        <input class="btn btn btn-info my-2 my-sm-0" type="submit">Search</input>

      </form>

    </nav><!-- NavBar END -->


    <!-- Bootstrap row -->
    <div class="row" id="body-row">
      <!-- Sidebar -->
      <div class="col mt-4 ml-4 bg-light text-dark shadow-lg p-3 mb-5 rounded  ">
        <div class="row">
          <ul id="list-of-folders">
            <li id="root"><i class="fas fa-folder" id="rootIcon"></i>root</li>
          </ul>

        </div>

      </div>

      <!-- MAIN -->
      <div class="col-9 mt-4" id="table_container">

        <table class="table table-hover table-bordered table-warning shadow-lg p-3 mb-5 rounded" id="table">
          <thead class="table-info">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Size</th>
              <th scope="col">Modified</th>
              <th scope="col">Update</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td><button type="button" class="btn btn-warning" id="update" data-name="folder">Update</button></td>
              <td><button type="button" class="btn btn-danger" id='delete'>Delete</button></td>

            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td><button type="button" class="btn btn-warning" id="update">Update</button></td>
              <td><button type="button" class="btn btn-danger" id='delete'>Delete</button></td>
            </tr>
          </tbody>
        </table>


        </><!-- Main Col END -->



      </div><!-- body-row END -->

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="script.php" method="POST">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="change_title"> Create new folder</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <p>Enter the file name</p>
                <input type="text" id="name_input" name="folder">
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="old_name" id="old_name">
                <button type="submit" class="btn btn-primary" id="rename">Rename</button>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary" id="create_file">Create folder</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>

</html>