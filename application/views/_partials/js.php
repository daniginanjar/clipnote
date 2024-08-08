<script>

function login(){
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var messagesuccess = "";

  $.ajax({
    url:"<?php echo base_url(); ?>auth/login",
    method:"POST",
    data:{
      username:username,
      password:password
    },
    success:function(){
      if (document.getElementById("loginvalidation").classList.contains("alert-danger")){
          document.getElementById("loginvalidation").classList.add("alert-success");
          document.getElementById("loginvalidation").hidden = false;        
        };    
        
        document.getElementById("loginvalidation").innerHTML = "<strong>Success!</strong> Login";

        window.setTimeout(function() {
          $("#loginvalidation").fadeTo(3000, 0).slideUp(3000, function(){
            $(this).remove(); 
          });
        }, 5000);
        
        window.location.replace("<?php echo base_url(); ?>clipnote");      
    }    
  });

}


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
            $("#saveresult").fadeTo(3000, 0).slideUp(3000, function(){
            $(this).remove(); 
            });
        }, 5000);

        clearformsave();
      
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

      clearformupdate();
      
      load_data();
    }
  })
}

function load_data(query){
  var id = <?php echo $this->session->userdata('id'); ?>;  

  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/fetch",
    method:"POST",
    data:{
      id:id,
      query:query
    },
    success:function(data){
      $('#result').html(data);
    }
  });
};

function showhide(id){
  var showhideid = "#showhide"+id;
  var showhideheight = "showhide"+id;
  var buttonshowhideid = "buttonshowhide"+id;

  if (document.getElementById(buttonshowhideid).innerHTML == "Expand"){
    document.getElementById(buttonshowhideid).innerHTML = "Collapse"; 
    document.getElementById(showhideheight).style.height = "auto";
    document.getElementById(showhideheight).style.overflow = "auto"; 
  } else {
    document.getElementById(buttonshowhideid).innerHTML = "Expand";  
    document.getElementById(showhideheight).style.height = "200px";  
    document.getElementById(showhideheight).style.overflow = "hidden";  
    
  }
  //$(showhideid).toggle(1000);
  //document.getElementById(showhideid).style.height = "1000px";

}

function newnote(){
  $('#newnoteform').toggle(100);
}

function editnote(id){

  $.ajax({
    url:"<?php echo base_url(); ?>clipnote/fetchbyid/"+id,
    method:"POST",
    data:{id:id, tags:tags},
    success:function(response){
      $('#newnoteform').toggle(100);
      //$('#tags').val(response.tags);     
    }
  })  
  
}

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

function deleteuser(id){
  $.ajax({
    url:"<?php echo base_url(); ?>user/delete",
    method:"POST",
    data:{id:id},
    success:function(){
      document.getElementById("saveresult").innerHTML = "User Deleted Successfuly"; 

      window.setTimeout(function() {
        $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);

      window.location.replace("<?php echo base_url(); ?>user");
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

  $(".delete-user").click(function () { 
      var id = $(this).val();       
      document.getElementById("modal-title").innerText = "User Deletion";
      $(".modal-body").html("<p>Are you sure to delete this user id ("+id+")?</p>");
      $(".modal-footer").html('<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="deleteuser('+id+')">Yes</button><button type="button" class="btn btn-default" data-dismiss="modal">No</button>');
      
  });

  $(".edit-user").click(function () { 
      var id = $(this).val();   
      var modalbody = $(".modal-body").html("");

      document.getElementById("modal-title").innerText = "User Update";

      $(".modal-body").append('<div class="col-md-12 col-xs-12" style="border-left-style: solid; background-color:#f2efef;">');

      $(".modal-body").append('<form action="<?= base_url('user/create'); ?>" method="post" id="myform">');
      $(".modal-body").append('<div class="form-group col-md-6 col-xs-6">');
      $(".modal-body").append('<label for="name">Name</label>');
      $(".modal-body").append('<input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="'+id+'">');
      $(".modal-body").append('</div>');
      $(".modal-body").append('<div class="form-group col-md-6 col-xs-6">');
      $(".modal-body").append('<label for="username">User Name</label>');
      $(".modal-body").append('<input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>');
      $(".modal-body").append('</div>');
      $(".modal-body").append('<div class="form-group col-md-6 col-xs-6">');
      $(".modal-body").append('<label for="email">Email address</label>');
      $(".modal-body").append('<input type="email" name="email" class="form-control" id="email" placeholder="Email" required>');
      $(".modal-body").append('</div>');
      $(".modal-body").append('<div class="form-group col-md-6 col-xs-6">');
      $(".modal-body").append('<label for="pwd">Password</label>');
      $(".modal-body").append('<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>');
      $(".modal-body").append('</div>');
      $(".modal-body").append('<div class="form-group col-md-6 col-xs-6">');
      $(".modal-body").append('<label for="pwd">User Type</label>');
      $(".modal-body").append('<select class="form-control" id="usertype" name="usertype"><option>CREATOR</option><option>SUPERADMIN</option><option>ADMINISTRATOR</option><option>SUPERUSER</option><option>USER</option><option>CUSTOMER</option><option>GUEST</option></select>');
      $(".modal-body").append('</div>');      

      $(".modal-body").append('</form> '); 
      $(".modal-body").append('</div> '); 
           
            
      $(".modal-footer").html('<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateuser('+id+')">Update</button><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');      
  });  

});
</script>