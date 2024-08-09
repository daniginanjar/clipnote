<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Clipnote extends CI_Controller {

  function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') !=TRUE){
            $url=base_url('auth');
            redirect($url);
		};
	}
	
	public function index()
	{
		$this->load->view('v_clipnote');
	}

  function save(){
    $notes = $this->input->post('notes');
    $tags = $this->input->post('tags');
    $created_by = $this->session->userdata('id');
    $updated_by = $this->session->userdata('id');

    if($notes == ''){
      $this->session->set_flashdata('error','Pls enter notes');
      redirect('clipnote');
    }else{
      $data = array(
        'notes' => $notes,
        'tags' => $tags,
        'created_by' => $created_by,
        'updated_by' => $updated_by
      );

      $this->load->model('clipnote_model');
      $insert = $this->clipnote_model->save($data);

      if($insert==true){
        $this->load->view('v_clipnote');
      } else {
        echo "saving data failed";
      }
    }    
  }

  function delete(){
    $id = $this->input->post('id');
    $this->clipnote_model->delete($id);
    redirect(base_url());
  }

  function copy(){
    $id = $this->input->post('id');
    $data = $this->clipnote_model->copy($id);
    return $this->load->view('v_clipnote',$data); 
  }

  function fetch(){  
    
    $output = '';
    $query = '';
    $id = $this->input->post('id');

    $this->load->model('clipnote_model');

    if($this->input->post('query')){
      $query = $this->input->post('query');
    }

    $data = $this->clipnote_model->fetch_data($query,$id);

    if($data->num_rows() > 0){ 
      foreach($data->result() as $row){
        $output .='
        <div class="list-group">  
      
        <li href="#" class="list-group-item list-group-item-action" >
                
          <div class="d-flex w-100 justify-content-between">      
            <!-- <button type="button" class="btn btn-xs btn-warning"><a id="editnote" href="'.base_url().'clipnote/fetchbyid/'.$row->id.'">Edit</a></button> -->
            <button type="button" class="btn btn-xs btn-Success" id="buttonshowhide'.$row->id.'"   onclick="showhide('.$row->id.')">Expand</button>                       
            <button type="button" class="btn btn-xs btn-primary" onclick="editnote('.$row->id.')">Edit Note</button>                        
            <button type="button" class="btn btn-xs btn-primary" onclick="copynote('.$row->id.')">Copy</button>
            <button type="button" class="btn btn-xs btn-danger" onclick="deletenote('.$row->id.')">Delete</button> 
            <hr>            
            <small class="text-muted" style="color:green"> <button type="button" class="btn btn-xs btn-dark"><b>Last Update :'.$row->updated_time.'</b></button></small>
            <small class="text-muted" style="color:red; display:none;"> <b>- Note ID('.$row->id.')</b></small>       
            <br> 
            <small class="text-muted " style="color:blue"><b>TAGS: <button type="button" class="btn btn-xs btn-dark">'.$row->tags.'</button></b></small>     
          </div>       
                                      
          <div id="showhide'.$row->id.'" style="height:200px; overflow:hidden;">
          <p class="mb-1" >'.$row->notes.'</p>
          </div>
                                                                          
                   
        </li>        
        </div>
        ';
      } 
    } else {
    $output .= '<p>No Data Found!</p>';

    }

  echo $output;
  }

  function fetchbyid($id){
    $data = $this->clipnote_model->get_record_by_id($id);
    return $this->load->view('veditnote',$data) ;    
  }

  function update(){
    $id = $this->input->post('noteid');
    $notes = $this->input->post('notes');
    $tags = $this->input->post('tags');    
    $updated_by = $this->input->post('updatedby');
    $updated_time = date("Y/m/d h:i:s");

    $data = array(      
      'notes' => $notes,
      'tags' => $tags,      
      'updated_by' => $updated_by,
      'updated_time' => $updated_time
    );

    $where = array(
      'id' => $id
    );

    $this->clipnote_model->update_data($where,$data,'notes');
	  redirect('clipnote/index');   
  }

  function copynote(){
    $id = $this->input->post('id');
    $data = $this->clipnote_model->get_record_by_id($id);
    
    echo $data['notes']; 
  }

  function newnote(){
    $this->load->view('vnewnote');
  }

}