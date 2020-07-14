<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coverfy</title>
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
            <!-- <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
            <span class="menu-collapsed">Local-FileSystem-Explorer</span>
          </a>
          <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn btn-info my-2 my-sm-0" type="submit">Search</button>
          </form>
          
        </nav><!-- NavBar END -->


<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block ml-3 mt-4"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#exampleModal" id="btn-create">New</button>
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-200 justify-content-start align-items-center">
                    <span><i class="fas fa-folder mr-3"></i></span>
                    <span class="menu-collapsed ">Root</span>
                    <span></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action list-group-item-info text-dark">
                <span><i class="fas fa-folder mr-3"></i></span>
                    <span class="menu-collapsed">Charts</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action list-group-item-info text-dark">
                    <span class="menu-collapsed">Reports</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action list-group-item-info text-dark">
                    <span class="menu-collapsed">Tables</span>
                </a>
            </div>  
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
            <div class="col-10 ml-4 mt-4">
                    
                <table class="table table-hover table-bordered table-warning" id="table">
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


         </div><!-- Main Col END -->


    
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