<?php
class Ajaxsearch_model extends CI_Model
{
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("notes");
  if($query != '')
  {
   $this->db->like('Notes', $query);
  }
  $this->db->order_by('NotesID', 'DESC');
  return $this->db->get();
 }
}
?>