$(document).ready(function () {

  loadFolders('root/');

  function loadFolders(path) {
    var action = 'load';
    var old_name = $('#old_name').val();


    $.ajax({
      url: 'script.php',
      method: 'POST',
      data: { action: action, currentPath: path, old_name: old_name },
      success: function (data) {
        
        $(".path_info").empty()
        
        $("#table_container").prepend(`<div class="path_info" id="path">${path}</div>`)

        let actualPath = $('#path').text();
        console.log(actualPath)
        
        let elements = JSON.parse(data)
        console.log(elements)
        for(let element of elements) {

          if(element.type === "dir") {
            $('#table').append(`
              <tr>
              <th scope='col'><img src='https://image.freepik.com/free-vector/illustration-data-folder-icon_53876-6329.jpg' width='30' height='30'><div class="folder_link" id="f_${element.name}">${element.name}</div></th>
                <th scope='col'>${element.size}</th>
                <th scope='col'>${element.date}</th>
                <td><button type='button' class='btn btn-warning' data-name='$name' id='update'>Update</button></td>
                <td><button type='button' class='delete_file btn btn-danger' id=$name'>Delete</button></td>
              </tr>
          `)
            
          } else if (element.type === "file") {
            $('#table').append(`
              <tr>
                <th scope='col'>${element.name}</th>
                <th scope='col'>${element.size}</th>
                <th scope='col'>${element.date}</th>
                <td><button type='button' class='btn btn-warning' data-name='$name' id='update'>Update</button></td>
                <td><button type='button' class='delete_file btn btn-danger' id=$name'>Delete</button></td>
              </tr>
        `)
          }

          $(`#f_${element.name}`).on("click", function() {
            
            $('#table').empty()
            loadFolders(`${element.path}/${element.name}`)
          })
         
        }
      },
    });

    $(document).on('click', '#update', function (e) {
      let folderName = $(this).data('name');
      console.log(folderName);
      $('#old_name').val(folderName);
      $('#name_input').val(folderName);
      $('#action').val('change');
      $('#rename').val('update');
      $('#change_title').text('Change Folder Name');
      $('#exampleModal').modal('show');
    });
  }
});
$(document).on('click', '.delete_file', function (e) {
  console.log(e.target);
  let path = $(this).attr('id');
  console.log(path);
  let action = 'delete_file';
  console.log(action);
  if (confirm('are you sure you want delete the file?')) {
    $.ajax({
      url: 'script.php',
      method: 'POST',
      data: { path: path, action: action },
      success: function (data) {
        alert(data);

        console.log(data);
      },
    });
  }
});

var actualPath = 'root/';
$('#root').data('path','root/').click(function () {
  var clickedFolder = event.target;
  getFolders(clickedFolder);
});

$('#rootIcon').data('path','root/')


function getFolders(clickedFolder) {
  actualPath = $(clickedFolder).data('path');
  $.ajax({
    url: 'script.php',
    method: 'POST',
    data: { actualPath: actualPath, action: 'showfolder' },
    success: function (data) {
      var dirs = JSON.parse(data);
      // console.log(dirs);
      // alert(data)
      $(clickedFolder).find('ul').remove();
      $(clickedFolder).append('<ul>');
      for (let i = 0; i < dirs.length; i++) {
        // console.log(dirs[i]);
        var icon= $('<i class="fas fa-folder"></i>').data('path', actualPath + dirs[i] + '/')
        var folder = $('<li id="root" >' + dirs[i] + '</li>'
        ).data('path', actualPath + dirs[i] + '/');
        $(folder).append(icon)
        $(clickedFolder).find('ul').append(folder);
      }
    },
  });
}
