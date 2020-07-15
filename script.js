$(document).ready(function () {

  loadFolders('root/');

  function loadFolders(path) {
    var action = 'load';
    var old_name = $('#old_name').val();

    $.ajax({
      url: 'script.php',
      method: 'POST',
      data: { action: action, currentPath: path, old_name: old_name},
      success: function (data) {
        console.log(data)
        $(".path_info").remove()
        
        $("#table_container").prepend(`<div class="path_info" id="path">${path}</div>`)
       
        

        let actualPath = $('#path').text();
        console.log(actualPath)
        
        let elements = JSON.parse(data)
        
        let folders = []
        let files = []

        for (let element of elements) {
          if (element.type === "dir") {
            folders.push(element)
          } else {
            files.push(element)
          }
        }
        for(let folder of folders) {  
          
            let size = sizing(folder);

            $('#table').append(`
              <tr>
              <td scope='col'><p class="folder_link" id="f_${folder.name}"><img src='https://image.flaticon.com/icons/svg/861/861319.svg' width='30' height='30' class="icons">${folder.name}</p></td>
                <td scope='col'>${size}</td>
                <td scope='col'>${folder.date}</td>
                <td scope='col'>${folder.modified}</td>
                <td><button type='button' class='btn btn-warning' data-name='${folder.name}' id='update'>Update</button></td>
                <td><button type='button' class='delete_file btn btn-danger' id=${folder.name}>Delete</button></td>
              </tr>
          `)

          $(`#f_${folder.name}`).on("click", function() {
            
            $('#table').empty()
            $("#back").remove()
            loadFolders(`${folder.path}/${folder.name}`)
            addButton()
            
          })
            
          }
          
           for (let file of files) {

            let size = sizing(file);
            let icon_src = getIcon(file.ext)
            $('#table').append(`
              <tr>
                <td scope='col'><p ><img src='${icon_src}' width='30' height='30' class="icons">${file.name}</p></td>
                <td scope='col'>${size}</td>
                <td scope='col'>${file.date}</td>
                <td scope='col'>${file.modified}</td>
                <td></td>
                <td></td>
              </tr>
        `)
          }     
      }
    })
  }

  $("#create_file").on("click", function () {
    let path = $('#path').text();
    let action = "create";
    let name = $('#name_input').val();

    $.ajax({
      url: 'new.php',
      method: 'POST',
      data: { path: path, action:action, name:name },
      success: function (data) {
       console.log(data)
       location.replace("index.php")
      },
    });
  })

  $("#create_file").on("click", function () {
    let path = $('#path').text();
    let action = "create";
    let name = $('#name_input').val();

    $.ajax({
      url: 'new.php',
      method: 'POST',
      data: { path: path, action:action, name:name },
      success: function (data) {
       console.log(data)
       location.replace("index.php")
      },
    });
  })


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

  $("#rename").on("click", function () {
    let oldName = $("#old_name").attr("value")
    let newName = $("#name_input").val()
    let path = $('#path').text()
    let action = "change"

    $.ajax({
      url: 'new.php',
      method: 'POST',
      data: { path: path, action:action, newName:newName, oldName: oldName},
      success: function (data) {
        location.replace("index.php")
       
      },
    });

  })

  $(document).on('click', '.delete_file', function (e) {
    let name = $(this).attr('id');
    let action = 'delete';
    let path = $('#path').text();

    if (confirm('are you sure you want delete the file?')) {
      $.ajax({
        url: 'new.php',
        method: 'POST',
        data: { path: path, action: action, name:name },
        success: function (data) {
          alert(data);
          location.replace("index.php");
  
        },
      });
    }
  });


  $("#search").on("click", function(e) {
    e.preventDefault()
    
    var input = $("#search_field").val()
    var action = "search"
    
    $.ajax({
  
      url: 'search.php',
      method: 'POST',
      data: { action: action, input:input},
      success: function (data) {
        $("#table_container").empty()
        $("#table_container").append('<div class="d-flex" id="search_results"></div>')
        let results = JSON.parse(data)
        for (let result of results) {
          if (result.type == "dir") {
            $("#search_results").append(
             `
              <div class="result" id="s_${result.name}">
              <img src="https://image.flaticon.com/icons/svg/861/861319.svg" height="40" width="40"><p>${result.name}</p>
              </div>        
              `
            )
  
            $(`#s_${result.name}`).on("click", function() {
              $("#table_container").empty()
              $("#table_container").append(tableBase)
              loadFolders(`${result.path}/${result.name}`)
              addButton()
            })
          } else {
            $("#table_container").append('<div class="d-flex" id="search_results_files"></div>')
            $("#search_results_files").append(
              `
              <div class="result" id="f_${result.name.slice(0,-4)}">
              <img src="https://image.flaticon.com/icons/svg/779/779550.svg" height="40" width="40"><p>${result.name}</p>
              </div>        
              `
            )
            $(`#f_${result.name.slice(0,-4)}`).on("click", function() {
              $("#table_container").empty()
              $("#table_container").append(tableBase)
              loadFolders(`${result.path}/`)
              addButton()
            })

          }
        }
      }
  
    })
  })
  
  
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


function addButton() {
  $("#table_container").prepend(`<button id="back">Back</button>`)

            $("#back").on("click", function () {
              $('#table').empty()
              let path = $("#path").text()
              let arrayPath = path.split("/")
              console.log(arrayPath)
              arrayPath.pop()
              console.log(arrayPath)

              if(arrayPath.length < 2) {
                path = "root/"
              } else {
                path = arrayPath.join("/")
              }
              console.log(path)

              loadFolders(path)
            
            })
}

const tableBase = `<table class="table shadow-lg p-3 mb-5 rounded" id="table">
                      <thead class="table-info">
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Size</th>
                          <th scope="col">Created</th>
                          <th scope="col">Modified</th>
                          <th scope="col">Update</th>
                          <th scope="col">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                      </table>`



  function sizing (element) {
    let size = "";

            if(element.size < 1000) {
              size = `${element.size} bytes`
            } else if (element.size < 1000000) {
              size = `${Math.round(element.size / 1000)} KB`
            } else {
              size = `${Math.round(element.size / 1000000)} MB`
            }

      return size;
  }

  function getIcon(ext) {
    let link = "";

    switch (ext) {
      case "doc" : link = "https://image.flaticon.com/icons/svg/3175/3175581.svg"; break;
      case "csv" : link = "https://image.flaticon.com/icons/svg/617/617555.svg"; break;
      case "jpg" : link = "https://image.flaticon.com/icons/svg/864/864115.svg"; break;
      case "jpg" : link = "https://image.flaticon.com/icons/svg/864/864115.svg"; break;
      case "png" : link = "https://image.flaticon.com/icons/svg/1979/1979210.svg"; break;
      case "txt" : link = "https://image.flaticon.com/icons/svg/864/864126.svg"; break;
      case "ppt" : link = "https://image.flaticon.com/icons/svg/617/617582.svg"; break;
      case "odt" : link = "https://image.flaticon.com/icons/svg/180/180912.svg"; break;
      case "pdf" : link = "https://image.flaticon.com/icons/svg/685/685192.svg"; break;
      case "zip" : link = "https://image.flaticon.com/icons/svg/2911/2911235.svg"; break;
      case "rar" : link = "https://image.flaticon.com/icons/svg/2911/2911225.svg"; break;
      case "exe" : link = "https://image.flaticon.com/icons/svg/617/617560.svg"; break;
      case "svg" : link = "https://image.flaticon.com/icons/svg/617/617590.svg"; break;
      case "mp3" : link = "https://image.flaticon.com/icons/svg/2425/2425367.svg"; break;
      case "mp4" : link = "https://image.flaticon.com/icons/svg/499/499465.svg"; break;
      default: link = "https://image.flaticon.com/icons/svg/546/546391.svg";
      
    }

    return link;
  }

});

