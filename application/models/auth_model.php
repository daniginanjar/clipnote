<?php

class Auth_model extends CI_model
{
    private $_table = "users";
    const SESSION_KEY = "user_id";

    function rules(){
        return [
            [
                'field' => 'username',
                'label' => 'Username or Email',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[255]'
            ]
        ];
    }

    function login($username, $password){
        $this->db->where('email', $username)->or_where('username', $username);
        $query = $this->db->get($this->_table);
        $user = $query->row();

        if(!$user){
            return FALSE;
        }

        if(!password_verify($password, $user->password)){
            return FALSE;
        }

        $this->session->has_userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table,['id' => $user->id]);
        return $query->row();        
    }

    function current_user(){
        if(!$this->session->has_userdata(self::SESSION_KEY)){
            return null;
        }
    }

    function logout(){
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->has_userdata(self::SESSION_KEY);
    }

    function _update_last_login($id){
        $data = [
            'last_login' => date('Y-m-d H:i:s'),
        ];

        return $this->db->update($this->_table, $data, ['id'=> $id]);
    }
}