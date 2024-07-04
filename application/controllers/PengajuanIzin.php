<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanIzin extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            is_logged_in();
            date_default_timezone_set('Asia/Jakarta');
            $this->load->model('Perizinan_model');
            $this->load->model('Notifikasi_model');
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
                    $this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
                        'required' => 'Tanggal Izin Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim', [
                        'required' => 'Tanggal Izin Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('waktu_izin', 'waktu_izin', 'required|trim', [
                        'required' => 'Waktu Izin Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('hingga_waktu', 'hingga_waktu', 'required|trim', [
                        'required' => 'Waktu Izin Wajib di isi'
                    ]);
                    $this->form_validation->set_rules('lama_izin', 'lama_izin', 'required|trim',[
                        'required' => 'Lama Izin Wajib di isi'
                    ]);
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
                        'tgl_izin' => htmlspecialchars($this->input->post('tgl_izin', true)),
                        'hingga_tgl' => htmlspecialchars($this->input->post('hingga_tgl', true)),
                        'waktu_izin' => htmlspecialchars($this->input->post('waktu_izin', true)),
                        'hingga_waktu' => htmlspecialchars($this->input->post('hingga_waktu', true)),
                        'lama_izin' => htmlspecialchars($this->input->post('lama_izin', true)),
                        'jenis_izin' => htmlspecialchars($this->input->post('jenis_izin', true)),
                        'tujuan_izin' => $tujuan_izin,
                        'alasan_izin' => htmlspecialchars($this->input->post('alasan_izin', true)),
                        'niy' => $niy,
                        'status' => 'Diajukan',
                    ];
                    
                    // print_r($this->session->userdata());
                    
                    $this->Perizinan_model->insert($data);
                    $izin_id = $this->db->insert_id();
                    $notif = [
                        'niy' => $niy,
                        'message' => $this->session->userdata('nama') . ' Mengajukan surat izin', 
                        'created_at' => date('Y-m-d H:i:s'),
                        'jenis' => 'Surat Izin',
                        'izin_id' => $izin_id, // Menyimpan ID izin ke dalam notifikasi
                    ];
                    $this->Notifikasi_model->insert($notif);
                    $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
                    redirect('PengajuanIzin');
                }    
}
public function editizin($id) 
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata('id')])->row_array();
    $data['izin'] = $this->Perizinan_model->getById($id);

    $this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim',[
        'required' => 'Tanggal Izin Wajib di isi'
    ]);
    $this->form_validation->set_rules('waktu_izin', 'waktu_izin', 'required|trim',[
        'required' => 'Waktu Izin Wajib di isi'
    ]);
    $this->form_validation->set_rules('lama_izin', 'lama_izin', 'required|trim',[
        'required' => 'Lama Izin Wajib di isi'
    ]);
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
            'tgl_izin' => $this->input->post('tgl_izin'),
            'hingga_tgl' => $this->input->post('hingga_tgl'),
            'waktu_izin' => $this->input->post('waktu_izin'),
            'hingga_waktu' => $this->input->post('hingga_waktu'),
            'lama_izin' => $this->input->post('lama_izin'),
            'jenis_izin' => $this->input->post('jenis_izin'),
            'tujuan_izin' =>   $tujuan_izin,
            'alasan_izin' => $this->input->post('alasan_izin'),
        ];
        
        $this->Perizinan_model->update(['id' => $izin_id], $data);
        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
        redirect('PengajuanIzin');
    }
}
    
    public function hapus($id)
    {
        $this->Perizinan_model->delete($id);
        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
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
                $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
                redirect('PengajuanIzin/approveizin');
    }
} 
