<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Berkas_model');
        
    }
public function index()
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
    $data['berkas'] = $this->Berkas_model->get();
    $this->load->view('layout/header',$data);
    $this->load->view('Berkas/vw_berkas',$data);
    $this->load->view('layout/footer',$data);
}
    public function tambah_berkas()
{
    $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim',[
        'required' => 'Keterangan Wajib di isi'
    ]);
    if ($this->form_validation->run() == false) {
        $data['title'] = 'Data Lembur';
        $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
    $this->load->view('layout/header',$data);
    $this->load->view('Berkas/vw_tambah_berkas',$data);
    $this->load->view('layout/footer',$data);
} else {
    $data = [
        'keterangan' => htmlspecialchars($this->input->post('keterangan', true)), 
        'id_pegawai' => htmlspecialchars($this->input->post('id_pegawai', true)), 
    ];
    $upload_image = $_FILES['file_berkas']['name'];
    if ($upload_image) {
    $config['allowed_types'] = 'gif|jpg|png|pdf';
    $config['max_size'] = '2048';
    $config['upload_path'] = './template/assets/img/berkas/';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('file_berkas')) {
        $new_image = $this->upload->data('file_name');
        $this->db->set('file_berkas', $new_image);
    } else {
        echo $this->upload->display_errors();
    }
}

    $this->Berkas_model->insert($data, $upload_image);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! 
    data telah berhasil disimpan</div>');
    redirect('Berkas');
}    
}

public function hapus($id)
{
    $this->Berkas_model->delete($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berkas Berhasil Dihapus!</div>');
    redirect('Berkas');
}
}