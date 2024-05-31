<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerizinanSakit extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            is_logged_in();
            $this->load->model('PerizinanSakit_model');
        }
        public function index()
	{
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
        $data['izin_sakit'] = $this->PerizinanSakit_model->get(); 
        $this->load->view('layout/header',$data);
        $this->load->view('Izinsakit/vw_izin_sakit',$data);
        $this->load->view('layout/footer',$data);
	}
        public function tambahsakit()
	{
                    $this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim',[
                        'required' => 'Tanggal Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim',[
                        'required' => 'Tanggal Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('ket_sakit', 'ket_sakit', 'required|trim',[
                        'required' => 'Keterangan Sakit Wajib di isi'
                    ]);
                    if ($this->form_validation->run() == false) {
                        $data['title'] = 'Data Perizinan Sakit';
                    $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
                    $this->load->view('layout/header',$data);
        $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
        $this->load->view('layout/header',$data);
        $this->load->view('Izinsakit/vw_tambah_sakit',$data);
        $this->load->view('layout/footer',$data);
} else {
    $niy = $this->session->userdata('niy');
        $data = [
            'tgl_izin' => htmlspecialchars($this->input->post('tgl_izin', true)),
            'hingga_tgl' => htmlspecialchars($this->input->post('hingga_tgl', true)),
            'ket_sakit' => htmlspecialchars($this->input->post('ket_sakit', true)),
            'niy' => $niy,
            'status' => 'Diajukan',
        ];
    $upload_image = $_FILES['file_sakit']['name'];
    if ($upload_image) {
    $config['allowed_types'] = 'gif|jpg|png|pdf';
    $config['max_size'] = '2048';
    $config['upload_path'] = './template/assets/img/suratsakit/';
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('file_sakit')) {
    $new_image = $this->upload->data('file_name');
    $this->db->set('file_sakit', $new_image);
    } else {
    echo $this->upload->display_errors();
    }
    }
    
        $this->PerizinanSakit_model->insert($data, $upload_image);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! 
        data telah berhasil disimpan</div>');
        redirect('PerizinanSakit');
    }    
}
	
        public function editsakit($id) 
	{
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
        $data['izin_sakit'] = $this->PerizinanSakit_model->getById($id);

        $this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim',[
            'required' => 'Tanggal Wajib di isi'
        ]);
        $this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim',[
            'required' => 'Tanggal Wajib di isi'
        ]);
        $this->form_validation->set_rules('ket_sakit', 'ket_sakit', 'required|trim',[
            'required' => 'Keterangan Sakit Wajib di isi'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header',$data);
            $this->load->view('Izinsakit/vw_edit_sakit',$data);
            $this->load->view('layout/footer',$data);
            } else {
                $data = [
                    'tgl_izin' => $this->input->post('tgl_izin'),
                    'hingga_tgl' => $this->input->post('hingga_tgl'),
                    'ket_sakit' => $this->input->post('ket_sakit'),
                ];
                $upload_image = $_FILES['file_sakit']['name'];
                if ($upload_image) {
                    // Konfigurasi upload file
                    $config['allowed_types'] = 'gif|jpg|png|pdf';
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './template/assets/img/suratsakit/';
                    
                    // Memuat library upload dengan konfigurasi
                    $this->load->library('upload', $config);
                    
                    if ($this->upload->do_upload('file_sakit')) {
                        // Mendapatkan informasi file lama
                        $old_image = $data['izin_sakit']['file_sakit'];
                        
                        // Menghapus file lama jika bukan file default
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'template/assets/img/suratsakit/' . $old_image);
                        }
                        
                        // Mendapatkan nama file baru yang diupload
                        $new_image = $this->upload->data('file_name');
                        
                        // Mengatur nama file baru ke dalam database
                        $data['file_sakit'] = $new_image;
                    } else {
                        // Menampilkan pesan kesalahan jika upload gagal
                        echo $this->upload->display_errors();
                    }
                }
                
                // Mendapatkan ID dari POST request
                $id = $this->input->post('id');
                
                // Memperbarui data di database melalui model
                $this->PerizinanSakit_model->update(['id' =>$id],$data,$upload_image);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">Data Sakit Berhasil DiUbah!</div>');
                    redirect('PerizinanSakit');
            }
        } 
    public function hapus($id)
{
    $this->PerizinanSakit_model->delete($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
    redirect('PerizinanSakit');
}

        public function approvesakit()
	{
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
        $data['approvesakit'] = $this->PerizinanSakit_model->get();  
        $this->load->view('layout/header',$data);
        $this->load->view('Izinsakit/vw_approve_sakit',$data);
        $this->load->view('layout/footer',$data);
	} 
    public function ubahstatus($id) 
	{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
    $data['izin_sakit'] = $this->PerizinanSakit_model->getById($id);

            $data = [
                'status' => $this->input->post('status'),
                
            ];
            $id = $this->input->post('id');
                $this->PerizinanSakit_model->update(['id' => $id], $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
    role="alert">Data Sakit Berhasil DiUbah!</div>');
                redirect('PerizinanSakit/approve_sakit');
    }
}           
