<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mulai extends CI_Controller{
    public function Index(){
        $this->load->view('home');
    }
}