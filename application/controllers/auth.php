<?php

class Auth extends CI_controller 
{
    function __construct(){
		parent::__construct();		
		$this->load->model('auth_model'); 
	}
 
	function index(){
		$this->load->view('login_form');
	}
 
	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->auth_model->cek_login("users",$where);           

		if($cek){                      
 
			$data_session = array(
				'nama' => $cek['name'],                
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("clipnote/index"));
 
		}else{
			echo "Username dan password salah !";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth/index'));
	}
    
}
