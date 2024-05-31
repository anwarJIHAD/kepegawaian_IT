<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Lembur_model');
    }

public function index()
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
    $data['lembur'] = $this->Lembur_model->get();
        $this->load->view('layout/header',$data);
        $this->load->view('Lembur/vw_lembur',$data);
        $this->load->view('layout/footer',$data);
} 
public function tambah_lembur()
{
    $this->form_validation->set_rules('tanggal', 'tanggal', 'required|trim',[
        'required' => 'Tanggal Wajib di isi'
    ]);
    $this->form_validation->set_rules('masuk', 'masuk', 'required|trim',[
        'required' => 'Masuk Wajib di isi'
    ]);
    $this->form_validation->set_rules('pulang', 'pulang', 'required|trim',[
        'required' => 'Pulang Wajib di isi'
    ]);
    $this->form_validation->set_rules('lama_lembur', 'lama_lembur', 'required|trim',[
        'required' => 'Lama Lembur Wajib di isi'
    ]);
    $this->form_validation->set_rules('ket_lembur', 'ket_lembur', 'required|trim',[
        'required' => 'Keterangan Lembur Wajib di isi'
    ]);
    if ($this->form_validation->run() == false) {
        $data['title'] = 'Data Lembur';
    $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
    $this->load->view('layout/header',$data);
    $this->load->view('Lembur/vw_tambah_lembur',$data);
    $this->load->view('layout/footer',$data);
} else {
    $niy = $this->session->userdata('niy');
    $data = [
        'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
        'masuk' => htmlspecialchars($this->input->post('masuk', true)),
        'pulang' => htmlspecialchars($this->input->post('pulang', true)),
        'lama_lembur' => htmlspecialchars($this->input->post('lama_lembur', true)),
        'ket_lembur' => htmlspecialchars($this->input->post('ket_lembur', true)),
        'niy' => $niy,
    ];
    $this->Lembur_model->insert($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! 
    data telah berhasil disimpan</div>');
    redirect('Lembur');
}

}
public function edit_lembur($id)
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
    $data['lembur'] = $this->Lembur_model->getById($id);
    $this->form_validation->set_rules('tanggal', 'tanggal', 'required|trim',[
        'required' => 'Tanggal Wajib di isi'
    ]);
    $this->form_validation->set_rules('masuk', 'masuk', 'required|trim',[
        'required' => 'Masuk Wajib di isi'
    ]);
    $this->form_validation->set_rules('pulang', 'pulang', 'required|trim',[
        'required' => 'Pulang Wajib di isi'
    ]);
    $this->form_validation->set_rules('lama_lembur', 'lama_lembur', 'required|trim',[
        'required' => 'Lama Lembur Wajib di isi'
    ]);
    $this->form_validation->set_rules('ket_lembur', 'ket_lembur', 'required|trim',[
        'required' => 'Keterangan Lembur Wajib di isi'
    ]);

    if ($this->form_validation->run() == false) {
    $this->load->view('layout/header',$data);
    $this->load->view('Lembur/vw_edit_lembur',$data);
    $this->load->view('layout/footer',$data);
    } else {
        $data = [
            'tanggal' => $this->input->post('tanggal'),
            'masuk' => $this->input->post('masuk'),
            'pulang' => $this->input->post('pulang'),
            'lama_lembur' => $this->input->post('lama_lembur'),
            'ket_lembur' => $this->input->post('ket_lembur'),
        ];
        $id = $this->input->post('id');
            $this->Lembur_model->update(['id' => $id], $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
role="alert">Data Lembur Berhasil DiUbah!</div>');
            redirect('Lembur');
    }
}

public function hapus($id)
{
    $this->Lembur_model->delete($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Lembur Berhasil Dihapus!</div>');
    redirect('Lembur');
}
}
