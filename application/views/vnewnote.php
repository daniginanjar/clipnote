<html>
  <?php $this->load->view('_partials/head.php') ?>
  
  <body>

  <div class="container" > 

    <textarea name="tempcopy" class="form-control" id="tempcopy" rows="3" style="display:none"></textarea>
    
    <div class="row">
      <div class="col-md-12 col-xs-12" style="background-color:;">
        <!-- <br />     -->
        
        <?php
        echo '
        <div class="newnoteform" id="newnoteform">
          <div class="card card-body">
            <form action="'. base_url().'clipnote/save " method="POST" class="float-left" >
              <h2 align="center" id="formtitle">Create New Notes</h2><br />
              <button name="savenote" class="btn btn-xs btn-primary" id="savenote" onclick="savenote()">Save Note</button>
              <button name="clearform" class="btn btn-xs btn-warning" id="clearform" onclick="clearformsave()">Clear Form</button>
              <button name="cancelnewnote" class="btn btn-xs btn-light" id="cancelnewnote" onclick="closenewnote()">Cancel</button>                
              
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
              <button name="savenote" class="btn btn-xs btn-primary" id="savenote" onclick="savenote()">Save Note</button>
              <button name="clearform" class="btn btn-xs btn-warning" id="clearform" onclick="clearformsave()">Clear Form</button>
              <button name="cancelnewnote" class="btn btn-xs btn-light" id="cancelnewnote" onclick="cancelnewnote()">Cancel</button>
              
            </form>
          </div>
        </div>
        
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
                 
        <br />
   
        <h5 id="saveresult"></h5> 
      </div>
    </div>

    <?php $this->load->view('_partials/footer.php') ?>
  
  </div>
  
</body>
</html>

<?php $this->load->view('_partials/js.php') ?>
