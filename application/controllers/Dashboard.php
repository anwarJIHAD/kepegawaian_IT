<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
        public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
    }
	public function index()
	{
         $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array(); 
        $this->load->view('layout/header',$data);
        $this->load->view('Dashboard/vw_test2',$data);
        $this->load->view('layout/footer',$data);
	}
        
}
