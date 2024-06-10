<script>

function login(){
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var messagesuccess = ""

  //alert(username);

  $.ajax({
    url:"<?php echo base_url(); ?>auth/login",
    method:"POST",
    data:{
      username:username,
      password:password
    },
    success:function(response){
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

//   $('form').on('submit',function(e){
//     e.preventDefault();
//     $.ajax({
//       type:$(this).attr('method'),
//       url:$(this).attr('action'),
//       data:$(this).serialize(),
//       success:function(){
//         document.getElementById("saveresult").innerHTML = "Data Saved Successfuly";    

//         window.setTimeout(function() {
//           $("#saveresult").fadeTo(500, 0).slideUp(500, function(){
//             $(this).remove(); 
//           });
//         }, 5000);
        
//         load_data();
//       }
//     })
//   });

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