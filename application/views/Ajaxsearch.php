<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Live Data Search in Codeigniter using Ajax JQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />    
 </head>
 <body>
  <div class="container">

  <br />
  <br />
   <div class="form-group">
    <div class="input-group">
    <button id="savenote" type="button" onclick="toggle()" class="btn btn-primary">Add New Note</button>
    <button id="cancelnote" style="display:none" type="button" onclick="toggle()" class="btn btn-warning">Cancel</button>
    </div>
   </div>
   

   <div id="inputnote" style="display:none" class="form-group" class="row justify-content-md-center">
    <div class="input-group" class="col-md-12 col-lg-8">
    <label for="labelinputnote">Create New Note:</label>
    <textarea class="form-control" rows="5" ></textarea> 
    </div>
   </div>
   <br />

  <h2 align="center">Search Any Notes</h2><br />
   <div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Enter Any Keywords" class="form-control" />     
    </div>
   </div>
   <br />



   
   <br />
   <div id="result"></div>
  </div>
  <div style="clear:both"></div>
  <br />
  <br />
  <br />
  <br />
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>ajaxsearch/fetch",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});

function toggle(){
  var x = document.getElementById("inputnote");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }

  var savenote = document.getElementById("savenote");
  
  if (savenote.innerHTML === "Add New Note"){
    savenote.innerHTML = "SAVE";  
  } else {
    savenote.innerHTML = "Add New Note";
  }

  var cancelnote = document.getElementById("cancelnote");
  if (savenote.innerHTML === "Add New Note"){
    cancelnote.style.display = "none";

  } else {
    cancelnote.style.display = "inline"
  }

}

</script>
