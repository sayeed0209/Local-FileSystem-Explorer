$(document).ready(function() {

  loadFolders()
  
  function loadFolders () {
    const action = "load"

    $.ajax({
      url: "script.php",
      method: "POST",
      data: {action:action},
      success: function(data) {
        console.log(data);
        $('#table').append(data)
      }
    })
  } 
})

