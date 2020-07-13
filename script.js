$(document).ready(function() {

  loadFolders()
  
  function loadFolders () {
    const action = "load"

    $.ajax({
      url: "script.php",
      method: "POST",
      data: {action:action},
      success: function(data) {
        $('#table').append(data)
      }
    })
  } 
})

// event listeners for create folder 
$('#save_file').click(function(e){
      const createEl = "create";
      const name =$('#name-input').val();
      $.ajax({
        url:"script.php",
        method:"post",
        data:{createEl:createEl,
                name:name},
        success:function(data){
          $('#table').append(data)
    }
  })

})