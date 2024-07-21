<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PerizinanCuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PerizinanCuti_model');
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
		$data['izin_cuti'] = $this->PerizinanCuti_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Izincuti/vw_izin_cuti', $data);
		$this->load->view('layout/footer', $data);
	}

	public function tambahcuti()
	{
		$this->form_validation->set_rules('jenis_cuti', 'jenis_cuti', 'required|trim', [
			'required' => 'Jenis Cuti Wajib di isi'
		]);
		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
			'required' => 'No Handphone Wajib di isi'
		]);
		$this->form_validation->set_rules('pemilik_nohp', 'pemilik_nohp', 'required|trim', [
			'required' => 'Pemilik No Hp Wajib di isi'
		]);
		$this->form_validation->set_rules('ket_cuti', 'ket_cuti', 'required|trim', [
			'required' => 'Keterangan Cuti Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Perizinan Cuti';
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$this->load->view('Izincuti/vw_tambah_cuti', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$niy = $this->session->userdata('niy');
			$data = [
				'jenis_cuti' => htmlspecialchars($this->input->post('jenis_cuti', true)),
				'tgl_izin' => htmlspecialchars($this->input->post('tgl_izin', true)),
				'hingga_tgl' => htmlspecialchars($this->input->post('hingga_tgl', true)),
				'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
				'pemilik_nohp' => htmlspecialchars($this->input->post('pemilik_nohp', true)),
				'ket_cuti' => htmlspecialchars($this->input->post('ket_cuti', true)),
				'niy' => $niy,
				'status' => 'Diajukan',
			];

			// print_r($this->session->userdata());

			$this->PerizinanCuti_model->insert($data);
			$izin_id = $this->db->insert_id();

			$notif = [
				'niy' => $niy,
				'message' => $this->session->userdata('nama') . ' Mengajukan surat cuti',
				'created_at' => date('Y-m-d H:i:s'),
				'jenis' => 'Surat Cuti',
				'izin_cuti_id' => $izin_id

			];
			$this->Notifikasi_model->insert($notif);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil ditambahkan!", "Success!", "success");</script>');
			redirect('PerizinanCuti');
		}
	}
	public function editcuti($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_cuti'] = $this->PerizinanCuti_model->getById($id);

		$this->form_validation->set_rules('jenis_cuti', 'jenis_cuti', 'required|trim', [
			'required' => 'Jenis Cuti Wajib di isi'
		]);
		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
			'required' => 'No Handphone Wajib di isi'
		]);
		$this->form_validation->set_rules('pemilik_nohp', 'pemilik_nohp', 'required|trim', [
			'required' => 'Pemilik No Hp Wajib di isi'
		]);
		$this->form_validation->set_rules('ket_cuti', 'ket_cuti', 'required|trim', [
			'required' => 'Keterangan Cuti Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('layout/header', $data);
			$this->load->view('Izincuti/vw_edit_cuti', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$data = [
				'jenis_cuti' => $this->input->post('jenis_cuti'),
				'tgl_izin' => $this->input->post('tgl_izin'),
				'hingga_tgl' => $this->input->post('hingga_tgl'),
				'no_hp' => $this->input->post('no_hp'),
				'pemilik_nohp' => $this->input->post('pemilik_nohp'),
				'ket_cuti' => $this->input->post('ket_cuti'),
			];
			$id = $this->input->post('id');
			$this->PerizinanCuti_model->update(['id' => $id], $data);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil diubah!", "Success!", "success");</script>');
			redirect('PerizinanCuti');
		}
	}

	public function hapus($id)
	{
		$this->PerizinanCuti_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dihapus!", "Success!", "success");</script>');
		redirect('PerizinanCuti');
	}

	public function approvecuti()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['approvecuti'] = $this->PerizinanCuti_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Izincuti/vw_approvecuti', $data);
		$this->load->view('layout/footer', $data);
	}

	public function ubahstatus($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_cuti'] = $this->PerizinanCuti_model->getById($id);

		$status = $this->input->post('status');
		$data = [
			'status' => $status,
			'ket_kepsek' => $this->input->post('ket_kepsek'),
		];

		$izin = $this->PerizinanCuti_model->getById($id);
		if ($status == 'Diterima') {

			$tanggal_mulai = $izin['tgl_izin'];
			$tanggal_selesai = $izin['hingga_tgl'];
			$dates = generateDateRange($tanggal_mulai, $tanggal_selesai);
			// var_dump($dates);
			// die;
			$cuti = array();
			foreach ($dates as $tanggal) {
				$absen = $this->Absensi_model->byDate($izin['niy'], $tanggal);
				if (!$absen) {
					$cuti[] = array(
						'niy' => $izin['niy'],
						'tanggal' => $tanggal,
						'status' => 'Tidak Hadir',
						'keterangan' => $izin['jenis_cuti'],
					);
				}
			}
			if (!empty($cuti)) {
				$this->Absensi_model->insert($cuti);
			}
		}
		$id = $this->input->post('id');
		$this->PerizinanCuti_model->update(['id' => $id], $data);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
		redirect('PerizinanCuti/approvecuti');
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
		$sheet->setCellValue('A1', "Laporan Data Pengajuan Izin");
		$sheet->mergeCells('A1:H1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		// Buat header tabel pada baris ke 4
		$sheet->setCellValue('A4', "NO");
		$sheet->setCellValue('B4', "Nama Pegawai");
		$sheet->setCellValue('C4', "Jenis Cuti");
		$sheet->setCellValue('D4', "Tanggal Izin");
		$sheet->setCellValue('E4', "Hingga Tanggal");
		$sheet->setCellValue('F4', "No Hp Selama Izin");
		$sheet->setCellValue('G4', "Pemilik No Hp");
		$sheet->setCellValue('H4', "Keterangan Cuti");
		$sheet->setCellValue('I4', "Status");
		// Apply style header ke masing-masing kolom header
		$sheet->getStyle('A1')->applyFromArray($style_judul);
		$sheet->getStyle('A4:I4')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$numrow = 5; // Start from row 5
		$no = 1;
		$penempatan = $this->PerizinanCuti_model->get();
		foreach ($penempatan as $us) {
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $us['nama']);
			$sheet->setCellValue('C' . $numrow, $us['jenis_cuti']);
			$sheet->setCellValue('D' . $numrow, $us['tgl_izin']);
			$sheet->setCellValue('E' . $numrow, $us['hingga_tgl']);
			$sheet->setCellValue('F' . $numrow, $us['no_hp']);
			$sheet->setCellValue('G' . $numrow, $us['pemilik_nohp']);
			$sheet->setCellValue('H' . $numrow, $us['ket_cuti']);
			$sheet->setCellValue('I' . $numrow, $us['status']);
			$sheet->getStyle('A' . $numrow . ':I' . $numrow)->applyFromArray($style_row);
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
		$sheet->getColumnDimension('G')->setWidth(20);
		$sheet->getColumnDimension('H')->setWidth(20);
		$sheet->getColumnDimension('I')->setWidth(20);

		// Set height semua kolom menjadi auto
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel
		$sheet->setTitle("Laporan Data Pengajuan Cuti");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Pengajuan Cuti.xlsx"');
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
