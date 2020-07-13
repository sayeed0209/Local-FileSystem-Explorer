$(document).ready(function() {
  
  function loadFolders () {
    const action = "load";

    $.ajax({
      url: "script.php",
      method: "POST",
      data: {action:action},
      success: function(data) {
        $('#table').html(data)
      }
    })
  } 
})

// event listeners for create folder 
$('#btn-create').click(function(e){

function createItems () {
  const createEl = "create";
  $.ajax({
    url:"script.php",
    method:"post",
    data:{createEl:createEl},
    success:function(data){
      $('#table').append(data)
    }
  })

}


})