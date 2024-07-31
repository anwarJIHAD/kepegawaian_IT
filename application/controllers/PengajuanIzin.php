<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PengajuanIzin extends CI_Controller
{
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
		$this->load->view('layout/header', $data);
		$this->load->view('Perizinan/vw_izin', $data);
		$this->load->view('layout/footer', $data);
	}

	public function tambahizin()
	{
		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('waktu_izin', 'waktu_izin', 'required|trim', [
			'required' => 'Waktu Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_waktu', 'hingga_waktu', 'required|trim', [
			'required' => 'Waktu Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('lama_izin', 'lama_izin', 'required|trim', [
			'required' => 'Lama Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('jenis_izin', 'jenis_izin', 'required|trim', [
			'required' => 'Jenis Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('tujuan_izin', 'tujuan_izin', 'required|trim', [
			'required' => 'Tujuan Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('alasan_izin', 'alasan_izin', 'required|trim', [
			'required' => 'Alasan Izin Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Perizinan ';
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$this->load->view('Perizinan/vw_tambah_izin', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$niy = $this->session->userdata('niy');
			$tujuan_izin = htmlspecialchars($this->input->post('tujuan_izin', true));
			if ($tujuan_izin == 'Others') {
				$tujuan_izin = htmlspecialchars($this->input->post('other_input', true));
			}
			$data = [
				'tgl_izin' => htmlspecialchars($this->input->post('tgl_izin', true)),
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
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil ditambahkan!", "Success!", "success");</script>');
			redirect('PengajuanIzin');
		}
	}
	public function editizin($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata('id')])->row_array();
		$data['izin'] = $this->Perizinan_model->getById($id);

		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('waktu_izin', 'waktu_izin', 'required|trim', [
			'required' => 'Waktu Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_waktu', 'hingga_waktu', 'required|trim', [
			'required' => 'Waktu Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('lama_izin', 'lama_izin', 'required|trim', [
			'required' => 'Lama Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('jenis_izin', 'jenis_izin', 'required|trim', [
			'required' => 'Jenis Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('tujuan_izin', 'tujuan_izin', 'required|trim', [
			'required' => 'Tujuan Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('alasan_izin', 'alasan_izin', 'required|trim', [
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
				'waktu_izin' => $this->input->post('waktu_izin'),
				'hingga_waktu' => $this->input->post('hingga_waktu'),
				'lama_izin' => $this->input->post('lama_izin'),
				'jenis_izin' => $this->input->post('jenis_izin'),
				'tujuan_izin' => $tujuan_izin,
				'alasan_izin' => $this->input->post('alasan_izin'),
			];

			$this->Perizinan_model->update(['id' => $izin_id], $data);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil diubah!", "Success!", "success");</script>');
			redirect('PengajuanIzin');
		}
	}

	public function hapus($id)
	{
		$this->Perizinan_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dihapus!", "Success!", "success");</script>');
		redirect('PengajuanIzin');
	}

	public function approveizin()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['approveizin'] = $this->Perizinan_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Perizinan/vw_approveizin', $data);
		$this->load->view('layout/footer', $data);
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
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dikonfirmasi!", "Success!", "success");</script>');
		redirect('PengajuanIzin/approveizin');
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
		$sheet->setCellValue('C4', "Tanggal Izin");
		$sheet->setCellValue('D4', "Waktu Izin");
		$sheet->setCellValue('E4', "Hingga Waktu");
		$sheet->setCellValue('F4', "Lama Izin");
		$sheet->setCellValue('G4', "Tujuan Izin");
		$sheet->setCellValue('H4', "Alasan Izin");
		$sheet->setCellValue('I4', "Status");
		// Apply style header ke masing-masing kolom header
		$sheet->getStyle('A1')->applyFromArray($style_judul);
		$sheet->getStyle('A4:I4')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$numrow = 5; // Start from row 5
		$no = 1;
		$penempatan = $this->Perizinan_model->get();
		foreach ($penempatan as $us) {
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $us['nama']);
			$sheet->setCellValue('C' . $numrow, $us['tgl_izin']);
			$sheet->setCellValue('D' . $numrow, $us['waktu_izin']);
			$sheet->setCellValue('E' . $numrow, $us['lama_izin']);
			$sheet->setCellValue('F' . $numrow, $us['jenis_izin']);
			$sheet->setCellValue('G' . $numrow, $us['tujuan_izin']);
			$sheet->setCellValue('H' . $numrow, $us['alasan_izin']);
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
		$sheet->setTitle("Laporan Data Pengajuan izin");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Pengajuan Izin.xlsx"');
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
