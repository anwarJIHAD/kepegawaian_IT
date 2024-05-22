<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

	}

	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
		$this->load->view('layout/header', $data);
		$this->load->view('Auth/vw_profile', $data);
		$this->load->view('layout/footer', $data);
	}
}
