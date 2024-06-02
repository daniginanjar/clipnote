<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Clipnote extends CI_Controller {
  function index(){
    $this->load->view("v_clipnote");
  }

  function save(){
    $notes = $this->input->post('notes');
    $tags = $this->input->post('tags');
    $created_by = 1;
    $updated_by = 1;

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

  

  function delete($id){
    $this->clipnote_model->delete($id);
    redirect(base_url());
  }

  function fetch(){  
    
    $output = '';
    $query = '';

    $this->load->model('clipnote_model');

    if($this->input->post('query')){
      $query = $this->input->post('query');
    }

    $data = $this->clipnote_model->fetch_data($query);

    if($data->num_rows() > 0){ 
      foreach($data->result() as $row){
        $output .='
        <div class="list-group">  
      
        <li href="#" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">      
            <small class="text-muted" style="color:green"> <b>'.$row->updated_time.'</b></small>
            <small class="text-muted" style="color:red"> <b>- Note ID('.$row->id.')</b></small>            
          </div>
          
          <p class="mb-1">'.$row->notes.'</p>
          <small class="text-muted style="color:blue"><b>TAGS: '.$row->tags.'</b></small>

          <span class="pull-right">
            <button type="button" class="btn btn-xs btn-warning"><a id="editnote" href="'.base_url().'clipnote/fetchbyid/'.$row->id.'">Edit</a></button>
            <button type="button" class="btn btn-xs btn-primary" onclick="copynote('.$row->id.')">Copy</button>
            <button type="button" class="btn btn-xs btn-danger"><a id="deletenote" href="'.base_url().'clipnote/delete/'.$row->id.'">Delete</a></button>                            
          </span>          
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
    return $this->load->view('v_clipnote',$data); 
  }

  function update(){
    $id = $this->input->post('noteid');
    $notes = $this->input->post('notes');
    $tags = $this->input->post('tags');    
    $updated_by = $this->input->post('updatedby');

    $data = array(      
      'notes' => $notes,
      'tags' => $tags,      
      'updated_by' => $updated_by
    );

    $where = array(
      'id' => $id
    );

    $this->clipnote_model->update_data($where,$data,'notes');
	  redirect('clipnote/index');   
  }

  function copy($id){
    $data = $this->clipnote_model->get_record_by_id($id);
    return $this->load->view('v_clipnote',$data); 
  }

}