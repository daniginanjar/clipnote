<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Clipnote App</title>
    <!-- Add Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Add Bootstrap -->    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />    
    
    <!-- Add CKEditor -->    
    <script src="<?php echo base_url(); ?>assets/ckeditor5-build-classic/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>assets/ckfinder/ckfinder.js"></script>
  </head>
  <body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Clipnote</a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Password Change</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="container"> 
    <br />
    <br />
    <br />

    <textarea name="tempcopy" class="form-control" id="tempcopy" rows="3" style="display:none"></textarea>
    
    <div class="row">
      <div class="col-md-6 col-xs-6" style="background-color:;">
        <br />    
        
        <?php
        if (isset($id)){

          echo '
          <form action="'. base_url().'clipnote/update " method="POST" class="float-left">
            <h2 align="center">Update Notes</h2><br />
            <div class="form-group">
              <textarea name="tempnote" class="form-control" id="tempnote" rows="3" style="display:none">'.$notes.'</textarea>
            </div>

            <div class="form-group">
              <textarea name="notes" class="form-control" id="editor" rows="3"></textarea>
            </div>

            <div class="form-group">
              <input type="text" name="tags" class="form-control" id="tags" value="'.$tags.'" />
            </div>

            <div class="form-group">
              <input type="text" name="noteid" class="form-control" id="noteid" value="'.$id.'" readonly style="display:none" />
            </div>

            <div class="form-group">
              <input type="text" name="updatedby" class="form-control" id="updatedby" value="'.$updated_by.'" readonly style="display:none" />
            </div>

            <div class="form-group">
              <!-- <input type="submit" name="update" value="Update" class="btn btn-primary" id="update"/> -->
              <!-- <input type="reset" name="reset" value="Reset" class="btn btn-warning" id="clearform" /> -->              
            </div>
          </form>

          
          <button name="update" class="btn btn-primary" id="update" onclick="updatenote()">Update Note</button>
          <button name="clearform" class="btn btn-warning" id="clearform" onclick="clearformupdate()">Clear Form</button>
          
          ';

          ?>

          <script>   

            var myEditor; 
            var notes = document.getElementById("tempnote").value; 

            ClassicEditor
              .create( document.querySelector('#editor'),{                     
                placeholder: 'Enter any notes here'
              })
              .then( editor => {
                console.log('Editor was initialized', editor );
                myEditor = editor; 
                myEditor.setData(notes);
                                          
              })
              .catch( err => {
                console.error(err.stack);
            });                    
            
          </script>

          <?php

        } else {

          echo '
          <form action="'. base_url().'clipnote/save " method="POST" class="float-left">
            <h2 align="center">Create New Notes</h2><br />
            <div class="form-group">
              <textarea name="tempnote" class="form-control" id="tempnote" rows="3" style="display:none"></textarea>
            </div>

            <div class="form-group">
              <textarea name="notes" class="form-control" id="editor" rows="3" ></textarea>
            </div>

            <div class="form-group">
              <input type="text" name="tags" class="form-control" id="tags" placeholder="Enter any tags, separate by comma (e.g. tech, system, outlook, etc)" />
            </div>          

            <div class="form-group">
              <!-- <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="submit"/> -->
              <!-- <input type="reset" name="reset" value="Reset" class="btn btn-warning" id="clearform" /> -->              
            </div>
          </form>

          
          <button name="savenote" class="btn btn-primary" id="savenote" onclick="savenote()">Save Note</button>
          <button name="clearform" class="btn btn-warning" id="clearform" onclick="clearformsave()">Clear Form</button>

          ';

          ?>

        <script>
            var myEditor;                    

            ClassicEditor
              .create( document.querySelector('#editor'),{                                          
                placeholder: 'Enter any notes here'
              })
              .then( editor => {
                console.log('Editor was initialized', editor );
                myEditor = editor;                            
              })
              .catch( err => {
                console.error(err.stack);
            });            
        </script>

          <?php

        }
        ?>
        
        <br />
   
        <h5 id="saveresult"></h5> 
      </div>

      <div id="notegrid" class="col-md-6 col-xs-6" style="">
        <br />
        <h2 align="center">Search Any Notes</h2><br />
        <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">Search</span>
          <input type="text" name="search_text" id="search_text" placeholder="Enter Any Keywords" class="form-control" />     
        </div>
        </div>
        <br />

        <button type="button" class="btn btn-default btn-sm" name="refresh" id="refresh" onclick="refresh()">
          <span class="glyphicon glyphicon-refresh"></span> Refresh
        </button>

        <br />
        <br />
  
        <div id="result" class="overflow-auto" style="height: 550px; overflow-y: scroll;"></div>
        <script>
          function editnote()  {

            document.getElementById('tags').value = '';
            myEditor.setData( '' );
            document.getElementById("submit").value = "Submit";

          }
        </script>
      </div>
    </div>
  
  </div>
  <div style="clear:both"></div>
  <br />

 </body>
</html>

<script>

function savenote(){
  document.getElementById("tempnote").value = myEditor.getData();
  var notes = document.getElementById("tempnote").value;
  var tags = document.getElementById("tags").value;

  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/save",
    method:"POST",
    data:{
      notes:notes,
      tags:tags
    },
    success:function(){
      document.getElementById("saveresult").innerHTML = "Data Saved Successfuly";    

      window.setTimeout(function() {
        $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);
      
      load_data();
    }
  })
}

function updatenote(){
  document.getElementById("tempnote").value = myEditor.getData();
  var notes = document.getElementById("tempnote").value;
  var tags = document.getElementById("tags").value;
  var noteid = document.getElementById("noteid").value;
  var updatedby = document.getElementById("updatedby").value;  
  var updatedtime = "<?php echo date("Y-M-d h:m:s"); ?>"  

  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/update",
    method:"POST",
    data:{
      notes:notes,
      tags:tags,
      noteid:noteid,
      updatedby:updatedby,
      updatedtime:updatedtime      
    },
    success:function(){
      document.getElementById("saveresult").innerHTML = "Note Updated Successfuly";    

      window.setTimeout(function() {
        $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);
      
      load_data();
    }
  })
}

function load_data(query){
  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/fetch",
    method:"POST",
    data:{query:query},
    success:function(data){
      $('#result').html(data);
    }
  });
};

function copynote(id){
  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/copynote",
    method:"POST",
    data:{id:id},
    success:function(response){
      $("#tempcopy").html(response);            

      var copyText = document.getElementById("tempcopy");

      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices

      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
  
      document.getElementById("saveresult").innerHTML = "Note copied to Clipboard";

      window.setTimeout(function() {
        $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);
      
    }
  });
}

function deletenote(id){
  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/delete",
    method:"POST",
    data:{id:id},
    success:function(){
      document.getElementById("saveresult").innerHTML = "Note Deleted Successfuly"; 

      window.setTimeout(function() {
        $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);

      window.location.replace("<?php echo base_url(); ?>");
    }
  });

}

function clearformsave(){
  myEditor.setData("");
  document.getElementById('tags').value = '';
  document.getElementById('tempnote').value = '';
  myEditor.editing.view.focus();  
}

function clearformupdate(){
  myEditor.setData("");
  document.getElementById('tags').value = '';
  document.getElementById('tempnote').value = '';
  document.getElementById("noteid").readOnly = false;
  document.getElementById("updatedby").readOnly = false;
  document.getElementById('noteid').value = '';
  document.getElementById('updatedby').value = '';
  // document.getElementById("noteid").readOnly = true;
  // document.getElementById("updatedby").readOnly = true;  
  document.getElementById('noteid').setAttribute('readonly', true);
  myEditor.editing.view.focus(); 
}

$(document).ready(function(){

  load_data();

  

  

  $('form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      type:$(this).attr('method'),
      url:$(this).attr('action'),
      data:$(this).serialize(),
      success:function(){
        document.getElementById("saveresult").innerHTML = "Data Saved Successfuly";    

        window.setTimeout(function() {
          $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
          });
        }, 5000);
        
        load_data();
      }
    })
  });

  $('#refresh').click(function(){
    load_data();
    document.getElementById("search_text").value = '';
    document.getElementById("search_text").focus();
  });  

  $('#search_text').keyup(function(){
    var search = $(this).val();
    if(search != ''){
      load_data(search);
    } else {
      load_data();
    }
  });

});
</script>
