<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PerizinanSakit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PerizinanSakit_model');
		$this->load->model('Notifikasi_model');
		$this->load->model('Absensi_model');
		function generateDateRange($startDate, $endDate)
		{
			$period = new DatePeriod(
				new DateTime($startDate),
				new DateInterval('P1D'),
				(new DateTime($endDate))->modify('+1 day')
			);

			$dates = [];
			foreach ($period as $date) {
				$dates[] = $date->format('Y-m-d');
			}

			return $dates;
		}
	}

	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_sakit'] = $this->PerizinanSakit_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Izinsakit/vw_izin_sakit', $data);
		$this->load->view('layout/footer', $data);
	}

	public function tambahsakit()
	{
		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim', [
			'required' => 'Tanggal Wajib di isi'
		]);
		$this->form_validation->set_rules('ket_sakit', 'ket_sakit', 'required|trim', [
			'required' => 'Keterangan Sakit Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Perizinan Sakit';
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$this->load->view('Izinsakit/vw_tambah_sakit', $data);
			$this->load->view('layout/footer', $data);
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
			$izin_id = $this->db->insert_id();
			$notif = [
				'niy' => $niy,
				'message' => $this->session->userdata('nama') . ' Mengajukan surat sakit',
				'created_at' => date('Y-m-d H:i:s'),
				'jenis' => 'Surat Sakit',
				'izin_sakit_id' => $izin_id, // Menyimpan ID izin ke dalam notifikasi
			];
			$this->Notifikasi_model->insert($notif);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil ditambahkan!", "Success!", "success");</script>');
			redirect('PerizinanSakit');
		}
	}

	public function editsakit($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_sakit'] = $this->PerizinanSakit_model->getById($id);
		$this->form_validation->set_rules('file_sakit', 'File Sakit', 'callback_file_check'); // Example callback for file validation
		if ($this->form_validation->run() == false) {
			$this->load->view('layout/header', $data);
			$this->load->view('Izinsakit/vw_edit_sakit', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$data = [];
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
			$this->PerizinanSakit_model->update(['id' => $id], $data, $upload_image);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil diubah!", "Success!", "success");</script>');
			redirect('PerizinanSakit');
		}
	}
	public function file_check($str)
	{
		// Custom file validation logic
		if (empty($_FILES['file_sakit']['name'])) {
			$this->form_validation->set_message('file_check', 'The {field} field is required.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function hapus($id)
	{
		$this->PerizinanSakit_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dihapus!", "Success!", "success");</script>');
		redirect('PerizinanSakit');
	}

	public function approvesakit()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['approvesakit'] = $this->PerizinanSakit_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Izinsakit/vw_approve_sakit', $data);
		$this->load->view('layout/footer', $data);
	}
	public function ubahstatus($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_sakit'] = $this->PerizinanSakit_model->getById($id);
		// var_dump($data['izin_sakit']);
		// die;

		$data = [
			'status' => $this->input->post('status'),
		];
		$status = $this->input->post('status');
		$izin = $this->PerizinanSakit_model->getById($id);
		if ($status == 'Disetujui') {

			$tanggal_mulai = $izin['tgl_izin'];
			$tanggal_selesai = $izin['hingga_tgl'];
			$dates = generateDateRange($tanggal_mulai, $tanggal_selesai);

			$sakit = array();
			foreach ($dates as $tanggal) {
				$absen = $this->Absensi_model->byDate($izin['niy'], $tanggal);
				if (!$absen) {
					$sakit[] = array(
						'niy' => $izin['niy'],
						'tanggal' => $tanggal,
						'status' => 'Tidak Hadir',
						'keterangan' => 'Izin Sakit ',
					);
				}
			}

			if (!empty($sakit)) {
				$this->Absensi_model->insert($sakit);
			}
		}

		$id = $this->input->post('id');
		$this->PerizinanSakit_model->update(['id' => $id], $data);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dikonfirmasi!", "Success!", "success");</script>');
		redirect('PerizinanSakit/approvesakit');
	}
	public function export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
			'font' => ['bold' => true],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
			]
		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
			]
		];
		//style judul
		$style_judul = [
			'font' => ['bold' => true, 'size' => 15],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			]
		];
		$sheet->setCellValue('A1', "Laporan Data Izin Sakit");
		$sheet->mergeCells('A1:H1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		// Buat header tabel pada baris ke 4
		$sheet->setCellValue('A4', "NO");
		$sheet->setCellValue('B4', "Nama Pegawai");
		$sheet->setCellValue('C4', "Tanggal Izin");
		$sheet->setCellValue('D4', "Hingga Tanggal");
		$sheet->setCellValue('E4', "Keterangan");
		$sheet->setCellValue('F4', "Status");

		// Apply style header ke masing-masing kolom header
		$sheet->getStyle('A1')->applyFromArray($style_judul);
		$sheet->getStyle('A4:F4')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$numrow = 5; // Start from row 5
		$no = 1;
		$penempatan = $this->PerizinanSakit_model->get();
		foreach ($penempatan as $us) {
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $us['nama']);
			$sheet->setCellValue('C' . $numrow, $us['tgl_izin']);
			$sheet->setCellValue('D' . $numrow, $us['hingga_tgl']);
			$sheet->setCellValue('E' . $numrow, $us['ket_sakit']);
			$sheet->setCellValue('F' . $numrow, $us['status']);
			$sheet->getStyle('A' . $numrow . ':F' . $numrow)->applyFromArray($style_row);
			$numrow++;
			$no++;
		}

		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(15);
		$sheet->getColumnDimension('C')->setWidth(25);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(20);
		$sheet->getColumnDimension('F')->setWidth(20);


		// Set height semua kolom menjadi auto
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel
		$sheet->setTitle("Laporan Data Pengajuan Sakit");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Pengajuan Sakit.xlsx"');
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
