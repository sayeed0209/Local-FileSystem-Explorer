$(document).ready(function() {

  loadFolders()
  
  function loadFolders () {
    const action = "load"
    var old_name = $("#old_name").val()

    $.ajax({
      url: "script.php",
      method: "POST",
      data: {action:action,
      old_name:old_name},
      success: function(data) {
        $('#table').append(data)
      }
    })
  }
  $(document).on('click','#update',function(e){
    let folderName = $(this).data('name');
    // console.log(folderName)
    $('#old_name').val(folderName);
    $('#name_input').val(folderName);
    $('#action').val('change')
    $('#create_file').val('Update')
    $("#change_title").text('Change Folder Name')
    $('#exampleModal').modal('show')
  })
})

