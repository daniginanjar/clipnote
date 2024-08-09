<html>
  <?php $this->load->view('_partials/head.php') ?>
  
  <body>

  <div class="container" > 

    

    <textarea name="tempcopy" class="form-control" id="tempcopy" rows="3" style="display:none"></textarea>
    
    <div class="row">
      <div class="col-md-12 col-xs-12" style="background-color:;">
        <!-- <br />     -->
        
        <?php
        if (isset($id)){

          echo '
          <div class="updatenoteform" id="updatenoteform" >
              <div class="card card-body">
                <form action="'. base_url().'clipnote/update " method="POST" class="float-left" style="display:auto">
                <h2 align="center">Update Notes</h2><br />
                <button name="update" class="btn btn-xs btn-primary" id="update" onclick="updatenote()">Update Note</button>
                <button name="clearform" class="btn btn-xs btn-warning" id="clearform" onclick="clearformupdate()">Clear Form</button>
                <button name="cancelupdatenote" class="btn btn-xs btn-light" id="cancelupdatenote" onclick="closenewnote()">Cancel</button>
                                
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
    
                <button name="update" class="btn btn-xs btn-primary" id="update" onclick="updatenote()">Update Note</button>
                <button name="clearform" class="btn btn-xs btn-warning" id="clearform" onclick="clearformupdate()">Clear Form</button>
                <button name="cancelupdatenote" class="btn btn-xs btn-light" id="cancelupdatenote" onclick="closenewnote()">Cancel</button>
                
              </form>
            </div>
          </div>
                            
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

        } 
        ?>
        
        <br />
   
        <h5 id="saveresult"></h5> 
      </div>

      
    </div>

    <?php $this->load->view('_partials/footer.php') ?>
  
  </div>
  <!-- <div style="clear:both"></div>
  <br /> -->


</body>
</html>

<?php $this->load->view('_partials/js.php') ?>