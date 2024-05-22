<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {	
        
        public function index()
	{
         $this->form_validation->set_rules('username', 'username', 'trim|required', [
         'valid_username' => 'username Harus Valid',
         'required' => 'username Wajib di isi'
         ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
        'required' => 'Password Wajib di isi'
        ]);
        if ($this->form_validation->run() == false) {
                $this->load->view('Auth/vw_login');
            } else {
                $this->cek_login();                
            }
	}
        
        public function cek_login()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $pegawai = $this->db->get_where('pegawai', ['username' => $username])->row_array();
            if ($pegawai) {
                if (password_verify($password, $pegawai['password'])) {
                    $data = [
                        'username' => $pegawai['username'],
                        'role' => $pegawai['role'],
                        'id' => $pegawai['id'],
                        'niy' => $pegawai['niy'],
                    ];
                    $this->session->set_userdata($data);
                    if ($pegawai['role'] == 'Admin') {
                        redirect('Dashboard');
                    } elseif ($pegawai['role'] == 'guru') {
                        redirect('Dashboard');
                    } elseif ($pegawai['role'] == 'pustakawati') {
                        redirect('Dashboard');
                    } elseif ($pegawai['role'] == 'kepala sekolah'){
                        redirect('Dashboard');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">username Belum Tedaftar! </div>');
                redirect('Auth');
            }
        }

        public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasii logout!</div>');
        redirect('auth');
    }
      
}
