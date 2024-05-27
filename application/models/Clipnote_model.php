<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class clipnote_model extends CI_Model {

    private $table = "notes";

    function fetch_data($query){
        $this->db->select("*");
        $this->db->from("$this->table");

        if($query !=''){
            $this->db->like('notes', $query);
            $this->db->or_like('tags', $query);
        }

        $this->db->order_by('id','DESC');
        return $this->db->get();
    }

    function get_record_by_id($id){
        return $this->db->get_where('notes', array('id'=> $id))->row_array();
    }

    function save($data){
        $query = $this->db->insert('notes', $data);
        return $query;
    }

    function delete($id){
        return $this->db->delete('notes', array("id"=> $id));
    }
}

?>