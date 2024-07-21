<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pegawai_model');
    }

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
            if ($pegawai['status'] != 'Aktif') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak Aktif! </div>');
                redirect('Auth');
            } elseif (password_verify($password, $pegawai['password'])) {
                $data = [
                    'username' => $pegawai['username'],
                    'nama' => $pegawai['nama'],
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
                } elseif ($pegawai['role'] == 'kepala sekolah') {
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
        redirect('Auth');
    }

    public function forgetpass()
    {
        $this->form_validation->set_rules('niy', 'niy', 'trim|required', [
            'required' => 'niy Wajib di isi'
        ]);
        $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required', [
            'required' => 'No HandPhone Wajib di isi'
        ]);
        $this->form_validation->set_rules('password1', 'Password1', 'trim|required', [
            'required' => 'Password Wajib di isi'
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'trim|required', [
            'required' => 'Password Wajib di isi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('Auth/vw_forget');
        } else {

            $niy = $this->input->post('niy');
            $no_hp = $this->input->post('no_hp');
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');

            $pegawai = $this->db->get_where('pegawai', ['niy' => $niy])->row_array();
            if ($pegawai['niy'] != $niy) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIY anda salah </div>');
                redirect('Auth/forgetpass');
            } else if ($pegawai['no_hp'] != $no_hp) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No Handphone anda salah </div>');
                redirect('Auth/forgetpass');
            } else if ($password1 != $password2) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Tidak Sama </div>');
                redirect('Auth/forgetpass');
            } else {
                $data = [
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                ];
                // print_r('hai gesya');
                $this->Pegawai_model->update(['niy' => $niy], $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil diubah </div>');
                redirect('Auth');
            }
        }
    }
}
