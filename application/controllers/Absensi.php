<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
        $this->load->helper(array('url','download'));	
		$this->load->model('Absensi_model');
	}

	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['absensi'] = $this->Absensi_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Absensi/vw_absensi', $data);
		$this->load->view('layout/footer', $data);
	}
	public function upload()
	{
		// Debugging: Lihat isi dari $_FILES
		if (isset($_FILES['excelFile'])) {
			$upload_file = $_FILES['excelFile']['name'];
			$extension = pathinfo($upload_file, PATHINFO_EXTENSION);

			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else if ($extension == 'xls') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			try {
				$spreadsheet = $reader->load($_FILES['excelFile']['tmp_name']);

				$sheetdata = $spreadsheet->getActiveSheet()->toArray();
				$sheetcount = count($sheetdata);

				date_default_timezone_set('Asia/Jakarta');
				$currentDateTime = new DateTime();
				$formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

				if ($sheetcount > 1) {
					$data = array();
					for ($i = 1; $i < $sheetcount; $i++) {
						$niy = $sheetdata[$i][0];
						$nama = $sheetdata[$i][1];
						$tanggal = $sheetdata[$i][2];
						$waktu_masuk = $sheetdata[$i][3];
						$waktu_pulang = $sheetdata[$i][4];
						$telat = $sheetdata[$i][5];
						$pulang_awal = $sheetdata[$i][6];
						$waktu_kerja = $sheetdata[$i][7];
						$status = $sheetdata[$i][8];
						$keterangan = $sheetdata[$i][9];
						$mulai_lembur = $sheetdata[$i][10];
						$selesai_lembur = $sheetdata[$i][11];
						$total_lembur = $sheetdata[$i][12];

						$data[] = array(
							'niy' => $niy,
							'tanggal' => $tanggal,
							'waktu_datang' => $waktu_masuk,
							'waktu_pulang' => $waktu_pulang,
							'pulang_awal' => $pulang_awal,
							'waktu_kerja' => $waktu_kerja,
							'status' => $status,
							'keterangan' => $keterangan,

						);
					}
					// var_dump($data);
					// die;
					$inserdata = $this->Absensi_model->insert($data);
					if ($inserdata) {
						$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
						redirect('Absensi');
					} else {
						$this->session->set_flashdata('message', '<script type="text/javascript">swal("Cannot add the data!", "Error!", "error");</script>');
						redirect('Absensi');
					}
				}
			} catch (Exception $e) {
				echo "Error loading file: " . $e->getMessage();
			}
		} else {
			$error = isset($_FILES['file']['error']) ? $_FILES['file']['error'] : 'File not uploaded.';
			echo "Upload failed with error: " . $error;
		}
	}


	public function tambah_absensi()
	{
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|trim', [
			'required' => 'Tanggal Wajib di isi'
		]);
		$this->form_validation->set_rules('masuk', 'masuk', 'required|trim', [
			'required' => 'Masuk Wajib di isi'
		]);
		$this->form_validation->set_rules('pulang', 'pulang', 'required|trim', [
			'required' => 'Pulang Wajib di isi'
		]);
		$this->form_validation->set_rules('lama_lembur', 'lama_lembur', 'required|trim', [
			'required' => 'Lama Lembur Wajib di isi'
		]);
		$this->form_validation->set_rules('ket_lembur', 'ket_lembur', 'required|trim', [
			'required' => 'Keterangan Lembur Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Lembur';
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$this->load->view('Lembur/vw_tambah_lembur', $data);
			$this->load->view('layout/footer', $data);
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
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil ditambahkan!", "Success!", "success");</script>');
			redirect('Lembur');
		}

	}
	public function edit_absensi($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['absensi'] = $this->Absensi_model->getById($id);
		// $this->form_validation->set_rules('nama', 'nama', 'required|trim', [
		// 	'required' => 'nama Wajib di isi'
		// ]);
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|trim', [
			'required' => 'tanggal Wajib di isi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('layout/header', $data);
			$this->load->view('Absensi/vw_edit_absensi', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$data = [
				'niy' => $this->input->post('niy'),
				'tanggal' => $this->input->post('tanggal'),
				'waktu_datang' => $this->input->post('waktu_datang'),
				'waktu_pulang' => $this->input->post('waktu_pulang'),
				'pulang_awal' => $this->input->post('pulang_awal'),
				'waktu_kerja' => $this->input->post('waktu_kerja'),
				'status' => $this->input->post('status'),
				'keterangan' => $this->input->post('keterangan'),
			];
			$id = $this->input->post('id');
			$this->Absensi_model->update(['id' => $id], $data);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
			redirect('Absensi');
		}
	}

	public function hapus($id)
	{
		$this->Absensi_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
		redirect('Absensi');
	}
	public function getTemplate()
	{
		force_download('./template/assets/template_absensi.xlsx', NULL);
	}
}
