<?php

class Auth_model extends CI_model
{
    function cek_login($table,$where){				
        return $this->db->get_where($table,$where)->row_array();                
	}
}