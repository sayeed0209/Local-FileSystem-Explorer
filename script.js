$(document).ready(function() {
  
  function loadFolders () {
    const action = "load";

    $.ajax({
      url: "script.php",
      method: "POST",
      data: {action:action},
      success: function(data) {
        $('#').html(data)
      }
    })
  } 
})