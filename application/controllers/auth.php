<?php

class Auth extends CI_controller 
{
	private $_table = "users";
	const SESSION_KEY = 'user_id';

	function __construct(){
		parent::__construct();		
		$this->load->model('auth_model'); 
	}

	public function rules()
	{
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

		$this->db->where('email', $username)->or_where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah password-nya benar?
		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $user->id]);
		$this->_update_last_login($user->id);

		return $this->session->has_userdata(self::SESSION_KEY);

		$cek = $this->auth_model->cek_login("users",$where);  		

		if($cek['name'] !=''){ 						
 
			$data_session = array(
				'nama' => $cek['name'],                
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			// redirect(base_url("clipnote/index"));

			return TRUE;

			
 
		}else{
			// echo "Username dan password salah !";

			return FALSE;
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
    
}
