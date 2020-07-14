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
        // console.log(data);
        $('#table').append(data)

        console.log(data)

        let links = $(".link")
        console.log(links)
 
          links.on("click", function() {
            
            let fname = $(this).attr("id")
            let action = "folders"
      
            console.log(fname);
      
            $.ajax({
              url: "script.php",
              method: "POST",
              data: {action:action,
              fname:fname},
              success: function(data) {
                // console.log(data);
                $('#table').empty()
                $('#table').append(`<thead class="table-info">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Size</th>
                <th scope="col">Modified</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>`)
                $('#table').append(data)
              }
            })
          })
        

      }
    })

      // new way to do event listener
    $(document).on('click','#update',function(e){
      let folderName = $(this).data('name');
      console.log(folderName)
      $('#old_name').val(folderName);
      $('#name_input').val(folderName);
      $('#action').val('change')
      $('#rename').val('update')
      $("#change_title").text('Change Folder Name')
      $('#exampleModal').modal('show')
  })

}


})

