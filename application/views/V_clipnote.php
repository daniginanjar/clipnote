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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <script>
      function copynote(notes){
        document.getElementById("tempcopy").value = notes;
        var tempcopy = document.getElementById("tempcopy").value;
        alert(tempcopy);
      }
    </script>

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

    <textarea name="tempcopy" class="form-control" id="tempcopy" rows="3" ></textarea>
    
    <div class="row">
      <div class="col-md-6 col-xs-6" style="background-color:;">
        <br />    
        
        <?php
        if (isset($id)){

          echo '
          <form action="'. base_url().'clipnote/update " method="POST" class="float-left">
            <h2 align="center">Update Notes</h2><br />
            <div class="form-group">
              <textarea name="tempnotes" class="form-control" id="tempnote" rows="3" style="display:none;">'.$notes.'</textarea>
            </div>

            <div class="form-group">
              <textarea name="notes" class="form-control" id="editor" rows="3"></textarea>
            </div>

            <div class="form-group">
              <input type="text" name="tags" class="form-control" id="tags" value="'.$tags.'" />
            </div>

            <div class="form-group">
              <input type="text" name="noteid" class="form-control" id="ntoeid" value="'.$id.'" readonly style="display:none;" />
            </div>

            <div class="form-group">
              <input type="text" name="updatedby" class="form-control" id="updatedby" value="'.$updated_by.'" readonly style="display:none;" />
            </div>

            <div class="form-group">
              <input type="submit" name="update" value="Update" class="btn btn-primary" id="update"/>
              <input type="reset" name="reset" value="Reset" class="btn btn-warning" id="clearform" />
            </div>
          </form>
          ';

          ?>

          <script>           

            var myEditor; 
            var notes = document.getElementById("tempnote").value;

            //notes = notes.Vals.replace(/["']/g, "");
            
            //alert('hahahah');

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
              <textarea name="notes" class="form-control" id="editor" rows="3" ></textarea>
            </div>

            <div class="form-group">
              <input type="text" name="tags" class="form-control" id="tags" placeholder="Enter any tags, separate by comma (e.g. tech, system, outlook, etc)" />
            </div>

            <div class="form-group">
              <input type="text" name="noteid" class="form-control" id="ntoeid" placeholder="note id" readonly style="display:none;" />
            </div>

            <div class="form-group">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary" id="submit"/>
              <input type="reset" name="reset" value="Reset" class="btn btn-warning" id="clearform" />
            </div>
          </form>
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
$(document).ready(function(){

  load_data();

  function load_data(query)
  {
    $.ajax({
      url:"<?php echo base_url(); ?>clipnote/fetch",
      method:"POST",
      data:{query:query},
      success:function(data){
        $('#result').html(data);
      }
    });
  };

  $('form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      type:$(this).attr('method'),
      url:$(this).attr('action'),
      data:$(this).serialize(),
      success:function(){
        document.getElementById("saveresult").innerHTML = "Data Saved Successfuly";    
        load_data();
      }
    })
  });

  $('#refresh').click(function(){
    load_data();
    document.getElementById("search_text").value = '';
    document.getElementById("search_text").focus();
  });

  $('#deletenote').click(function(){
    alert("Delete?");
    var href = $(this).attr("href")
    var btn = this;

    $.ajax({
      type: "GET",
      url: href,
      success: function() {
        document.getElementById("saveresult").innerHTML = "Data Deleted Successfuly";    
        load_data();
      }
    });
    
  });

  $("#clearform").click(function(){
    document.getElementById('tags').value = '';
    myEditor.setData( '' );
    document.getElementById("submit").value = "Submit";
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
