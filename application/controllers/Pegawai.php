<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        is_logged_in();
        $this->load->model('Pegawai_model');
        $this->load->helper(array('url', 'download'));
    }

    public function index()
    {
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
        $data['pegawai_m'] = $this->Pegawai_model->get();
        $this->load->view('layout/header', $data);
        $this->load->view('Pegawai/vw_pegawai', $data);
        $this->load->view('layout/footer', $data);
    }
    public function tambah_pegawai()
    {
        $this->form_validation->set_rules('niy', 'niy', 'required|trim', [
            'required' => 'NIY Wajib di isi'
        ]);
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Nama Wajib di isi'
        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[pegawai.username]', [
            'is_unique' => 'Username ini sudah terdaftar!',
            'required' => 'Username Wajib di isi'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]', [
            'min_length' => 'Password Terlalu Pendek',
            'required' => 'Password harus diisi'
        ]);
        $this->form_validation->set_rules('tmpt_lahir', 'tmpt_lahir', 'required|trim', [
            'required' => 'Tempat lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required|trim', [
            'required' => 'Tanggal lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('pnd_trkhr', 'pnd_trkhr', 'required|trim', [
            'required' => 'Pendidikan Terakhir Wajib di isi'
        ]);
        $this->form_validation->set_rules('tmt_smait', 'tmt_smait', 'required|trim', [
            'required' => 'TMT SMA IT Wajib di isi'
        ]);
        $this->form_validation->set_rules('jurusan', 'jurusan', 'required|trim', [
            'required' => 'Jurusan Wajib di isi'
        ]);
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim', [
            'required' => 'Jabatan Wajib di isi'
        ]);
        $this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
            'required' => 'No handphone Wajib di isi'
        ]);
        $this->form_validation->set_rules('password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data pegawai';
            $data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
            $this->load->view('layout/header', $data);
            $this->load->view('Pegawai/vw_tambah_pegawai', $data);
            $this->load->view('layout/footer', $data);
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
                'status' => htmlspecialchars($this->input->post('status', true)),
            ];
            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil ditambahkan!", "Success!", "success");</script>');
            redirect('Pegawai');
        }
    }
    public function edit_pegawai($id)
    {
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
        $data['pegawai_m'] = $this->Pegawai_model->getById($id);

        $this->form_validation->set_rules('niy', 'niy', 'required|trim', [
            'required' => 'NIY Wajib di isi'
        ]);
        $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
            'required' => 'Nama Wajib di isi'
        ]);
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'Username Wajib di isi'
        ]);
        $this->form_validation->set_rules('tmpt_lahir', 'tmpt_lahir', 'required|trim', [
            'required' => 'Tempat lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required|trim', [
            'required' => 'Tanggal lahir Wajib di isi'
        ]);
        $this->form_validation->set_rules('pnd_trkhr', 'pnd_trkhr', 'required|trim', [
            'required' => 'Pendidikan terakhir Wajib di isi'
        ]);
        $this->form_validation->set_rules('tmt_smait', 'tmt_smait', 'required|trim', [
            'required' => 'TMT SMA IT Wajib di isi'
        ]);
        $this->form_validation->set_rules('jurusan', 'jurusan', 'required|trim', [
            'required' => 'Jurusan Wajib di isi'
        ]);
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim', [
            'required' => 'Jabatan Wajib di isi'
        ]);
        $this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
            'required' => 'No handphone Wajib di isi'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('Pegawai/vw_edit_pegawai', $data);
            $this->load->view('layout/footer', $data);
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
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role'),
                'status' => $this->input->post('status'),
            ];
            $id = $this->input->post('id');
            $this->Pegawai_model->update(['id' => $id], $data);
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil diubah!", "Success!", "success");</script>');
            redirect('Pegawai');
        }
    }

    public function hapus($id)
    {
        $this->Pegawai_model->delete($id);
        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dihapus!", "Success!", "success");</script>');
        redirect('Pegawai');
    }


    public function loadfile()
    {
        if (isset($_FILES['myFile'])) {
            $upload_file = $_FILES['myFile']['name'];
            $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            try {
                $spreadsheet = $reader->load($_FILES['myFile']['tmp_name']);
                $sheetdata = $spreadsheet->getActiveSheet()->toArray();
                $sheetcount = count($sheetdata);
                if ($sheetcount > 1) {
                    $data = array();
                    for ($i = 1; $i < $sheetcount; $i++) {
                        $nama = $sheetdata[$i][0];
                        $niy = $sheetdata[$i][1];
                        $tmpt_lahir = $sheetdata[$i][2];
                        $tgl_lahir = $sheetdata[$i][3];
                        $pnd_trkhr = $sheetdata[$i][4];
                        $tmt_smait = $sheetdata[$i][5];
                        $jurusan = $sheetdata[$i][6];
                        $jabatan = $sheetdata[$i][7];
                        $no_hp = $sheetdata[$i][8];
                        $data[] = array(
                            'nama' => $nama,
                            'niy' => $niy,
                            'tmpt_lahir' => $tmpt_lahir,
                            'tgl_lahir' => $tgl_lahir,
                            'pnd_trkhr' => $pnd_trkhr,
                            'tmt_smait' => $tmt_smait,
                            'jurusan' => $jurusan,
                            'jabatan' => $jabatan,
                            'no_hp' => $no_hp,
                        );
                    }
                    $inserdata = $this->Pegawai_model->insert_batch($data);
                    if ($inserdata) {
                        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
                        redirect('Pegawai');
                    } else {
                        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Cannot add the data!", "Error!", "error");</script>');
                        redirect('Pegawai');
                    }
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('message', '<script type="text/javascript">swal("Error loading file: File Kosong", "Error!", "error");</script>');
                redirect('Pegawai');
                // echo "Error loading file: " . $e->getMessage();
            }
        } else {
            $error = isset($_FILES['file']['error']) ? $_FILES['file']['error'] : 'File not uploaded.';
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("' . $error . '", "Error!", "error");</script>');
            redirect('Pegawai');
        }
    }
    public function getTemplate()
    {
        force_download('./template/assets/datapegawai.xlsx', NULL);
    }
    public function ubahstatus($id)
    {
        $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
        $data['pegawai'] = $this->Pegawai_model->getById($id);

        $data = [
            'status' => $this->input->post('status'),

        ];
        $id = $this->input->post('id');
        $this->Pegawai_model->update(['id' => $id], $data);
        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
        redirect('Pegawai');
    }
}
