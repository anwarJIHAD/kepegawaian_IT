<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Lembur extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Lembur_model');
		$this->load->model('Pegawai_model');
	}

	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['lembur'] = $this->Lembur_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Lembur/vw_lembur', $data);
		$this->load->view('layout/footer', $data);
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
			$data['pegawai_data'] = $this->Pegawai_model->get();
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$this->load->view('Lembur/vw_tambah_lembur', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$data = [
				'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
				'masuk' => htmlspecialchars($this->input->post('masuk', true)),
				'pulang' => htmlspecialchars($this->input->post('pulang', true)),
				'lama_lembur' => htmlspecialchars($this->input->post('lama_lembur', true)),
				'ket_lembur' => htmlspecialchars($this->input->post('ket_lembur', true)),
				'niy' => htmlspecialchars($this->input->post('niy', true)),
				'status' => 'Diajukan',
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
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil diubah!", "Success!", "success");</script>');
			redirect('Lembur');
		}
	}

	public function hapus($id)
	{
		$this->Lembur_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dihapus!", "Success!", "success");</script>');
		redirect('Lembur');
	}

	public function approvelembur()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['approve_lembur'] = $this->Lembur_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Lembur/vw_approve_lembur', $data);
		$this->load->view('layout/footer', $data);
	}
	public function ubahstatus($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['lembur'] = $this->Lembur_model->getById($id);

		$data = [
			'status' => $this->input->post('status'),
		];
		$id = $this->input->post('id');
		$this->Lembur_model->update(['id' => $id], $data);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dikonfirmasi!", "Success!", "success");</script>');
		redirect('Lembur/approvelembur');
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
		$sheet->setCellValue('A1', "Laporan Data Lembur");
		$sheet->mergeCells('A1:H1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		// Buat header tabel pada baris ke 4
		$sheet->setCellValue('A4', "NO");
		$sheet->setCellValue('B4', "NAMA");
		$sheet->setCellValue('C4', "WAKTU MASUK");
		$sheet->setCellValue('D4', "WAKTU PULANG");
		$sheet->setCellValue('E4', "LAMA_LEMBUR");
		$sheet->setCellValue('F4', "TANGGAL");
		$sheet->setCellValue('G4', "KETERANGAN");
		$sheet->setCellValue('H4', "STATUS");
		// Apply style header ke masing-masing kolom header
		$sheet->getStyle('A1')->applyFromArray($style_judul);
		$sheet->getStyle('A4:H4')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$numrow = 5; // Start from row 5
		$no = 1;
		$penempatan = $this->Lembur_model->get();
		foreach ($penempatan as $us) {
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $us['nama']);
			$sheet->setCellValue('C' . $numrow, $us['masuk']);
			$sheet->setCellValue('D' . $numrow, $us['pulang']);
			$sheet->setCellValue('E' . $numrow, $us['lama_lembur']);
			$sheet->setCellValue('F' . $numrow, $us['tanggal']);
			$sheet->setCellValue('G' . $numrow, $us['ket_lembur']);
			$sheet->setCellValue('H' . $numrow, $us['status']);
			$sheet->getStyle('A' . $numrow . ':H' . $numrow)->applyFromArray($style_row);
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

		// Set height semua kolom menjadi auto
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel
		$sheet->setTitle("Laporan Data Lembur");

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan_Data_Lembur.xlsx"');
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
