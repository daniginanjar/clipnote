<html>
  <?php $this->load->view('_partials/head.php') ?>
  <body>

  <?php $this->load->view('_partials/navbar.php') ?>

  

  <div class="container"> 
    <br />
    <br />
    <br />

    <textarea name="tempcopy" class="form-control" id="tempcopy" rows="3" style="display:none"></textarea>
    
    <div class="row">
      <div class="col-md-12 col-xs-12" style="background-color:;">
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

      <div id="notegrid" class="col-md-12 col-xs-12" style="">
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
  
        <!-- <div id="result" class="overflow-auto" style="height: 550px; overflow-y: scroll;"></div> -->
        <div id="result" class="overflow-auto" ></div>
        
        
      </div>
    </div>
  
  </div>
  <div style="clear:both"></div>
  <br />

 </body>
</html>

<?php $this->load->view('_partials/js.php') ?>
