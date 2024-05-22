<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            is_logged_in();
            
        }

public function index()
{
        $this->load->view('layout/header');
        $this->load->view('Auth/vw_profile');
        $this->load->view('layout/footer');
} 
}