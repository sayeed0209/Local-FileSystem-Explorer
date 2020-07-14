$(document).ready(function () {
  loadFolders();

  function loadFolders() {
    const action = 'load';
    var old_name = $('#old_name').val();

    $.ajax({
      url: 'script.php',
      method: 'POST',
      data: { action: action, old_name: old_name },
      success: function (data) {
        // console.log(data);
        $('#table').append(data);
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
