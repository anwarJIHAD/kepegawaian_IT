<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller 
{

    public function __construct()
    {

        parent::__construct();
        is_logged_in();
        $this->load->model('Pegawai_model');
    }

public function index()
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
    $data['pegawai_m'] = $this->Pegawai_model->get();
    $this->load->view('layout/header',$data);
    $this->load->view('Pegawai/vw_pegawai',$data);
    $this->load->view('layout/footer',$data);
}
    public function tambah_pegawai()
{
        $this->form_validation->set_rules('niy', 'niy', 'required|trim',[
            'required' => 'NIY Wajib di isi'
        ]);
        $this->form_validation->set_rules('nama', 'nama', 'required|trim',[
            'required' => 'Nama Wajib di isi'
        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[pegawai.username]', [
            'is_unique' => 'Username ini sudah terdaftar!',
            'required' => 'Username Wajib di isi'
        ]);
        $this->form_validation->set_rules('password','password','required|trim|min_length[5]',[
                'min_length' => 'Password Terlalu Pendek',
                'required' => 'Password harus diisi'
        ]);
        $this->form_validation->set_rules('tmpt_lahir', 'tmpt_lahir', 'required|trim',[
            'required' => 'Tempat lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required|trim',[
            'required' => 'Tanggal lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('pnd_trkhr', 'pnd_trkhr', 'required|trim',[
            'required' => 'Pendidikan Terakhir Wajib di isi'
        ]);
        $this->form_validation->set_rules('tmt_smait', 'tmt_smait', 'required|trim',[
            'required' => 'TMT SMA IT Wajib di isi'
        ]);
        $this->form_validation->set_rules('jurusan', 'jurusan', 'required|trim',[
            'required' => 'Jurusan Wajib di isi'
        ]);
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim',[
            'required' => 'Jabatan Wajib di isi'
        ]);
        $this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim',[
            'required' => 'No handphone Wajib di isi'
        ]);
        $this->form_validation->set_rules( 'password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data pegawai';
            $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
            $this->load->view('layout/header',$data);
            $this->load->view('Pegawai/vw_tambah_pegawai',$data);
            $this->load->view('layout/footer',$data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'niy' => htmlspecialchars($this->input->post('niy', true)),
                'tmpt_lahir' => htmlspecialchars($this->input->post('tmpt_lahir', true)),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
                'pnd_trkhr' => htmlspecialchars($this->input->post('pnd_trkhr', true)),
                'tmt_smait' => htmlspecialchars($this->input->post('tmt_smait', true)),
                'jurusan' => htmlspecialchars($this->input->post('jurusan', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => htmlspecialchars($this->input->post('role', true)),
            ];
            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! 
            data telah berhasil disimpan</div>');
            redirect('Pegawai');
        }

}
    public function edit_pegawai($id)
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
    $data['pegawai_m'] = $this->Pegawai_model->getById($id);

    $this->form_validation->set_rules('niy', 'niy', 'required|trim',[
        'required' => 'NIY Wajib di isi'
    ]);
    $this->form_validation->set_rules('nama', 'nama', 'required|trim',[
        'required' => 'Nama Wajib di isi'
    ]);
    $this->form_validation->set_rules('username', 'username', 'required|trim', [
        'required' => 'Username Wajib di isi'
    ]);
    $this->form_validation->set_rules('tmpt_lahir', 'tmpt_lahir', 'required|trim',[
        'required' => 'Tempat lahir Wajib di isi'
    ]);
    $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required|trim',[
        'required' => 'Tanggal lahir Wajib di isi'
    ]);
    $this->form_validation->set_rules('pnd_trkhr', 'pnd_trkhr', 'required|trim',[
        'required' => 'Pendidikan terakhir Wajib di isi'
    ]);
    $this->form_validation->set_rules('tmt_smait', 'tmt_smait', 'required|trim',[
        'required' => 'TMT SMA IT Wajib di isi'
    ]);
    $this->form_validation->set_rules('jurusan', 'jurusan', 'required|trim',[
        'required' => 'Jurusan Wajib di isi'
    ]);
    $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim',[
        'required' => 'Jabatan Wajib di isi'
    ]);
    $this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim',[
        'required' => 'No handphone Wajib di isi'
    ]);
    if ($this->form_validation->run() == false) {
    $this->load->view('layout/header',$data);
    $this->load->view('Pegawai/vw_edit_pegawai',$data);
    $this->load->view('layout/footer',$data);
    } else {
        $data = [
            'nama' => $this->input->post('nama'),
            'niy' => $this->input->post('niy'),
            'tmpt_lahir' => $this->input->post('tmpt_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'pnd_trkhr' => $this->input->post('pnd_trkhr'),
            'tmt_smait' => $this->input->post('tmt_smait'),
            'jurusan' => $this->input->post('jurusan'),
            'jabatan' => $this->input->post('jabatan'),
            'no_hp' => $this->input->post('no_hp'),
            'username' =>$this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role'),
        ];
        $id = $this->input->post('id');
            $this->Pegawai_model->update(['id' => $id], $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
role="alert">Data Pegawai Berhasil DiUbah!</div>');
            redirect('Pegawai');
    }
}

public function hapus($id)
{
    $this->Pegawai_model->delete($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pegawai Berhasil Dihapus!</div>');
    redirect('Pegawai');
}
}