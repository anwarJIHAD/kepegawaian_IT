<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
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
			$upload_file = $_FILES['myFile']['name'];
			$extension = pathinfo($upload_file, PATHINFO_EXTENSION);
			var_dump($extension);
			die;
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

				date_default_timezone_set('Asia/Jakarta');
				$currentDateTime = new DateTime();
				$formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

				if ($sheetcount > 1) {
					$data = array();
					for ($i = 1; $i < $sheetcount; $i++) {
						$id_alat = $sheetdata[$i][0];
						$datetime = $sheetdata[$i][1];
						$latitude = $sheetdata[$i][2];
						$langitude = $sheetdata[$i][3];
						$pm25 = $sheetdata[$i][4];
						$speed = $sheetdata[$i][5];
						$elevation = $sheetdata[$i][6];
						$distance = $sheetdata[$i][7];
						$bpm = $sheetdata[$i][8];
						$sign = $sheetdata[$i][9];

						$data[] = array(
							'id_alat' => $id_alat,
							'datetime' => $datetime,
							'latitude' => $latitude,
							'langitude' => $langitude,
							'pm25' => $pm25,
							'speed' => $speed,
							'elevation' => $elevation,
							'distance' => $distance,
							'bpm' => $bpm,
							'sign' => $sign,
							'date_create' => $formattedDateTime,
						);
					}
					// var_dump($data);
					// die;
					$inserdata = $this->db_sensor->insert($data);
					if ($inserdata) {
						$this->session->set_flashdata('message', '<script type="text/javascript">swall("Good job!", "Success!", "success");</script>');
						redirect('C_visual');
					} else {
						$this->session->set_flashdata('message', '<script type="text/javascript">swall("Cannot add the data!", "Error!", "error");</script>');
						redirect('C_Visual');
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


	public function tambah_lembur()
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
	public function edit_lembur($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['lembur'] = $this->Lembur_model->getById($id);
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
			$this->load->view('layout/header', $data);
			$this->load->view('Lembur/vw_edit_lembur', $data);
			$this->load->view('layout/footer', $data);
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
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
			redirect('Lembur');
		}
	}

	public function hapus($id)
	{
		$this->Lembur_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
		redirect('Lembur');
	}
}
