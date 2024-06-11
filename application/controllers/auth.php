<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
    }
    
	function index(){
        if($this->session->userdata('logged') !=TRUE){
            $this->load->view('login_form');
        }else{
            $url=base_url('clipnote');
            redirect($url);
        };
    }
    
    function autentikasi(){
        $email = $this->input->post('email');
        $password = $this->input->post('pass');
                
        $validasi_email = $this->auth_model->query_validasi_email($email);
        if($validasi_email->num_rows() > 0){
			$passcheck = $validasi_email->row_array();

            $validate_ps=$this->auth_model->query_validasi_email($email);
            if(password_verify($password,$passcheck['password'])){
                $x = $validate_ps->row_array();
                if($x['user_status']=='1'){
                    $this->session->set_userdata('logged',TRUE);
                    $this->session->set_userdata('user',$email);
                    $id=$x['id'];
                    if($x['type']=='CREATOR'){ //Creator
                        $name = $x['name'];
                        $this->session->set_userdata('access','Creator');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }else if($x['type']=='SUPERADMIN'){ //Superadmin
                        $name = $x['name'];
                        $this->session->set_userdata('access','Superadmin');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }else if($x['type']=='ADMINISTRATOR'){ //Administrator
                        $name = $x['name'];
                        $this->session->set_userdata('access','Administrator');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }else if($x['type']=='SUPERUSER'){ //Superuser
                        $name = $x['name'];
                        $this->session->set_userdata('access','Superuser');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }else if($x['type']=='USER'){ //User
                        $name = $x['name'];
                        $this->session->set_userdata('access','User');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }else if($x['type']=='CUSTOMER'){ //Customer
                        $name = $x['name'];
                        $this->session->set_userdata('access','Customer');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }else if($x['type']=='GUEST'){ //Guest
                        $name = $x['name'];
                        $this->session->set_userdata('access','Guest');
                        $this->session->set_userdata('id',$id);
                        $this->session->set_userdata('name',$name);
                        redirect('clipnote');

                    }

                }else{
                    $url=base_url('auth');
                    echo $this->session->set_flashdata('msg','<span onclick="this.parentElement.style.display=`none`" class="w3-button w3-large w3-display-topright">&times;</span>
                    <h3>Uupps!</h3>
                    <p>You are blocked</p>');
                    redirect($url);
                }
            }else{
                $url=base_url('auth');
                echo $this->session->set_flashdata('msg','<span onclick="this.parentElement.style.display=`none`" class="w3-button w3-large w3-display-topright">&times;</span>
                    <h3>Uupps!</h3>
                    <p>Wrong password</p>');
                redirect($url);
            }

        }else{
            $url=base_url('auth');
            echo $this->session->set_flashdata('msg','<span onclick="this.parentElement.style.display=`none`" class="w3-button w3-large w3-display-topright">&times;</span>
            <h3>Uupps!</h3>
            <p>Wrong mail</p>');
            redirect($url);
        }

    }

    function logout(){
        $this->session->sess_destroy();
        $url=base_url('auth');
        redirect($url);
    }

}