<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanIzin extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            is_logged_in();
            $this->load->model('Perizinan_model');
        }
        public function index()
	{
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array(); 
        $data['izin'] = $this->Perizinan_model->get(); 
        $this->load->view('layout/header',$data);
        $this->load->view('Perizinan/vw_izin',$data);
        $this->load->view('layout/footer',$data);
	}
        
        public function tambahizin() 
	{
                    $this->form_validation->set_rules('jenis_izin', 'jenis_izin', 'required|trim',[
                        'required' => 'Jenis Izin Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('tujuan_izin', 'tujuan_izin', 'required|trim',[
                        'required' => 'Tujuan Izin Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('alasan_izin', 'alasan_izin', 'required|trim',[
                        'required' => 'Alasan Izin Wajib di isi'
                    ]);
                 if ($this->form_validation->run() == false) {
                        $data['title'] = 'Data Perizinan ';
                    $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
                    $this->load->view('layout/header',$data);
                    $this->load->view('Perizinan/vw_tambah_izin',$data);
                    $this->load->view('layout/footer',$data);
                } else {
                    $niy = $this->session->userdata('niy');
                    $tujuan_izin = htmlspecialchars($this->input->post('tujuan_izin', true));
                    if ($tujuan_izin == 'Others') {
                        $tujuan_izin = htmlspecialchars($this->input->post('other_input', true));
                    }
                    $data = [
                        'jenis_izin' => htmlspecialchars($this->input->post('jenis_izin', true)),
                        'tujuan_izin' => $tujuan_izin,
                        'alasan_izin' => htmlspecialchars($this->input->post('alasan_izin', true)),
                        'niy' => $niy,
                        'status' => 'Diajukan',
                    ];

                    // print_r($this->session->userdata());
                    
                    $this->Perizinan_model->insert($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! 
                    data telah berhasil disimpan</div>');
                    redirect('PengajuanIzin');
                }    
}
public function editizin($id) 
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata('id')])->row_array();
    $data['izin'] = $this->Perizinan_model->getById($id);

    $this->form_validation->set_rules('jenis_izin', 'jenis_izin', 'required|trim',[
        'required' => 'Jenis Izin Wajib di isi'
    ]);
    $this->form_validation->set_rules('tujuan_izin', 'tujuan_izin', 'required|trim',[
        'required' => 'Tujuan Izin Wajib di isi'
    ]);
    $this->form_validation->set_rules('alasan_izin', 'alasan_izin', 'required|trim',[
        'required' => 'Alasan Izin Wajib di isi'
    ]);

    if ($this->form_validation->run() == false) {
        $this->load->view('layout/header', $data);
        $this->load->view('Perizinan/vw_edit_izin', $data);
        $this->load->view('layout/footer', $data);
    } else {
        $izin_id = $this->input->post('id');
        $tujuan_izin = htmlspecialchars($this->input->post('tujuan_izin', true));
        if ($tujuan_izin == 'Others') {
            $tujuan_izin = htmlspecialchars($this->input->post('other_input', true));
        }
        $data = [
            'jenis_izin' => $this->input->post('jenis_izin'),
            'tujuan_izin' =>   $tujuan_izin,
            'alasan_izin' => $this->input->post('alasan_izin'),
        ];
        
        $this->Perizinan_model->update(['id' => $izin_id], $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Izin Berhasil DiUbah!</div>');
        redirect('PengajuanIzin');
    }
}
    
    public function hapus($id)
    {
        $this->Perizinan_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Izin Berhasil Dihapus!</div>');
        redirect('PengajuanIzin');
    }
    
    public function approveizin()
	{
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();   
        $data['approveizin'] = $this->Perizinan_model->get();      
        $this->load->view('layout/header',$data);
        $this->load->view('Perizinan/vw_approveizin',$data);
        $this->load->view('layout/footer',$data);
	}  
    public function ubahstatus($id) 
	{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
    $data['izin'] = $this->Perizinan_model->getById($id);

            $data = [
                'status' => $this->input->post('status'),
            ];
            $id = $this->input->post('id');
                $this->Perizinan_model->update(['id' => $id], $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
    role="alert">Data Izin Berhasil DiUbah!</div>');
                redirect('PengajuanIzin/approveizin');
    }
} 
