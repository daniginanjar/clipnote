<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('user_view', $data);
    }

    public function create() {
        $data = array(
            'username' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password'))
        );
        $this->User_model->insert_user($data);
        redirect('user');
    }

    public function edit($id) {
        //load model 
        $this->load->model('user_model');

        //get ID dari URL segment ke 3
        $id = $this->uri->segment(3);

        $data['coba'] = $this->user_model->get_user_by_id($id);
        $data['users'] = $this->User_model->get_all_users();

        //load view
        $this->load->view('user_view', $data);
    }

    public function update($id) {
        $data = array(
            'username' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password'))
        );
        $this->User_model->update_user($id, $data);
        redirect('user');
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('user');
    }
}
?>